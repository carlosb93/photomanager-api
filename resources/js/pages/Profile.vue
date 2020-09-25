<template>
  <div class="row">
    <div class="col-md-12">
  <card style="border-bottom: 3px inset rgb(253, 185, 19); border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
      <el-tabs v-model="selectName" @tab-click="handleClick">
        <el-tab-pane label="Persona Fisica" name="tab1">
           <edit-user v-if="selection===0" :user="user" :model="model">
      </edit-user>
        </el-tab-pane>
        <el-tab-pane label="Persona Moral" name="tab2">
          <edit-moral v-if="selection===1" :user="user" :model="model">
      </edit-moral>
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
  import EditUser from './UserProfile/EditUser';
  import EditMoral from './UserProfile/EditMoral';
  import { Tabs,TabPane } from 'element-ui';
  import config from "../config";
  import UserCard from './Profile/UserCard'
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
      EditUser,
      EditMoral,
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
