<template>
  <div>
    <div class="row">
      <div class="col-md-8">
        <car-carousel :auto="auto"></car-carousel>
      </div>
      <div class="col-md-4">
        <car-sale :auto="auto"></car-sale>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <car-content :auto="auto"></car-content>
      </div>
    </div>
  </div>
</template>
<script>
import config from "../config";
import axios from "axios";
import CarContent from "./Car/Carcontent";
import CarCarousel from "./Car/CarCarousel";
import CarSale from "./Car/CarSale";

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
  data() {
    return {
      auto: {}
    };
  },
  created() {
    this.fetchAuto();
  },
  components: {
    CarContent,
    CarCarousel,
    CarSale
  },

  methods: {
    triggerChildRecived(value) {
      if (value == "1") {
        this.fetchAutoResend();
      } else {
      }
    },

    fetchAuto() {
      axios
        .get(buildURL("URL_API_SUBASTA", "showcar/" + this.$route.params.id))
        .then(res => {
          let auto = {
            id: res.data[0].id,
            foto: res.data[0].fotos,
            fotos: res.data[0].fotos,
            nombrereferencial: res.data[0].nombrereferencial,
            anno: res.data[0].anno,
            cantidadpuerta: res.data[0].cantidadpuerta,
            fechasubida: res.data[0].fechasubida,
            nivelcombustiblevalor: res.data[0].nivelcombustiblevalor,
            nombrecolorauto: res.data[0].nombrecolorauto,
            nombremarca: res.data[0].nombremarca,
            nombremodeloauto: res.data[0].nombremodeloauto,
            nombrepais: res.data[0].nombrepais,
            descripcion: res.data[0].auto[0].descripcion,
            aire: res.data[0].aire,
            nombretipocombustible: res.data[0].nombretipocombustible,
            nombretipotransmision: res.data[0].nombretipotransmision,
            nombreversionauto: res.data[0].nombreversionauto,
            numeromotor: res.data[0].numeromotor,
            tipotransmision: res.data[0].tipotransmision,
            precioventametrica: res.data[0].tramite[0] == undefined ? '0' : res.data[0].tramite[0].parametrizacion[0].preciolista,
            kminicial: res.data[0].kminicial,
            subasta: res.data[0].subasta,
            ventaDirecta: res.data[0].ventaDirecta,
            categoriaventa: res.data[0].categoriaventa,
            tramite: res.data[0].tramite
          };
          this.auto = auto;
        })
        .catch(err => console.log(err));
    },
    fetchAutoResend() {
      axios
        .get(buildURL("URL_API_SUBASTA", "showcar/" + this.$route.params.id))
        .then(res => {
          let auto = {
            id: res.data[0].id,
            foto: res.data[0].fotos,
            fotos: res.data[0].fotos,
            nombrereferencial: res.data[0].nombrereferencial,
            anno: res.data[0].anno,
            cantidadpuerta: res.data[0].cantidadpuerta,
            fechasubida: res.data[0].fechasubida,
            nivelcombustiblevalor: res.data[0].nivelcombustiblevalor,
            nombrecolorauto: res.data[0].nombrecolorauto,
            nombremarca: res.data[0].nombremarca,
            nombremodeloauto: res.data[0].nombremodeloauto,
            nombrepais: res.data[0].nombrepais,
            descripcion: res.data[0].auto[0].descripcion,
            aire: res.data[0].aire,
            nombretipocombustible: res.data[0].nombretipocombustible,
            nombretipotransmision: res.data[0].nombretipotransmision,
            nombreversionauto: res.data[0].nombreversionauto,
            numeromotor: res.data[0].numeromotor,
            tipotransmision: res.data[0].tipotransmision,
            precioventametrica: res.data[0].tramite[0] == undefined ? '0' : res.data[0].tramite[0].parametrizacion[0].preciolista,
            kminicial: res.data[0].kminicial,
            subasta: res.data[0].subasta,
            ventaDirecta: res.data[0].ventaDirecta,
            categoriaventa: res.data[0].categoriaventa,
            tramite: res.data[0].tramite
          };
          this.auto = auto;
        })
        .catch(err => console.log(err));
    }
    /**
     * Obtiene los años
     */
  }
  // mounted() {
  //   this.i18n = this.$i18n;
  //   if (this.enableRTL) {
  //     this.i18n.locale = "es";
  //     this.$rtl.enableRTL();
  //   }
  // },
  // beforeDestroy() {
  //   if (this.$rtl.isRTL) {
  //     this.i18n.locale = "en";
  //     this.$rtl.disableRTL();
  //   }
  // }
};
</script>
<style>
/* select option {
  background-color: #27293d;
} */
</style>
