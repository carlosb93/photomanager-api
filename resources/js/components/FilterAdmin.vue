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
              <!-- Select Tipo de Categorias -->
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
             <div class="col-md-6">
              <!-- Select Tipo de Categorias -->
              <label>
                <span class="required">*</span> Categorias de Venta
              </label>
              <select class="form-control" @change="SendFilter">
                <option v-bind:value="this.categoriav.id">{{ this.categoriav.nombre }}</option>
              </select>
            </div>
            <div class="col-md-6">
              <label>
                <span class="required">*</span> VIN
              </label>
              <input
                type="text"
                class="form-control"
                v-model="vin"
                @keyup="SendFilter"
                id="vin"
                placeholder="Codigo VIN del vehiculo"
              />
            </div>
          </div>
        </div>
      </card>
    </div>
  </div>    
      <list-car-admin :autos="autos" @triggerFromChild2="triggerChildRecived"></list-car-admin>  
    </div>
</template>
<script>
import config from "../config";
import axios from "axios";
import  ListCarAdmin  from "./ListCarAdmin";

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
   props: {
    categoriav: {}
   },
  name: "filter-admin",
  data() {
    return {
      autos: [],
      searchModalVisible: false,
      marcas: [],
      anno: [],
      categoriasventa: [],
      colores: [],
      
      filtroRequest: {
        marca_id: "",
        categoria_id: "",
        color_id: "",
        categoriasventa_id: this.categoriav.id,
        vin: ""
      },
      marcaSelected: "Todas",
      colorSelected: "Todas",
      annoSelected: "Todas",
      categoriaVSelected: this.categoriav.id,
      vin: "",
      pagination: {},
      detailsFilter: true
    };
  },
  components: {
    ListCarAdmin
  },
  created() {
    this.fetchMarcas();
    this.fetchAnno();
    this.fetchCategoriasVenta();
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
    /**
     * filtro basico
     */
   
    SendFilter() {
     this.autos=[];
      axios
        .get(buildURL("URL_API_SUBASTA", "resultfilteradmin"), {
          params: {
            marca: this.marcaSelected,
            color: this.colorSelected,
            anno: this.annoSelected,
            categoriasventa: this.categoriaVSelected,
            vin: this.vin,
          }
        })
        .then(res => {
          let autos = [];
          for (let i = 0; i < res.data.data.length; i++) {
          if(res.data.data[i].tramite[0] == undefined){}
          else{

            autos = {
              id: res.data.data[i].id,
              foto:res.data.data[i].fotos,
              modelo: res.data.data[i].nombremodeloauto,
              placas: res.data.data[i].placas,
              marca: res.data.data[i].nombremarca,
              version: res.data.data[i].nombreversionauto,
              color: res.data.data[i].nombrecolorauto,
              combustible: res.data.data[i].nombretipocombustible,
              precio: res.data.data[i].tramite[0] == undefined ? '0' : res.data.data[i].tramite[0].parametrizacion[0].preciolista,
              vin: res.data.data[i].vin,
              anno: res.data.data[i].anno,
              kilometraje: res.data.data[i].kminicial,
              transmision: res.data.data[i].tipotransmision,
              all:res.data.data[i],
              categoria_venta:this.categoriav.id,
              estado:res.data.data[i].subasta[0] == undefined ? res.data.data[i].ventaDirecta[0] == undefined ? 'Nuevo' : res.data.data[i].ventaDirecta[0].estado_id == 1 ? 'Venta Creada' : 'Finalizada'  : res.data.data[i].subasta[0].estado_id == 1 ? 'Subasta Creada' : 'Finalizada'
              
      
            };
            
            this.autos.push(autos);
          }
          }
          
        })
        .catch(err => console.log(err));
    },
    /**
     * Obtiene las Categorias
     */
    fetchAnno() {
      axios
        .get(buildURL("URL_API_SUBASTA", "listAnno"))
        .then(res => {
          this.$data.anno = res.data.data;
        })
        .catch(err => console.log(err));
    },
    /**
     * Obtiene las Categorias de Venta
     */
    fetchCategoriasVenta() {
      axios
        .get(buildURL("URL_API_SUBASTA", "listCategoriasVenta"))
        .then(res => {
          this.$data.categoriasventa = res.data.data;
        })
        .catch(err => console.log(err));
    },

    /**
     * Obtiene los Colores
     */
    fetchColores() {
      axios
        .get(buildURL("URL_API_SUBASTA", "listColores"))
        .then(res => {
          this.$data.colores = res.data.data;
        })
        .catch(err => console.log(err));
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