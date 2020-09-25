<template>
  <card>
     <div class="row">
         <div class="col-md-12">
         <h5 slot="header" class="title">  <router-link to="/home"><base-button
                icon
                round
                simple
              data-toggle="tooltip" data-placement="top" title="Atras" style="color:rgba(82, 95, 127, 0.56);border-color: rgba(82, 95, 127, 0.56);">
                <i class="mdi mdi-keyboard-backspace text-black" style="font-size:35px;color:rgba(82, 95, 127, 0.56);"></i>
              </base-button></router-link>
        
                Verificación de perfíl de Usuario  </h5>
        </div>
      </div>
    <div class="row">
      <div class="col-md-12 pr-md-1">
        <el-steps :active="active" finish-status="success">
          <el-step title="Paso 1" description="Datos generales" icon="tim-icons icon-badge"></el-step>
          <el-step title="Paso 2" description="Domicilio" icon="tim-icons icon-square-pin"></el-step>
          <el-step title="Paso 3" description="Documentacion" icon="tim-icons icon-cloud-upload-94"></el-step>
        </el-steps>
      </div>
    </div>

     <p v-if="errors_validation.length">
    <b>Por favor, corrija el(los) siguiente(s) error(es):</b>
    <ul>
      <li v-for="error in errors_validation"><p style="color:#ff8578">{{ error }}</p></li>
    </ul>
  </p>

     <!-- formulario 1 -->

    <el-form v-if="active===0" ref="form0" :model="form0" label-width="90px">
      <div class="row">
        <div class="col-md-3 px-md-1">
          
          <base-input label="* Nombre" placeholder="Nombre" v-model="form0.name"></base-input>
        </div>
        <div class="col-md-3 px-md-1">
          <base-input
            label="* Apellido Paterno"
            placeholder="Primer Apellido"
            v-model="form0.firstname"
          ></base-input>
        </div>
        <div class="col-md-3 px-md-1">
          <base-input
            label="* Apellido Materno"
            placeholder="Segundo Apellido"
            v-model="form0.lastname"
          ></base-input>
        </div>
      
        
        <div class="col-md-3 px-md-1">
          <base-input label="* Fecha de Nacimiento">
            <el-date-picker
              format="dd/MM/yyyy"
              value-format="dd/MM/yyyy"
              v-model="form0.fechanacimiento"
              type="datetime"
              placeholder="Fecha de Nacimiento"
            ></el-date-picker>
          </base-input>
        </div>
        </div>
      <div class="row">
        <div class="col-md-3 px-md-1">
          <base-input label="* Email" placeholder="Email" v-model="form0.email"></base-input>
        </div>
        <div class="col-md-3 px-md-1">
          <base-input label="Telefono" placeholder="Telefono" v-model="form0.telefonocontacto1"></base-input>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 px-md-1">
          <base-input label="* Pais de Nacionalidad" v-model="form0.nombrepais"></base-input>
        </div>
        <div class="col-md-4 px-md-1">
          <base-input label="* Tipo de identificacion" v-model="form0.nombretipodocidentificacion"></base-input>
        </div>
        <div class="col-md-4 px-md-1">
          <base-input label="* Calidad Migratoria" v-model="form0.calidadmigratorias"></base-input>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 px-md-1">
          <base-input label="* Curp" placeholder="Curp" v-model="form0.curp"></base-input>
        </div>
        <div class="col-md-6">
          <base-input label="* RFC" placeholder="RFC" v-model="form0.rfc"></base-input>
        </div>
      </div>
      <div class="row">
         <div class="col-md-2">
          <base-button slot="footer" type="primary" fill @click="next">Siguiente</base-button>
        </div>
      </div>
    </el-form>

 <!-- formulario 2 -->

    <el-form v-if="active===1" ref="form1" :model="form1" label-width="90px">
      <div class="row">
        <div class="col-md-3 pr-md-1">
          <base-input
            label="* Codigo Postal"
            placeholder="Codigo Postal"
            v-model="form1.cp"
          ></base-input>
        </div>
        <div class="col-md-6 px-md-1">
          <base-input
            label="* Calle, avenida o vía y número exterior"
            placeholder="Calle, avenida o vía y número exterior"
            v-model="form1.address"
          ></base-input>
        </div>
        <div class="col-md-3 pl-md-1">
          <base-input
            label="Número Interior"
            placeholder="Número Interior"
            v-model="form1.numinterior"
          ></base-input>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3 pr-md-1">
          <base-input label="* Colonia" placeholder="Colonia" v-model="form1.colonia" disabled></base-input>
        </div>
        <div class="col-md-3 px-md-1">
          <base-input
            label="* Alcaldía o Municipio"
            placeholder="Alcaldía o Municipio"
            v-model="form1.municipio"
            disabled></base-input>
        </div>
        <div class="col-md-3 pl-md-1">
          <base-input label="* Estado" placeholder="Estado" v-model="form1.dc_estado" disabled></base-input>
        </div>
        <div class="col-md-3 pl-md-1">
          <base-input
            label="* País"
            placeholder="País"
            v-model="form1.pais"
            disabled></base-input>
        </div>
      </div>
      <div class="row">

        <div class="col-md-12">
          <base-button slot="footer" type="default" simple @click="back">Atras</base-button>
        
          <base-button slot="footer" type="primary" fill @click="next">Siguiente</base-button>
        </div>
         
      </div>
    </el-form>


     <!-- formulario 3 -->


   
    <el-form v-if="active===2" ref="form2" :model="form3" label-width="90px">
        <div class="row">
        <div class="col-md-6 px-md-1">
       <base-button slot="footer" round type="info" simple @click="print1"> <i class="mdi mdi-printer" style="font-size: 19px"> </i> {{form0.doc_name1}}</base-button>
  </div>
        </div>
      <div class="row">
        <div class="col-md-6 px-md-1">
       <base-button slot="footer" round type="info" simple @click="print2"> <i class="mdi mdi-printer" style="font-size: 19px"> </i> {{form0.doc_name2}}</base-button>
  </div>
        </div>
      <div class="row">
        <div class="col-md-6 px-md-1">
       <base-button slot="footer" round type="info" simple @click="print3"> <i class="mdi mdi-printer" style="font-size: 19px"> </i> {{form0.doc_name3}}</base-button>
  </div>
        </div>
      <div class="row">
        <div class="col-md-6 px-md-1">
       <base-button slot="footer" round type="info" simple @click="print4"> <i class="mdi mdi-printer" style="font-size: 19px"> </i> {{form0.doc_name4}}</base-button>
  </div>
        </div>
      <div class="row">
        <div class="col-md-6 px-md-1">
       <base-button slot="footer" round type="info" simple @click="print5"> <i class="mdi mdi-printer" style="font-size: 19px"> </i> {{form0.doc_name5}}</base-button>
  </div>
        </div>
      <div class="row" style="margin-top: 10px;">
         <div class="col-md-12">
          <base-button slot="footer" type="default" simple @click="back">Atras</base-button>
        </div>
        
      </div>
    </el-form>
    
  </card>
</template>
<script>
import config from "../../config";
import axios from "axios";
import { DatePicker, TimeSelect, Steps, Step, Form, Upload, Button } from "element-ui";
import NotificationTemplate from "../Notifications/NotificationTemplate";
import BaseAlert from "../../components/BaseAlert";


const URL_API_SUBASTA = config.url_api.URL_API_SUBASTA;
const URL_API_CENTRAL = config.url_api.URL_API_CENTRAL;
const URL_API = config.url_api.URL_API;
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
   name: "edit-user",
  components: {
    BaseAlert,
    [DatePicker.name]: DatePicker,
    [TimeSelect.name]: TimeSelect,
    [Steps.name]: Steps,
    [Step.name]: Step,
    [Form.name]: Form,
    [Upload.name]: Upload,
    [Button.name]: Button
  },
  data() {
    return {
      name_app: localStorage.getItem('name_app'),
      errors_validation: [],
      categoriaSelected: {},
      RoleSelected: {},
      IdemSelected: {},
      CmigratoriaSelected: {},
      countrySelected: 'Todos',
      cp:'',
      domicilio:{
        address_id:{},
        colonia:'',
        municipio:'',
        dc_estado:'',
        pais:'',
      },
      Idemtype: {},
      paises: {},
      roles: {},
      calidadmigratorias: {},
      bancos: {},
      active: 0,
      form0: {
        name:'',
        firstname:'',
        lastname:'',
        fechanacimiento:'',
        email:'',
        telefonocontacto1:'',
        nombrepais: '',
        nombretipodocidentificacion:'',
        curp:'',
        rfc:'',
      },
      form1: {
       cp:'',
       address:'',
       numinterior:'',
       colonia:'',
       colonia_id:'',
       municipio_id:'',
       estado_id:'',
       pais_id:'',
       municipio:'',
       dc_estado:'',
       pais:'',
      },
     
      form2: {
        fileList:{},
      },
      form3: {},
      form4: {},
      subasta: {
        precio_min: "",
        precio_max: "",
        inicio: "",
        final: "",
        autos_id: ""
      },
      isProcessing: false,
      errors: {},
      type: ["", "info", "success", "warning", "danger"],
      notifications: {
        topCenter: false
      },
      fileList: [{
          name: 'Curp.PDF',
          url: 'https://fuss10.elemecdn.com/3/63/4e7f3a15429bfda99bce42a18cdd1jpeg.jpeg?imageMogr2/thumbnail/360x360/format/webp/quality/100'
        }, {
          name: 'Documentacion.pdf',
          url: 'https://fuss10.elemecdn.com/3/63/4e7f3a15429bfda99bce42a18cdd1jpeg.jpeg?imageMogr2/thumbnail/360x360/format/webp/quality/100'
        }]
    };
  },
  props: {
    model:{},
    user: {}
  },
  created() {
    this.fetchuser();      
    this.fetchRoles();      
  },
  methods: {
    next() {
     
      if (this.active++ > 3) this.active = 0;
    },
    back() {
     
      if (this.active-- > 3) this.active = 0;
    },
     print1() {
   
     window.open( URL_API +'/'+ this.form0.doc1,"_blank");
    },
    print2() {
     window.open( URL_API +'/'+ this.form0.doc2,"_blank");
    },
    print3() {
     window.open( URL_API +'/'+ this.form0.doc3,"_blank");
    },
    print4() {
     window.open( URL_API +'/'+ this.form0.doc4,"_blank");
    },
    print5() {
     window.open( URL_API +'/'+ this.form0.doc5,"_blank");
    },
     sendValidator(){
      this.errors_validation = [];
      
      if (this.RoleSelected == 19 || this.RoleSelected == 24 || this.RoleSelected == 11) {
this.sendActivation();
      }else{
this.errors_validation.push("Debe especificar un rol para el usuario.");
      }   
    },
     sendValidatordisable(){
      this.errors_validation = [];
      
      if (this.RoleSelected == 19 || this.RoleSelected == 24 || this.RoleSelected == 11) {
this.sendDeactivation();
      }else{
this.errors_validation.push("Debe especificar un rol para el usuario.");
      }   
    },

    fetchuser(){ 
 axios.get(buildURL("URL_API_SUBASTA", "auth/me"),{ headers:{'Authorization': 'Bearer ' + localStorage.getItem('token')}}).then((res) => {
 axios.get(buildURL("URL_API_SUBASTA", "fetchuser/" + res.data.setter))
        .then(res => {
         
            this.form0 = {
        name:res.data[0].userpersona[0].personas[0].nombres,
        firstname: res.data[0].userpersona[0].personas[0].apellidopaterno,
        lastname: res.data[0].userpersona[0].personas[0].apellidomaterno,
        fechanacimiento:res.data[0].userpersona[0].personas[0].fechanacimiento, 
        email: res.data[0].email,
        telefonocontacto1:res.data[0].userpersona[0].personas[0].telefonocontacto1, 
        nombrepais: res.data[0].userpersona[0].personas[0].pais[0].nombrepais,
        nombretipodocidentificacion: res.data[0].userpersona[0].personas[0].tipodocidentificacion_id,
        calidadmigratorias: res.data[0].userpersona[0].personas[0].calidadmigratoria[0].nombrecalidadmigratoria,
        curp: res.data[0].userpersona[0].personas[0].curp,
        rfc: res.data[0].userpersona[0].personas[0].rfc,
            }
            this.form1 = {
             cp:res.data[0].userpersona[0].personas[0].domicilio[0].colonia[0].codigopostal,
       address:res.data[0].userpersona[0].personas[0].domicilio[0].lugardomicilio,
       numinterior:res.data[0].userpersona[0].personas[0].domicilio[0].numerointerior,
       colonia:res.data[0].userpersona[0].personas[0].domicilio[0].colonia[0].nombrecolonia,
       municipio:res.data[0].userpersona[0].personas[0].domicilio[0].colonia[0].municipio[0].nombremunicipio,
       dc_estado:res.data[0].userpersona[0].personas[0].domicilio[0].colonia[0].municipio[0].estadoterritorial[0].nombreestadoterritorial,
       pais:res.data[0].userpersona[0].personas[0].domicilio[0].colonia[0].municipio[0].estadoterritorial[0].pais[0].nombrepais,
            }
            
            this.form2 = {

            }

        }).catch(err => console.log(err));
        }).catch((error) => {console.log(error);});

    },
    
    sendActivation(){
      this.isProcessing = true;
 axios.post(buildURL("URL_API_SUBASTA", "activateUser/" + this.$route.params.id), {id:  this.RoleSelected})
 .then((res) => {
   
          this.isProcessing = false;
          this.$router.push('/users');
this.$notify({
            message: 'Usuario: '+ this.form0.email+' Activado !!!!',
            title: this.name_app,
            component: NotificationTemplate,
            icon: "tim-icons icon-bell-55",
            type: "success",
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
              
            message: 'Error en la activacion',
            title: this.name_app,
            component: NotificationTemplate,
            icon: "tim-icons icon-bell-55",
            type: "danger",
            timeout: 4000
          });
          }
        });
        },
    sendDeactivation(){
      this.isProcessing = true;
 axios.post(buildURL("URL_API_SUBASTA", "deactivateUser/" + this.$route.params.id), {id:  this.RoleSelected})
 .then((res) => {
   
          this.isProcessing = false;
          this.$router.push('/users');
this.$notify({
            message: 'Usuario: '+ this.form0.email+' Desactivado !!!!',
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
              
            message: 'Error en la Desactivacion',
            title: this.name_app,
            component: NotificationTemplate,
            icon: "tim-icons icon-bell-55",
            type: "danger",
            timeout: 4000
          });
          }
        });
        },
    handleChange(file, fileList) {
        this.fileList = fileList.slice(-3);
      },


      ///////////////////////////////////// populate selects
      fetchPaises() {
      axios
        .get(buildURL("URL_API_SUBASTA", "listPaises"))
        .then(res => {
          
          
          this.paises = res.data.data;
        })
        .catch(err => console.log(err));
    },
      fetchRoles(){
 axios.get(buildURL("URL_API_SUBASTA", "listRoles"))
        .then(res => {
          this.roles = res.data.data;
        })
        .catch(err => console.log(err));
    },
      fetchIdem() {
      axios
        .get(buildURL("URL_API_SUBASTA", "listIdem"))
        .then(res => {
          this.Idemtype = res.data.data;
        })
        .catch(err => console.log(err));
    },
      fetchCmigra() {
      axios
        .get(buildURL("URL_API_SUBASTA", "listCmigra"))
        .then(res => {
          
          this.calidadmigratorias = res.data.data;
        })
        .catch(err => console.log(err));
    }, 

  }
};
</script>
<style>
</style>
