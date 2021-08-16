<template>
<div class="limiter100">
 <div class="container-login100">
  <div class="wrap-login100 p-t-190 p-b-30">
		
		<form method="post" class="login100-form" v-on:submit.prevent="login" role="form">
			<div class="login100-form-avatar">
					<img v-bind:src="logo" alt="AVATAR">
			</div>
      <div class="wrap-input100 validate-input m-b-10" style="margin-top: 50px; text-align: center">
				<h1>GRACIAS POR VISITAR PHOTOMANAGER</h1>
			</div>
    </form>
	</div>
 </div>
</div> 
</template>
<script>
import Modal from "../components/Modal";


export default {
  components: {
    Modal
  },
  
  data() {
    return {
      logo:localStorage.getItem('logo_app'),
      loginModalVisible: false,
    };
  },
  created(){
 this.loginModalVisible = true;
 this.go();
  },
  methods: {
    go(){
      setTimeout(() => this.$router.push('/login'), 1000);
    }
   
    
  }
};

</script>
<style>
</style>