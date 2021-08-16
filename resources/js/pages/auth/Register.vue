<template>
  <card>
    <h5 slot="header" class="title">Register User</h5>
    <div class="row">
      <div class="col-md-6 px-md-1">
        <base-input label="Username" placeholder="Username" v-model="registerRequest.username"></base-input>
        <small v-if="errors.username" class="text text-danger">{{ errors.username[0]}}</small>
      </div>
      <div class="col-md-6 pl-md-1">
        <base-input label="Email address" type="email" placeholder="mike@email.com" v-model="registerRequest.email"></base-input>
        <small v-if="errors.email" class="text text-danger">{{ errors.email[0]}}</small>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 pl-md-1">
        <base-input label="Password" v-model="registerRequest.password" placeholder="password"></base-input>
        <small v-if="errors.password" class="text text-danger">{{ errors.password[0]}}</small>
      </div>
      <div class="col-md-6 pl-md-1">
        <base-input label="Confirmed Password" v-model="registerRequest.password_confirmation" placeholder="confirmed password"></base-input>
      </div>
    </div>
    <base-button slot="footer" type="primary" fill :disabled="isProcessing" @click="register">Register</base-button>
  </card>
</template>
<script>
import config from "../../config";
import axios from "axios";
import { CollapseTransition } from "vue2-transitions";

const URL_API = config.url.URL_API;
/**
 * Arma la URL de el servicio
 */
function buildURL(api, resource = "") {
  return URL_API + resource;
}
export default {
  name: "register",
  data() {
    return {
      registerRequest: {
          username: '',
          email: '',
          password: '',
          password_confirmation: '',
      },
      isProcessing: false,
      errors: {}
    }
  },
  created(){

  },
  methods: {
    register() {
      this.isProcessing = true;
      axios
        .post(buildURL("URL_API", "auth/register"), this.registerRequest)
        .then(res => {
          this.isProcessing = false;
        })
        .catch((error) => {
          if(error.response.status === 422) {
             this.errors = error.response.data.errors;
             this.isProcessing = false;
          }
          if (error.response.status === 401) {
            this.isProcessing = false;
          }
        });
    }
  }
};
</script>
<style>
</style>
