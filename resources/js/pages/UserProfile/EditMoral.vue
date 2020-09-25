<template>
  <card >
    <div class="row">
         <div class="col-md-12">
         <h5 slot="header" class="title">  <router-link to="/users"><base-button
                icon
                round
                simple
              data-toggle="tooltip" data-placement="top" title="Atras" style="color:rgba(82, 95, 127, 0.56);border-color: rgba(82, 95, 127, 0.56);">
                <i class="mdi mdi-keyboard-backspace text-black" style="font-size:35px;color:rgba(82, 95, 127, 0.56);"></i>
              </base-button></router-link>
        
                Verificación de perfíl de Usuario Empresa  </h5>
        </div>
      </div>
    <div class="row">
      <div class="col-md-12 pr-md-1">
        <el-steps :active="active" finish-status="success">
          <el-step title="Paso 1" description="Datos De Representante" icon="tim-icons icon-badge"></el-step>
          <el-step title="Paso 2" description="Datos Empresa" icon="tim-icons icon-badge"></el-step>
          <el-step title="Paso 3" description="Ubicación" icon="tim-icons icon-square-pin"></el-step>
          <el-step title="Paso 4" description="Documentación Empresa" icon="tim-icons icon-cloud-upload-94"></el-step>
          <el-step title="Paso 5" description="Documentación Representante" icon="tim-icons icon-cloud-upload-94"></el-step>
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
          <base-input label="Telefono" placeholder="* Telefono" v-model="form0.telefonocontacto1"></base-input>
        </div>
      
        
        
        </div>
      <div class="row">
        
        <div class="col-md-6 px-md-1">
          <base-input label="* Email" placeholder="Email" v-model="form0.email"></base-input>
        </div>
        <div class="col-md-6 px-md-1">
          <base-input label="* RFC" placeholder="RFC" v-model="form0.rfc"></base-input>
        </div>
      </div>
      
      <div class="row">
         <div class="col-md-12 px-md-1">
          <base-button slot="footer" type="primary" fill @click="next">Siguiente</base-button>
        </div>
      </div>
    </el-form>

 <!-- formulario 2 -->

    <el-form v-if="active===1" ref="form2" :model="form2" label-width="90px">
      <div class="row">
        <div class="col-md-8 px-md-1">
          
          <base-input label="* Nombre Completo del cliente, Denominación o razón social sin abreviaturas" placeholder="Nombre Empresa" v-model="form2.name_empresa"></base-input>
        </div>
        <div class="col-md-4 px-md-1">
          <base-input label="* Fecha de Constitución">
            <el-date-picker
              format="dd/MM/yyyy"
              value-format="dd/MM/yyyy"
              v-model="form2.fecha_constit"
              type="datetime"
              placeholder="Fecha de Constitución"
            ></el-date-picker>
          </base-input>
        </div>
        </div>
        <div class="row">
       
<div class="col-md-3 px-md-1">
          <base-input label="* País de Nacionalidad" placeholder=" País de Nacionalidad" v-model="form2.pais_nac"></base-input>
        
        </div>
        <div class="col-md-3 px-md-1">
          
          <base-input label="* RFC" placeholder="RFC" v-model="form2.rfc"></base-input>
        </div>
        <div class="col-md-3 px-md-1">
          
          <base-input label="* Número de Escritura Pública" placeholder="Número de Escritura Pública" v-model="form2.numero_e_publica"></base-input>
        </div>
        <div class="col-md-3 px-md-1">
          
          <base-input label="* Número de Notaría Pública" placeholder="Número de Notaría Pública" v-model="form2.numero_n_publica"></base-input>
        </div>
      </div>
       <div class="row">
       
<div class="col-md-3 px-md-1">
         
          <label>
            <span class="required">*</span> Estado de la Notaría
          </label>
          <select class="form-control" v-model="form2.notaria_estado" @change="fetchEstados">
             <option v-for="item in estados" v-bind:value="item.id">{{ item.nombreestadoterritorial }}</option> 
            
          </select>
        
        </div>
<div class="col-md-6 px-md-1">
          
          <base-input label="* Nombre del Notario Público" placeholder="Nombre del Notario Público" v-model="form2.nombre_notario"></base-input>
        </div>
<div class="col-md-3 px-md-1">
          
          <base-input label="* Teléfono del Notario Público" placeholder="Teléfono del Notario Público" v-model="form2.telef_notario"></base-input>
        </div>
        </div>
      <div class="row">
       
       
<div class="col-md-4 px-md-1">
          
          <base-input label="* Correo Electrónico" placeholder="Correo Electrónico" v-model="form2.email"></base-input>
        </div>
<div class="col-md-4 px-md-1">
          
          <base-input label="* Teléfono a 10 digitos" placeholder="Teléfono a 10 digitos" v-model="form2.telefono"></base-input>
        </div>
<div class="col-md-4 px-md-1">
          
          <base-input label="* Teléfono 2 de contacto" placeholder="Teléfono 2 de contacto" v-model="form2.telefono2"></base-input>
        </div>
        </div>
        <div class="row">
       
       

 <div class="col-md-4 px-md-1">
   
          <base-input label="* Fecha de Inscripción RPPC">
            <el-date-picker
              format="dd/MM/yyyy"
              value-format="dd/MM/yyyy"
              v-model="form2.fecha_rppc"
              type="datetime"
              placeholder="Fecha de Inscripción RPPC"
            ></el-date-picker>
          </base-input>
        </div>
<div class="col-md-4 px-md-1">
          
          <base-input label="* Folio" placeholder="Folio" v-model="form2.folio_rppc"></base-input>
        </div>
        </div>
        <div class="row">
       
       
<div class="col-md-8 px-md-1">
          
          <base-input label="* Actividad Giro Mercantil, Objeto Social que desempeña(Empresas Extranjeras)" placeholder="Actividad Giro Mercantil, Objeto Social que desempeña(Empresas Extranjeras)" v-model="form2.actividad"></base-input>
        </div>
 
<div class="col-md-4 px-md-1">
          
          <base-input label="* SIEM" placeholder="SIEM" v-model="form2.siem"></base-input>
        </div>
        </div>
      <div class="row">

        <div class="col-md-12">
          <base-button slot="footer" type="default" simple @click="back">Atras</base-button>
        
          <base-button slot="footer" type="primary" fill @click="next">Siguiente</base-button>
        </div>
         
      </div>
    </el-form>
 <!-- formulario 2 -->

    <el-form v-if="active===2" ref="form1" :model="form1" label-width="90px">
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


    
    <el-form v-if="active===3" ref="form3" :model="form3" label-width="90px">

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
        
          <base-button slot="footer" type="primary" fill @click="next">Siguiente</base-button>
        </div>
        
      </div>
    </el-form>

     <!-- formulario 3 -->


    
    <el-form v-if="active===4" ref="form4" :model="form4" label-width="90px">

      <div class="row">
        <div class="col-md-6 px-md-1">
       <base-button slot="footer" round type="info" simple @click="print6"> <i class="mdi mdi-printer" style="font-size: 19px"> </i> {{form0.doc_name6}}</base-button>
  </div>
        </div>
      <div class="row">
        <div class="col-md-6 px-md-1">
       <base-button slot="footer" round type="info" simple @click="print7"> <i class="mdi mdi-printer" style="font-size: 19px"> </i> {{form0.doc_name7}}</base-button>
  </div>
        </div>
      <div class="row">
        <div class="col-md-6 px-md-1">
       <base-button slot="footer" round type="info" simple @click="print8"> <i class="mdi mdi-printer" style="font-size: 19px"> </i> {{form0.doc_name8}}</base-button>
  </div>
        </div>
      <div class="row">
        <div class="col-md-6 px-md-1">
       <base-button slot="footer" round type="info" simple @click="print9"> <i class="mdi mdi-printer" style="font-size: 19px"> </i> {{form0.doc_name9}}</base-button>
  </div>
        </div>
      <div class="row">
        <div class="col-md-6 px-md-1">
       <base-button slot="footer" round type="info" simple @click="print10"> <i class="mdi mdi-printer" style="font-size: 19px"> </i> {{form0.doc_name10}}</base-button>
  </div>
        </div>
      <div class="row">
        <div class="col-md-6 px-md-1">
       <base-button slot="footer" round type="info" simple @click="print11"> <i class="mdi mdi-printer" style="font-size: 19px"> </i> {{form0.doc_name11}}</base-button>
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
import { DatePicker, TimeSelect, Steps, Step, Form, Upload, Button, Switch} from "element-ui";
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
  name: "edit-moral",
  components: {
    BaseAlert,
    [DatePicker.name]: DatePicker,
    [TimeSelect.name]: TimeSelect,
    [Steps.name]: Steps,
    [Step.name]: Step,
    [Form.name]: Form,
    [Upload.name]: Upload,
    [Switch.name]: Switch,
    [Button.name]: Button
  },
  data() {
    return {
      name_app: localStorage.getItem('name_app'),
      stado1:"default",
      stado2:"default",
      stado3:"default",
      stado4:"default",
      stado5:"default",
      switch_val: false,
      errors_validation: [],
      categoriaSelected: {},
      BancoSelected: {},
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
      estados: {},
      calidadmigratorias: {},
      bancos: {},
      roles: {},
      active: 0,
      form0: {
        name:'',
        firstname:'',
        lastname:'',
        password:'',
        password_confirmation:'',
        email:'',
        telefonocontacto1:'',
        rfc:'',
        doc1:'',
doc_name1:'',
doc2:'',
doc_name2:'',
doc3:'',
doc_name3:'',
doc4:'',
doc_name4:'',
doc5:'',
doc_name5:'',
doc6:'',
doc_name6:'',
doc7:'',
doc_name7:'',
doc8:'',
doc_name8:'',
doc9:'',
doc_name9:'',
doc10:'',
doc_name10:'',
doc11:'',
doc_name11:'',
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
       name_empresa:'',
       fecha_constit:'',
       pais_nac:'',
       rfc:'',
       numero_e_publica:'',
       numero_n_publica:'',
       notaria_estado:'',
       nombre_notario:'',
       telef_notario:'',
       email:'',
       telefono:'',
       telefono2:'',
       ins_rppc:'',
       fecha_rppc:'',
       folio_rppc:'',
       actividad:'',
       siem:'',
      },
      
      form3: {},
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
        }],
        comprobanteDomicilioFile:'',
        comprobanteDomicilioName:'',
        datosBancariosFile:'',
        datosBancariosName:'',
        ActaFile:'',
        ActaName:'',
        rfcFile:'',
        rfcName:'',
        podernotarialFile:'',
        podernotarialName:'',
    };
  },
  props: {
    model:{},
    user: {}
  },
  created() {
    this.fetchPaises();
    this.fetchIdem();
    this.fetchCmigra();
    this.fetchuser();      
    this.fetchRoles();
    this.fetchEstados();
   
  },
  methods: {
    OpenimgUpload(){
     
    },
    next() {
     
      if (this.active++ > 4) this.active = 0;
    },
    back() {
     
      if (this.active-- > 4) this.active = 0;
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
    print6() {
      
     window.open( URL_API +'/'+ this.form0.doc6,"_blank");
    },
    print7() {
     window.open( URL_API +'/'+ this.form0.doc7,"_blank");
    },
    print8() {
     window.open( URL_API +'/'+ this.form0.doc8,"_blank");
    },
    print9() {
     window.open( URL_API +'/'+ this.form0.doc9,"_blank");
    },
    print10() {
     window.open( URL_API +'/'+ this.form0.doc10,"_blank");
    },
    print11() {
     window.open( URL_API +'/'+ this.form0.doc11,"_blank");
    },
    SendcodigoPostal() {
      axios.get(buildURL("URL_API_SUBASTA", "postalcode"), {
          params: {cp: this.cp,}})
        .then((res) => {let result = []; 
         
         if (res.data.data === null) {
            this.errors = 'Codigo Postal indefinido';
            this.isProcessing = false;

            this.$notify({
          message: this.errors,
          title: this.name_app,
          component: NotificationTemplate,
          icon: "tim-icons icon-bell-55",
          type: 'warning',
          timeout: 2000
        });}else{
         
 result = {
              address_id: res.data.data,
              colonia: res.data.data.nombrecolonia,         
              municipio: res.data.data.nombremunicipio,         
              dc_estado: res.data.data.nombreestadoterritorial,         
              pais: res.data.data.nombrepais, 
              
              

            };
            this.domicilio = result;
          }
        })
        .catch((err) => console.log(err));
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


    validEmail: function(email){
    var re= /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    },
    validCurp: function(curp){
    var re= /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/;
      return re.test(curp);
    },
    validRfc: function(rfc){
    var re= /^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/;
      return re.test(rfc);
    },
    fetchuser(){
        
 axios.get(buildURL("URL_API_SUBASTA", "fetchuser/" + this.$route.params.id))
        .then(res => {
         
            this.form0 = {
        name:res.data[0].userpersona[0].personas[0].nombres,
        firstname: res.data[0].userpersona[0].personas[0].apellidopaterno,
        lastname: res.data[0].userpersona[0].personas[0].apellidomaterno,
        email: res.data[0].email,
        telefonocontacto1:res.data[0].userpersona[0].personas[0].telefonocontacto1,
        rfc: res.data[0].userpersona[0].personas[0].rfc,

        doc1: res.data[0].doc_user[0].docs[0].url, 
        doc_name1: res.data[0].doc_user[0].docs[0].nombredocumento, 
        doc2: res.data[0].doc_user[1].docs[0].url, 
        doc_name2: res.data[0].doc_user[1].docs[0].nombredocumento, 
        doc3: res.data[0].doc_user[2].docs[0].url, 
        doc_name3: res.data[0].doc_user[2].docs[0].nombredocumento, 
        doc4: res.data[0].doc_user[3].docs[0].url, 
        doc_name4: res.data[0].doc_user[3].docs[0].nombredocumento, 
        doc5: res.data[0].doc_user[4].docs[0].url, 
        doc_name5: res.data[0].doc_user[4].docs[0].nombredocumento, 

        doc6: res.data[0].doc_user[0].docs[0].url, 
        doc_name6: res.data[0].doc_user[0].docs[0].nombredocumento, 
        doc7: res.data[0].doc_user[1].docs[0].url, 
        doc_name7: res.data[0].doc_user[1].docs[0].nombredocumento, 
        doc8: res.data[0].doc_user[2].docs[0].url, 
        doc_name8: res.data[0].doc_user[2].docs[0].nombredocumento, 
        doc9: res.data[0].doc_user[3].docs[0].url, 
        doc_name9: res.data[0].doc_user[3].docs[0].nombredocumento, 
        doc10: res.data[0].doc_user[4].docs[0].url, 
        doc_name10: res.data[0].doc_user[4].docs[0].nombredocumento, 
        doc11: res.data[0].doc_user[4].docs[0].url, 
        doc_name11: res.data[0].doc_user[4].docs[0].nombredocumento, 
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
              name_empresa: res.data[0].userpersona[0].personas[0].personamoral[0].nombrecompleto,
fecha_constit: res.data[0].userpersona[0].personas[0].personamoral[0].fechaconstitucion,
pais_nac: res.data[0].userpersona[0].personas[0].personamoral[0].pais[0].nombrepais,
rfc: res.data[0].userpersona[0].personas[0].personamoral[0].rfc,
numero_e_publica: res.data[0].userpersona[0].personas[0].personamoral[0].notaria[0].escriturapublicanumero,
numero_n_publica: res.data[0].userpersona[0].personas[0].personamoral[0].notaria[0].notariopubliconumero,
notaria_estado: res.data[0].userpersona[0].personas[0].personamoral[0].notaria[0].estado_id,
nombre_notario: res.data[0].userpersona[0].personas[0].personamoral[0].notaria[0].notariopubliconombre,
telef_notario: res.data[0].userpersona[0].personas[0].personamoral[0].notaria[0].telefonocontactonotaria,
email: res.data[0].userpersona[0].personas[0].personamoral[0].email,
telefono: res.data[0].userpersona[0].personas[0].personamoral[0].telefonocontacto1,
telefono2: res.data[0].userpersona[0].personas[0].personamoral[0].telefonocontacto2,
ins_rppc: res.data[0].userpersona[0].personas[0].personamoral[0],
fecha_rppc: res.data[0].userpersona[0].personas[0].personamoral[0].fecharppc,
folio_rppc: res.data[0].userpersona[0].personas[0].personamoral[0].foliorppc,
actividad: res.data[0].userpersona[0].personas[0].personamoral[0].actividadrealiza,
siem: res.data[0].userpersona[0].personas[0].personamoral[0].siem,

            }

        }).catch(err => console.log(err));

    },
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
 notificaActiva(){
       let formData = new FormData();
      formData.append('user_id', this.$route.params.id);
      formData.append('msg','Su usuario ha sido Activado');
      formData.append('url','');
      formData.append('type','0');

axios.post(buildURL("URL_API_SUBASTA", "activa_notifica"), formData)
 .then((res) => {
   
     
        }).catch((error) => {console.log(error);});
    },
 notificaDesactiva(){
       let formData = new FormData();
      formData.append('user_id', this.$route.params.id);
      formData.append('msg','Su usuario ha sido Rechazado');
      formData.append('url','');
      formData.append('type','0');

axios.post(buildURL("URL_API_SUBASTA", "activa_notifica"), formData)
 .then((res) => {
   
      
        }).catch((error) => {console.log(error);});
    },

            sendActivation(){
      this.isProcessing = true;
 axios.post(buildURL("URL_API_SUBASTA", "activateUser/" + this.$route.params.id), {id:  this.RoleSelected})
 .then((res) => {
   
          this.isProcessing = false;
          this.$router.push('/users');
          this.notificaActiva();
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
          this.notificaDesactiva();
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
    handleChange1(e) {
       
         this.comprobanteDomicilioFile = e.target.files[0];
         this.comprobanteDomicilioName = e.target.files[0].name;
  this.stado1="info";
      },
    handleChange2(e) {
       
         this.datosBancariosFile = e.target.files[0];
         this.datosBancariosName = e.target.files[0].name;
       this.stado2="info";
      },
    handleChange3(e) {
     
         this.ActaFile = e.target.files[0];
         this.ActaName = e.target.files[0].name;
       this.stado3="info";
      },
    handleChange4(e) {
       
         this.rfcFile = e.target.files[0];
         this.rfcName = e.target.files[0].name;
       this.stado4="info";
      },
    handleChange5(e) {
       
         this.podernotarialFile = e.target.files[0];
         this.podernotarialName = e.target.files[0].name;
       this.stado5="info";
      },
    

       ///////////////////////////////////// populate selects
        fetchEstados() {
      axios
        .get(buildURL("URL_API_SUBASTA", "listEstados"))
        .then(res => {
          
          this.estados = res.data.data;
        })
        .catch(err => console.log(err));
    }, 
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
