<template>
<div class="table">
    <div class="table1">
      <div class="title1">
        <h1>请选择学院和年级</h1>

        <div class = "return">
          <el-button type="text" @click="Menu()">返回个人界面</el-button>
        </div>

      </div>
      <div class="input1">
        <el-select
                v-model="value1"
                multiple placeholder="请选择学院"
                style="width: 26%">
          <el-option
              v-for="item in options1"
              :key="item.value"
              :label="item.label"
              :value="item.value"
          style="width: 130%">
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
        <el-button icon="el-icon-search" circle v-on:click="chaxun"></el-button>
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
                width="250">
            </el-table-column>
            <el-table-column
                prop="name"
                label="姓名"
                width="80">
            </el-table-column>
          </el-table>

          <div class="block">
            <el-pagination
                class="page"
                @current-change="handleCurrentChange1"
                :current-page="currentPage1"
                :page-size="pagesize1"
                layout="total, prev, pager, next, jumper"
                :total="totals1">
            </el-pagination>
          </div>

        </el-tab-pane>
        <el-tab-pane v-bind:label="'未签到'+number2" name="2">
          <el-table
              :data="tableData2"
              style="width: 40%">
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
            <el-pagination
                class="page"
                @current-change="handleCurrentChange2"
                :current-page="currentPage2"
                :page-size="pagesize2"
                layout="total, prev, pager, next, jumper"
                :total="totals2">
            </el-pagination>
          </div>

        </el-tab-pane>
        <el-tab-pane v-bind:label="'签到有异常'+number3" name="3">
          <el-table
              :data="tableData3"
              style="width: 40%">
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
            <el-pagination
                class="page"
                @current-change="handleCurrentChange3"
                :current-page="currentPage3"
                :page-size="pagesize3"
                layout="total, prev, pager, next, jumper"
                :total="totals3">
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
      totals1: 0, //总条数
      currentPage1: 1, //当前页数
      pagesize1: 10, //页大小
      totals2: 0, //总条数
      currentPage2: 1, //当前页数
      pagesize2: 10, //页大小
      totals3: 0, //总条数
      currentPage3: 1, //当前页数
      pagesize3: 10, //页大小
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
      this.chaxun1(this.currentPage1,this.pagesize1)
      this.chaxun2(this.currentPage2,this.pagesize2)
      this.chaxun3(this.currentPage3,this.pagesize3)
      this.chaxun1Num()
      this.chaxun2Num()
      this.chaxun3Num()
    },
    chaxun1:function (pagenum, pagesize){
      var data = Qs.stringify({'department': this.value1, 'grade':this.value2});
      this.axios.post('/daily/model_from_php/getTotalKaoQin.php',data,{
        headers:{'Content-Type':'application/x-www-form-urlencoded'}
      })
          .then(response=>{
            if (response.status >= 200 && response.status < 300) {
              this.tableData1 = response.data;
              this.totals1 = this.tableData1.length
              this.tableData1 = this.tableData1.slice((pagenum - 1) * pagesize, pagenum * pagesize)
            } else {
              console.log(response.message);
            }
          })
          .catch(function (error) {
            console.log(error);
          })
    },
    chaxun2:function (pagenum, pagesize){
      var data = Qs.stringify({'department': this.value1, 'grade':this.value2});
      this.axios.post('/daily/model_from_php/getTotalWeiKaoQin.php',data,{
        headers:{'Content-Type':'application/x-www-form-urlencoded'}
      })
          .then(response=>{
            if (response.status >= 200 && response.status < 300) {
              this.tableData2 = response.data;
              this.totals2 = this.tableData2.length
              this.tableData2 = this.tableData2.slice((pagenum - 1) * pagesize, pagenum * pagesize)
            } else {
              console.log(response.message);
            }
          })
          .catch(function (error) {
            console.log(error);
          })
    },
    chaxun3:function (pagenum, pagesize){
      var data = Qs.stringify({'department': this.value1, 'grade':this.value2});
      this.axios.post('/daily/model_from_php/getTotalSpecialKaoQin.php',data,{
        headers:{'Content-Type':'application/x-www-form-urlencoded'}
      })
          .then(response=>{
            if (response.status >= 200 && response.status < 300) {
              this.tableData3 = response.data;
              this.totals3 = this.tableData3.length
              this.tableData3 = this.tableData3.slice((pagenum - 1) * pagesize, pagenum * pagesize)
              console.log(response.data)
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
    },
    handleCurrentChange1(val) {
      this.currentPage1 = val
      this.chaxun1(val, this.pagesize1)
    },
    handleCurrentChange2(val) {
      this.currentPage2 = val
      this.chaxun2(val, this.pagesize2)
    },
    handleCurrentChange3(val) {
      this.currentPage3 = val
      this.chaxun3(val, this.pagesize3)
    }
  }
}
</script>

<style scoped>
  .title1{
    padding-top: 2%;
    padding-left: 38%;
    font-family: 幼圆;
  }
  .input1{
    padding-left: 30%;
    padding-top: 3%;
  }
  .button{
    padding-top: -15%;
    margin-top: -3%;
    padding-left: 67%;
  }
  .show{
    margin-top: 5%;
    padding-left: 36%;
  }
  .block{
    padding-left: 5%;
    padding-top: 2%;
    padding-bottom: 10%;
  }
  .table{
    margin: 0;
    padding: 0;
    align: center;
    width: 100%;
    height: 100%;
    padding-bottom: 10%;
    background:url("../assets/img/bg.png");
    background-size: 100%;
    background-attachment: fixed;
  }
  .return{
    padding-left: 10%;
  }
</style>