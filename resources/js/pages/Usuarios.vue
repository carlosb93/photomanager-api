<template>
<card style="border-bottom: 3px inset rgb(253, 185, 19); border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
   <template slot="header">
          <h5 class="card-category">
            Administrar Usuarios</h5>
            <slot name="header"></slot>
            <slot name="Agregar Usuario">
              <div v-show="permission">
              <base-button slot="footer" type="primary" class="btn btn-sm" right fill @click="go_to_link()" to="/creauser"><i class="mdi mdi-account-plus" style="font-size:19px;margin-right: 5px;"></i> Nuevo</base-button>
            </div>
            </slot>

            <!-- <button @click="detailsFilter = !detailsFilter">Filtros Detalles</button> -->
          
        </template>
  <el-table
    :data="tableData">
    <el-table-column
      label="Verificado">
      <template slot-scope="scope">
        <div v-if="scope.row.status == '1'">
<h4><i class="mdi mdi-shield-check" style="font-size:19px; color:rgb(34, 202, 3);"></i> Verificado</h4>
        </div>
         <div v-else>
<h4><i class="mdi mdi-alert-outline" style="font-size:19px; color:#FDB913;"></i> No Verificado</h4>
        </div>
        
        
      </template>
    </el-table-column>
    <el-table-column
      label="Nombre">
      <template slot-scope="scope">
        <el-popover trigger="hover" placement="top">
          <p style="color:#000">e-mail: {{ scope.row.email }}</p>
          <p style="color:#000">Nombre: {{ scope.row.nombre }}</p>
          <p style="color:#000">Apellidos: {{ scope.row.apellidos }}</p>
          <div v-if="scope.row.role == '19'">
            <p style="color:#000">Rol: Gerente de Ventas</p>
            </div>
          <div v-else-if="scope.row.role == '11'">
            <p style="color:#000">Rol: Super Administrador</p>
            </div><div v-else>
            <p style="color:#000">Rol: Usuario</p>
            </div>
          
          <div slot="reference" class="name-wrapper">
            <el-tag size="medium">{{ scope.row.email }}</el-tag>
          </div>
        </el-popover>
      </template>
    </el-table-column>
    <el-table-column
      label="Acciones">
      <template slot-scope="scope">

        

        <el-button
          size="mini"
          @click="handleEdit(scope.row.id, scope.row)">Editar</el-button>
           <div v-show="permission">
        <el-button
          size="mini"
          type="danger"
          @click="handleCancel(scope.row.id, scope.row)" style="margin-left: 0px;">Desactivar</el-button>
           </div>
      </template>
    </el-table-column>
  </el-table>
  </card>
</template>






<script>
import config from "../config";
import axios from "axios"; 
import { Table, TableColumn, Popover, Tag, Button } from "element-ui";
import NotificationTemplate from "./Notifications/NotificationTemplate";
import BaseAlert from "../components/BaseAlert";

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
       components: {
    BaseAlert,
    [Table.name]: Table,
    [TableColumn.name]: TableColumn,
    [Popover.name]: Popover,
    [Tag.name]: Tag,
    [Button.name]: Button
  },
    data() {
      return {
        name_app: localStorage.getItem('name_app'),
        permission:localStorage.getItem('role') === 'Super Administrador' ? true : false,
          errors: {},
      type: ["", "info", "success", "warning", "danger"],
      notifications: {
        topCenter: false
      },

        tableData: []
      }
    },
    created(){
this.showallusers();

  

    },
    methods: {
      go_to_link(){
this.$router.push('/creauser');
      },
      showallusers(){
        let user = [];
        axios.get(buildURL("URL_API_SUBASTA", "showallusers"))
        .then(res => {
         for (let i = 0; i < res.data.length; i++) {
           if(res.data[i].role[0].role_id == '24' || res.data[i].role[0].role_id == '19' || res.data[i].role[0].role_id == '11' ){
             if(res.data[i].verification_profile.length > 0){
 user={
              id: res.data[i].id,
              email: res.data[i].email,
              nombre: res.data[i].firstName,
              apellidos: res.data[i].lastName,
              role: res.data[i].role[0].role_id,
              status: res.data[i].verification_profile[0].status_id,
             };
             this.tableData.push(user);
             }
       
            

           }
         }
         

        }).catch(err => console.log(err));
      },
      handleEdit(index, row) {
          this.$router.push(`/user/${index}`);
        
      },
      handleCancel(index, row) {

        axios.get(buildURL("URL_API_SUBASTA", "deactivateUser/"+ index))
        .then(res => {
 this.$notify({
            message:'Eliminado exitosamente',
            title: this.name_app,
            component: NotificationTemplate,
            icon: "tim-icons icon-bell-55",
            type: "danger",
            timeout: 4000
          });
        }).catch(err=>console.log(err));

        
      }
    }
  }
</script>
