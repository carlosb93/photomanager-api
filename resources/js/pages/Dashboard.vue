<template>
  <div>

    <div class="row">
      <div class="col-12">
        <div class="card">

      <div class="card-header">
      <h5 class="title">Bienvenido</h5>
    </div>

    </div>
    </div>
    
      
    </div>
    </div>

</template>
<script>
  import config from '@/config';
  import { requestsMixin } from "../mixins/requestsMixin";
  import CalendarForm from "@/components/CalendarForm.vue";
  import  {FullCalendar}  from "vue-full-calendar";

  

  export default {
    components: {
      CalendarForm,
      FullCalendar
    },
    mixins: [requestsMixin],
    data() {
      return {
        calendarEvent: {},
      }
    },
async beforeMount() {
    await this.getEvents();
  },
    
    computed: {
      events() {
      return this.$store.state.events;
    },
      enableRTL() {
        return this.$route.query.enableRTL;
      },
      isRTL() {
        return this.$rtl.isRTL;
      },
      bigLineChartCategories() {
        return this.$t('dashboard.chartCategories');
      }
    },
    methods: {
      async getEvents() {
      const response = await this.getCalendar();
      console.log(response.data)
      this.$store.commit("setEvents", response.data);
    },
    closeModal() {
      this.$refs["add-modal"].hide();
      this.$refs["edit-modal"].hide();
      this.calendarEvent = {};
    },
    openEditModal(event) {
      let { id, start, end, title, color } = event;
      this.calendarEvent = { id, start, end, title, color };
      this.$refs["edit-modal"].show();
    },


     
     
    },
    mounted() {
      this.i18n = this.$i18n;
      if (this.enableRTL) {
        this.i18n.locale = 'ar';
        this.$rtl.enableRTL();
      }
     
    },
    beforeDestroy() {
      if (this.$rtl.isRTL) {
        this.i18n.locale = 'en';
        this.$rtl.disableRTL();
      }
    }
  };
</script>

<style lang="scss" scoped>
.buttonz {
  margin-bottom: 10px;
}
.card {
  position: relative;
  display: flex;
  flex-direction: column;
  min-width: 0;
  word-wrap: break-word;
  background-color:  #28293e;
  background-clip: border-box;
  border: 1px solid rgba( #000, .125);
}
.red {
      background: #fd5d93 !important;
      color: whitesmoke !important;
    }
.blue {
      background: #1d8cf8 !important;
      color: whitesmoke !important;
    }
.orange {
      background: #ff8d72 !important;
      color: white !important;
    }
.green {
      background: #00f2c3 !important;
      color: white !important;
    }
.blue,
.orange,
.red,
.green {
      font-size: 13px;
      font-weight: 500;
      text-transform: capitalize;
    }

</style>
