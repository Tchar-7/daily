<template>
    <div class="table">
                <div class="table2">
                    <div class="title2">
                        <h1>请输入学号</h1>
                    </div>
                    <div class="input2">
                        <el-input v-model="idInput" placeholder="请输入学号"></el-input>
                    </div>

                <div class="button2">
                    <router-link :to=chaxun2url replace><el-button icon="el-icon-search" type="primary" v-on:click="showInfo">查询</el-button>
                    </router-link>
                </div>
                </div>
    </div>
      <router-view  :key="$route.fullPath"></router-view>
</template>
<script>

    import Qs from "qs";
    import router from "@/router";
    export default {
        name: "ChaxunNumber",
        created() {
          localStorage.setItem('page','/Tongji')
        },
        methods: {
          checkname:async function (){
            var temp = false;
              this.urldata = Qs.stringify({'userID': this.idInput})
              await this.axios.post('/daily/model_from_php/getName.php',this.urldata,{
              headers:{'Content-Type':'application/x-www-form-urlencoded'}
            })
                .then(response=>{
                  if (response.status >= 200 && response.status < 300) {
                    if(response.data !=''){
                      temp=true
                    }
                    else {
                      temp=false
                    }

                  }
                  else {
                    console.log(response.message);
                  }
                })
                .catch(function (error) {
                  console.log(error);
                })
            return temp
        },

          showInfo:function (){
            this.checkname().then(res=>{
                if(res == true){
                  this.chaxun2url = "/ShowForChaxunNumber1/"+this.idInput
                }
                else{
                  this.$message.error('没有该学生,请重新输入学号!');
                  this.idInput = '';
                  this.chaxun2url='/Kongbai1';
                }
                router.replace(this.chaxun2url)
            })
          }
        },
        data() {
            return {
                idInput: '',
                chaxun2url:'/Kongbai1',
                urldata:Qs.stringify({'userID': this.idInput}),
            }
        }
    }
</script>

<style scoped>
    .table{
        padding-top: 5%;
        padding-left: 15%;
    }
    .el-button{
        margin-left: 40%;
        margin-top: 15%;
    }
    .table1{
        padding-top: 5%;
        padding-left: 20%;
        float:left;
    }
    .table2{
        padding-top: 5%;
        padding-left: 20%;
    }
    .el-input{
        width:30%;
        padding-left: 2%;
    }
    .title1{
        padding-left: 10%;
    }
    .title2{
        padding-left: 10%;
    }
    .show{
        padding-top: 30%;
        padding-left: 20%;
    }
    .button2{
        margin-left: 15%;
        margin-top: -16%;
    }

</style>