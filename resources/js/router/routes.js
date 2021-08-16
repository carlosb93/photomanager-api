import DashboardLayout from "@/layout/dashboard/DashboardLayout.vue";
// GeneralViews
import NotFound from "@/pages/NotFoundPage.vue";

// Admin pages
const Dashboard = () => import(/* webpackChunkName: "dashboard" */"@/pages/Dashboard.vue");
const Calendar = () => import(/* webpackChunkName: "common" */ "@/pages/Calendar.vue");
const Calendar2 = () => import(/* webpackChunkName: "common" */ "@/pages/Calendar2.vue");

const Login = () => import(/* webpackChunkName: "js/Perfil" */ "../pages/auth/Login.vue");
const Registrar = () => import(/* webpackChunkName: "js/Perfil" */ "../pages/auth/Register.vue");
const VerifyEmail = () => import(/* webpackChunkName: "js/common" */ "../pages/auth/VerifyEmail.vue");

const HomeReg = () => import(/* webpackChunkName: "js/Perfil" */ "../pages/HomeReg.vue");
const HomeOut = () => import(/* webpackChunkName: "js/Perfil" */ "../pages/HomeOut.vue");



const BusinessEdit = () => import(/* webpackChunkName: "common" */ "@/pages/business/EditBusiness.vue");
const ListBranches = () => import(/* webpackChunkName: "common" */ "@/pages/business/ListBranches.vue");

const Profile = () => import(/* webpackChunkName: "common" */ "@/pages/Profile.vue");
const Notifications = () => import(/* webpackChunkName: "common" */"@/pages/Notifications.vue");
const Icons = () => import(/* webpackChunkName: "common" */ "@/pages/Icons.vue");
const Typography = () => import(/* webpackChunkName: "common" */ "@/pages/Typography.vue");
const TableList = () => import(/* webpackChunkName: "common" */ "@/pages/TableList.vue");
const Configuraciones = () => import(/* webpackChunkName: "js/Administracion" */ "../pages/Configuraciones.vue");


const routes = [
  {
    path: "/",
    component: DashboardLayout,
    redirect: "/home",
    children: [
      {
        path: "registro",
        name: "Registrarse",
        component: Registrar,
         meta:{role:false,requiresAuth: false},
      },
      {
        path: "login",
        name: "Entrar",
        component: Login,
         meta:{role:false,requiresAuth: false},
      },
      {
        path: "inicio",
        name: "Registrar",
        component: HomeReg,
        meta:{role:false,requiresAuth: false},
      },
      {
        path: "out",
        name: "Salida",
        component: HomeOut,
         meta:{role:false,requiresAuth: false},
      },



// Dashboard//////////////////////////////////
      {
        path: "home",
        name: "Inicio",
        component: Dashboard,
        meta:{role:true,requiresAuth: true},
      },



//Business/////////////////////////////////////
      {
        path: "calendar",
        name: "calendar",
        component: Calendar,
      },
      {
        path: "businessedit",
        name: "bussiness",
        component: BusinessEdit,
      },
      {
        path: "listarramas",
        name: "listarramas",
        component: ListBranches,
      },



//Branch/////////////////////////////////////
      {
        path: "branch",
        name: "branch",
        component: Calendar,
      },
      {
        path: "config",
        name: "Configuraciones",
        component: Configuraciones,
         meta:{role:true,requiresAuth: true},
      },



//Profile/////////////////////////////////////
      {
        path: "profile",
        name: "Perfil",
        component: Profile,
        meta:{role:false,requiresAuth: true},
      },
    ]
},
  {
    name: 'verify-email',
    path: '/email/verify',
    component:VerifyEmail
  },  
  { path: "*", component: DashboardLayout, redirect: "/login", },
];

/**
 * Asynchronously load view (Webpack Lazy loading compatible)
 * The specified component must be inside the Views folder
 * @param  {string} name  the filename (basename) of the view to load.
function view(name) {
   var res= require('../components/Dashboard/Views/' + name + '.vue');
   return res;
};**/

export default routes;
