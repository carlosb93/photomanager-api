<template>
<div class="row">
   <div class="col-12">
        <card :title="table1.title">
          <div class="table-responsive">
            <base-table :data="this.autos"
                        :columns="table1.columns"
                        thead-classes="text-primary"
                        @triggerFromChild="triggerChildRecived">
            </base-table>
            <!-- <infinite-loading @infinite="infiniteHandler"></infinite-loading> -->
          </div>
        </card>
      </div>
    </div>
  </template>

  <script> 
import BaseTable  from "./BaseTable";
import InfiniteLoading from 'vue-infinite-loading';


const tableColumns = [ "estado","placas", "vin","color", "marca","modelo"];

export default {
  name: 'list-car-admin',
  props: {
    autos: {}
  },
  components: {
    BaseTable,
    InfiniteLoading,
    
  },
  data() {
   
    return {
      list:[],
      table1: {
        title: "Resultados",
        columns: [...tableColumns],
        data: [...this.autos]
        
      }
    };
  },
  methods:{
    trigger() {
      this.$emit("triggerFromChild2", "1");
    },

    triggerChildRecived(value){
      if(value == '1'){
         this.trigger();
      }else{
         
      }
  
    },
    infiniteHandler($state){
      setTimeout(() =>{
        const temp =[];
        for (let i = this.autos.length + 1; i <= this.autos.length + 2; i++){
          temp.push(i);
        }
        this.autos = this.autos;
        $state.loaded();
      }, 1000);
    },
  }

  
};
</script>

<style>
/* select option {
  background-color: #27293d;
} */
</style>