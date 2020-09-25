<template>
<div>
  <div class="row">
    <div class="col-12">
      <card type="chart" style="
    border-bottom-width: 3px;
    border-bottom-color: #FDB913;
    border-bottom-style: inset;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
">
        <template slot="header">
          <h5 class="card-category">
            {{$t('dashboard.filter')}}
            <slot name="header"></slot>
            <slot name="close-button">
              <button
                type="button"
                class="close"
                @click="detailsFilter = !detailsFilter"
                aria-label="Close"
              >
                <i class="tim-icons icon-simple-remove" style="color: #000;"></i>
              </button>
            </slot>
            <slot name="header"></slot>
            <slot name="close-button">
              <button type="button" class="close" aria-label="Filtro avanzado">
                <i class="tim-icons icon-align-left-2" style="color: #000; margin-right: 10px;"></i>
              </button>
            </slot>

            <!-- <button @click="detailsFilter = !detailsFilter">Filtros Detalles</button> -->
          </h5>
        </template>
        <div v-show="detailsFilter" class="form">
          <div class="row">
            <div class="col-md-4">
              <!-- Select Tipo de Marcas -->
              <label>
                <span class="required">*</span> Marcas
              </label>
              <select class="form-control" v-model="marcaSelected" @change="SendFilter">
                <option value="Todas">Todas</option>
                <option v-for="item in marcas" v-bind:value="item.id">{{ item.nombremarca }}</option>
              </select>
            </div>
            <div class="col-md-4">
              <!-- Select Tipo de Colores -->
              <label>
                <span class="required">*</span> Color
              </label>
              <select class="form-control" v-model="colorSelected" @change="SendFilter">
                <option value="Todas">Todas</option>
                <option v-for="item in colores" v-bind:value="item.id">{{ item.nombrecolorauto }}</option>
              </select>
            </div>
           <div class="col-md-4">
              <!-- Select Tipo de Año -->
              <label>
                <span class="required">*</span> Año de la versión
              </label>
              <select class="form-control" v-model="annoSelected" @change="SendFilter">
                <option value="Todas">Todas</option>
                <option v-for="item in anno" v-bind:value="item.anno">{{ item.anno }}</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <label>
                <span class="required">*</span> Precio
              </label>
              <input
                type="text"
                class="form-control"
                v-model="precio"
                @keyup="SendFilter"
                id="price"
                placeholder="Max"
              />
            </div>
          </div>
        </div>
      </card>
    </div>
  </div>    
     <list-car-fav :autos="autos" :not_found="no_encontrado" @triggerFromChild="triggerChildRecived"></list-car-fav> 
    </div>
</template>
<script>
import config from "../config";
import axios from "axios";
import ListCarFav  from "./ListCarFav";
import NotificationTemplate from '../pages/Notifications/NotificationTemplate';
import BaseAlert  from './BaseAlert';

const URL_API_SUBASTA = config.url_api.URL_API_SUBASTA;
const URL_API_CENTRAL = config.url_api.URL_API_CENTRAL;
/**
 * Arma la URL de el servicio
 */
function buildURL(api, resource = "") {
  if (api == "URL_API_CENTRAL") {
    return URL_API_CENTRAL + resource;
  } else {
    return URL_API_SUBASTA + resource;
  }
}
export default {
  name: "filter-car-fav",
   props: {
    tipoventaSend: {},
    favorite_res: "",
   not_found:""
  },
  data() {
    return {
      name_app: localStorage.getItem('name_app'), 
      no_encontrado: this.not_found,
      email:"",
      autos: [],
      searchModalVisible: false,
      marcas: [],
      anno: [],
      colores: [],
      filtroRequest: {
        marca_id: "",
        categoria_id: "",
        color_id: "",
        precio: "",
      },
      marcaSelected: "Todas",
      colorSelected: "Todas",
      annoSelected: "Todas",
      precio: "",

      pagination: {},
      detailsFilter: true,
      
    };
  },
  components: {
    ListCarFav,
    BaseAlert
  },
  created() {
    this.fetchMarcas();
    this.fetchAnno();
    this.fetchColores();
    this.SendFilter();
   
  },
  methods: {
    triggerChildRecived(value){
      if(value == '1'){
         this.SendFilter();
      }else{
         
      }
  
    },
    /**
     * Realiza la paginacion
     */
    makePagination(current_page, last_page, next_page_url, prev_page_url) {
      let pagination = {
        current_page: current_page,
        last_page: last_page,
        next_page_url: next_page_url,
        prev_page_url: prev_page_url
      };
      this.pagination = pagination;
    },
    checkFav(id) {
       this.email =localStorage.getItem('email');
      let result =[];
      axios.post(buildURL("URL_API_SUBASTA", "check-fav/" + id),{'email': this.email}
        ).then((res) =>{
         
        if(res.data == true){
      result.push(true); 
        }else{
      result.push(false);  
        }
        
        });
        return result;
       
        
    },
    /**
     * filtro basico
     */
    SendFilter() {
      this.email =localStorage.getItem('email');
     this.autos=[];
      axios
        .get(buildURL("URL_API_SUBASTA", "showroomfav"), {
          params: {
            marca: this.marcaSelected,
            color: this.colorSelected,
            anno: this.annoSelected,
            precio: this.precio,
            email: this.email,
          }
        })
        .then((res) => {
          
          let autos = [];
          
          for (let i = 0; i < res.data.data.length; i++) {

            if(res.data.data[i].tramite[0] == undefined){

            }else{
 autos = {
              id: res.data.data[i].id,
              foto:res.data.data[i].fotos,
              tramite:res.data.data[i].tramite,
              nombremodeloauto: res.data.data[i].nombremodeloauto,
              precioventametrica: res.data.data[i].tramite[0] == undefined ? '0' : res.data.data[i].tramite[0].parametrizacion[0].preciolista,
              marca: res.data.data[i].nombremarca,
              anno: res.data.data[i].anno,
              kminicial: res.data.data[i].kminicial,
              tipotransmision: res.data.data[i].tipotransmision,
              fav_status: this.checkFav(res.data.data[i].id),
              tipoventa: res.data.data[i].categoriaventa,
              subasta: res.data.data[i].subasta,             
              venta: res.data.data[i].ventaDirecta,  
             
            };
            
            this.autos.push(autos);
            this.no_encontrado = false;
            }
           
           
     
           
          
          }

          
        })
        .catch((err) =>{
          if (err.response.status === 401) {
            this.errors = err.response.data;
            this.isProcessing = false;
            this.no_encontrado = true;
        this.$notify({
          message: this.errors,
          title: this.name_app,
          component: NotificationTemplate,
          icon: "tim-icons icon-bell-55",
          type: 'warning',
          timeout: 4000
        });
          }
        });
    },
    /**
     * Obtiene las Categorias
     */
    fetchAnno() {
      axios
        .get(buildURL("URL_API_SUBASTA", "listAnno"))
        .then((res) => {
          this.$data.anno = res.data.data;
          
        })
        .catch((err) => console.log(err));
    },

    /**
     * Obtiene los Colores
     */
    fetchColores() {
      axios
        .get(buildURL("URL_API_SUBASTA", "listColores"))
        .then((res) => {
          this.$data.colores = res.data.data;
        })
        .catch((err) => console.log(err));
    },

    /**
     * Obtiene los Tipos de Trasmision
     */
    fetchTipoTransmision() {
      axios
        .get(buildURL("URL_API_SUBASTA", "listTipoTransmision"))
        .then(res => {
          this.$data.colores = res.data;
        })
        .catch(err => console.log(err));
    },

    /**
     * Obtiene los Tipos de Combustibles
     */
    fetchTiposCombustibles() {
      axios
        .get(buildURL("URL_API_SUBASTA", "listTiposCombustibles"))
        .then(res => {
          this.$data.tipo_de_combustibles = res.data;
        })
        .catch(err => console.log(err));
    },

    /**
     * Obtiene los paises
     */
    fetchPaises() {
      axios
        .get(buildURL("URL_API_SUBASTA", "listPaises"))
        .then(res => {
          this.$data.paises = res.data;
        })
        .catch(err => console.log(err));
    },

    /**
     * Obtiene los Estados Territoriales
     */
    fetchEstadosTerritoriales() {
      let pais_id = 1;
      axios
        .get(buildURL("URL_API_SUBASTA", "listEstadosTerritoriales"))
        .then(res => {
          this.$data.estados_territoriales = res.data;
        })
        .catch(err => console.log(err));
    },

    /**
     * Obtiene los años
     */
    fetchVersionesAutos() {
      axios
        .get(buildURL("URL_API_SUBASTA", "listVersionesAutos"))
        .then(res => {
          this.$data.annos = res.data;
        })
        .catch(err => console.log(err));
    },

    /**
     * Obtiene las Marcas
     */
    fetchMarcas() {
      axios
        .get(buildURL("URL_API_SUBASTA", "listMarcas"))
        .then(res => {
          this.$data.marcas = res.data.data;
        })
        .catch(err => console.log(err));
    },
    /**
     * Obtiene el listado de autos
     */
    fetchModelosAutos() {
      let marca_id =
        this.filtroRequest.marca_id == "" ? 1 : this.filtroRequest.marca_id;
      axios
        .get(buildURL("URL_API_SUBASTA", "listModelosAutos/" + marca_id))
        .then(res => {
          this.$data.modelos = res.data;
        })
        .catch(err => console.log(err));
    }
  }
};
</script>
<style>
/* select option {
  background-color: #27293d;
} */
</style>