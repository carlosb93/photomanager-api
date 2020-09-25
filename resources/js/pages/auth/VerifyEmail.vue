<template>
    <div>
        <div
            class="mt-2 alert alert-warning"
            role="alert"
        >
           La verificación del email esta siendo procesada
        </div>
    </div>
</template>

<script>
    export default {
        async mounted() {
            const { queryURL } = this.$route.query;
            // alert('dsfsdfsd:' + queryURL);
            console.log('post this url with your token', queryURL, "Sample = Authorization : Bearer "+ localStorage.getItem('token'));
            await axios.post(queryURL, {
                'Accept': 'application/json',
                'Content-Type':'application/json',
            }).then(x => {
                console.log(x);
                this.$router.push('/home');
            }).catch(x => {
                console.log(x);
                this.$router.push('/home');
            });
        }
    }
</script>
