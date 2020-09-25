<template>
  <card>
    <h5 slot="header" class="title">Completar Perfíl Persona Física</h5>
    <div class="row">
      <div class="col-md-12 pr-md-1">
        <el-steps :active="active" finish-status="success">
          <el-step title="Paso 1" description="Datos generales" icon="tim-icons icon-badge"></el-step>
          <el-step title="Paso 2" description="Domicilio" icon="tim-icons icon-square-pin"></el-step>
          <el-step title="Paso 3" description="Documentación" icon="tim-icons icon-cloud-upload-94"></el-step>
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
          <base-input label="Teléfono" placeholder="* Teléfono" v-model="form0.telefonocontacto1"></base-input>
        </div>
        <div class="col-md-3 px-md-1">
          <base-input label="* Email" placeholder="Email" v-model="form0.email"></base-input>
        </div>
        <div class="col-md-3 px-md-1">
          <base-input type="password" label="* Contraseña" placeholder="Contraseña" v-model="form0.password"></base-input>
        </div>
        <div class="col-md-3 px-md-1">
          <base-input type="password" label="* Confirmación de Contraseña" placeholder="Confirmación de Contraseña" v-model="form0.password_confirmation"></base-input>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 px-md-1">
          <label>
            <span class="required">*</span> País de Nacionalidad
          </label>
          <select class="form-control" v-model="countrySelected" @change="fetchPaises">
             <option v-for="item in paises" v-bind:value="item.id">{{ item.nombrepais }}</option> 
            
          </select>
        </div>
        <div class="col-md-4 px-md-1">
          <label>
            <span class="required">*</span> Tipo de identificación
          </label>
          <select class="form-control" v-model="IdemSelected" @change="fetchIdem">
            <option v-for="item in Idemtype" v-bind:value="item.id">{{ item.nombretipodocidentificacion }}</option> 
          </select>
        </div>
        <div class="col-md-4 px-md-1">
          <label>
            <span class="required">*</span> Calidad Migratoria
          </label>
          <select class="form-control" v-model="CmigratoriaSelected" @change="fetchCmigra">
            <option v-for="item in calidadmigratorias" v-bind:value="item.id">{{ item.nombrecalidadmigratoria }}</option> 
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 px-md-1">
          <base-input label="* Curp" placeholder="Curp" v-model="form0.curp" @keyup="toUpperCurp"></base-input>
        </div>
        <div class="col-md-6 px-md-1">
          <base-input label="* RFC" placeholder="RFC" v-model="form0.rfc" @keyup="toUpperRfc"></base-input>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 px-md-1">
        <input type="file" v-on:change="handleAvatar" ref="AvatarFile" style="display:none;"/>
      <base-button round :type="stado0" simple @click="$refs.AvatarFile.click()"><i class="mdi mdi-cloud-upload-outline" style="font-size:19px;"> </i> Avatar</base-button>
        </div>
        </div>
      <div class="row">
         <div class="col-md-12 px-md-1">
          <base-button slot="footer" type="primary" fill @click="next">Siguiente</base-button>
        </div>
      </div>

    </el-form>

 <!-- formulario 2 -->

    <el-form v-if="active===1" ref="form1" :model="form1" label-width="90px">
      <div class="row">
        <div class="col-md-3 pr-md-1">
          <base-input
            label="* Código Postal"
            placeholder="Código Postal"
            v-model="cp"
            @keyup="SendcodigoPostal"
          ></base-input>
        </div>
        <div class="col-md-6 px-md-1">
          <base-input
            label="* Calle, avenida o vía y número exterior"
            placeholder="Calle, avenida o vía y número exterior"
            v-model="user.address"
          ></base-input>
        </div>
        <div class="col-md-3 pl-md-1">
          <base-input
            label="Número Interior"
            placeholder="Número Interior"
            v-model="user.numinterior"
          ></base-input>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3 pr-md-1">
           
          <label>
            <span class="required">*</span> Colonia
          </label>
          <select class="form-control" v-model="coloniaSelected">
            <option>Seleccione una Colonia</option> 
            <option v-for="item in domicilio.colonia">{{ item }}</option> 
          </select>
        </div>
        <div class="col-md-3 px-md-1">
          <base-input
            label="* Alcaldía o Municipio"
            placeholder="Alcaldía o Municipio"
            v-model="domicilio.municipio"
            disabled></base-input>
        </div>
        <div class="col-md-3 pl-md-1">
          <base-input label="* Estado" placeholder="Estado" v-model="domicilio.dc_estado" disabled></base-input>
        </div>
        <div class="col-md-3 pl-md-1">
          <base-input
            label="* País"
            placeholder="País"
            v-model="domicilio.pais"
            disabled></base-input>
        </div>
      </div>
      <div class="row">

        <div class="col-md-12 px-md-1">
          <base-button slot="footer" type="default" simple @click="back">Atras</base-button>
        
          <base-button slot="footer" type="primary" fill @click="next">Siguiente</base-button>
        </div>
         
      </div>
    </el-form>


     <!-- formulario 3 -->


    
    <el-form v-if="active===2" ref="form2" :model="form3" label-width="90px">

      <div class="row">
        <div class="col-md-6 px-md-1">
        <input type="file" v-on:change="handleChange1" ref="comprobanteDomicilioFile" style="display:none;"/>
      <base-button round :type="stado1" simple @click="$refs.comprobanteDomicilioFile.click()"><i class="mdi mdi-cloud-upload-outline" style="font-size:19px;"> </i> Comprobante De Domicilio Con Antiguedad No Mayor A Tres Meses</base-button>
        </div>
        </div>
    
      <div class="row">
        <div class="col-md-6 px-md-1">
          <input type="file" v-on:change="handleChange2" ref="datosBancariosFile" style="display:none;"/>
      <base-button round :type="stado2" simple @click="$refs.datosBancariosFile.click()"><i class="mdi mdi-cloud-upload-outline" style="font-size:19px;"> </i> Datos Bancarios para Trámites de Pago</base-button>
      
</div>
</div>
<div class="row">
<div class="col-md-6 px-md-1">
        <input type="file" v-on:change="handleChange3" ref="IdentificacionOficialFile" style="display:none;"/>
      <base-button round :type="stado3" simple @click="$refs.IdentificacionOficialFile.click()"><i class="mdi mdi-cloud-upload-outline" style="font-size:19px;"> </i> Identificación Oficial</base-button>
        
</div>
</div>
<div class="row">
<div class="col-md-6 px-md-1">
         <input type="file" v-on:change="handleChange4" ref="rfcFile" style="display:none;"/>
      <base-button round :type="stado4" simple @click="$refs.rfcFile.click()"><i class="mdi mdi-cloud-upload-outline" style="font-size:19px;"> </i> RFC</base-button>
      
</div>
</div>
<div class="row">
<div class="col-md-6 px-md-1">
       <input type="file" v-on:change="handleChange5" ref="curlFile" style="display:none;"/>
      <base-button round :type="stado5" simple @click="$refs.curlFile.click()"><i class="mdi mdi-cloud-upload-outline" style="font-size:19px;"> </i> CURP(Clave Única de Registro Poblacional)</base-button>
      
</div>
</div>

       
      <div class="row" style="margin-top: 10px;">
         <div class="col-md-12 px-md-1">
          <base-button slot="footer" type="default" simple @click="back">Atras</base-button>
        
          <base-button slot="footer" type="primary" fill @click="next">Siguiente</base-button>
        </div>
        
      </div>
    </el-form>
    <el-form v-if="active===3" ref="form4" :model="form3" label-width="90px">
      
      <div class="row" style="margin-top: 50px;">
        <div class="col-md-12 pr-md-1">
          <h2 v-if="errors_validation.length == 0">Su perfíl en Autosubasta esta completado!!!! Ya puede enviarlo para ser validado</h2>
          
        </div>
      </div>
      <div class="row" style="margin-top: 20px;">
        <div class="col-md-3">
<base-button slot="footer" round type="success" fill @click="print"> <i class="mdi mdi-printer" style="font-size: 19px"> </i> IMPRIMIR TODO</base-button>
        </div>
        <div class="col-md-5">
<base-button slot="footer" round type="info" fill @click="print"> <i class="mdi mdi-printer" style="font-size: 19px"> </i> REQUISITOS PARA INICIO DE TRÁMITE</base-button>
        </div>
        <div class="col-md-4">
<base-button slot="footer" round type="success" fill @click="print"> <i class="mdi mdi-printer" style="font-size: 19px"> </i> AVISO DE PRIVACIDAD</base-button>
        </div>
      </div>
      <div class="row" style="margin-top: 50px;">
        <div class="col-md-12">
      <el-switch v-model="switch_val" active-text="ACEPTO LA POLÍTICA DE PRIVACIDAD"> </el-switch>
        </div>
        </div>
       <br> <br>
      <div class="row">
        <div class="col-md-12 px-md-1" v-if="switch_val == false">
          <base-button slot="footer" type="default" simple @click="back">Atras</base-button>
          <base-button slot="footer" type="warning" fill :disabled="true">Solicitar Verificación</base-button>
            </div><div class="col-md-12 px-md-1" v-else>
          <base-button slot="footer" type="default" simple @click="back">Atras</base-button>
          <base-button slot="footer" type="warning" fill :disabled="isProcessing" @click="validator">Solicitar Verificación</base-button>
          </div>
          
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
  name: "edit-profile-form-fisica",
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
      el:'',
      stado0:"default",
      stado1:"default",
      stado2:"default",
      stado3:"default",
      stado4:"default",
      stado5:"default",
      switch_val: false,
      errors_validation: [],
      categoriaSelected: {},
      coloniaSelected: {},
      BancoSelected: {},
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
      calidadmigratorias: {},
      bancos: {},
      active: 0,
      form0: {
        name:'',
        firstname:'',
        lastname:'',
        password:'',
        password_confirmation:'',
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
        IdentificacionOficialFile:'',
        IdentificacionOficialName:'',
        rfcFile:'',
        rfcName:'',
        curlFile:'',
        curlName:'',
        AvatarFile:'',
        AvatarName:'',
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
   
  },
  directives:{
 uppercase:{
 
update(el){
    
  el.value = el.value.toUpperCase()
},
    }
  },
  methods: {
   
    toUpperCurp(){
     this.form0.curp = this.form0.curp.toUpperCase();
    },
    toUpperRfc(){
     this.form0.rfc = this.form0.rfc.toUpperCase();
    },
    OpenimgUpload(){
     
    },
    next() {
     
      if (this.active++ > 3) this.active = 0;
    },
    back() {
     
      if (this.active-- > 3) this.active = 0;
    },
    print() {
     window.open( URL_API + "/documentos/privacidad.pdf","_blank");
    },
    SendcodigoPostal() {
      axios.get(buildURL("URL_API_SUBASTA", "postalcode"), {
          params: {cp: this.cp,}})
        .then((res) => {let result = []; 
         
         if (res.data.result.length === 0) {
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
              address_id: res.data.result[0],
              colonia: res.data.nombrecolonia,         
              municipio: res.data.result[0].nombremunicipio,         
              dc_estado: res.data.result[0].nombreestadoterritorial,         
              pais: res.data.result[0].nombrepais, 
              
              

            };
            this.domicilio = result;

          }
        })
        .catch((err) => console.log(err));
    },
    validator(){
      this.errors_validation = [];
////////////////////////////////////////////////// form 0

      if(!this.form0.password && !this.form0.password_confirmation){
this.errors_validation.push("La Contraseña es obligatoria.");
      }else{if(this.form0.password != this.form0.password_confirmation){
  //password deben ser iguales
  this.errors_validation.push("Las Contraseñas deben ser las mismas");
 }}

if(!this.form0.email){
 this.errors_validation.push('El correo electrónico es obligatorio.');
  //email Required
}else if(!this.validEmail(this.form0.email)){
   this.errors_validation.push('El correo electrónico debe ser válido.');
//valid emailrequired
}
if (!this.form0.name) {
        this.errors_validation.push("El nombre es obligatorio.");
      }
if (!this.form0.firstname) {
        this.errors_validation.push("El Apellido paterno es obligatorio.");
      }
if (!this.form0.lastname) {
        this.errors_validation.push("El Apellido materno es obligatorio.");
      }
if (!this.form0.fechanacimiento) {
        this.errors_validation.push("La fecha de nacimiento es obligatoria.");
      }
if (!this.form0.telefonocontacto1) {
        this.errors_validation.push("El Teléfono de contacto es obligatorio.");
      }
if (!this.countrySelected) {
        this.errors_validation.push("El Pais es obligatorio.");
      }
if (!this.coloniaSelected) {
        this.errors_validation.push("La Colonia es obligatoria.");
      }
if (!this.IdemSelected) {
        this.errors_validation.push("El tipo de identificación es obligatorio.");
      }
if (!this.CmigratoriaSelected) {
        this.errors_validation.push("La calidad migratoria es obligatoria.");
      }
if (!this.form0.curp) {
        this.errors_validation.push("El CURP es obligatorio.");
      }else if(!this.validCurp(this.form0.curp)){
 this.errors_validation.push('El CURP debe ser válido.');
      }
if (!this.form0.rfc) {
        this.errors_validation.push("El RFC es obligatorio.");
      }else if(!this.validRfc(this.form0.rfc)){
 this.errors_validation.push('Su RFC debe ser válido.');
      }
      ///////////////////////////////////////////////////// form 1

      if (!this.cp) {
        this.errors_validation.push("El Codigo postal es obligatorio.");
      }
      if (!this.user.address) {
        this.errors_validation.push("la dirección es obligatoria.");
      }
      if (this.switch_val == false) {
        this.errors_validation.push("Debe aceptar nuestras politicas de privacidad para continuar con el registro.");
      }

      ////////////////////////////////////////////////////// form 2
      // if (!this.this.fileList) {
      //   this.errors_validation.push("La documentacion obligatoria.");
      // }

if(this.errors_validation.length === 0){
this.sendVerification();

}else{
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
    
    sendVerification(){
      this.isProcessing = true;
      let formData = new FormData();
              formData.append('comprobanteDomicilioFile',this.comprobanteDomicilioFile);
              formData.append('comprobanteDomicilioName', this.comprobanteDomicilioName);
              formData.append('datosBancariosFile', this.datosBancariosFile);
              formData.append('datosBancariosName', this.datosBancariosName);
              formData.append('IdentificacionOficialFile', this.IdentificacionOficialFile);
              formData.append('IdentificacionOficialName', this.IdentificacionOficialName);
              formData.append('rfcFile', this.rfcFile);
              formData.append('rfcName', this.rfcName);
              formData.append('curlFile', this.curlFile);
              formData.append('curlName', this.curlName);
              formData.append('AvatarFile', this.AvatarFile);
              formData.append('AvatarName', this.AvatarName);

              formData.append('name',this.form0.name);
              formData.append('password', this.form0.password);
              formData.append('password_confirmation', this.form0.password_confirmation);
              formData.append('firstname', this.form0.firstname);
              formData.append('lastname', this.form0.lastname);
              formData.append('fechanacimiento', this.form0.fechanacimiento);
              formData.append('email', this.form0.email);
              formData.append('telefono', this.form0.telefonocontacto1);
              formData.append('nombrepais', this.countrySelected);
              formData.append('nombretipodocidentificacion', this.IdemSelected);
              formData.append('calidad_migratoria', this.CmigratoriaSelected);
              formData.append('curp', this.form0.curp);
              formData.append('rfc', this.form0.rfc);

              formData.append('cp', this.cp);
              formData.append('address', this.user.address);
              formData.append('numinterior', this.user.numinterior);
              formData.append('colonia', this.coloniaSelected);
              formData.append('colonia_id', this.coloniaSelected);
              formData.append('municipio', this.domicilio.municipio);
              formData.append('municipio_id', this.domicilio.address_id.municipio_id);
              formData.append('estado', this.domicilio.dc_estado);
              formData.append('estado_id', this.domicilio.address_id.estadoterritorial_id);
              formData.append('pais', this.domicilio.pais);
              formData.append('pais_id', this.domicilio.address_id.pais_id);

              
              

      const config ={
        headers: {'content-type': 'multipart/form-data'}    
          }
 axios.post(buildURL("URL_API_SUBASTA", "auth/register_fisica"), formData, config).then((res) => {
            localStorage.setItem('token', res.data.access_token);
          this.isProcessing = false;
          this.$router.push('/home');
this.$notify({
            message: 'Ya su cuenta ha sido creada revise el correo para realizar la verificacion!!!!',
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
            this.$notify({
              
            message: "El correo electronico ya esta en uso!!!",
            title: this.name_app,
            component: NotificationTemplate,
            icon: "tim-icons icon-bell-55",
            type: "danger",
            timeout: 4000
          });            
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
    handleAvatar(e) {
       
         this.AvatarFile = e.target.files[0];
         this.AvatarName = e.target.files[0].name;
  this.stado0="info";
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
       
         this.IdentificacionOficialFile = e.target.files[0];
         this.IdentificacionOficialName = e.target.files[0].name;
       this.stado3="info";
      },
    handleChange4(e) {
       
         this.rfcFile = e.target.files[0];
         this.rfcName = e.target.files[0].name;
       this.stado4="info";
      },
    handleChange5(e) {
       
         this.curlFile = e.target.files[0];
         this.curlName = e.target.files[0].name;
       this.stado5="info";
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
