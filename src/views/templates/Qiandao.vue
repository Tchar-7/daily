<template>
    <div class="whole">
        <div align="center">
            <h2>本月签到统计</h2>
        </div>
      <a href="Menu" class="returnButton">返回</a>
        <div class="message">
            <el-row>
                <el-col><div class="text">姓名</div></el-col>
                <el-col><div class="text">{{uName}}</div> </el-col>
            </el-row>
            <el-row>
                <el-col><div class="text">签到天数</div></el-col>
                <el-col><div class="text">{{number_of_day}}</div> </el-col>
            </el-row>
            <el-row>
                <el-col><div class="text">缺勤天数</div></el-col>
                <el-col><div class="text">{{number_of_queqin}}</div> </el-col>
            </el-row>
        </div>
        <br>
        <div class="cal">
            <el-calendar v-model="value">
            </el-calendar>
        </div>
    </div>
</template>

<script>
// eslint-disable-next-line no-unused-vars
  import router from "@/router";
  // import axios from 'axios';
  import Qs from 'qs'

  var data = Qs.stringify({'userID': localStorage.getItem('userID')});

    export default {
        name: "Qiandao",
        data() {
            return {
              uID:'',
              uName:'',
              number_of_day:'',
              number_of_queqin:''
            };
        },
      created() {
        this.getInfo()
      },
      methods: {
          getInfo:function () {
            this.axios.post('/daily/model_from_php/getKaoQin.php',data,{
              headers:{'Content-Type':'application/x-www-form-urlencoded'}
            })
                .then(response=>{
                  if (response.status >= 200 && response.status < 300) {
                    this.number_of_day = response.data[0].num_of_day
                    this.number_of_queqin = response.data[0].num_of_queqin
                  } else {
                    console.log(response.message);
                  }
                })
                .catch(function (error) {
                  console.log(error);
                })
          }
      }
    }
</script>

<style scoped>
    .text{
        padding-left: 35%;
        padding-top: 3%;
    }
    .message{
        margin: 0 auto;
    }
    .cal{
        padding-top: 5%;
        padding-left: 20%;
        padding-right: 20%;
    }
    .returnButton {
      margin-left: 20%;
    }
</style>