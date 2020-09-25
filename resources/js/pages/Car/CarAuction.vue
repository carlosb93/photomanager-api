<template>
  <card type="user" style="border-bottom: 3px inset rgb(253, 185, 19); border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
    
    
     <h4 class="card-title"> <i class="tim-icons icon-money-coins text-primary"></i>  Informacion de la Subasta</h4>
     <div class="card-text">
    <div class="row">
    <div class="col-md-7">
    <h4 class="card-title"><i class="mdi mdi-lightbulb-outline" style="font-size: 19px;"></i>Estado:</h4>
    </div>
    <div class="col-md-5">
      <div v-if="auto.subasta.length > 0">
              <div v-if="auto.subasta[0].estado_id == 1">
                <div v-if="auto.subasta[0].hoy < auto.subasta[0].inicio">
                  
  <base-button simple type="info"  style="width: 100%;padding-right: 0px;padding-left: 0px;">
        Proximamente 
      </base-button>
                </div><div v-else>
  <base-button simple type="info"  style="width: 100%;">
        Activa
      </base-button>
                </div>
              
              </div>
              <div v-else>
                 <base-button simple type="danger"  style="width: 100%; padding-right: 0px;padding-left: 0px;">
        Finalizada
      </base-button>
              </div>
             
              </div>
            

    
    </div>
    </div>
    <div class="row">
      <div class="col-md-7">
    <h4 class="card-title"><i class="mdi mdi-gavel" style="font-size: 19px;"></i>  Puja actual:</h4>
    </div>
    <div class="col-md-5">
    <base-button simple type="info"  style="width: 100%;">
     $ {{auto.subasta[0].puja_actual == 0 ? auto.subasta[0].precio_min : auto.subasta[0].puja_actual}}
      </base-button>
    </div>
    </div>
    <div class="row">
      <div class="col-md-5" 
    style="padding-right: 5px;"
>
    <h4 class="card-title"><i class="mdi mdi-timetable" style="font-size: 19px;"></i> Finalizará:</h4>
    </div>
    <div class="col-md-7" style="padding-left: 10px;">
    <base-button simple type="info" style="width: 100%;">
        {{ auto.subasta[0].final }}
      </base-button>
    </div>
    </div>
    </div>
      <div class="row">
    <div class="col-md-6">
       <div class="form-group">
	<input aria-describedby="addon-right addon-left" placeholder="su oferta..." class="form-control"
   v-model="auction.puja"
   v-currency="{currency:null,locale:'en'}"
   style="margin-top: 5px;"> <!----> 
       </div>

     <!-- <base-input placeholder="su oferta..." style="margin-top: 5px;" v-model="auction.puja"></base-input> -->
     
      <base-input v-model="auto.subasta[0].id" type="hidden"></base-input>
     </div>
    <div class="col-md-6" style="text-align: center;">
      <div v-if="token != null">
        <div v-if="isActive == 'Activo'">
<div v-if="auto.subasta[0].hoy >= auto.subasta[0].inicio && auto.subasta[0].estado_id == 1">
           <base-button  class="btn btn-info"  fill
      :disabled="isProcessing" @click="sendOffer" style="width: 100%;">Pujar</base-button>
         </div>
         <div v-else>
  <base-button  class="btn btn-info"  fill
       style="width: 100%;" disabled>Pujar</base-button>
         </div>
        </div>
        <div v-else>
<base-button  class="btn btn-info"  fill
       style="width: 100%;padding-right:0px;padding-left:0px;" disabled>Usuario Inactivo</base-button>
        </div>
         
      </div>
      <div v-else>
        <router-link  class="btn btn-info"  fill
      :disabled="isProcessing" to="/login" style="width: 100%;">Pujar</router-link>
      </div> 
     
    </div>
    </div>
    <div class="row">
      <div class="col-md-12">
      <h5 class="card-title"> Su oferta debe ser mayor que la oferta actual!!!</h5>
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
import { CurrencyDirective, CurrencyInput }  from 'vue-currency-input';

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
    directives:{
currency: CurrencyDirective
  },
    name:'car-auction',
     components: {
    BaseAlert,
     },
    data() {
    return {
      name_app: localStorage.getItem('name_app'),
    min_price:'',
    actual_price:'',
      token: localStorage.getItem('token'),
      isActive: localStorage.getItem('isActive'),
      isProcessing: false,
      viewDashboard: false,
       errors: {},
      type: ["", "info", "success", "warning", "danger"],
        notifications: {
          topCenter: false
        },
      uri: URL_API_CENTRAL,
      email:"",
       auction:{
        puja:"",
        id:"",
        email:"",
      },
    };
  },
    props: {
      auto: {
        'subasta':[]
      },
     
      },
      created(){
     
     this.fetchBet();
     this.toCurrency();
      },
    
    methods:{
      toCurrency(){

this.min_price = "$ " + this.auto.subasta[0].precio_min;
this.actual_price = "$ " + this.auto.subasta[0].puja_actual;
this.min_price = "$ " + this.min_price.toFixed(2).replace(/(\d)(?=(\d{3})+(?:\.\d+)?$)/g, "$1,");
this.actual_price = "$ " + this.actual_price.toFixed(2).replace(/(\d)(?=(\d{3})+(?:\.\d+)?$)/g, "$1,");
      },
trigger() {
      this.$emit("triggerFromChild", "1");
    },

fetchBet(){
Echo.channel('bet').listen('BetEvent', (e) => {
  this.trigger();
  
});
},
  sendOffer(){
      this.fetchBet();
      this.auction.id = this.auto.subasta[0].id;
      this.auction.email = localStorage.getItem('email');
      this.auction.puja =  parseFloat(this.auction.puja.replace(/[^\d\.]/g, ""));
      this.isProcessing = true;
      axios
        .post(buildURL("URL_API_SUBASTA", "subastaupdate/" + this.auto.subasta[0].id), this.auction)
        .then((res) => {
          this.isProcessing = false;
         if(res.status === 401){
this.$notify({
          message: res.data,
          title: this.name_app,
          component: NotificationTemplate,
          icon: "tim-icons icon-bell-55",
          type: 'danger',
          timeout: 4000
        });
         }else{
this.$notify({
          message: res.data,
          title: this.name_app,
          component: NotificationTemplate,
          icon: "tim-icons icon-bell-55",
          type: 'success',
          timeout: 4000
        });
         }
        
       this.trigger();
        })
        .catch((error) => {
           
          if (error.response.status === 401) {
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
          if (error.response.status === 404) {
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
    },



     
  }

  
      
    }
  
</script>
<style>
</style>
