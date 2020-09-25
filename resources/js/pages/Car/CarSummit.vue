<template>
 <card class="card">
          <img v-bind:src="firstfoto()" slot="image" class="card-img-top" />
          <div class="card-img-overlay">
            <h4 class="card-title">
               <i class="mdi mdi-sale text-primary" style="margin-right:5px; font-size: 25px;"></i>
              {{ auto.nombremodeloauto }}
              <div v-if="auto.fav_status[0] == true"> 
              <base-button icon round type="danger" class="favorite" block @click="notifyVue(auto.id)">
                <i class="tim-icons icon-heart-2 text-white" style="margin-right:10px"></i>
              </base-button>
               </div>
              <div v-else>
              <base-button icon round type="default" class="favorite" block @click="notifyVue(auto.id)">
                <i class="tim-icons icon-heart-2 text-danger" style="margin-right:10px"></i>
              </base-button>
              </div> 
              
            </h4>
          </div>
          <div class="row">
            <div class="col-md-8">
              <h5><i class="mdi mdi-car-info text-default" style="margin-right:10px; font-size: 25px;"></i>{{ auto.nombremarca }} | {{auto.nombrecolorauto}} | {{ auto.anno }} | <i class="mdi mdi-car-shift-pattern text-default"></i>{{ auto.tipotransmision }} </h5>
              <h4>$ {{ auto.precioventametrica }} | {{auto.kminicial}} KM</h4>
            </div>
            <div class="col-md-4">
              
                <base-button icon round type="primary" class="right" style="margin-right:10px">
                  <i class="tim-icons icon-cart"></i>
                </base-button>
              
            </div>
          </div>
        </card>
</template>
 <script> 
import config from "../../config";
import axios from "axios";
import NotificationTemplate from '../Notifications/NotificationTemplate';
import BaseAlert  from '../../components/BaseAlert';

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
  name: 'car-summit',
  components: {
      BaseAlert
    },
     data() {
      return {
        name_app: localStorage.getItem('name_app'),
        type: ["", "info", "success", "warning", "danger"],
        notifications: {
          topCenter: false
        },
      };
    },
  props: {
    auto: {}
  },   
  methods: {
file_exists(url){
  let formData = new FormData();
      formData.append('url',url);

const config ={headers: {'content-type': 'multipart/form-data'}}

axios.post(buildURL("URL_API_SUBASTA", "file_exists"), formData, config)
        .then(res => {
          return res.data;
        } 

        ).catch(err => console.log(err));
},
     firstfoto(){
       if(this.auto.foto == undefined){
         
       }else{
         
 return this.auto.foto.length > 0 ? this.auto.foto[0].documentos[0].url_init+"/TRAMITE-"+ this.auto.tramite[0].numerotramite+"/GALERIA/"+this.auto.foto[0].documentos[0].nombrereferencial : URL_API_CENTRAL + '2019/defaultcar.jpg'; 

       }
     
      },
    trigger(){
this.$emit('triggerFromChild','1');
    },
  /**
     * setea favoritos
     */
    notifyVue(id) {
      this.email = localStorage.getItem('email');
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
       
  }
};
</script>
<style>
</style>
