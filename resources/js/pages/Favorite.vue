<template>
  <div>
    <filter-car-fav></filter-car-fav>      
  </div>    
</template>
<script>
import { FilterCarFav } from '@/components';

export default {
  components: {
     FilterCarFav,
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
