<template>
  <div>
    <div class="row">
        <div class="col-md-8">
        <car-form-venta :auto="auto"></car-form-venta>
      </div>
    <div class="col-md-4">
        <car-summit :auto="auto" @triggerFromChild="triggerChildRecived"></car-summit>
      </div>
        
     
      
      </div>
    
  </div>
</template>
<script>
import config from "../config";
import axios from "axios";
import CarFormVenta from "./Car/CarFormVenta";
import CarSummit from "./Car/CarSummit";

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
     props: {
    favorite_res: ""
  },
  data() {
    return {
      auto: {}
    };
  },
  created() {
    this.fetchAuto();    
  },
  components: {
    CarFormVenta,
    CarSummit
  },

  methods: {
       triggerChildRecived(value){
      if(value == '1'){
         this.fetchAuto();
      }else{
         
      }
  
    },
      checkFav(id) {
        let status = [];
      axios.post(buildURL("URL_API_SUBASTA", "check-fav/" + id)).then((res) =>{
        if(res.data == true){
          status.push(true);
        }else{
           status.push(false);       
        }
        });
return status;       
    },
    fetchAuto() {
      axios
        .get(buildURL("URL_API_SUBASTA", "showcar/" + this.$route.params.id))
        .then((res) => {
           
          let auto = {
            id: res.data[0].id,
            foto:res.data[0].fotos,  
            nombrereferencial: res.data[0].nombrereferencial,
            anno: res.data[0].anno,
            cantidadpuerta: res.data[0].cantidadpuerta,
            fechasubida: res.data[0].fechasubida,
            nivelcombustiblevalor: res.data[0].nivelcombustiblevalor,
            nombrecolorauto: res.data[0].nombrecolorauto,
            nombremarca: res.data[0].nombremarca,
            nombremodeloauto: res.data[0].nombremodeloauto,
            nombrepais: res.data[0].nombrepais,
            nombretipocombustible: res.data[0].nombretipocombustible,
            nombretipotransmision: res.data[0].nombretipotransmision,
            nombreversionauto: res.data[0].nombreversionauto,
            numeromotor: res.data[0].numeromotor,
            tipotransmision: res.data[0].tipotransmision,
            precioventametrica: res.data[0].tramite[0] == undefined ? '0' : res.data[0].tramite[0].parametrizacion[0].preciolista,
            kminicial: res.data[0].kminicial,
            tipoventa: this.categoriaventa(res.data[0]),
            fav_status: this.checkFav(res.data[0].id),
            tramite: res.data[0].tramite
          };

          this.auto = auto;
          
          
        })
        .catch((err) => console.log(err));
    },
    categoriaventa(value){
    return value.categoriaventa.filter(function(value) {
             return value.categoria_id == '1' || value.categoria_id == '2'; 
          });
    }
    /**
     * Obtiene los años
     */
  },
  mounted() {
    this.i18n = this.$i18n;
    if (this.enableRTL) {
      this.i18n.locale = "es";
      this.$rtl.enableRTL();
    }
  },
  beforeDestroy() {
    if (this.$rtl.isRTL) {
      this.i18n.locale = "en";
      this.$rtl.disableRTL();
    }
  }
};
</script>
<style>
/* select option {
  background-color: #27293d;
} */
</style>
