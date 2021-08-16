<template>
  <div>
    <ValidationObserver ref="observer" v-slot="{ invalid }">
      <b-form @submit.prevent="onSubmit" novalidate>
        <b-form-group label="Descripcion" label-for="title">
          <ValidationProvider name="title" rules="required" v-slot="{ errors }">
            <b-form-input
              :state="errors.length == 0"
              v-model="form.title"
              type="text"
              required
              placeholder="Title"
              name="title"
            ></b-form-input>
            <b-form-invalid-feedback :state="errors.length == 0">Title is required</b-form-invalid-feedback>
          </ValidationProvider>
        </b-form-group>
        <b-form-group  label-for="priority">
          
        <div class="input-holder">
          <color-picker @colorPicked="selectColor" :color="eventColor" />
        </div>
        </b-form-group>
<b-form-group label="Inicio" label-for="start">
          <ValidationProvider name="start" rules="required" v-slot="{ errors }">
            <VueCtkDateTimePicker
              input-class="form-control"
              :state="errors.length == 0"
              v-model="form.start"
              name="start"
            ></VueCtkDateTimePicker>
            <b-form-invalid-feedback :state="errors.length == 0">Fecha inicio requerida</b-form-invalid-feedback>
          </ValidationProvider>
        </b-form-group>
        <b-form-group label="Finaliza" label-for="end">
          <ValidationProvider name="end" rules="required" v-slot="{ errors }">
            <VueCtkDateTimePicker
              input-class="form-control"
              :state="errors.length == 0"
              v-model="form.end"
              name="end"
            ></VueCtkDateTimePicker>
            <b-form-invalid-feedback :state="errors.length == 0">Fecha fin requerida</b-form-invalid-feedback>
          </ValidationProvider>
        </b-form-group>
        <div class="row">
          <div class="col-6">
            <button type="submit" variant="primary" class="login100-form-btn-simple">Guardar</button>
          </div>
          <div class="col-6">
            <button type="button" variant="primary" class="login100-form-btn-simple" @click="deleteEvent(form.id)">Eliminar</button>
          </div>
        </div>
        
        
       
      </b-form>
    </ValidationObserver>
  </div>
</template>
<script>
import { requestsMixin } from "../mixins/requestsMixin";
import ColorPicker from './ColorPicker';
import * as moment from "moment";

export default {
  name: "CalendarForm",
  props: {
    edit: Boolean,
    calendarEvent: Object,
    
  },

  mixins: [requestsMixin],
  data() {
    return {
      form: {},
      eventColor:''
    };
  },
  watch: {
    calendarEvent: {
      immediate: true,
      deep: true,
      handler(val, oldVal) {
        this.form = val || {};
      }
    }
  },
  components: {
        
        ColorPicker
      },
  methods: {
    async onSubmit() {
      const isValid = await this.$refs.observer.validate();
      if (!isValid) {
        return;
      }
      if(this.form.color == 'rgb(235, 77, 77)'){
            this.form.category = 1
        }
      if(this.form.color == 'rgb(49, 155, 49)'){
            this.form.category = 3
        }
      if(this.form.color == 'rgb(59, 59, 163)'){
            this.form.category = 4
        }
      if(this.form.color == 'orange'){
            this.form.category = 2
        }
      this.form.start = moment(this.form.start).format("YYYY-MM-DD HH:mm:ss");
      this.form.end = moment(this.form.end).format("YYYY-MM-DD HH:mm:ss");
      if (this.edit) {
        await this.editCalendar(this.form);
      } else {
        await this.addCalendar(this.form);
      }
      const response = await this.getCalendar();
      this.$store.commit("setEvents", response.data);
      this.$emit("eventSaved");
    },
    async deleteEvent(id) {
      await this.deleteCalendar(id);
      const response = await this.getCalendar();
      this.$store.commit("setEvents", response.data);
      this.$emit("eventSaved");
    },
selectColor(color){
  this.form = {
    ...this.form,
            color: color
          }
        },
  }
};
</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">
button {
  margin-right: 10px;
}
</style>