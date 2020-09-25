<template>
  <card type="user" style="height:290px; border-bottom: 3px inset rgb(253, 185, 19); border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
    
    
     <h4 class="card-title"> <i class="tim-icons icon-money-coins text-primary"></i>  Información de la Venta</h4>
     <div class="card-text">
    <div class="row">
    <div class="col-md-7">
    <h4 class="card-title"><i class="mdi mdi-lightbulb-outline" style="font-size: 19px;"></i>   Estado de la Venta:</h4>
    </div>
    <div class="col-md-5">
      <div v-if="auto.ventaDirecta.length > 0">
              <div v-if="auto.ventaDirecta[0].estado_id == 1">
                
                <base-button simple type="info"  style="width: 100%;">
        Activa
      </base-button>
              </div>
              <div v-else>
                 <base-button simple type="danger"  style="width: 100%;">
        Vendido
      </base-button>
              </div>
             
              </div>
    </div>
    </div>
    <div class="row">
      <div class="col-md-6">
    <h4 class="card-title"><i class="mdi mdi-currency-usd" style="font-size: 19px;"></i>  Precio:</h4>
    </div>
    <div class="col-md-6">
    <base-button simple type="default" style="width: 100%;">
        $ {{auto.ventaDirecta[0].precio}}
      </base-button>
    </div>
    </div>
    </div>
      <div class="row">
    <div class="col-md-4">
      <base-input placeholder="id" v-model="auto.ventaDirecta[0].id" type="hidden"></base-input>
     </div>
    <div class="col-md-4">
      <div v-if="token != null">
        <div v-if="auto.ventaDirecta[0].estado_id == 1">
        <base-button  class="btn btn-sm btn-info"  fill
      :disabled="isProcessing" @click="sendOffer">Comprar</base-button>
        </div>
        <div v-else>
           <base-button  class="btn btn-sm btn-info"  fill disabled>Comprar</base-button>
        </div>
      </div>
      <div v-else>
        <router-link  class="btn btn-sm btn-info"  fill
      :disabled="isProcessing" to="/login">Comprar</router-link>
      </div>
    </div>
   
    </div>
    <br>
    <br>
    <div class="row">
      <div class="col-md-12">
      <h5 class="card-title"> Usted sera redireccionado hacia la pagina para realizar el proceso de compra directa!!!</h5>
      </div>
    </div>
    
    
    
  </card>
</template>
<script>
import config from "../../config";
import axios from 'axios';
import { CarouselItem, Carousel } from 'element-ui';
import NotificationTemplate from '../Notifications/NotificationTemplate';
import BaseAlert  from '../../components/BaseAlert';

const URL_API_SUBASTA = config.url_api.URL_API_SUBASTA;
const URL_API_CENTRAL = config.url_api.URL_API_CENTRAL;

function buildURL(api, resource = "") {
  if (api == "URL_API_CENTRAL") {
    return URL_API_CENTRAL + resource;
  } else {
    return URL_API_SUBASTA + resource;
  }
}

  export default {
      name:'car-sale',
     components: {
    BaseAlert,
     },
    data() {
    return {
      name_app: localStorage.getItem('name_app'),
      token: localStorage.getItem('token'),
      isProcessing: false,
       errors: {},
      type: ["", "info", "success", "warning", "danger"],
        notifications: {
          topCenter: false
        },
      uri: URL_API_CENTRAL,
       sale:{
        id:"",
      },
    };
  },
    props: {
      auto: {},
     
      },
    methods:{
trigger() {
      this.$emit("triggerFromChild", "1");
    },

  sendOffer(){
      this.sale.id = this.auto.ventaDirecta[0].id;
      this.sale.email = localStorage.getItem('email');
    
      this.isProcessing = true;
     
      axios
        .post(buildURL("URL_API_SUBASTA", "ventaupdate/" + this.auto.ventaDirecta[0].id), this.sale)
        .then((res) => {
          
          this.isProcessing = false;
         
        this.$notify({
          message: res.data,
          title: this.name_app,
          component: NotificationTemplate,
          icon: "tim-icons icon-bell-55",
          type: 'success',
          timeout: 4000
        });
       this.trigger();
        })
        .catch((error) => {
           
          if (error.response.status === 404) {
            this.errors = error.response.data;
            this.isProcessing = false;
            
        this.$notify({
          message: this.errors,
          title: this.name_app,
          component: NotificationTemplate,
          icon: "tim-icons icon-bell-55",
          type: 'warning',
          timeout: 4000
        });
          }
          if (error.response.status === 401) {
             this.errors = error.response.data;
            this.isProcessing = false;
           
        this.$notify({
          message: this.errors,
          title: this.name_app,
          component: NotificationTemplate,
          icon: "tim-icons icon-bell-55",
          type: 'danger',
          timeout: 4000
        });
          }else if(error.response.status === 404){
            this.isProcessing = false;
      
        this.$notify({
          message: this.errors,
          title: this.name_app,
          component: NotificationTemplate,
          icon: "tim-icons icon-bell-55",
          type: 'danger',
          timeout: 4000
        });
          }
        });
    }
  }

  
      
    }
  
</script>
<style>
</style>
