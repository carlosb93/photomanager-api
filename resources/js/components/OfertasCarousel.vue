<template>

<div class="row"><div class="col-lg-6">
   <el-carousel class="card">
          <el-carousel-item v-for="(item,i) in ofertas"
          :key="i">
         <div class="card-img-overlay opaco_carousel">


           <div v-if="item.subasta == null">
<router-link :to="`/car-detail-sale/${item.auto_id}`" >
                  <base-button  type="danger" class="right" style="margin-right:10px">
                    <i class="mdi mdi-eye" style="font-size: 19px;"></i> Ver
                  </base-button>
                </router-link>
          </div>
          <div v-if="item.venta == null">
<router-link :to="`/car-detail-auction/${item.auto_id}`" >
                  <base-button  type="danger" class="right" style="margin-right:10px">
                    <i class="mdi mdi-eye" style="font-size: 19px;"></i> Ver
                  </base-button>
                </router-link>
          </div> 



             
          <h2 style="font-weight:600;color:#fff;"><i class="tim-icons icon-image-02"></i> {{item.titulo}}</h2>
          <h4 style="font-weight:600;color:#fff;">{{item.descripcion}}</h4>
            
         </div>
          <img v-bind:src="item.foto" :alt="item.titulo">
         
          </el-carousel-item>
</el-carousel> 
  </div>
  <div class="col-lg-6">
     <el-carousel class="card">
          <el-carousel-item v-for="(item,i) in ofertas2"
          :key="i">
         <div class="card-img-overlay opaco_carousel">
             <div v-if="item.subasta == null">
<router-link :to="`/car-detail-sale/${item.auto_id}`" >
                  <base-button  type="danger" class="right" style="margin-right:10px">
                    <i class="mdi mdi-eye" style="font-size: 19px;"></i> Ver
                  </base-button>
                </router-link>
          </div>
          <div v-if="item.venta == null">
<router-link :to="`/car-detail-auction/${item.auto_id}`" >
                  <base-button  type="danger" class="right" style="margin-right:10px">
                    <i class="mdi mdi-eye" style="font-size: 19px;"></i> Ver
                  </base-button>
                </router-link>
          </div> 
          <h2 style="font-weight:600;color:#fff;"><i class="tim-icons icon-image-02"></i> {{item.titulo}}</h2>
          <h4 style="font-weight:600;color:#fff;">{{item.descripcion}}</h4>
         </div>
          <img v-bind:src="item.foto" :alt="item.titulo" >
         
          </el-carousel-item>
</el-carousel> 
  </div></div>
 
         
            
         

       
</template>
<script>
import config from "../config";
import { CarouselItem, Carousel } from 'element-ui';

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
      uri: URL_API_CENTRAL,
      ofertas:'',
      ofertas2:'',
        titulo:'',
        descripcion:''
    

    };
  },
  components: {
    [Carousel.name]: Carousel,
    [CarouselItem.name]: CarouselItem, 
  },
  created(){
this.fetchoferta();
this.fetchoferta2();
  },
  methods:{
    title(item){
 this.titulo = item;
    },
    desc(item){
 this.descripcion = item;
    },
    fetchoferta(){
      axios
        .post(buildURL("URL_API_SUBASTA", "ofertas"))
        .then(res => {
         
          this.ofertas = res.data.data;
          
        })
        .catch(err => console.log(err));
         
    
        },
    fetchoferta2(){
      axios
        .post(buildURL("URL_API_SUBASTA", "ofertas2"))
        .then(res => {
         
          this.ofertas2 = res.data.data;
           
        })
        .catch(err => console.log(err));
         
    
        },
   
  }
  
};
</script>
<style >
.opaco_carousel{
background: linear-gradient(to bottom, rgba(92, 77, 66, 0.37) 0%, rgba(92, 77, 66, 0.37) 100%);
}
.el-carousel__item{
  color: #fff;
  font-size: 14px;
  opacity: 0.75;
  
}

.el-carousel__item:nth-child(2n){
background-color: #99a9bf;
}
.el-carousel__item:nth-child(2n+1){

  background-color: #d3dce600;
}

.carouselimg{
  width:100%;
  height:100%;
  
}
.el-carousel--horizontal {
    overflow-x: hidden;
    height: 285px !important;
}
.el-carousel__container{
  height:100% !important;
  margin-bottom: 0px
}
.small{
    padding-top: 50% !important;
    padding-bottom: 0% !important;
    padding-left: 0% !important;
    padding-right: 0% !important;
    color:#acacbe !important;
    z-index:3;
}
.small2{
    padding-top: 45% !important;
    padding-bottom: 0% !important;
    padding-left: 0% !important;
    padding-right: 0% !important;
    color:#acacbe !important;
    z-index:3;
}
</style>
