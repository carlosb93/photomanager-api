<template>
  <card >
    <h5 slot="header" class="title">Nuevo usuario</h5>
    <p v-if="errors_validation.length">
    <b>Por favor, corrija el(los) siguiente(s) error(es):</b>
    <ul>
      <li v-for="error in errors_validation"><p style="color:#ff8578">{{ error }}</p></li>
    </ul>
  </p>
    <div class="row">
      
        <div class="col-md-12 px-md-1">
          <base-input label="* Nombre" placeholder="Nombre" v-model="firstName"></base-input>
        </div>
    </div>
    <div class="row">
      
        <div class="col-md-12 px-md-1">
          <base-input label="* Apellidos" placeholder="Apellidos" v-model="lastName"></base-input>
        </div>
    </div>
    <div class="row">
      
        <div class="col-md-12 px-md-1">
          <base-input label="* Email" placeholder="Email" v-model="email"></base-input>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 px-md-1">
          <base-input type="password" label="* Contraseña" placeholder="Contraseña" v-model="password"></base-input>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 px-md-1">
          <base-input type="password" label="* Confirmacion de Contraseña" placeholder="Contraseña" v-model="password_confirmation"></base-input>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 px-md-1">
    <base-button slot="footer" type="warning" fill :disabled="isProcessing" @click="validator">Guardar</base-button>
        </div>
        </div>
  </card>
</template>
<script>
  import config from "../../config";
import axios from "axios";
import NotificationTemplate from "../Notifications/NotificationTemplate";
import BaseAlert from "../../components/BaseAlert";
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
  name: "edit-profile-form-fisica",
components: {
    BaseAlert
    },
data() {
    return {
      name_app: localStorage.getItem('name_app'),
      firstName:'',
      lastName:'',
      email:'',
      password:'',
      password_confirmation:'',
      errors_validation:[],
      isProcessing: false,
  };
  },

  methods: {
validator(){
      this.errors_validation = [];
////////////////////////////////////////////////// form 0

      if(!this.password && !this.password_confirmation){
this.errors_validation.push("La contraseña es obligatoria.");
      }else{if(this.password != this.password_confirmation){
  //password deben ser iguales
  this.errors_validation.push("Las Contraseñas deben ser las mismas");
 }}

if(!this.email){
 this.errors_validation.push('El correo electrónico es obligatorio.');
  //email Required
}else if(!this.validEmail(this.email)){
   this.errors_validation.push('El correo electrónico debe ser válido.');
//valid emailrequired
}
if(this.errors_validation.length === 0){
this.create_user();

}else{
}
    },
    validEmail: function(email){
    var re= /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    },
create_user(){
      this.isProcessing = true;
      let formData = new FormData();
formData.append('password', this.password);
formData.append('password_confirmation', this.password_confirmation);
formData.append('email', this.email);
formData.append('firstName', this.firstName);
formData.append('lastName', this.lastName);
 const config ={
        headers: {'content-type': 'multipart/form-data'}    
          }
 axios.post(buildURL("URL_API_SUBASTA", "auth/register_admin"), formData, config).then((res) => {
            localStorage.setItem('token', res.data.access_token);
          this.isProcessing = false;
          this.$router.push('/users');
this.$notify({
            message: 'Ya la cuenta ha sido creada revise el correo para realizar la verificacion!!!!',
            title: this.name_app,
            component: NotificationTemplate,
            icon: "tim-icons icon-bell-55",
            type: "danger",
            timeout: 4000
          });
          
          
        }).catch((error) => {
          if(error.response.status === 422) {
             this.errors = error.response.data.errors;
             this.isProcessing = false;             
          }
          if (error.response.status === 401) {
            this.isProcessing = false;
            this.$notify({
              
            message: 'Error en el registro',
            title: this.name_app,
            component: NotificationTemplate,
            icon: "tim-icons icon-bell-55",
            type: "danger",
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
