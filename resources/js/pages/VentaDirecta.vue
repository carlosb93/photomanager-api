<template>
  <div>
    <filter-car :tipoventaSend="tipoventa"></filter-car>      
  </div>    
</template>
<script>
import { FilterCar } from '@/components';
export default {
  data() {
    return {
      tipoventa: '3'
    };
  },
  components: {
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
  created(){

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
</style>
