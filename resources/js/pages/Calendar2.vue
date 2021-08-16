<template>
  <card>

      <div class="card-header">
      <h5 class="title">Calendario</h5>
    </div>

    <div class="buttonz">
        <div class="col-4">
      <button v-b-modal.add-modal class="login100-form-btn-simple" >Add Calendar Event</button>
        </div>
    </div>

    <ds-calendar-app :calendar="calendar"></ds-calendar-app>
    
<b-modal id="add-modal" title="Add Calendar Event" hide-footer ref="add-modal">
      <CalendarForm :edit="false" @eventSaved="closeModal()" />
    </b-modal>
<b-modal id="edit-modal" title="Edit Calendar Event" hide-footer ref="edit-modal">
      <CalendarForm :edit="true" :calendarEvent="calendarEvent" @eventSaved="closeModal()" />
    </b-modal>
     
   </card>

</template>
<script>
  import config from '@/config';
  import { requestsMixin } from "../mixins/requestsMixin";
  import CalendarForm from "@/components/CalendarForm.vue";
  import { Calendar } from 'dayspan';

  

  export default {
    components: {
      CalendarForm,
      Calendar
    },
    mixins: [requestsMixin],
    data() {
      return {
        calendar: Calendar.months(),
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
// .main-panel > .content {
//     padding: 78px 0px 30px 0px;
// }
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
