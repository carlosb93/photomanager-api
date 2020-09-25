<template>
  <div>
    <filter-car-my-auction></filter-car-my-auction>      
  </div>    
</template>
<script>
import { FilterCarMyAuction } from '@/components';

export default {
  components: {
     FilterCarMyAuction,
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
