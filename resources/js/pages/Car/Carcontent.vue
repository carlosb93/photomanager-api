<template>
  <card style="border-bottom: 3px inset rgb(253, 185, 19); border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
    <h5 slot="header" class="title">{{auto.nombremarca}} >> {{auto.nombremodeloauto}}</h5>

    <div class="row">
      <div class="col-md-12">
        <h2><i class="mdi mdi-car-info" style="font-size: 40px; margin-right:10px;"></i>{{auto.nombremarca}} | {{auto.nombremodeloauto}}</h2>       
    
      </div>
      </div>
    <div class="row">
      <div class="col-md-12 ">
        <h4><i class="mdi mdi-car-back" style="font-size: 40px; margin-right:10px;"></i>{{auto.nombreversionauto}}</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <h4><i class="mdi mdi-book-information-variant" style="font-size: 40px; margin-right:10px;"></i>{{auto.descripcion}}</h4>       
    
      <div style="height: 0;
    margin: 0.5rem 0;
    overflow: hidden;
    border-top: 1px solid #FDB913;"></div>
      </div>
      
    </div>
    <div class="row">
      <div class="col-md-12">
        <h5><i class="mdi mdi-update" style="font-size: 30px; margin-right:10px;"></i>{{auto.anno}} | {{auto.kminicial}} KM | {{auto.tipotransmision}}</h5>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <h5><i class="mdi mdi-cash-usd-outline" style="font-size: 30px; margin-right:10px;"></i>Precio Venta Directa: $ {{auto.precioventametrica}}</h5>
        <h5><i class="mdi mdi-flag" style="font-size: 30px; margin-right:10px;"></i>País de Procedencia:  {{auto.nombrepais}}</h5>
        <h5><i class="mdi mdi-format-color-fill" style="font-size: 30px; margin-right:10px;"></i>Color:  {{auto.nombrecolorauto}}</h5>
        <h5><i class="mdi mdi-air-conditioner" style="font-size: 30px; margin-right:10px;"></i>AC:  {{ auto.aire == true ? 'Si' : 'No'}}</h5>
      </div>
     <div class="col-md-4">
       <h5><i class="mdi mdi-engine" style="font-size: 30px; margin-right:10px;"></i>Numeración del Motor:  {{auto.numeromotor}}</h5>
       <h5><i class="mdi mdi-fuel" style="font-size: 30px; margin-right:10px;"></i> Nivel de combustible:  {{auto.nivelcombustiblevalor}}</h5>
       <h5><i class="mdi mdi-gas-station" style="font-size: 30px; margin-right:10px;"></i>Tipo de Combustible:  {{auto.nombretipocombustible}}</h5>
     </div>
      <div class="col-md-4">
       
        <h5><i class="mdi mdi-car-door" style="font-size: 30px; margin-right:10px;"></i>Número de puertas:  {{auto.cantidadpuerta}}</h5>
        <h5><i class="mdi mdi-speedometer-slow" style="font-size: 30px; margin-right:10px;"></i>Kilometraje:  {{auto.kminicial}}</h5>
         <h5><i class="mdi mdi-car-shift-pattern" style="font-size: 30px; margin-right:10px;"></i>Tipo Transmisión:  {{auto.tipotransmision}} | {{auto.nombretipotransmision}}</h5>
        
        
        
      </div>
    </div>
  </card>
</template>
<script>


export default {
  props: {
    auto: {}
  },
};




</script>
<style>
</style>
