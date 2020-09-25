<template>
  <div>
    <filter-admin :categoriav="categoriav"></filter-admin>      
  </div>    
</template>
<script>
import { FilterAdmin } from '@/components';
export default {
   data() {
    return {
categoriav: {
    id:'3',
    nombre:'Ventas'}
    }
    },
  components: {
     FilterAdmin,
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
