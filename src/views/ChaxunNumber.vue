<template>
    <div class="table">
                <div class="table2">
                    <div class="title2">
                        <h1>请输入学号</h1>
                    </div>
                    <div class="input2">
                        <el-input v-model="idInput" placeholder="请输入学号"></el-input>
                    </div>
                </div>
                <div class="button2">
                    <router-link :to=chaxun2url><el-button type="primary" v-on:click="showInfo">查询</el-button></router-link>
                    <router-view  :key="$route.fullPath"></router-view>
                </div>
    </div>
</template>
<script>

    import Qs from "qs";
    export default {
        name: "ChaxunNumber",
        created() {
          localStorage.setItem('page','/Tongji')
        },
        methods: {
          changeURL:function (){
                if(this.idInput!=''){
                    this.chaxun2url = "/ShowForChaxunNumber1/"+this.idInput
                    }
                else {
                  this.chaxun2url='/ChaxunNumber'
                }
            },
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
                  null;
                }
                else{
                  this.$message.error('没有该学生,请重新输入学号!');
                  this.idInput = ''
                }
            })
            this.changeURL()
          }
        },
        data() {
            return {
                idInput: '',
                chaxun2url:'/ChaxunNumber',
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
        padding-left: 8%;
    }
    .show{
        padding-top: 30%;
        padding-left: 20%;
    }
    .button2{
        margin-left: 20%;
        margin-top: -15%;
    }

</style>