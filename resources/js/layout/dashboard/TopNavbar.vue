<template>
  <div>
    <nav
      class="navbar navbar-expand-lg navbar-absolute"
      :class="{'bg-white': showMenu, 'navbar-transparent': !showMenu}"
    >
      <div class="container-fluid">
        <div class="navbar-wrapper">
          <div class="navbar-toggle d-inline" :class="{toggled: $sidebar.showSidebar}">
            <button
              type="button"
              class="navbar-toggler"
              aria-label="Navbar toggle button"
              @click="toggleSidebar"
            >
              <span class="navbar-toggler-bar bar1"></span>
              <span class="navbar-toggler-bar bar2"></span>
              <span class="navbar-toggler-bar bar3"></span>
            </button>
          </div>
          <strong>
            <a class="navbar-brand" href="#" style="font-size:20px;margin-left: auto;margin-right: auto;padding-bottom: 10px">{{name_app}}</a>
          </strong>
        </div>

        <modal
          :show.sync="searchModalVisible"
          class="modal-search"
          id="searchModal"
          :centered="false"
          :show-close="true"
        >
          <input
            slot="header"
            v-model="searchQuery"
            type="text"
            class="form-control"
            id="inlineFormInputGroup"
            placeholder="SEARCH"
          />

          <input
            slot="header"
            v-model="searchQuery"
            type="text"
            class="form-control"
            id="1"
            placeholder="year"
          />

          <input
            slot="header"
            v-model="searchQuery"
            type="text"
            class="form-control"
            id="2"
            placeholder="brand"
          />

          <input
            slot="header"
            v-model="searchQuery"
            type="text"
            class="form-control"
            id="3"
            placeholder="color"
          />
        </modal>
        <button
          class="navbar-toggler"
          type="button"
          @click="toggleMenu"
          data-toggle="collapse"
          data-target="#navigation"
          aria-controls="navigation-index"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-bar navbar-kebab"></span>
          <span class="navbar-toggler-bar navbar-kebab"></span>
          <span class="navbar-toggler-bar navbar-kebab"></span>
        </button>

        <collapse-transition>
          <div class="collapse navbar-collapse show" v-show="showMenu">
            <ul class="navbar-nav" :class="$rtl.isRTL ? 'mr-auto' : 'ml-auto'">
             
              <base-dropdown tag="li"
                           :menu-on-right="!$rtl.isRTL"
                           title-tag="a" class="nav-item dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="true">
              <a slot="title" href="#" class="nav-link">
                  <div class="notification d-none d-lg-block d-xl-block" style="color:#fb4d4a;background: #f5f6fa;border: 0px solid #f5f6fa;"> {{ notifica === '0' ? '0' : notifica.length }}</div>
                  <i class="mdi mdi-bell-ring-outline"></i>
                  <p class="d-lg-none">Notificaciones Recientes <span style="color:#fb4d4a;">{{ notifica === '0' ? '0' : notifica.length }}</span></p>
                </a>
                
                <div v-if="notifica === '0'">
                   <li class="nav-link">
                  <p class="nav-item dropdown-item"><i class="mdi mdi-bell-ring-outline" 
                                                       style="margin-right:10px; font-size:15px;"></i> Sin notificaciones</p>
                </li>
                  </div><div v-else>
 <div v-for="item in notifica" class="col-lg-4" :key="item.id">
                <li class="nav-link">
                  <p class="nav-item dropdown-item"><i class="mdi mdi-trash-can-outline text-danger" 
                                                       style="margin-right:10px; font-size:15px;"  
                                                       @click="delete_notification(item.id)"></i> {{ item.msg }}<i class="mdi mdi-arrow-right-circle text-success" 
                                                       style="margin-left:20px; font-size:20px;"  
                                                       @click="go_to_link(item.url)" v-show="item.type == 0 ? false : true"></i> </p>
                </li>
                </div>
                </div>
               
              </base-dropdown>
               <base-dropdown tag="li"
                           :menu-on-right="!$rtl.isRTL"
                           title-tag="a" class="nav-item dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="true">
              <a slot="title" href="#" class="nav-link">
                <div class="photo">
                 <img v-bind:src="avatar" alt="" style="shadow">
                </div>
                <b class="caret d-none d-lg-block d-xl-block"></b>
                <p class="d-lg-none">
                  Opciones de inicio
                </p>
              </a>
              <li class="nav-link" v-if="token === null">
                 <router-link to="/registro" class="nav-item dropdown-item">Registrarse</router-link>
              </li>
              <li class="nav-link" v-if="token === null">
                 <router-link to="/login" class="nav-item dropdown-item">Iniciar sesión</router-link>
              </li>
              <div class="dropdown-divider" v-if="token != null">
              </div>
              <li class="nav-link" v-if="token != null">
                <router-link to="/profile" class="nav-item dropdown-item">Perfíl</router-link>
                <a href="#" class="nav-item dropdown-item" v-on:click="logout">Salir</a>
              </li>
            </base-dropdown>
            </ul>
          </div>
        </collapse-transition>
      </div>
    </nav>
    
  
  </div>
</template>
<script>
import config from "../../config";
import axios from "axios";
import { CollapseTransition } from "vue2-transitions";
import Modal from "../../components/Modal";
import NotificationTemplate from "../../pages/Notifications/NotificationTemplate";
import BaseAlert from "../../components/BaseAlert";

const URL_API  = config.url.URL_API;
const URL_STORAGE = config.url.URL_STORAGE;;
/**
 * Arma la URL de el servicio
 */
function buildURL(api, resource = "") {
  if (api == "URL_API") {
    return URL_API  + resource;
  }
  
}

export default {
  components: {
    CollapseTransition,
    Modal,
    BaseAlert,
    
  },
  computed: {
    isRTL() {
      return this.$rtl.isRTL;
    }
  },
  data() {
    return {
      token: localStorage.getItem('token'),
      name_app: localStorage.getItem('name_app'),
      loginModalVisible: false,
      activeNotifications: false,
      showMenu: false,
      searchModalVisible: false,
      searchQuery: "",
      notifica:{},
      id:"",
      loginRequest: {
        email: "",
        password: ""
      },
      errors: {
        message: ''
      },
      isProcessing: false,
      // installBtn: "none",
     avatar: URL_STORAGE+'/upload_documentos/avatar.png',

    };
  },
   created(){
   },
  methods: {

  
    toggleNotificationDropDown() {
      this.activeNotifications = !this.activeNotifications;
    },
    closeDropDown() {
      this.activeNotifications = false;
    },
    toggleSidebar() {
      this.$sidebar.displaySidebar(!this.$sidebar.showSidebar);
    },
    hideSidebar() {
      this.$sidebar.displaySidebar(false);
    },
    toggleMenu() {
      this.showMenu = !this.showMenu;
    },
    go_to_link(url){

this.$router.push(url);

    },
   get_notifications(){
            
    if(localStorage.getItem('email') == null){
    this.notifica = '0';
    }else{
        const AuthToken = "Bearer " + localStorage.getItem('token')
       axios.get(buildURL("URL_API", "auth/me"),{headers:{ 
            'Authorization': AuthToken,
         }})
        .then((res) => {
          if(res.data.user.imageUrl === null){
           this.avatar = URL_STORAGE+'/upload_documentos/avatar.png';
          }else{
           this.avatar = URL_API+'/'+res.data.user.imageUrl;
          }
         
           axios.get(buildURL("URL_API", "notificame/" + res.data.setter))
            .then(res => {
              if(res.data.data.length > 0){
  this.notifica = res.data.data
              }else{
this.notifica = '0';
              }
            
              }).catch(err => console.log(err));
}).catch((error) => {
             console.log(error);
            });

      
    }
   },
   updateNotifications(){
Echo.channel('notifica').listen('NotifyEvent', (e) => {
  this.get_notifications();
  
});
},
   delete_notification(id){
    
    this.updateNotifications();
      axios.get(buildURL("URL_API", "destroy_notifica/" + id),{ header:{
                "Access-Control-Allow-Origin": "*"}})
        .then(res => {
          
          this.get_notifications();
          
        })
        .catch(err => console.log(err));
  
   },
    logout() {
     

      if(localStorage.getItem('token') == null){
        this.$router.push('/out');
      }else{
       axios.post(buildURL("URL_API", "auth/logout"),{ token: localStorage.getItem('token')},{header:{ 
           "Access-Control-Allow-Origin": "*"
         }})
        .then(res => {
          
          localStorage.removeItem('token');
          localStorage.removeItem('status');
          localStorage.removeItem('role');
          localStorage.removeItem('email');
          localStorage.removeItem('isActive');
          localStorage.removeItem('business_id');
          
          this.$router.push('/out');
        }).catch(err => {
          localStorage.removeItem('token');
          localStorage.removeItem('status');
          localStorage.removeItem('role');
          localStorage.removeItem('email');
          localStorage.removeItem('isActive');
          localStorage.removeItem('business_id');
          this.$router.push('/out');
         
        });
    }
    },

    
  }
};


</script>
<style>

</style>