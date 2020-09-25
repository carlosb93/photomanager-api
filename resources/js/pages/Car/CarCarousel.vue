<template>

  <el-carousel style="box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 22px 0px;border-radius: 0.2857rem; width: 100%;height: 500px !important; margin-bottom: 30px;">
          <el-carousel-item v-for="(item,i) in auto.fotos"
          :key="i">
          
          <div v-if="!item" style="height: 500px;">
  <h3 class="card-img-overlay small"> <i class="tim-icons icon-image-02"></i> No existe ninguna foto para este vehículo!!!</h3>
          <img class="carouselimg" v-bind:src="fetchnull(item)" style="width: 100%; height: 100%;">
         
 
          </div>
          <div v-else style="height: 500px;"> 
            <h3 class="card-img-overlay small"> <i class="tim-icons icon-image-02"></i> {{item.categoriafoto[0].nombrecategoriafoto}}</h3>
          <img class="carouselimg" v-bind:src="fetchfoto(item)" :alt="fetchAlt(item)" style="width: 100%; height: 100%;">
         
           
          </div>
          
          </el-carousel-item>
</el-carousel> 

       
</template>
<script>
import config from "../../config";
import { CarouselItem, Carousel } from 'element-ui';

const URL_API_CENTRAL = config.url_api.URL_API_CENTRAL;

export default {
  props: {
    auto: {},
    
    
  },
  
  data() {
    return {
      uri: URL_API_CENTRAL,
    };
  },
  components: {
    [Carousel.name]: Carousel,
    [CarouselItem.name]: CarouselItem, 
  },
  methods:{
    
     fetchnull(){
 return this.uri + "2019/defaultcar.jpg";
     },
    fetchfoto(valor){
      if(valor.documentos == undefined){
return this.uri + "2019/defaultcar.jpg";
      }else{
return valor.documentos.length > 0 ? this.uri+valor.documentos[0].fechasubida.substring(0, 4)+'/TRAMITE-'+this.auto.tramite[0].numerotramite+'/GALERIA/'+valor.documentos[0].nombrereferencial : this.uri + "2019/defaultcar.jpg";

      }
        },
fetchAlt(valor){
   if(valor.documentos == undefined){
return 'No existe la foto.';
      }else{
return valor.documentos.length > 0 ? valor.documentos[0].nombrereferencial : 'No existe la foto.';
}
}
   
  }
  
};
</script>
<style>
.el-carousel__item, h3{
  color: #fff !important;
  font-size: 14px !important;
  opacity: 1 !important;
  line-height: 150px !important;
  margin: 0 !important;
}
.el-carousel__item:nth-child(2n){
background-color: #99a9bf !important;
}
.el-carousel__item:nth-child(2n+1){

  background-color: #d3dce600 !important;
}
.carouselimg{
  width:100% !important;
  height:100% !important;
  
}
.el-carousel__container{
  height:100% !important;
  margin-bottom: 0px !important;
}
.small{
    padding-left: 293px !important;
    padding-right: 215px !important;
    padding-bottom: 16px !important;
    padding-top: 343px !important;
}
</style>
