<template>
  <card>
    <h5 slot="header" class="title">Completar Perfíl Persona Moral</h5>
    <div class="row">
      <div class="col-md-12 pr-md-1">
        <el-steps :active="active" finish-status="success">
          <el-step title="Paso 1" description="Datos Empresa" icon="tim-icons icon-badge"></el-step>
          <el-step title="Paso 2" description="Datos De Representante" icon="tim-icons icon-badge"></el-step>
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

    <el-form v-if="active===0" ref="form2" :model="form2" label-width="90px">
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
          <label>
            <span class="required">*</span> País de Nacionalidad
          </label>
          <select class="form-control" v-model="form2.pais_nac" @change="fetchPaises">
             <option v-for="item in paises" v-bind:value="item.id">{{ item.nombrepais }}</option> 
            
          </select>
        </div>
        <div class="col-md-3 px-md-1">
          
          <base-input label="* RFC" placeholder="RFC" v-model="form2.rfc" @keyup="toUpperRfc"></base-input>
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
          
          <base-input label="* Teléfono a 10 dígitos" placeholder="Teléfono a 10 dígitos" v-model="form2.telefono"></base-input>
        </div>
<div class="col-md-4 px-md-1">
          
          <base-input label="* Teléfono 2 de contacto" placeholder="Teléfono 2 de contacto" v-model="form2.telefono2"></base-input>
        </div>
        </div>
        <div class="row">
       
       
<div class="col-md-4 px-md-1">
          
          <base-input label="* Inscripción RPPC" placeholder="Inscripción RPPC" v-model="form2.ins_rppc"></base-input>
        </div>
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
          
          <base-input label="* Actividad Giro Mercantíl, Objeto Social que desempeña(Empresas Extranjeras)" placeholder="Actividad Giro Mercantíl, Objeto Social que desempeña(Empresas Extranjeras)" v-model="form2.actividad"></base-input>
        </div>
 
<div class="col-md-4 px-md-1">
          
          <base-input label="* SIEM" placeholder="SIEM" v-model="form2.siem"></base-input>
        </div>
        </div>
      <div class="row">

        <div class="col-md-12 px-md-1">
          <base-button slot="footer" type="primary" fill @click="next">Siguiente</base-button>
        </div>
         
      </div>
    </el-form>
    
 <!-- formulario 2 -->
<el-form v-if="active===1" ref="form0" :model="form0" label-width="90px">
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
          <base-input label="Teléfono" placeholder="* Teléfono" v-model="form0.telefonocontacto1"></base-input>
        </div>
      
        
        
        </div>
      <div class="row">
        
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
        
        <div class="col-md-12 px-md-1">
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
         <input type="file" v-on:change="handleChange4" ref="rfcFile" style="display:none;"/>
      <base-button round :type="stado4" simple @click="$refs.rfcFile.click()"><i class="mdi mdi-cloud-upload-outline" style="font-size:19px;"> </i> RFC</base-button>
      
</div>
</div>
<div class="row">
<div class="col-md-6 px-md-1">
        <input type="file" v-on:change="handleChange3" ref="ActaFile" style="display:none;"/>
      <base-button round :type="stado3" simple @click="$refs.ActaFile.click()"><i class="mdi mdi-cloud-upload-outline" style="font-size:19px;"> </i> Acta Constitutiva Inscrita en el Registro Público de la Propiedad y del Comercio</base-button>
        
</div>
</div>
<div class="row">
<div class="col-md-6 px-md-1">
       <input type="file" v-on:change="handleChange5" ref="podernotarialFile" style="display:none;"/>
      <base-button round :type="stado5" simple @click="$refs.podernotarialFile.click()"><i class="mdi mdi-cloud-upload-outline" style="font-size:19px;"> </i> Poder Notarial Que Otorga Facultades al Representante Legal</base-button>
      
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
        <input type="file" v-on:change="handleChange6" ref="comprobanteDomicilioFile" style="display:none;"/>
      <base-button round :type="stado6" simple @click="$refs.comprobanteDomicilioRepFile.click()"><i class="mdi mdi-cloud-upload-outline" style="font-size:19px;"> </i> Comprobante De Domicilio Con Antiguedad No Mayor A Tres Meses</base-button>
        </div>
        </div>
    
      <div class="row">
        <div class="col-md-6 px-md-1">
          <input type="file" v-on:change="handleChange7" ref="IdemRepFile" style="display:none;"/>
      <base-button round :type="stado7" simple @click="$refs.IdemRepFile.click()"><i class="mdi mdi-cloud-upload-outline" style="font-size:19px;"> </i> IDENTIFICACION OFICIAL</base-button>
      
</div>
</div>
<div class="row">
<div class="col-md-6 px-md-1">
         <input type="file" v-on:change="handleChange8" ref="rfcRepFile" style="display:none;"/>
      <base-button round :type="stado8" simple @click="$refs.rfcRepFile.click()"><i class="mdi mdi-cloud-upload-outline" style="font-size:19px;"> </i> RFC</base-button>
      
</div>
</div>
<div class="row">
<div class="col-md-6 px-md-1">
        <input type="file" v-on:change="handleChange9" ref="CurpRepFile" style="display:none;"/>
      <base-button round :type="stado9" simple @click="$refs.CurpRepFile.click()"><i class="mdi mdi-cloud-upload-outline" style="font-size:19px;"> </i> CURP (CLAVE UNICA DE REGISTRO POBLACIONAL)</base-button>
        
</div>
</div>
<div class="row">
<div class="col-md-6 px-md-1">
       <input type="file" v-on:change="handleChange10" ref="podernotarialRepFile" style="display:none;"/>
      <base-button round :type="stado10" simple @click="$refs.podernotarialRepFile.click()"><i class="mdi mdi-cloud-upload-outline" style="font-size:19px;"> </i> Poder Notarial Que Otorga Facultades al Representante Legal</base-button>
      
</div>
</div>
<div class="row">
<div class="col-md-6 px-md-1">
       <input type="file" v-on:change="handleChange11" ref="instrumentonotarialFile" style="display:none;"/>
      <base-button round :type="stado11" simple @click="$refs.instrumentonotarialFile.click()"><i class="mdi mdi-cloud-upload-outline" style="font-size:19px;"> </i> INSTRUMENTO NOTARIAL QUE ACREDITA EL PODER</base-button>
      
</div>
</div>

       
      <div class="row" style="margin-top: 10px;">
         <div class="col-md-12">
          <base-button slot="footer" type="default" simple @click="back">Atras</base-button>
        
          <base-button slot="footer" type="primary" fill @click="next">Siguiente</base-button>
        </div>
        
      </div>
    </el-form>
    <el-form v-if="active===5" ref="form5" :model="form5" label-width="90px">
      
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
        <div class="col-md-12" v-if="switch_val == false">
          <base-button slot="footer" type="default" simple @click="back">Atras</base-button>
          <base-button slot="footer" type="warning" fill :disabled="true">Solicitar Verificación</base-button>
            </div><div class="col-md-12" v-else>
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
  name: "edit-profile-form-moral",
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
      stado6:"default",
      stado7:"default",
      stado8:"default",
      stado9:"default",
      stado10:"default",
      stado11:"default",
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
      estados: {},
      calidadmigratorias: {},
      bancos: {},
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
        AvatarFile:'',
        AvatarName:'',

        comprobanteDomicilioRepFile:'',
        comprobanteDomicilioRepName:'',
        IdemRepFile:'',
        IdemRepName:'',
        rfcRepFile:'',
        rfcRepName:'',
        CurpRepFile:'',
        CurpRepName:'',
        podernotarialRepFile:'',
        podernotarialRepName:'', 
        instrumentonotarialFile:'',
        instrumentonotarialName:'',

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
    this.fetchEstados();
   
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
     
      if (this.active++ > 5) this.active = 0;
    },
    back() {
     
      if (this.active-- > 5) this.active = 0;
    },
    print() {
     window.open( URL_API_CENTRAL + "documentos/privacidad.pdf","_blank");
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
this.errors_validation.push("La contraseña es obligatoria.");
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
if (!this.coloniaSelected) {
        this.errors_validation.push("La Colonia es obligatoria.");
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
if (!this.form0.telefonocontacto1) {
        this.errors_validation.push("El Teléfono de contacto es obligatorio.");
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
       if (!this.form2.name_empresa) {
        this.errors_validation.push("El Nombre de la Empresa es obligatoria.");
      }
       if (!this.form2.fecha_constit) {
        this.errors_validation.push("La fecha de constitución es obligatoria.");
      }
       if (!this.form2.pais_nac) {
        this.errors_validation.push("La nacionalidad de la empresa es obligatoria.");
      }
       if (!this.form2.rfc) {
        this.errors_validation.push("El RFC es obligatorio.");
      }
       if (!this.form2.numero_e_publica) {
        this.errors_validation.push("El número de escritura pública es obligatorio.");
      }
       if (!this.form2.numero_n_publica) {
        this.errors_validation.push("El número de notario público es obligatorio.");
      }
       if (!this.form2.notaria_estado) {
        this.errors_validation.push("El Estado del Notario es obligatorio.");
      }
       if (!this.form2.nombre_notario) {
        this.errors_validation.push("El Nombre de Notario es obligatorio.");
      }
       if (!this.form2.telef_notario) {
        this.errors_validation.push("El Teléfono del Notario es obligatorio.");
      }
       if (!this.form2.email) {
        this.errors_validation.push("El Email de contacto es obligatorio.");
      }else if(!this.validEmail(this.form2.email)){
   this.errors_validation.push('El correo electrónico debe ser válido.');
//valid emailrequired
}
       if (!this.form2.telefono) {
        this.errors_validation.push("El Teléfono de contacto es obligatorio.");
      }
       if (!this.form2.ins_rppc) {
        this.errors_validation.push("Inscripcion de RPPC es obligatorio.");
      }
       if (!this.form2.fecha_rppc) {
        this.errors_validation.push("La Fecha de RPPC es obligatorio.");
      }
       if (!this.form2.folio_rppc) {
        this.errors_validation.push("El Folio RPPC es obligatorio.");
      }
       if (!this.form2.siem) {
        this.errors_validation.push("El SIEM es obligatorio.");
      }

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
              formData.append('ActaFile', this.ActaFile);
              formData.append('ActaName', this.ActaName);
              formData.append('rfcFile', this.rfcFile);
              formData.append('rfcName', this.rfcName);
              formData.append('podernotarialFile', this.podernotarialFile);
              formData.append('podernotarialName', this.podernotarialName);
              formData.append('AvatarFile', this.AvatarFile);
              formData.append('AvatarName', this.AvatarName);

              formData.append('comprobanteDomicilioRepFile',this.comprobanteDomicilioRepFile);
              formData.append('comprobanteDomicilioRepName', this.comprobanteDomicilioRepName);
              formData.append('IdemRepFile', this.IdemRepFile);
              formData.append('IdemRepName', this.IdemRepName);
              formData.append('rfcRepFile', this.rfcRepFile);
              formData.append('rfcRepName', this.rfcRepName);
              formData.append('CurpRepFile', this.CurpRepFile);
              formData.append('CurpRepName', this.CurpRepName);
              formData.append('podernotarialRepFile', this.podernotarialRepFile);
              formData.append('podernotarialRepName', this.podernotarialRepName);
              formData.append('instrumentonotarialFile', this.instrumentonotarialFile);
              formData.append('instrumentonotarialName', this.instrumentonotarialName);

              formData.append('name',this.form0.name);
              formData.append('password', this.form0.password);
              formData.append('password_confirmation', this.form0.password_confirmation);
              formData.append('firstname', this.form0.firstname);
              formData.append('lastname', this.form0.lastname);
              formData.append('email', this.form0.email);
              formData.append('telefono', this.form0.telefonocontacto1);
              formData.append('rfc', this.form0.rfc);
              
              formData.append('name_empresa', this.form2.name_empresa);
              formData.append('fecha_constit', this.form2.fecha_constit);
              formData.append('pais_nac', this.form2.pais_nac);
              formData.append('rfc2', this.form2.rfc);
              formData.append('numero_e_publica', this.form2.numero_e_publica);
              formData.append('numero_n_publica', this.form2.numero_n_publica);
              formData.append('notaria_estado', this.form2.notaria_estado);
              formData.append('nombre_notario', this.form2.nombre_notario);
              formData.append('telef_notario', this.form2.telef_notario);
              formData.append('email2', this.form2.email);
              formData.append('telefono1', this.form2.telefono);
              formData.append('telefono2', this.form2.telefono2);
              formData.append('ins_rppc', this.form2.ins_rppc);
              formData.append('fecha_rppc', this.form2.fecha_rppc);
              formData.append('folio_rppc', this.form2.folio_rppc);
              formData.append('actividad', this.form2.actividad);
              formData.append('siem', this.form2.siem);

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
 axios.post(buildURL("URL_API_SUBASTA", "auth/register_moral"), formData, config).then((res) => {
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


    handleChange6(e) {
       
         this.comprobanteDomicilioRepFile = e.target.files[0];
         this.comprobanteDomicilioRepName = e.target.files[0].name;
  this.stado6="info";
      },
    handleChange7(e) {
      
         this.IdemRepFile = e.target.files[0];
         this.IdemRepName = e.target.files[0].name;
       this.stado7="info";
      },
    handleChange8(e) {
       
         this.rfcRepFile = e.target.files[0];
         this.rfcRepName = e.target.files[0].name;
       this.stado8="info";
      },
    handleChange9(e) {
      
         this.CurpRepFile = e.target.files[0];
         this.CurpRepName = e.target.files[0].name;
       this.stado9="info";
      },
    handleChange10(e) {
      
         this.podernotarialRepFile = e.target.files[0];
         this.podernotarialRepName = e.target.files[0].name;
       this.stado10="info";
      },
    handleChange11(e) {
      
         this.instrumentonotarialFile = e.target.files[0];
         this.instrumentonotarialName = e.target.files[0].name;
       this.stado11="info";
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
      fetchEstados() {
      axios
        .get(buildURL("URL_API_SUBASTA", "listEstados"))
        .then(res => {
          
          this.estados = res.data.data;
        })
        .catch(err => console.log(err));
    }, 

  }
};
</script>
<style>
</style>
