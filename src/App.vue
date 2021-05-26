<template>
  <div id="app">
      <router-view ></router-view>
  </div>
</template>
<script>
import router from "@/router";

export default {
  name: 'App',
  created:function () {
    var ID = localStorage.getItem('userID')

      if (ID != null) {
          router.push('/Menu')
      }
      else {
        router.push('/Login')
      }
    }
}
</script>

<!--<style>-->
<!--#app {-->
<!--  font-family: Avenir, Helvetica, Arial, sans-serif;-->
<!--  -webkit-font-smoothing: antialiased;-->
<!--  -moz-osx-font-smoothing: grayscale;-->
<!--  text-align: center;-->
<!--  color: #2c3e50;-->
<!--  margin-top: 60px;-->
<!--}-->
<!--</style>-->
<style>
  body{
    margin: 0;
  }
</style>
