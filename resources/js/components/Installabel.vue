<template>
   <div :style="{'display': installBtn}"><div class="notifications" >
    <span mode="in-out">
      <div data-notify="container" role="alert" data-notify-position="top-center" 
      class="alert open alert-with-icon bottom right alert-info list-enter-to"  style="background-color: #419ef97a;bottom: 20px;">
       <base-button
                icon
                round
                simple
                type="white"
                block
                @click="close()"
              data-toggle="tooltip" data-placement="top" title="close" class="col-xs-1 "
              style="
    border-color:#fff;
    position: absolute;
    right: 15px;
    top: 50%;
    margin-top: -13px;">
                <i class="mdi mdi-close text-white" style="font-size: 20px;color:#344675;"></i>
              </base-button>
          <!-- <span data-notify="icon" class="alert-icon mdi mdi-cellphone-arrow-down"></span> -->
          <base-button
          data-notify="icon"
                icon
                round
                simple
                type="white"
                block
                @click="installer()"
              data-toggle="tooltip" data-placement="top" title="Instalar" class="alert-icon col-xs-1 "
              style="
    border-color:#fff;
    position: absolute;
    right: 15px;
    top: 50%;
    margin-top: -13px;">
                <i class="mdi mdi-cellphone-arrow-down text-white" style="font-size: 20px;color:#344675;"></i>
              </base-button>
           <div data-notify="message"><div class="title"><b>Auto Subasta RN2<br></b></div>
            <div>Desea instalar la app</div>
             </div></div></span></div>
  </div>
  
</template>
<style lang="scss">
</style>
<script>
export default {
  name: "install-pop-up",
  components: {
  },
  data() {
    return { 
      installBtn: "none",
     
    };
  },
  created(){
   let installPrompt;
    window.addEventListener("beforeinstallprompt", e =>{
        e.preventDefault();
        installPrompt = e;
        this.installBtn = "block";
        

    });
    
this.installer = () =>{
  this.installBtn = "none";
  installPrompt.prompt();
  installPrompt.userChoice.then(result =>{ 
    if(result.outcome === "accepted"){
      console.log("user accepted");

    }else{
      console.log("user denied");
    }
    installPrompt = null;
  })
}
   
    
  
  },
  method:{
      close(){
        this.installBtn = "none"; 
        installPrompt = null; 
      }
  }

};


</script>
