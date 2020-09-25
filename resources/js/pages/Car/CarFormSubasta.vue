<template>
  <card>
   
    <h5 slot="header" class="title">
      <router-link to="/dashboard-auction"><base-button
                icon
                round
                simple
              data-toggle="tooltip" data-placement="top" title="Atras" style="color:rgba(82, 95, 127, 0.56);border-color: rgba(82, 95, 127, 0.56);">
                <i class="mdi mdi-keyboard-backspace text-black" style="font-size:35px;color:rgba(82, 95, 127, 0.56);"> </i>
              </base-button></router-link> Crear Nueva Subasta</h5>
    <p v-if="errors_validation.length">
    <b>Por favor, corrija el(los) siguiente(s) error(es):</b>
    <ul>
      <li v-for="error in errors_validation"><p style="color:#ff8578">{{ error }}</p></li>
    </ul>
  </p>

    <div class="row">
      <div class="col-md-6 pr-md-1">
        <div class="form-group">
        <label class="control-label">
      Precio mínimo
    </label> <!----> 
	<input aria-describedby="addon-right addon-left" placeholder="Min" class="form-control"
   v-model="subasta.precio_min"
   v-currency="{currency:null,locale:'en'}"> <!----> 
       </div>
        <!-- <base-input label="Precio minimo" placeholder="Min" v-model="subasta.precio_min"></base-input> -->
       
      </div>
      <div class="col-md-6 px-md-1">
         <div class="form-group">
        <label class="control-label">
      Precio Máximo
    </label> <!----> 
	<input aria-describedby="addon-right addon-left" placeholder="Max" class="form-control"
   v-model="subasta.precio_max"
   v-currency="{currency:null,locale:'en'}"> <!----> 
       </div>
        
       
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 pr-md-1">
        <base-input label="Inicio de subasta" >
        <el-date-picker format="dd/MM/yyyy HH:mm" value-format="dd/MM/yyyy HH:mm" v-model="subasta.inicio"
        type="datetime"
        placeholder="Seleccionar fecha de Inicio"></el-date-picker>
        </base-input>
      </div>
      <div class="col-md-6 px-md-1">
        <base-input label="Fin de subasta">
        <el-date-picker format="dd/MM/yyyy HH:mm" value-format="dd/MM/yyyy HH:mm" v-model="subasta.final"
        type="datetime" placeholder="Seleccionar fecha de finalización"></el-date-picker>
        </base-input>
      </div>
    </div>
  <div style="height: 0;
    margin: 0.5rem 0;
    overflow: hidden;
    border-top: 1px solid #e9ecef;"></div>
    
<div class="row">
  <div class="col-md-12 px-md-1">
    <h2> Oferta Asociada</h2>
      </div>
</div>
<div class="row">

      <div class="col-md-6 px-md-1">
        <div class="form-group">
        <label class="control-label">
      Título
    </label> <!----> 
	<input aria-describedby="addon-right addon-left" placeholder="Título" class="form-control"
   v-model="subasta.titulo"> <!----> 
       </div>
      </div>
      <div class="col-md-6 px-md-1">
        <base-input label="Fin de oferta">
        <el-date-picker format="dd/MM/yyyy HH:mm" value-format="dd/MM/yyyy HH:mm" v-model="subasta.final_oferta"
        type="datetime" placeholder="Seleccionar fecha de finalización"></el-date-picker>
        </base-input>
      </div>
    </div>
    <div class="row">

      <div class="col-md-6 px-md-1">
        <div class="form-group">
        <label class="control-label">
      Descripcion
    </label> <!----> 
	<input aria-describedby="addon-right addon-left" placeholder="Descripción" class="form-control"
   v-model="subasta.descripcion"> <!----> 
       </div>
      </div>
      <div class="col-md-6 px-md-1">
        <div class="form-group">
        <label class="control-label">
      Porcentaje de descuento en %
    </label> <!----> 
	<input aria-describedby="addon-right addon-left" type="number" placeholder="Porcentaje" class="form-control"
   v-model="subasta.porcentaje"> <!----> 
       </div>
      </div>
      </div>
  <base-button
      slot="footer"
      type="primary"
      fill
      :disabled="isProcessing"
      @click="validator">Crear Subasta</base-button>
  </card>
  
</template>
<script>
import config from "../../config";
import axios from 'axios';
import { DatePicker, TimeSelect } from 'element-ui';
import NotificationTemplate from '../Notifications/NotificationTemplate';
import BaseAlert  from '../../components/BaseAlert';
import { CurrencyDirective }  from 'vue-currency-input';





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
   directives:{
currency: CurrencyDirective
  },
  name: "car-form-subasta",
  components: {
    BaseAlert,
    [DatePicker.name]: DatePicker,
    [TimeSelect.name]: TimeSelect,
  },
  data() {
    return {
      name_app: localStorage.getItem('name_app'),
      errors_validation: [],
      subasta: {
        precio_min: '',
        precio_max: '',
        inicio: '',
        final: '',
        autos_id: '',
        titulo: '',
        descripcion: '',
        porcentaje: '',
        final_oferta: ''
        
      },
      isProcessing: false,
      errors: {},
      type: ["", "info", "success", "warning", "danger"],
        notifications: {
          topCenter: false
        },
    };
  },
  props: {
    auto:{},
  },
  created(){

  }, 
  methods: {
    validator(){    
      
      this.errors_validation = [];
      this.subasta.precio_min =  parseFloat(this.subasta.precio_min.replace(/[^\d\.]/g, ""));
      this.subasta.precio_max =  parseFloat(this.subasta.precio_max.replace(/[^\d\.]/g, ""));
 
 if (!this.subasta.precio_min) {
        this.errors_validation.push("El Precio Mínimo de la subasta es obligatorio.");
      }else if(!this.subasta.precio_max){
         this.errors_validation.push("El Precio Máximo de la subasta es obligatorio.");
      }

if (this.subasta.precio_max < this.subasta.precio_min) {
        this.errors_validation.push("El Precio Mínimo de la subasta es mayor que el Máximo.");
      }
if (this.subasta.porcentaje > 100) {
        this.errors_validation.push("El descuento debe ser menor que 100");
      }
 if (!this.subasta.inicio) {
        this.errors_validation.push("La fecha de inicio de la subasta es obligatoria.");
      }else if(!this.subasta.final){
         this.errors_validation.push("La fecha de finalizacion de la subasta es obligatoria.");
      }else{
 if (this.subasta.final < this.subasta.inicio) {
        this.errors_validation.push("La fecha de inicio debe ser menor que la fecha final.");
      }
      }
    
      if(this.errors_validation.length === 0){
this.sendSubasta();
}else{
  
}
    },    
    sendSubasta() {
      this.subasta.autos_id = this.auto.id;
      this.isProcessing = true;

      axios.post(buildURL("URL_API_SUBASTA", "subastastore"), this.subasta)
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
        this.$router.push('/dashboard-auction');
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
     sendVenta() {
       
      this.subasta.autos_id = this.auto.id;
      this.isProcessing = true;
      axios
        .post(buildURL("URL_API_SUBASTA", "ventastore"), this.subasta)
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
        this.$router.push('/dashboard-sale');
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
    }
  }
};
</script>
<style>
</style>