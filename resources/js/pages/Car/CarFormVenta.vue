<template>
  <card>
          <h5 slot="header" class="title">
             <router-link to="/dashboard-sale"><base-button
                icon
                round
                simple
              data-toggle="tooltip" data-placement="top" title="Atras" style="color:rgba(82, 95, 127, 0.56);border-color: rgba(82, 95, 127, 0.56);">
                <i class="mdi mdi-keyboard-backspace text-black" style="font-size:35px;color:rgba(82, 95, 127, 0.56);"> </i>
              </base-button></router-link> Crear Nueva Venta Directa</h5>
          <div class="row">
      <div class="col-md-6 pr-md-1">
        <div class="form-group">
        <label class="control-label">
      Precio de venta
    </label> <!----> 
	<input aria-describedby="addon-right addon-left" placeholder="Precio de Venta" class="form-control"
   v-model="venta.precio"
   v-currency="{currency:null,locale:'en'}"> <!----> 
        <!-- <base-input label="Precio de venta" placeholder="Precio de Venta" v-model="venta.precio" v-currency="{currency:'null',locale:'en'}"></base-input> -->
      </div>
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
      Titulo
    </label> <!----> 
	<input aria-describedby="addon-right addon-left" placeholder="Titulo" class="form-control"
   v-model="venta.titulo"> <!----> 
       </div>
      </div>
      <div class="col-md-6 px-md-1">
        <base-input label="Fin de oferta">
        <el-date-picker format="dd/MM/yyyy HH:mm" value-format="dd/MM/yyyy HH:mm" v-model="venta.final_oferta"
        type="datetime" placeholder="Seleccionar fecha de finalizacion"></el-date-picker>
        </base-input>
      </div>
    </div>
    <div class="row">

      <div class="col-md-6 px-md-1">
        <div class="form-group">
        <label class="control-label">
      Descripcion
    </label> <!----> 
	<input aria-describedby="addon-right addon-left" placeholder="Descripcion" class="form-control"
   v-model="venta.descripcion"> <!----> 
       </div>
      </div>
      <div class="col-md-6 px-md-1">
        <div class="form-group">
        <label class="control-label">
      Porcentaje de descuento
    </label> <!----> 
	<input aria-describedby="addon-right addon-left" type="number" placeholder="Porcentaje" class="form-control"
   v-model="venta.porcentaje"> <!----> 
       </div>
      </div>
      </div>
           <base-button
      slot="footer"
      type="primary"
      fill
      :disabled="isProcessing"
      @click="sendVenta">Crear Venta</base-button>
      
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
  name: "car-form-venta",
  components: {
    BaseAlert,
    [DatePicker.name]: DatePicker,
    [TimeSelect.name]: TimeSelect,
  },
  data() {
    
    return {
      name_app: localStorage.getItem('name_app'),
      venta: {
        precio: "",
        autos_id: "",
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
     sendVenta() {
      this.venta.autos_id = this.auto.id;
      this.isProcessing = true;
      this.venta.precio =  parseFloat(this.venta.precio.replace(/[^\d\.]/g, ""));
      axios
        .post(buildURL("URL_API_SUBASTA", "ventastore"), this.venta)
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