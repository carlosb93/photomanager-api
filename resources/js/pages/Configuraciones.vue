<template>
  <card style="border-bottom: 3px inset rgb(253, 185, 19); border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
    <h5 slot="header" class="title">
      <router-link to="/home">
        <base-button
          icon
          round
          simple
          data-toggle="tooltip"
          data-placement="top"
          title="Atras"
          style="color:rgba(82, 95, 127, 0.56);border-color: rgba(82, 95, 127, 0.56);"
        >
          <i
            class="mdi mdi-keyboard-backspace text-black"
            style="font-size:35px;color:rgba(82, 95, 127, 0.56);"
          ></i>
        </base-button>
      </router-link> Configuración de App
    </h5>
    <div v-if="errors_validation.length">
      <b>Por favor, corrija el(los) siguiente(s) error(es):</b>
      <ul>
        <li v-for="error in errors_validation">
          <p style="color:#ff8578">{{ error }}</p>
        </li>
      </ul>
    </div>

    <label class="control-label">Nombre de la app</label>
    <div class="row">
      <div class="col-md-6 px-md-1">
        <input
          aria-describedby="addon-right addon-left"
          placeholder="Nombre"
          class="form-control"
          v-model="name_app"
          style="margin-top: 5px;"
        >
      </div>
      <div class="col-md-6 px-md-1">
        <base-button
          slot="footer"
          type="info"
          fill
          :disabled="isProcessing"
          @click="validatorName"
        >Guardar</base-button>
      </div>
    </div>
    <label class="control-label">Correo de contacto Empresa</label>
    <div class="row">
      <div class="col-md-6 px-md-1">
        <input
          aria-describedby="addon-right addon-left"
          placeholder="Email"
          class="form-control"
          v-model="email_app"
          style="margin-top: 5px;"
        >
      </div>
      <div class="col-md-6 px-md-1">
        <base-button
          slot="footer"
          type="info"
          fill
          :disabled="isProcessing"
          @click="validatorEmail"
        >Guardar</base-button>
      </div>
    </div>
    <label class="control-label">Teléfono de contacto Empresa</label>
    <div class="row">
      <div class="col-md-6 px-md-1">
        <input
          aria-describedby="addon-right addon-left"
          placeholder="Telefono"
          class="form-control"
          v-model="telef_app"
          style="margin-top: 5px;"
        >
      </div>
      <div class="col-md-6 px-md-1">
        <base-button
          slot="footer"
          type="info"
          fill
          :disabled="isProcessing"
          @click="validatorTelef"
        >Guardar</base-button>
      </div>
    </div>
    <label class="control-label">Logo de app</label>
     <div class="row">
        <div class="col-md-2 px-md-1">
        <input type="file" v-on:change="handleLogo" ref="LogoFile" style="display:none;"/>
      <base-button round :type="stado0" simple @click="$refs.LogoFile.click()"><i class="mdi mdi-cloud-upload-outline" style="font-size:19px;"> </i> Logo de la App</base-button>
        </div>
      <div class="col-md-10 px-md-1">
        <base-button
          slot="footer"
          type="info"
          fill
          :disabled="isProcessing"
          @click="validatorLogo"
        >Guardar</base-button>
      </div>
        </div>
    
  </card>
</template>
<script>
import config from "../config";
import axios from "axios";
import { DatePicker, TimeSelect } from "element-ui";
import NotificationTemplate from "./Notifications/NotificationTemplate";
import BaseAlert from "../components/BaseAlert";

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
  components: {
    BaseAlert,
    [DatePicker.name]: DatePicker,
    [TimeSelect.name]: TimeSelect
  },
  data() {
    return {
      stado0:"default",
      LogoFile:'',
      LogoName:'',
      errors_validation: [],
      titulo_app: localStorage.getItem('name_app'),
      name_app:'',
      logo_app:'',
      email_app:'',
      telef_app:'',
      parametros:'',
      isProcessing: false,
      errors: {},
      type: ["", "info", "success", "warning", "danger"],
      notifications: {
        topCenter: false
      }
    };
  },

  created() {},
  methods: {
    validatorName() {
      this.errors_validation = [];

      if (!this.name_app) {
        this.errors_validation.push(
          "El nombre de la app no puede estar vacio."
        );
      }
      if (this.errors_validation.length === 0) {
        this.sendConfigName();
      } else {
      }
    },
    sendConfigName(){
      this.isProcessing = true; 
      let formData = new FormData();
          formData.append('name_app',this.name_app);

           const config ={
        headers: {'content-type': 'multipart/form-data'}    
          }
          axios.post(buildURL("URL_API_SUBASTA", "set_name_app"), formData, config).then((res) => {
           
          this.isProcessing = false;
          this.$notify({
      message: 'Cambio realizado con éxito',
      title: this.titulo_app,
      component: NotificationTemplate,
      icon: "tim-icons icon-bell-55",
      type: 'success',
      timeout: 4000
    });
          }).catch(err=>{
             this.isProcessing = false;
             console.log(err);});
    },
    validatorEmail() {
      this.errors_validation = [];

      if (!this.email_app) {
        this.errors_validation.push(
          "El email de contacto no puede estar vacio."
        );
      }
      if (this.errors_validation.length === 0) {
        this.sendConfigEmail();
      } else {
      }
    },
    sendConfigEmail(){
      this.isProcessing = true; 
      let formData = new FormData();
          formData.append('email_app',this.email_app);

           const config ={
        headers: {'content-type': 'multipart/form-data'}    
          }
          axios.post(buildURL("URL_API_SUBASTA", "set_email_app"), formData, config).then((res) => {
           
          this.isProcessing = false;
          this.$notify({
      message: 'Cambio realizado con éxito',
      title: this.titulo_app,
      component: NotificationTemplate,
      icon: "tim-icons icon-bell-55",
      type: 'success',
      timeout: 4000
    });
          }).catch(err=>{
             this.isProcessing = false;
             console.log(err);});
    },
    validatorTelef() {
      this.errors_validation = [];

      if (!this.telef_app) {
        this.errors_validation.push(
          "El telefono de contacto no puede estar vacio."
        );
      }
      if (this.errors_validation.length === 0) {
        this.sendConfigTelef();
      } else {
      }
    },
    sendConfigTelef(){
      this.isProcessing = true; 
      let formData = new FormData();
          formData.append('telef_app',this.telef_app);

           const config ={
        headers: {'content-type': 'multipart/form-data'}    
          }
          axios.post(buildURL("URL_API_SUBASTA", "set_telef_app"), formData, config).then((res) => {
           
          this.isProcessing = false;
          this.$notify({
      message: 'Cambio realizado con éxito',
      title: this.titulo_app,
      component: NotificationTemplate,
      icon: "tim-icons icon-bell-55",
      type: 'success',
      timeout: 4000
    });
          }).catch(err=>{
             this.isProcessing = false;
             console.log(err);});
    },
    validatorLogo() {
      this.errors_validation = [];

      if (!this.LogoFile) {
        this.errors_validation.push(
          "El logo de la app no puede estar vacio."
        );
      }
      if (this.errors_validation.length === 0) {
        this.sendConfigLogo();
      } else {
      }
    },
    sendConfigLogo(){
      this.isProcessing = true; 
      let formData = new FormData();
         formData.append('LogoFile', this.LogoFile);
              formData.append('LogoName', this.LogoName);

           const config ={
        headers: {'content-type': 'multipart/form-data'}    
          }
          axios.post(buildURL("URL_API_SUBASTA", "set_logo_app"), formData, config).then((res) => {
           
          this.isProcessing = false;
          this.$notify({
      message: 'Cambio realizado con éxito',
      title: this.titulo_app,
      component: NotificationTemplate,
      icon: "tim-icons icon-bell-55",
      type: 'success',
      timeout: 4000
    });
          }).catch(err=>{
             this.isProcessing = false;
             console.log(err);});
    },
     handleLogo(e) {
       
         this.LogoFile = e.target.files[0];
         this.LogoName = e.target.files[0].name;
  this.stado0="info";
      },

    
  }
};
</script>
<style>
</style>