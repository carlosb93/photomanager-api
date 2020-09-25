<template>
  <div class="row">
    <div v-for="item in categorias()" class="col-lg-4" :key="item.id">
      <!-- aqui esta el nuevo -->
      <card class="card" style="
    border-bottom-width: 3px;
    border-bottom-color: #FDB913;
    border-bottom-style: inset;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
">
        <img v-bind:src="firstfoto(item)" slot="image" class="card-img-top" />
        <div class="card-img-overlay">
          <h4 class="card-title">
            <i class="mdi mdi-sale text-primary" style="margin-right:5px; font-size: 25px;"></i>
            {{ item.nombremodeloauto }} 
            <div v-if="item.fav_status[0] === true">
              <base-button
                icon
                round
                type="danger"
                class="favorite"
                block
                @click="notifyVue(item.id)"
              data-toggle="tooltip" data-placement="top" title="Quitar de mis favoritos">
                <i class="tim-icons icon-heart-2 text-white" style="margin-right:10px;z-index: 10;"></i>
              </base-button>
            </div>
            <div v-else>
              <base-button
                icon
                round
                type="default"
                class="favorite"
                block
                @click="notifyVue(item.id)"
             data-toggle="tooltip" data-placement="top" title="Añadir a mis favoritos">
                <i class="tim-icons icon-heart-2 text-danger" style="margin-right:10px;z-index: 10;"></i>
              </base-button>
            </div>
          </h4>
        </div>
        <div class="row">
          <div class="col-md-8">
            
            <h5><i class="mdi mdi-car-info text-default" style="margin-right:10px; font-size: 25px;"></i>{{ item.marca }} | {{ item.anno }} | <i class="mdi mdi-car-shift-pattern text-default"></i>{{ item.tipotransmision }}</h5>  
            <span v-if="item.subasta.length > 0" style="display:inline;padding: .2em .6em .3em;font-size: 80%;font-weight: 700;line-height: 1;color: #fff;text-align: center;white-space: nowrap;vertical-align: baseline;border-radius: .25em;background-color: #5cb85c;">Puja mas alta: $ 
      {{ item.subasta[0].puja_actual >= item.subasta[0].precio_min ? item.subasta[0].puja_actual : item.subasta[0].precio_min }}</span>
    <span v-if="item.venta.length > 0" style="display:inline;padding: .2em .6em .3em;font-size: 80%;font-weight: 700;line-height: 1;color: #fff;text-align: center;white-space: nowrap;vertical-align: baseline;border-radius: .25em;background-color: #5cb85c;">Precio actual: $ 
      {{ item.venta[0].precio }}</span>
            <h4>$ {{ item.precioventametrica }} | {{item.kminicial}} KM</h4>
            <h4><div v-if="item.subasta.length > 0">
              <div v-if="item.subasta[0].estado_id == 1">
              <div v-if="item.subasta[0].hoy > item.subasta[0].inicio">
                <i class="mdi mdi-cart-minus" style="font-size: 25px; color: #41B314;"></i> Activa
                </div>
                <div v-else>
                   <i class="mdi mdi-timer-sand text-info" style="font-size: 25px;"></i> Proximamente <p style="font-size:15px; color:rgba(109, 107, 107, 0.8);;">{{item.subasta[0].inicio}}</p>
                  </div>
              </div>
              <div v-else>
                 <i class="mdi mdi-cart-off text-danger" style="font-size: 25px;"></i> Finalizada
              </div>
             
              </div>
            <div v-else>
               <div v-if="item.venta[0].estado_id == 1">
                <i class="mdi mdi-cart-minus" style="font-size: 25px;color: #41B314;"></i> Activa
                
              </div>
              <div v-else>
                 <i class="mdi mdi-cart-off text-danger" style="font-size: 25px;"></i> Vendido
              </div>
              </div></h4>
          </div>
          <div class="col-md-4">
          <div v-if="item.venta.length > 0">
<router-link :to="`/car-detail-sale/${item.id}`">
              <base-button icon round type="primary" class="right" style="margin-right:10px" data-toggle="tooltip" data-placement="top" title="Comprar Vehiculo">
                <i class="tim-icons icon-cart"></i>
              </base-button>
</router-link>
          </div>
          <div v-if="item.subasta.length > 0">
<router-link :to="`/car-detail-auction/${item.id}`">
              <base-button icon round type="primary" class="right" style="margin-right:10px" data-toggle="tooltip" data-placement="top" title="Acceder a Subasta">
                <i class="mdi mdi-gavel" style="font-size:20px;"></i>
              </base-button>
</router-link>
          </div>
         
            
          </div>
        </div>
      </card>
    </div>
  <div v-if="not_found == true" class="limiter100" style="width: 10%;">
<i class="mdi mdi-car-off" style="    font-size: 200px;
    color: rgba(168, 170, 173, 0.35);"></i>
  </div>
  </div>
</template>
  <script>
import config from "../config";
import axios from "axios";
import NotificationTemplate from "../pages/Notifications/NotificationTemplate";
import BaseAlert from "./BaseAlert";

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
  name: "list-car",
  components: {
    BaseAlert
  },
  data() {
    return {
      name_app: localStorage.getItem('name_app'),
      email:"",
      type: ["", "info", "success", "warning", "danger"],
      notifications: {
        topCenter: false
      },
      uri: URL_API_CENTRAL,
    };
  },
  props: {
    autos: {},
    not_found: false,
  },
  methods: {
    file_exists(url){
  let formData = new FormData();
      formData.append('url',url);

const config ={headers: {'content-type': 'multipart/form-data'}}

axios.post(buildURL("URL_API_SUBASTA", "file_exists"), formData, config)
        .then(res => {
         console.log(res.data);
          return res.data;
        } 

        ).catch(err => console.log(err));
},
    firstfoto(value) {
     
      return value.foto.length > 0 ? this.uri+value.foto[0].documentos[0].fechasubida.substring(0, 4)+"/TRAMITE-"+value.tramite[0].numerotramite+"/GALERIA/"+value.foto[0].documentos[0].nombrereferencial : URL_API_CENTRAL + "2019/defaultcar.jpg";
    },
    trigger() {
      this.$emit("triggerFromChild", "1");
    },
    /**
     * setea favoritos
     */

    notifyVue(id) {
      this.email =localStorage.getItem('email');
      if(localStorage.getItem('email') == null){
 this.$notify({
            message: 'Debe logguearce en el sistema para realizar esta accion',
            title: this.name_app,
            component: NotificationTemplate,
            icon: "tim-icons icon-bell-55",
            type: "success",
            timeout: 4000
          });
      }else{
 axios
        .post(buildURL("URL_API_SUBASTA", "update-fav/" + id),
        {'email': this.email
        })
        .then(res => {
          this.trigger();

          this.$notify({
            message: res.data,
            title: this.name_app,
            component: NotificationTemplate,
            icon: "tim-icons icon-bell-55",
            type: "success",
            timeout: 4000
          });
        })
        .catch(err => console.log(err));
      }
     
    },

    categorias2() {
      return this.autos.filter(function(value) {
        return value.tipoventa.filter(function(value) {
          return value.categoria_id == "1" || value.categoria_id == "2";
        });
      });
    },
    categorias() {

      return this.autos.filter(function(value) {
       
        if ((value.subasta.length === 0)) {
          if ((value.venta.length > 0)) {
            
            return value.tipoventa.filter(function(item) {
              return item.categoria_id == "1" || item.categoria_id == "2";
            });
          } else {
       
          }
        } else {
       
          return value.tipoventa.filter(function(item) {
            return item.categoria_id == "1" || item.categoria_id == "2";
          });
        }
      });
    }
  }
};
</script>
<style>
/* select option {
  background-color: #27293d;
} */
</style>