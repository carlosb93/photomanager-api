<template>
      <div class="picker-main"> 
        <h4 class="header">Seleccione el nivel de importancia</h4>
        <div class="color-picker">
          <div class="color" v-for="(theme, index) in colors" :key="index" @click="selectColor(theme)" :class="{selected: color === theme, [theme]: theme}"></div>
        </div>
      </div>
</template>

<script>
    export default {
      name: 'ColorPicker',
      props: ['color'],
      data(){
        return {
          colors: ['red','orange','green','blue'],
          
        }
      },
      methods: {
        selectColor(color){
          if(color == 'red'){
            color = 'rgb(235, 77, 77)'
          }
          if(color == 'green'){
            color = 'rgb(49, 155, 49)'
          }
          if(color == 'blue'){
            color = 'rgb(59, 59, 163)'
          }
          if(color == 'orange'){
            color = 'orange'
          }
          this.$emit('colorPicked', color);
        }
      }
    }
</script>

<style scoped lang="scss">
.picker-main {
      width: 60%;
    }
.header {
      font-size: 14px;
      text-transform: uppercase;
      color: orangered;
      margin: 0 0 10px;
      text-align: left;
    }
.color-picker {
      display: flex;
      justify-content: space-around;
    }
.color-picker > .color {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      border: 1.5px solid whitesmoke;
      cursor: pointer;
    }
.color.selected{
      box-shadow: 0 2px 3px 1px rgba(0, 0, 0, 0.2);
      border: 3px solid rgba(0, 0, 0, 0.4);
    }
.color.red {
      background: rgb(235, 77, 77);
    }
.color.blue {
      background: rgb(59, 59, 163);
    }
.color.orange {
      background: orange;
}
.color.green {
      background: rgb(49, 155, 49);
}
</style>