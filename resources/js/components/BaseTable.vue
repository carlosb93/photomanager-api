<template>
  <table class="table tablesorter" :class="tableClass">
    <thead :class="theadClasses">
      <tr>
        <slot name="columns">
          <th>Acciones</th>
          <th v-for="column in columns" :key="column">{{column}}</th>
        </slot>
      </tr>
    </thead>
    <tbody :class="tbodyClasses">
      <tr v-for="(item, index) in data" :key="index">
        <slot :row="item">
          <div v-if="item.categoria_venta == 1">
            <td>
              <div v-if="item.estado == 'Subasta Creada'">
                <base-button
                simple                 
                  type="danger"
                  class="right"
                  style="margin-right:10px"
                  @click="removeAuction(item.id)"
                >
                  <i class="mdi mdi-trash-can-outline" style="font-size:19px;"></i> Eliminar
                </base-button>
                <base-button 
                  simple                 
                  type="info"
                  class="right"
                  style="margin-right:10px"
                  @click="stopAuction(item.id)">
                  <i class="mdi mdi-close" style="font-size: 19px;"></i> Finalizar
                </base-button>
              </div>
              <div v-else-if="item.estado == 'Finalizada'">
                <router-link :to="`/car-detail-auction/${item.id}`">
                  <base-button simple type="success" class="right" style="margin-right:10px">
                    <i class="mdi mdi-eye-check-outline" style="font-size: 19px;"></i> Ver
                  </base-button>
                </router-link>
              </div>
              <div v-else> 
                <router-link :to="`/add-auction/${item.id}`">
                  <base-button simple type="primary" class="right" style="margin-right:10px">
                    <i class="mdi mdi-plus" style="font-size:20px;"></i>Crear
                  </base-button>
                </router-link>
              </div>
            </td>
          </div>
          <div v-else>
            <td>
          <div v-if="item.estado == 'Venta Creada'">
                 <base-button
                
                simple
                type="danger"
                class="right"
                style="margin-right:10px"
                @click="removeSale(item.id)"
              >
                <i class="mdi mdi-trash-can-outline" style="font-size:19px;"></i> Eliminar
              </base-button>
              </div>
              <div v-else-if="item.estado == 'Finalizada'">
                <router-link :to="`/car-detail-view/${item.id}`">
                  <base-button simple type="success" class="right" style="margin-right:10px">
                    <i class="mdi mdi-eye-check-outline" style="font-size: 19px;"></i> Ver
                  </base-button>
                </router-link>
              </div>
              <div v-else> 
               <router-link :to="`/add-sale/${item.id}`">
                <base-button simple type="primary" class="right" style="margin-right:10px">
                  <i class="mdi mdi-plus" style="font-size:20px;"></i> Crear
                </base-button>
              </router-link>
              </div>
            </td>
          </div>


          <td  v-for="(column, index) in columns" :key="index" v-if="hasValue(item, column)">
            {{itemValue(item, column)}}
            </td>

        </slot>
      </tr>
    </tbody>
  </table>
</template>
<script>
import config from "../config";
import axios from "axios";
import NotificationTemplate from "../pages/Notifications/NotificationTemplate";
import BaseAlert from "./BaseAlert.vue";

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
  name: "base-table",
  data() {
    return { 
            name_app: localStorage.getItem('name_app'),
     
    };
  },
  components: {
    BaseAlert
  },
  props: {
    columns: {
      type: Array,
      default: () => [],
      description: "Table columns"
    },
    data: {
      type: Array,
      default: () => [],
      description: "Table data"
    },
    type: {
      type: String, // striped | hover
      default: "",
      description: "Whether table is striped or hover type"
    },
    theadClasses: {
      type: String,
      default: "",
      description: "<thead> css classes"
    },
    tbodyClasses: {
      type: String,
      default: "",
      description: "<tbody> css classes"
    }
  },
  computed: {
    tableClass() {
      return this.type && `table-${this.type}`;
    }
  },
  methods: {
    trigger() {
      this.$emit("triggerFromChild", "1");
    },
    removeAuction(id) {
      axios
        .get(buildURL("URL_API_SUBASTA", "remove_auction/" + id))
        .then(res => {
          this.$notify({
            message: res.data,
            title: this.name_app,
            component: NotificationTemplate,
            icon: "tim-icons icon-bell-55",
            type: "danger",
            timeout: 4000
          });
          this.trigger();
          
        })
        .catch(error => {});
    },
    removeSale(id) {
      axios
        .get(buildURL("URL_API_SUBASTA", "remove_sale/" + id))
        .then(res => {
          this.$notify({
            message: res.data,
            title: this.name_app,
            component: NotificationTemplate,
            icon: "tim-icons icon-bell-55",
            type: "danger",
            timeout: 4000
          });
          this.trigger();
          
        })
        .catch(error => {});
    },
     stopAuction(id) {
       axios
         .get(buildURL("URL_API_SUBASTA", "stop_auction/" + id))
         .then(res => {
           this.$notify({
             message: 'Finalizada con exito',
             title: this.name_app,
             component: NotificationTemplate,
             icon: "tim-icons icon-bell-55",
             type: "success",
             timeout: 4000
           });
           this.$router.push("/dashboard-auction");
         })
         .catch(error => {});
     },
    hasValue(item, column) {
      return item[column.toLowerCase()] !== "undefined";
    },
    itemValue(item, column) {
      return item[column.toLowerCase()];
    }
  }
};
</script>
<style>
</style>
