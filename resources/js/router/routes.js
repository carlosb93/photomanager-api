import DashboardLayout from "../layout/dashboard/DashboardLayout.vue";
// GeneralViews
import NotFound from "../pages/NotFoundPage.vue";

// Admin pages
const CarDetailSale = () => import(/* webpackChunkName: "js/subasta-venta" */"../pages/CarDetailSale.vue");
const VentaDirecta = () => import(/* webpackChunkName: "js/subasta-venta" */ "../pages/VentaDirecta.vue");
const CarDetailAuction = () => import(/* webpackChunkName: "js/subasta-venta" */"../pages/CarDetailAuction.vue");
const Subasta = () => import(/* webpackChunkName: "js/subasta-venta" */ "../pages/Subasta.vue");
const CarDetailView = () => import(/* webpackChunkName: "js/subasta-venta" */"../pages/CarDetailView.vue");

const Register = () => import(/* webpackChunkName: "js/Perfil" */ "../pages/Auth/Register.vue");
const Favorite = () => import(/* webpackChunkName: "js/Perfil" */ "../pages/Favorite.vue");
const MyAuction = () => import(/* webpackChunkName: "js/Perfil" */ "../pages/MyAuction.vue");
const Login = () => import(/* webpackChunkName: "js/Perfil" */ "../pages/auth/Login.vue");
const Profile = () => import(/* webpackChunkName: "js/Perfil" */ "../pages/Profile.vue");
const Registrar = () => import(/* webpackChunkName: "js/Perfil" */ "../pages/Registrar.vue");
const Home = () => import(/* webpackChunkName: "js/Perfil" */ "../pages/Home.vue");
const HomeReg = () => import(/* webpackChunkName: "js/Perfil" */ "../pages/HomeReg.vue");
const HomeOut = () => import(/* webpackChunkName: "js/Perfil" */ "../pages/HomeOut.vue");

const DashboardSale = () => import(/* webpackChunkName: "js/Administracion" */"../pages/DashboardSale.vue");
const DashboardAuction = () => import(/* webpackChunkName: "js/Administracion" */"../pages/DashboardAuction.vue");
const AddAuction = () => import(/* webpackChunkName: "js/Administracion" */ "../pages/AddAuction.vue");
const AddSale = () => import(/* webpackChunkName: "js/Administracion" */ "../pages/AddSale.vue");
const Ofertas = () => import(/* webpackChunkName: "js/Administracion" */ "../pages/Ofertas.vue");
const Usuarios = () => import(/* webpackChunkName: "js/Administracion" */ "../pages/Usuarios.vue");
const Usuario = () => import(/* webpackChunkName: "js/Administracion" */ "../pages/Usuario.vue");
const EditUser = () => import(/* webpackChunkName: "js/Administracion" */ "../pages/User/EditUser.vue");
const EditMoral = () => import(/* webpackChunkName: "js/Administracion" */ "../pages/User/EditMoral.vue");
const EditProfileForm = () => import(/* webpackChunkName: "js/Administracion" */ "../pages/Profile/EditProfileForm.vue");
const Configuraciones = () => import(/* webpackChunkName: "js/Administracion" */ "../pages/Configuraciones.vue");

const Notifications = () => import(/* webpackChunkName: "js/common" */"../pages/Notifications.vue");
const Icons = () => import(/* webpackChunkName: "js/common" */ "../pages/Icons.vue");
const Maps = () => import(/* webpackChunkName: "js/common" */ "../pages/Maps.vue");
const Typography = () => import(/* webpackChunkName: "js/common" */ "../pages/Typography.vue");
const TableList = () => import(/* webpackChunkName: "js/common" */ "../pages/TableList.vue");
const VerifyEmail = () => import(/* webpackChunkName: "js/common" */ "../pages/Auth/VerifyEmail.vue");


const routes = [
  {
    path: "/",
    component: DashboardLayout,
    redirect: "/home",
    children: [
      {
        path: "dashboard-sale",
        name: "dashboard venta",
        component: DashboardSale,
        meta:{role:true,requiresAuth: true},
      },
      {
        path: "dashboard-auction",
        name: "Dashboard subasta",
        component: DashboardAuction,
        meta:{role:true,requiresAuth: true},
      },
      {
        path: "add-auction/:id",
        name: "Agregar Subasta",
        component: AddAuction,
        meta:{role:true,requiresAuth: true},
      },
      {
        path: "add-sale/:id",
        name: "Agregar venta",
        component: AddSale,
        meta:{role:true,requiresAuth: true},
      },
      {
        path: "home",
        name: "Inicio",
        component: Home,
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
      {
        path: "subasta",
        name: "subasta",
        component: Subasta,
        meta:{role:true,requiresAuth: true},
      },
      {
        path: "venta-directa",
        name: "venta directa",
        component: VentaDirecta,
         meta:{role:true,requiresAuth: true},
      },
      {
        path: "car-detail-sale/:id",
        name: "Detalles Venta",
        component: CarDetailSale,
         meta:{role:true,requiresAuth: true},
      },
      {
        path: "car-detail-auction/:id",
        name: "Detalles Subasta",
        component: CarDetailAuction,
         meta:{role:true,requiresAuth: true},
      },
      {
        path: "car-detail-view/:id",
        name: "Ver auto",
        component: CarDetailView,
         meta:{role:true,requiresAuth: true},
      },
      {
        path: "profile",
        name: "Perfil",
        component: Profile,
        meta:{role:false,requiresAuth: true},
      },
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
        path: "notifications",
        name: "Notificaciones",
        component: Notifications,
         meta:{role:true,requiresAuth: true},
      },
      {
        path: "icons",
        name: "Iconos",
        component: Icons,
         meta:{role:true,requiresAuth: true},
      },
      {
        path: "config",
        name: "Configuraciones",
        component: Configuraciones,
         meta:{role:true,requiresAuth: true},
      },
      {
        path: "maps",
        name: "mapas",
        component: Maps,
         meta:{role:true,requiresAuth: true},
      },
      {
        path: "typography",
        name: "typography",
        component: Typography,
         meta:{role:true,requiresAuth: true},
      },
      {
        path: "ofertas",
        name: "Ofertas",
        component: Ofertas,
        meta:{role:false,requiresAuth: false},
      },
      {
        path: "myoffers",
        name: "Mis Autos",
        component: MyAuction,
        meta:{role:false,requiresAuth: true},
      },
      {
        path: "users",
        name: "Usuarios",
        component: Usuarios,
        meta:{role:true,requiresAuth: true},
      },
      {
        path: "creauser",
        name: "Crear Usuario",
        component: EditProfileForm,
        meta:{role:true,requiresAuth: true},
      },
      {
        path: "user/:id",
        name: "Editar Usuario",
        component: Usuario,
        meta:{role:true,requiresAuth: true},
      },
      {
        path: "favorite",
        name: "favoritos",
        component: Favorite,
        meta:{role:false,requiresAuth: true},
      }
    ]
  },
  {
    name: 'verify-email',
    path: '/email/verify',
    component:VerifyEmail
  },  
  { path: "*", component: DashboardLayout, redirect: "/home", },
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
