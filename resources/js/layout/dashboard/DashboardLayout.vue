<template>
  <div class="wrapper">
    <side-bar style="border-bottom: 3px inset rgb(253, 185, 19); border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
      <template slot="links">
        <sidebar-link to="/home" :name="$t('sidebar.home')" icon="tim-icons icon-istanbul" />
         
        <div v-if="token != null">
        <sidebar-link to="/subasta" :name="$t('sidebar.subasta')" icon="tim-icons icon-bank" />
        <sidebar-link to="/venta-directa" :name="$t('sidebar.venta-directa')" icon="tim-icons icon-cart"/>
        </div>
        <div v-else>
        <sidebar-link to="/login" :name="$t('sidebar.subasta')" icon="tim-icons icon-bank" />
        <sidebar-link to="/login" :name="$t('sidebar.venta-directa')" icon="tim-icons icon-cart"/>
        </div>
       
        <sidebar-link to="/profile" :name="$t('sidebar.userProfile')" icon="tim-icons icon-single-02" v-show="logged_in"/>
        <sidebar-link to="/favorite" :name="$t('sidebar.favoritos')" icon="tim-icons icon-heart-2" v-show="logged_in"/>
        <sidebar-link to="/myoffers" :name="$t('sidebar.myoffers')" icon="mdi mdi-shopping-outline"  v-show="logged_in" style="font-size:20px;"/>
      

      
    <el-menu 
      default-active="2"
      class="el-menu-vertical-demo"
      @open="handleOpen"
      @close="handleClose"
      background-color="transparent"
      text-color="#fff" v-if="estado == 'true'">
      <el-submenu index="1">
        <template slot="title">
          <span style="font-weight: 300;font-size: 11px;text-transform: uppercase;color: rgba(255, 255, 255, 0.76);">{{$t('sidebar.dashboard')}}</span>
        </template>
        
          <el-menu-item index="1-1"><sidebar-link to="/dashboard-auction" :name="$t('sidebar.add-auction')" icon="tim-icons icon-bank"/></el-menu-item>
          <el-menu-item index="1-2"><sidebar-link to="/dashboard-sale" :name="$t('sidebar.add-sale')" icon="tim-icons icon-basket-simple"/></el-menu-item> 
          <el-menu-item index="1-3"><sidebar-link to="/users" :name="$t('sidebar.users')" icon="mdi mdi-account-edit" style="font-size:19px;"/></el-menu-item> 
          <el-menu-item index="1-4" v-show="role === 'Super Administrador'"><sidebar-link to="/config" :name="$t('sidebar.config')" icon="mdi mdi-cellphone-settings-variant" style="font-size:19px;"/></el-menu-item> 
       
      </el-submenu>
    </el-menu>
   

      </template>
    </side-bar>
    <div class="main-panel">
      <top-navbar></top-navbar>

      <dashboard-content @click.native="toggleSidebar"></dashboard-content>

      <content-footer></content-footer>
    </div>
   <div :style="{'display': installBtn}"><div class="notifications" >
    <span mode="in-out">
      <div data-notify="container" role="alert" data-notify-position="top-center" 
      class="alert open alert-with-icon bottom right alert-primary list-enter-to"  style="background-color: rgba(253, 185, 19, 0.64);bottom: 20px;">
       <base-button
                icon
                round
                simple
                type="white"
                block
                @click="installer()"
              data-toggle="tooltip"  title="Instalar" class="col-xs-1 "
              style="
    border-color:rgba(255, 255, 255, 0.01);
    position: absolute;
    left: 15px;
    top: 50%;
    margin-top: -18px;">
    <i class="mdi mdi-cellphone-settings-variant text-white" style="font-size: 30px;color:#344675;"></i>
              
              </base-button>
          <base-button
          data-notify="icon"
                icon
                round
                simple
                type="white"
                block
                @click="close()"
              data-toggle="tooltip" data-placement="top" title="close"  class="alert-icon col-xs-1 "
              style="
    border-color:rgba(255, 255, 255, 0.01);
    position: absolute;
    right: 15px;
    top: 50%;
    margin-top: -18px;">
                  <i class="mdi mdi-close text-white" style="font-size: 20px;color:#344675;"></i>
              </base-button>
          <!-- <span data-notify="icon" class="alert-icon mdi mdi-cellphone-arrow-down"></span> -->
           <div data-notify="message" @click="installer()"><div class="title"><b>{{name_app}}<br></b></div>
            <div @click="installer()">Desea instalar nuestra app ?</div>
             </div></div></span></div>

  </div>
  </div>
</template>
<style lang="scss">
</style>
<script>
import config from "../../config";
import axios from "axios";
import TopNavbar from "./TopNavbar.vue";
import ContentFooter from "./ContentFooter.vue";
import DashboardContent from "./Content.vue";
import MobileMenu from "./MobileMenu";
import { CollapseTransition } from "vue2-transitions";
import { Col, Row, Menu,MenuItem,MenuItemGroup,Submenu,Dropdown,DropdownItem,DropdownMenu,Select } from 'element-ui';
import NotificationTemplate from "../../pages/Notifications/NotificationTemplate";
import BaseAlert from "../../components/BaseAlert";
import Installabel from "../../components/Installabel";



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
    Installabel,
    TopNavbar,
    ContentFooter,
    DashboardContent,
    MobileMenu,
    CollapseTransition,
    [Col.name]: Col,
    [Row.name]: Row,
    [Menu.name]: Menu,
    [MenuItem.name]: MenuItem,
    [MenuItemGroup.name]: MenuItemGroup,
    [Submenu.name]: Submenu,
    [Dropdown.name]: Dropdown,
    [DropdownItem.name]: DropdownItem,
    [DropdownMenu.name]: DropdownMenu,
    [Select.name]: Select,

  },
  data() {
    return { 
      token: localStorage.getItem('token'),
      role: localStorage.getItem('role'),
      activeNotifications: false,
      estado: localStorage.getItem('status'),
      logged_in: false,
      installBtn: "none",
      name_app: localStorage.getItem('name_app'),
     
    };
  },
  created(){
   let installPrompt;
    window.addEventListener("beforeinstallprompt", e =>{
        e.preventDefault();
        installPrompt = e;
        this.installBtn = "block";
        

    });
this.installer = () =>{
  this.installBtn = "none";
  installPrompt.prompt();
  installPrompt.userChoice.then(result =>{ 
    if(result.outcome === "accepted"){
      console.log("user accepted");

    }else{
      console.log("user denied");
    }
    installPrompt = null;
  })
}
    if(localStorage.getItem('token') === null){
    this.unknowUser();
    }else{
      this.logged_in = true;
      this.permission();
    }
    
  
  },
  methods: {
    close(){
        let installPrompt;
        this.installBtn = "none"; 
        installPrompt = null; 
      },
    toggleSidebar() {
      if (this.$sidebar.showSidebar) {
        this.$sidebar.displaySidebar(false);
      }
      },
       toggleNotificationDropDown() {
      this.activeNotifications = !this.activeNotifications;
    },
    closeDropDown() {
      this.activeNotifications = false;
    },
      handleOpen(key, keyPath) {
        //console.log(key, keyPath);
      },
      handleClose(key, keyPath) {
        //console.log(key, keyPath);
      },
      permission() {
        
        axios.get(buildURL("URL_API_SUBASTA", "auth/me"),{ headers:{
          'Authorization': 'Bearer ' + localStorage.getItem('token')}})
        .then((res) => {
          if(res.data.user.isActive == "Inactivo" ){
            axios.post(buildURL("URL_API_SUBASTA", "auth/logout"),{ token: localStorage.getItem('token')})
        .then(res => {
          localStorage.removeItem('token');
          localStorage.removeItem('status');
          localStorage.removeItem('role');
          localStorage.removeItem('email');
          localStorage.removeItem('isActive');
          this.$router.push('/out')

        this.$notify({
          message: 'Su usuario esta inactivo',
          title: this.name_app,
          component: NotificationTemplate,
          icon: "tim-icons icon-bell-55",
          type: 'warning',
          timeout: 2000
        });
        }).catch(res => {
          if(res.status_code === 422) {
            this.res = res;
          }
          this.res = res;
          alert(this.res);
        });

          }else{
        
            
  if(res.data.role != null){
    
 if(res.data.role.name == 'Gerente de Ventas' || res.data.role.name == 'Super Administrador'){
          localStorage.removeItem('status');
          localStorage.setItem('status', true);
          localStorage.setItem('role', res.data.role.name);
          localStorage.setItem('email', res.data.user.email);
          localStorage.setItem('isActive', res.data.user.isActive);
          }else{
          localStorage.removeItem('status');
          localStorage.setItem('status', false);
          localStorage.setItem('role', res.data.role.name);
          localStorage.setItem('email', res.data.user.email);
          localStorage.setItem('isActive', res.data.user.isActive);
          }}
          }
        }).catch((error) => {
             localStorage.setItem('status', false);
            });
    },
      unknowUser() {
          localStorage.removeItem('status');
          localStorage.setItem('status', false);
          localStorage.setItem('role', 'Empty');
    }



    
  }
};


</script>
