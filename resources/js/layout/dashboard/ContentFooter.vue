<template>
  <footer class="footer">
    <div class="container-fluid">
      <ul class="nav">
        
      </ul>
      <div class="copyright">
        © {{year}} Hecho con <i class="tim-icons icon-heart-2"></i> por
        <a href="https://www.subastas.rn2.site" target="_blank" rel="noopener">RN2 </a>.
      </div>
    </div>
    <!-- <div :style="{'display': installBtn}"><div class="notifications" >
    <span mode="in-out">
      <div data-notify="container" role="alert" data-notify-position="top-center" 
      class="alert open alert-with-icon bottom right alert-info list-enter-to"  style="background-color: #419ef97a;bottom: 20px;">
       <base-button
                icon
                round
                simple
                type="white"
                block
                @click="installer()"
              data-toggle="tooltip" data-placement="top" title="Instalar" class="col-xs-1 "
              style="
    border-color:#fff;
    position: absolute;
    right: 15px;
    top: 50%;
    margin-top: -13px;">
                <i class="mdi mdi-application-import text-white" style="font-size: 20px;color:#344675;"></i>
              </base-button>
          <span data-notify="icon" class="alert-icon mdi mdi-cellphone-arrow-down"></span>
           <div data-notify="message"><div class="title"><b>Auto Subasta RN2<br></b></div>
            <div>Desea instalar la app</div>
             </div></div></span></div>
  </div> -->
  </footer>
</template>
<script>
  export default {
    data() {
      return {
 //installBtn: "none",
        year: new Date().getFullYear()
      }
      },
//       created(){
//   let installPrompt;
//     window.addEventListener("beforeinstallprompt", e =>{
//         e.preventDefault();
//         installPrompt = e;
//         this.installBtn = "block";
        

//     });
// this.installer = () =>{
//   this.installBtn = "none";
//   installPrompt.prompt();
//   installPrompt.userChoice.then(result =>{ 
//     if(result.outcome === "accepted"){
//       console.log("user accepted");

//     }else{
//       console.log("user denied");
//     }
//     installPrompt = null;
//   })
// }
//       }
     
    
  };
</script>
<style>
</style>
