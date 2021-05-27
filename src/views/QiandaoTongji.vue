<template>
<div class="table">
    <div class="table1">
      <div class="title1">
        <h1>请选择学院和年级</h1>

        <dic class = "return">
          <el-button type="text" @click="Menu()">返回个人界面</el-button>
        </dic>

      </div>
      <div class="input1">
        <el-select v-model="value1" multiple placeholder="请选择学院">
          <el-option
              v-for="item in options1"
              :key="item.value"
              :label="item.label"
              :value="item.value">
          </el-option>
        </el-select>

        <el-select
            v-model="value2"
            multiple
            collapse-tags
            style="margin-left: 20px;"
            placeholder="请选择年级">
          <el-option
              v-for="item in options2"
              :key="item.value"
              :label="item.label"
              :value="item.value">
          </el-option>
        </el-select>
      </div>
      <div class="button">
        <el-button icon="el-icon-search" type="primary" v-on:click="chaxun">查询</el-button>
      </div>
    </div>

    <div class="show">
      <el-tabs v-model="activeName1" @tab-click="handleClick">
        <el-tab-pane v-bind:label="'已签到'+number1" name="1">
          <el-table
              :data="tableData1"
              style="width: 40%">
            <el-table-column
                prop="ID"
                label="学/工号"
                width="180">
            </el-table-column>
            <el-table-column
                prop="name"
                label="姓名"
                width="180">
            </el-table-column>
          </el-table>
          <div class="block">
            <span class="demonstration"></span>
            <el-pagination
                layout="prev, pager, next"
                :total="50">
            </el-pagination>
          </div>
        </el-tab-pane>
        <el-tab-pane v-bind:label="'未签到'+number2" name="2">
          <el-table
              :data="tableData2"
              style="width: 100%">
            <el-table-column
                prop="ID"
                label="学/工号"
                width="180">
            </el-table-column>
            <el-table-column
                prop="name"
                label="姓名"
                width="180">
            </el-table-column>
          </el-table>
          <div class="block">
            <span class="demonstration"></span>
            <el-pagination
                layout="prev, pager, next"
                :total="50">
            </el-pagination>
          </div>
        </el-tab-pane>
        <el-tab-pane v-bind:label="'签到有异常'+number3" name="3">
          <el-table
              :data="tableData3"
              style="width: 100%">
            <el-table-column
                prop="ID"
                label="学/工号"
                width="250">
            </el-table-column>
            <el-table-column
                prop="name"
                label="姓名"
                width="80">
            </el-table-column>
          </el-table>
          <div class="block">
            <span class="demonstration"></span>
            <el-pagination
                layout="prev, pager, next"
                :total="50">
            </el-pagination>
          </div>
        </el-tab-pane>
      </el-tabs>
    </div>
</div>
</template>

<script>
import Qs from "qs";

export default {
  name: "QiandaoTongji",
  data() {
    return {
      options1: [{
          value: '计算机科学与技术学院、软件学院',
          label: '计算机科学与技术学院、软件学院'
        }, {
          value: '人文学院',
          label: '人文学院'
        }, {
          value: '机械学院',
          label: '机械学院'
        },
        {value: '材料科学与工程学院',
          label: '材料科学与工程学院'
        },{
          value: '药学院',
          label: '药学院'
        },{
          value: '机械工程学院',
          label: '机械工程学院 '
        }, {
          value: '信息工程学院',
          label: '信息工程学院 '
        },{
          value: '化工学院',
          label: '化工学院'
        }, {
          value: '经济学院',
          label: '经济学院'
        }, {
          value: '理学院',
          label: '理学院'
        },{
          value: '健行学院',
          label: '健行学院'
        }
      ],
      options2: [{
        value: '2020',
        label: '2020级'
      }, {
        value: '2019',
        label: '2019级'
      }, {
        value: '2018',
        label: '2018级'
      }, {
        value: '2017',
        label: '2017级'
      }
      ],
      value1: [],
      value2: [],
      number1: '',
      number2: '',
      number3: '',
      tableData1:[],
      tableData2:[],
      tableData3:[],
      activeName1:'1',
    }
  },
  methods:{

    Menu() {
      this.$router.push('/Menu');
    },

    handleSelect(key, keyPath) {
      console.log(key, keyPath);
    },
    handleClick(tab, event) {
      console.log(tab, event);
    },
    chaxun:function (){
      this.chaxun1()
      this.chaxun2()
      this.chaxun3()
      this.chaxun1Num()
      this.chaxun2Num()
      this.chaxun3Num()
    },
    chaxun1:function (){
      var data = Qs.stringify({'department': this.value1, 'grade':this.value2});
      this.axios.post('/daily/model_from_php/getTotalKaoQin.php',data,{
        headers:{'Content-Type':'application/x-www-form-urlencoded'}
      })
          .then(response=>{
            if (response.status >= 200 && response.status < 300) {
              this.tableData1 = response.data;
            } else {
              console.log(response.message);
            }
          })
          .catch(function (error) {
            console.log(error);
          })
    },
    chaxun2:function (){
      var data = Qs.stringify({'department': this.value1, 'grade':this.value2});
      this.axios.post('/daily/model_from_php/getTotalWeiKaoQin.php',data,{
        headers:{'Content-Type':'application/x-www-form-urlencoded'}
      })
          .then(response=>{
            if (response.status >= 200 && response.status < 300) {
              this.tableData2 = response.data;
              console.log(response.data)
            } else {
              console.log(response.message);
            }
          })
          .catch(function (error) {
            console.log(error);
          })
    },
    chaxun3:function (){
      var data = Qs.stringify({'department': this.value1, 'grade':this.value2});
      this.axios.post('/daily/model_from_php/getTotalSpecialKaoQin.php',data,{
        headers:{'Content-Type':'application/x-www-form-urlencoded'}
      })
          .then(response=>{
            if (response.status >= 200 && response.status < 300) {
              this.tableData3 = response.data;
            } else {
              console.log(response.message);
            }
          })
          .catch(function (error) {
            console.log(error);
          })
    },
    chaxun1Num:function (){
      var data = Qs.stringify({'department': this.value1, 'grade':this.value2});
      this.axios.post('/daily/model_from_php/getTotalKaoQinNum.php',data,{
        headers:{'Content-Type':'application/x-www-form-urlencoded'}
      })
          .then(response=>{
            if (response.status >= 200 && response.status < 300) {
              this.number1 = "("+response.data +")";
            } else {
              console.log(response.message);
            }
          })
          .catch(function (error) {
            console.log(error);
          })
    },
    chaxun2Num:function (){
      var data = Qs.stringify({'department': this.value1, 'grade':this.value2});
      this.axios.post('/daily/model_from_php/getTotalWeiKaoQinNum.php',data,{
        headers:{'Content-Type':'application/x-www-form-urlencoded'}
      })
          .then(response=>{
            if (response.status >= 200 && response.status < 300) {
              this.number2 = "("+response.data +")";
            } else {
              console.log(response.message);
            }
          })
          .catch(function (error) {
            console.log(error);
          })
    },
    chaxun3Num:function (){var data = Qs.stringify({'department': this.value1, 'grade':this.value2});
      this.axios.post('/daily/model_from_php/getTotalSpecialKaoQinNum.php',data,{
        headers:{'Content-Type':'application/x-www-form-urlencoded'}
      })
          .then(response=>{
            if (response.status >= 200 && response.status < 300) {
              this.number3 = "("+response.data +")";
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
.table{
  align: center;
}
  .title1{
    padding-left: 40%;
  }
  .input1{
    padding-left: 30%;
    padding-top: 3%;
  }
  .button{
    padding-left: 63%;
  }
  .show{
    padding-left: 30%;
  }
  .block{
    padding-left: 8%;
  }
  .table{
    width: 100%;
    height: 600px;
    background:url("../assets/img/bg.png");
    background-size: 100%;
    background-attachment: fixed;
  }
  .return{
    padding-left: 10%;
  }
  .el-table{
    ackground-color: transparent;
  }
</style>