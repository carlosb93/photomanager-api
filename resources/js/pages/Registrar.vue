<template>
  <div class="row">
    <div class="col-md-12">
  <card style="border-bottom: 3px inset rgb(253, 185, 19); border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
      <el-tabs v-model="selectName" @tab-click="handleClick">
        <el-tab-pane label="Persona Fisica" name="tab1">
           <edit-profile-form-fisica v-if="selection===0" :user="user" :model="model">
      </edit-profile-form-fisica>
        </el-tab-pane>
        <el-tab-pane label="Persona Moral" name="tab2">
          <edit-profile-form-moral v-if="selection===1" :user="user" :model="model">
      </edit-profile-form-moral>
        </el-tab-pane>
      </el-tabs>
  </card>
     
      
    </div>
    <!-- <div class="col-md-4">
      <user-card :user="user"></user-card>
    </div> -->
  </div>
</template>
<script>
  import EditProfileFormFisica from './Profile/EditProfileFormFisica';
  import EditProfileFormMoral from './Profile/EditProfileFormMoral';
  import UserCard from './Profile/UserCard'
  import { Tabs,TabPane } from 'element-ui';
  import config from "../config";
  import axios from "axios";

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
      EditProfileFormFisica,
      EditProfileFormMoral,
      UserCard,
      [TabPane.name]: TabPane,
      [Tabs.name]: Tabs,
    },
    data() {
      return {
        selection: 0,
        selectName: 'tab1',
        model:{},
        user: {},
      }
    },
    created(){

    },
    methods:{
      getUser(){
     axios.get(buildURL("URL_API_SUBASTA", "finduser/" + 101))
        .then(res => {
          let user = {
            id: res.data[0].id,
            email: res.data[0].email,
            phone: res.data[0].phone,
            name: res.data[0].firstName,
            firstname: res.data[0].userpersona[0].personas[0].apellidopaterno,
            lastname: res.data[0].userpersona[0].personas[0].apellidomaterno,
            curp: res.data[0].userpersona[0].personas[0].curp,
            rfc: res.data[0].userpersona[0].personas[0].rfc,
            telefonocontacto1: res.data[0].userpersona[0].personas[0].telefonocontacto1,
            telefonocontacto2: res.data[0].userpersona[0].personas[0].telefonocontacto2,
            tipodocidentificacion_id: res.data[0].userpersona[0].personas[0].tipodocidentificacion_id,
            paisnacionalidad_id: res.data[0].userpersona[0].personas[0].paisnacionalidad_id,
            fechanacimiento: res.data[0].userpersona[0].personas[0].fechanacimiento,
            domicilio_id: res.data[0].userpersona[0].personas[0].domicilio_id,
            calidadmigratoria_id: res.data[0].userpersona[0].personas[0].calidadmigratoria_id,
          };
          this.user = user;

        })
        .catch(err => console.log(err));
      },

      handleClick(){
        if(this.selection === 0){
          this.selection = 1;

        }else{
           this.selection = 0;
        }
      }
    }
  }
</script>
<style>
</style>
