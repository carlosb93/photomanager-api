<template> 
<div>
<ofertas-carousel></ofertas-carousel>

 
   </div>
 </template>
<script>
 import { FilterCar,OfertasCarousel } from '@/components';
import { CarouselItem, Carousel } from 'element-ui';
import config from "../config";
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
  data() {
    return {
      tipoventa: '1',
      ofertas: []
    };
  },
  components: {
    OfertasCarousel,
     FilterCar,

    },
  computed: {
    enableRTL() {
      return this.$route.query.enableRTL;
    },
    isRTL() {
      return this.$rtl.isRTL;
    } 
  },
 methods:{

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
  },
 
};
</script>
<style>
</style>
