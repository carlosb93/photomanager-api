<template>
<card style="border-bottom: 3px inset #f96332; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
   <template slot="header">
          <h5 class="card-category">
            Administrar Ramas</h5>
            <slot name="header"></slot>
            <slot name="Agregar Usuario">
              <div v-show="permission">
                  <button class="login100-form-btn-simple" @click="go_to_link()" to="/creauser"><i class="mdi mdi-account-plus" style="font-size:19px;margin-right: 5px;"></i>Nueva</button>
 
            </div>
            </slot>

            <!-- <button @click="detailsFilter = !detailsFilter">Filtros Detalles</button> -->
          
        </template>
  <el-table
    :data="tableData[0]">
    
    <el-table-column
      label="Nombre">
      <template slot-scope="scope">
        {{ scope.row.name }}
        
          <p style="color:#000">Nombre: {{ scope.row.name }}</p>
        
      </template>
    </el-table-column>
    <el-table-column
      label="Descripcion">
      <template slot-scope="scope">
        {{ scope.row.description }}
        
          <p style="color:#000">Descripcion: {{ scope.row.description }}</p>
       
      
      </template>
    </el-table-column>
    <el-table-column
      label="codigo de invitacion">
      <template slot-scope="scope">
        {{ scope.row.code }}
         <p style="color:#000">codigo de invitacion: {{ scope.row.code }}</p>
        
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
        <el-button
          size="mini"
          type="danger"
          @click="handleDelete(scope.row.id, scope.row)" style="margin-left: 0px;">Eliminar</el-button>
           </div>
      </template>
    </el-table-column>
  </el-table>
  </card>
</template>






<script>
import config from "../../config";
import axios from "axios"; 
import { Table, TableColumn, Popover, Tag, Button } from "element-ui";
import NotificationTemplate from "../Notifications/NotificationTemplate";
import BaseAlert from "../../components/BaseAlert";

  
const URL = config.url.URL_API;

function buildURL(api, resource = "") {
  if (api == "URL_API") {
    return URL + resource;
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
        permission:localStorage.getItem('role') === 'Admin_negocio' ? true : false,
          errors: {},
      type: ["", "info", "success", "warning", "danger"],
      notifications: {
        topCenter: false
      },

        tableData: []
      }
    },
    created(){
this.showallbranch();

  

    },
    methods: {
      go_to_link(){
this.$router.push('/creauser');
      },
      showallbranch(){
        let branch = [];
        const AuthToken = 'Bearer ' + localStorage.getItem('token');

        axios.get(buildURL("URL_API", "branch"),{headers:{ 
            'Authorization': AuthToken,
         }})
        .then(res => {
            console.log(res.data.length)
         for (let i = 0; i < res.data.length; i++) {
        
             
       branch={
              name: res.data[i].name,
              description: res.data[i].description,
              code: res.data[i].code
              };

             this.tableData.push(branch);
             console.log(this.tableData)
       
            

           
         }
         

        }).catch(err => console.log(err));
      },
      handleEdit(index, row) {
          this.$router.push(`/branch/${index}`);
        
      },
      handleCancel(index, row) {

        axios.get(buildURL("URL_API", "deactivateUser/"+ index))
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

        
      },
      handleDelete(index, row) {

        axios.get(buildURL("URL_API", "deactivateUser/"+ index))
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
