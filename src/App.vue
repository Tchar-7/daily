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
    var identity = localStorage.getItem('userIdentity')
    var page = localStorage.getItem('page')
    if (page != null) {
      router.push(page)
    }
    else {
      if (ID != null) {
        if (identity == '1') {
          router.push('/Menu')
        } else if (identity == '2') {
          router.push('/TeacherMenu')
        } else {
          router.push('/AdminMenu')
        }
      } else {
        router.push('/')
      }
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
