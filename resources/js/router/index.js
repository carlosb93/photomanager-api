import VueRouter from "vue-router";
import routes from "./routes";

// configure router
export const router = new VueRouter({
  routes, // short for routes: routes
  base: '/',
  mode: 'history',
  linkExactActiveClass: "active",
  scrollBehavior: (to) => {
    if (to.hash) {
      return {selector: to.hash}
    } else {
      return { x: 0, y: 0 }
    }
  }
});

//Aquí puedo hacer un chequeo para proteger las rutar, similar a los middleware de laravel
router.beforeEach((to, from, next) => {

  if(to.matched.some(record => record.meta.requiresAuth)){
      if(to.matched.some(record => record.meta.role)){
    
        if(!localStorage.getItem('token')){
          next({
            path: '/home',
            query: {redirect: to.fullPath}
          })
        }else{
          next()
        }
      }else{
        next()
      }
      }else{
        next()
      }

//   if(localStorage.getItem('status') == 'false'){
//     if(to.name === 'dashboard-sale' || to.name === 'dashboard-auction' && 'Ejecutivo de Ventas' != localStorage.getItem('role')) {
     
//        router.push('/home');
//     }
    
//   }else{
//     if(to.name === 'dashboard-sale' || to.name === 'dashboard-auction' && 'Ejecutivo de Ventas' == localStorage.getItem('role')) {
     
//       router.push('/home');
//    }
//   }
 
// next();
 
})

