<template>
  <div class="wrapper">
  <div v-if="token != null">
    <side-bar>
      <template slot="links">
        <sidebar-link to="/home" :name="$t('sidebar.dashboard')" icon="tim-icons icon-chart-pie-36"/>
 
       <li class="nav-item" >

        <a v-b-toggle.collapse-1 class="nav-link" ><i class="tim-icons icon-bank"></i>Negocio</a>
           <!-- <span style="content: '';    
  position: absolute;       
  right: 15px;    
  height: 1px;    
  width: calc(100% - 30px);   
  background: rgba(255, 255, 255, 0.5);
"></span>   -->
         <b-collapse id="collapse-1" class="mt-2" style="background-color: rgb(21 21 33);" >
             <sidebar-link to="/businessedit" :name="$t('sidebar.config')" icon="tim-icons icon-settings-gear-63"/>
             <sidebar-link to="/listarramas" :name="$t('sidebar.branches')" icon="tim-icons icon-bullet-list-67"/>
             <sidebar-link to="/calendar" :name="$t('sidebar.calendar')" icon="tim-icons icon-calendar-60"/>
         </b-collapse>
        </li>
     
     
       <li class="nav-item">

        <a v-b-toggle.collapse-2 class="nav-link" ><i class="tim-icons icon-bullet-list-67"></i>Mis Ramas </a>
        
         <b-collapse id="collapse-2" class="mt-2" style="background-color: rgb(21 21 33);" >
             <sidebar-link to="/calendar" :name="$t('sidebar.calendar')" icon="tim-icons icon-calendar-60"/>
             <sidebar-link to="/branch" :name="$t('sidebar.config')" icon="tim-icons icon-settings-gear-63"/>
         </b-collapse>
        </li>
          
    

      </template>
    </side-bar>
    </div>
    <div class="main-panel">
      <top-navbar></top-navbar>

      <dashboard-content @click.native="toggleSidebar">

      </dashboard-content>

      <content-footer></content-footer>
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



const URL = config.url.URL_API;

/**
 * Arma la URL de el servicio
 */
function buildURL(api, resource = "") {
  if (api == "URL_API") {
    return URL + resource;
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
   this.permission();
   this.initialsetup();
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
       initialsetup(){
           axios.get(buildURL("URL_API", "initialsetup"))
              .then(res => {
            localStorage.setItem('name_app',res.data[0][0].name_app);
            localStorage.setItem('telef_app',res.data[0][0].telef_app);
            localStorage.setItem('logo_app',res.data[0][0].logo_app);
            localStorage.setItem('email_app',res.data[0][0].email_app);
              }).catch(res => { });
        },
       permission() {
         const AuthToken = 'Bearer ' + localStorage.getItem('token');

         axios.get(buildURL("URL_API", "auth/me"),{headers:{ 
            'Authorization': AuthToken,
         }})
        .then((res) => {
          if(res.data.user.isActive == "Inactivo" ){
             axios.post(buildURL("URL_API", "auth/logout"),{ token: localStorage.getItem('token')})
        .then(res => {
          
          localStorage.removeItem('token');
          localStorage.removeItem('status');
          localStorage.removeItem('role');
          localStorage.removeItem('email');
          localStorage.removeItem('isActive');
          localStorage.removeItem('business_id');
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
    
 if(res.data.role.name == 'Admin_negocio' || res.data.role.name == 'Administrator'){
          localStorage.removeItem('status');
          localStorage.setItem('status', true);
          localStorage.setItem('role', res.data.role.name);
          localStorage.setItem('email', res.data.user.email);
          localStorage.setItem('isActive', res.data.user.isActive);
          localStorage.setItem('business_id', res.data.branch_data[0].business_id);
          }else{
          localStorage.removeItem('status');
          localStorage.setItem('status', false);
          localStorage.setItem('role', res.data.role.name);
          localStorage.setItem('email', res.data.user.email);
          localStorage.setItem('isActive', res.data.user.isActive);
          localStorage.setItem('isActive', res.data.user.isActive);
          localStorage.setItem('business_id', res.data.branch_data[0].business_id);
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


