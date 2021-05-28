<template>
  <div class="whole">
    <div align="center" class="title">
      <h1>本月签到统计</h1>

      <dic class = "return">
        <el-button type="text" @click="Menu()">返回个人界面</el-button>
      </dic>

    </div>
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
    <div class="cal" id="cal">
      <el-calendar v-model="value">
        <template
            slot="dateCell"
            slot-scope="{date, data}">
          <p>
            {{data.day.split('-').slice(1).join('-')}}
          </p>
          <div v-for="item in calendarData" :key="item">
            <div v-if="(item.months).indexOf(data.day.split('-').slice(1)[0])!=-1">
              <div v-if="(item.days).indexOf(data.day.split('-').slice(2).join('-'))!=-1">
                <el-tooltip :content="item.things">
                  <div>{{item.things}}</div>
                </el-tooltip>
              </div>
              <div v-else></div>
            </div>
            <div v-else>
            </div>
          </div>
        </template>
      </el-calendar>
    </div>
  </div>
</template>

<script>
// eslint-disable-next-line no-unused-vars
import router from "@/router";
// import axios from 'axios';
import Qs from 'qs'

//var data = Qs.stringify({'userID': localStorage.getItem('userID')});

export default {
  name: "ShowForChaxunNumber",
  data() {
    return {
      uID:'',
      uName:'',
      number_of_day:'',
      number_of_queqin:'',
      calendarData: [],
      value: new Date(),
      urldata:Qs.stringify({'userID': localStorage.getItem('userID')})
    };
  },
  created() {
    localStorage.setItem('page','/Qiandao')
    this.checkID()
    this.getname()
    this.getInfo()
    this.getKaoqinInfo()
  },
  methods: {

    Menu() {
      this.$router.push('/Menu');
    },

    checkID:function (){
      if(this.$route.params.num !=null){
        this.urldata = Qs.stringify({'userID': this.$route.params.num})
      }
    },
    getname:function (){
      this.axios.post('/daily/model_from_php/getName.php',this.urldata,{
        headers:{'Content-Type':'application/x-www-form-urlencoded'}
      })
          .then(response=>{
            if (response.status >= 200 && response.status < 300) {
              this.uName = response.data[0].name
            } else {
              console.log(response.message);
            }
          })
          .catch(function (error) {
            console.log(error);
          })
    },
    getInfo:function () {
      this.axios.post('/daily/model_from_php/getKaoQin.php',this.urldata,{
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
    },

    getKaoqinInfo:function () {
      this.axios.post('/daily/model_from_php/getKaoQinInfo.php',this.urldata,{
        headers:{'Content-Type':'application/x-www-form-urlencoded'}
      })
          .then(response=>{
            if (response.status >= 200 && response.status < 300) {
              for (let i = 0; i < response.data.length; i++) {
                let mon = response.data[i].apply_date.slice(5, 7);
                let day = response.data[i].apply_date.slice(8);
                this.calendarData.push({months:[mon],days: [day],things:'已签到'})
              }
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
.title{
  font-family: 幼圆;
  padding-top: 2%;
}
.message{
  margin: 0 auto;
  font-family: 幼圆;
}
.cal{
  padding-top: 5%;
  padding-left: 20%;
  padding-right: 20%;
}
  .whole{
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
    background:url("../assets/img/bg.png");
    background-size: 100%;
    background-attachment: fixed;
  }
</style>