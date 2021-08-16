<template>
<card style="border-bottom: 3px inset #f96332; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
    <div class="card-header">
      <h5 class="title">Editar Negocio</h5>
    </div>
    <div class="card-body">
    <div v-show="status_edit">
<div class="row">
      <div class="col-md-12 pr-md-1">
        <base-input label="Nombre de su Negocio"
                  v-model="model.name"
                  >
        </base-input>
      </div>
      </div>
    <div class="row">
      <div class="col-md-12 pr-md-1">
        <base-input>
          <label>Breve descripción de su negocio</label>
          <textarea rows="4" cols="80"
                    class="form-control"
                    v-model="model.description"
                    >

              </textarea>
        </base-input>
      </div>
      </div>
    
    <button class="login100-form-btn-simple" v-on:click="editsubmit">Actualizar</button>
  </div>
    
    <div v-show="status_new">
<div class="row">
      <div class="col-md-12 pr-md-1">
        <base-input label="Nombre de su Negocio"
                  v-model="model.name"
                  >
        </base-input>
      </div>
      </div>
    <div class="row">
      <div class="col-md-12 pr-md-1">
        <base-input>
          <label>Breve descripción de su negocio</label>
          <textarea rows="4" cols="80"
                    class="form-control"
                    v-model="model.description"
                    >

              </textarea>
        </base-input>
      </div>
      </div>
    
    <button class="login100-form-btn-simple" v-on:click="submit">Crear</button>
  </div>
    
    </div>
    
  </card>
  
</template>
<script>
  import config from "../../config";
  import axios from "axios";
  import BaseAlert  from '../../components/BaseAlert';
  import NotificationTemplate from '../Notifications/NotificationTemplate';
  
const URL = config.url.URL_API;

function buildURL(api, resource = "") {
  if (api == "URL_API") {
    return URL + resource;
  }
  
}

  export default {
    data() {
      return {
        name_app: localStorage.getItem('name_app'),
        model:{
            name:'',
            description:'',
        },
        business_id: localStorage.getItem('business_id'),
        status_new: false,
        status_edit: false,

        type: ["", "info", "success", "warning", "danger"],
        notifications: {
          topCenter: false
        },
        
      }
    },
    components: {
    BaseAlert,
     },
    created(){
this.fetch_business()
    },
    methods:{
        fetch_business(){
         const AuthToken = 'Bearer ' + localStorage.getItem('token');

         axios.get(buildURL("URL_API", "business/" + this.business_id),{headers:{ 
            'Authorization': AuthToken,
         }})
        .then((res) => {  
          if(localStorage.getItem('status') && localStorage.getItem('role') == 'Admin_negocio'){
            
            if(res.data[0].name != 'Unknown'){
             this.status_edit = true
             this.model.name = res.data[0].name
             this.model.description = res.data[0].description
            }else{
            this.status_new = true
            }
            

          }else if(localStorage.getItem('status') && localStorage.getItem('role') == 'Administrator'){
            this.status_edit = true
            this.model.name = res.data[0].name
            this.model.description = res.data[0].description
          }

         }).catch((error) => {
               this.$notify({
          message: error,
          title: this.name_app,
          component: NotificationTemplate,
          icon: "tim-icons icon-bell-55",
          type: 'danger',
          timeout: 4000
        });
            });
    },

        submit(){
         const AuthToken = 'Bearer ' + localStorage.getItem('token');

         axios.post(buildURL("URL_API", "business"),this.model,{headers:{ 
            'Authorization': AuthToken,
         }})
        .then((res) => {  
          this.$notify({
          message: res.data,
          title: this.name_app,
          component: NotificationTemplate,
          icon: "tim-icons icon-bell-55",
          type: 'success',
          timeout: 4000
        });
         }).catch((error) => {
          this.$notify({
          message: error,
          title: this.name_app,
          component: NotificationTemplate,
          icon: "tim-icons icon-bell-55",
          type: 'danger',
          timeout: 4000
        });
            });
    },

        editsubmit(){

         const AuthToken = 'Bearer ' + localStorage.getItem('token');

         axios.put(buildURL("URL_API", "business/" + this.business_id),this.model,{headers:{ 
            'Authorization': AuthToken,
         }})
        .then((res) => {  
         
          this.$notify({
          message: res.data,
          title: this.name_app,
          component: NotificationTemplate,
          icon: "tim-icons icon-bell-55",
          type: 'success',
          timeout: 4000
        });
         }).catch((error) => {
             console.log(error)
             this.$notify({
          message: error,
          title: this.name_app,
          component: NotificationTemplate,
          icon: "tim-icons icon-bell-55",
          type: 'danger',
          timeout: 4000
        });
            });
    },

    }
  }
</script>
<style>
</style>
