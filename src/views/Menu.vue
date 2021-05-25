<template>
<div class="menu">
    <el-menu
            :default-active="activeIndex2"
            class="el-menu-demo"
            mode="horizontal"
            @select="handleSelect"
            background-color="#545c64"
            text-color="#fff"
            active-text-color="#ffd04b">

            <el-menu-item index="1">个人中心</el-menu-item>
            <el-submenu index="2">
                <template slot="title">每日一报</template>
                <el-menu-item index="2-1" @click="Tianbao()">信息填报</el-menu-item>
                <el-menu-item index="2-2" @click="Qiandao()">个人签到信息</el-menu-item>
            </el-submenu>
            <el-submenu index="3">
                <template slot="title">其他</template>
                <el-menu-item index="2-1" @click="Chuxiao()">出校申请</el-menu-item>
            </el-submenu>

        <div class = 'button'>
            <el-button type="text" @click="logOut()">退出登录</el-button>
            <!--<button v-on:click="logOut()" type="success" plain>退出登录</button>-->
        </div>

    </el-menu>
    <div class="info">
    <el-tabs  v-model="activeName" @tab-click="handleClick">
        <el-tab-pane label="个人信息" name="first">
            <div class="show-info"
                 >
                <div class="pic"> <!--头像-->
                    <div class = "pic1">
                        <img src="../assets/img/img.jpg"/>
                    </div>
                </div>
                <div class="detail"><!--个人信息-->
                    <el-row>
                        <el-col :span="4"><div class="grid-content bg-purple-light">姓名</div></el-col>
                        <el-col :span="10"><div class="grid-content bg-purple">{{ uName }}</div></el-col>
                    </el-row>
                    <el-row>
                        <el-col :span="4"><div class="grid-content bg-purple-light">所在部门</div></el-col>
                        <el-col :span="10"><div class="grid-content bg-purple">{{ department }}</div></el-col>
                    </el-row>
                    <el-row>
                        <el-col :span="4"><div class="grid-content bg-purple-light">学号/工号</div></el-col>
                        <el-col :span="10"><div class="grid-content bg-purple">{{ uID }}</div></el-col>
                    </el-row>
                    <el-row>
                        <el-col :span="4"><div class="grid-content bg-purple-light">邮箱</div></el-col>
                        <el-col :span="10"><div class="grid-content bg-purple">{{ mail }}</div></el-col>
                    </el-row>
                    <el-row>
                        <el-col :span="4"><div class="grid-content bg-purple-light">手机</div></el-col>
                        <el-col :span="10"><div class="grid-content bg-purple">{{ phone }}</div></el-col>
                    </el-row>

                </div>
            </div>
        </el-tab-pane>
        <el-tab-pane label="个人申请" name="second">
          <el-tabs  v-model="activeName2" @tab-click="handleClick">

            <el-tab-pane label="办理中" name="21">
                <div class="applying">

                    <el-table
                            :data="tableData0"
                            style="width: 100%">
                        <el-table-column
                                prop="applyTime"
                                label="申请时间"
                                width="180">
                        </el-table-column>
                        <el-table-column
                                prop="applyName"
                                label="办理事项"
                                width="180">
                        </el-table-column>
                    </el-table>
                  <div class="block">
                    <el-pagination
                        class="page"
                        @current-change="handleCurrentChange0"
                        :current-page="currentPage0"
                        :page-size="pagesize0"
                        layout="total, prev, pager, next, jumper"
                        :total="totals0">
                    </el-pagination>
                  </div>
                </div>
            </el-tab-pane>

            <el-tab-pane label="办理失败" name="22">
                <div class="failed">
                    <el-table
                            :data="tableData1"
                            style="width: 100%">
                        <el-table-column
                                prop="applyTime"
                                label="申请时间"
                                width="180">
                        </el-table-column>
                        <el-table-column
                                prop="applyName"
                                label="办理事项"
                                width="180">
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
                </div>
            </el-tab-pane>

            <el-tab-pane label="历史办理" name="23">
                <div class="history">
                    <el-table
                            :data="tableData2"
                            style="width: 100%">
                        <el-table-column
                                prop="applyTime"
                                label="申请时间"
                                width="180">
                        </el-table-column>
                        <el-table-column
                                prop="applyName"
                                label="办理事项"
                                width="180">
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
                </div>
            </el-tab-pane>

          </el-tabs>
        </el-tab-pane>
    </el-tabs>
    </div>
</div>
</template>

<script>
    import router from "@/router";
    // import axios from 'axios';
    import Qs from 'qs'

    var data = Qs.stringify({'userID': localStorage.getItem('userID')});

    export default {
        name:"Menu",
        data() {
            return {
                activeIndex2: '1',
                activeName: 'first',
                activeName2:'21',
                uName:'',
                department:'',
                uID:'',
                mail:'',
                phone:'',
                sex:'',
                tableData0: [],
                tableData1: [],
                tableData2: [],
                totals0: 0, //总条数
                currentPage0: 1, //当前页数
                pagesize0: 10, //页大小
                totals1: 0, //总条数
                currentPage1: 1, //当前页数
                pagesize1: 10, //页大小
                totals2: 0, //总条数
                currentPage2: 1, //当前页数
                pagesize2: 10, //页大小
            };

        },
        created() {
          localStorage.setItem('page','/Menu')
          this.getInfo()
          this.getApply0(this.currentPage0,this.pagesize0)
          this.getApply1(this.currentPage1,this.pagesize1)
          this.getApply2(this.currentPage2,this.pagesize2)
      },
        methods: {
            handleSelect(key, keyPath) {
                console.log(key, keyPath);
            },
            handleClick(tab, event) {
                console.log(tab, event);
            },
            Tianbao() {
                    this.$router.push('/Tianbao');
            },
            Chuxiao() {
                this.$router.push('/Chuxiao');
            },
            Qiandao() {
                this.$router.push('/Qiandao');
            },
            logOut(){
              localStorage.removeItem('userID');
              localStorage.removeItem('userIdentity');
              localStorage.removeItem('userName');
              localStorage.removeItem('page');
              router.push('/');
            },

            getInfo:function (){
              this.axios.post('/daily/model_from_php/getPInfo.php',data,{
                headers:{'Content-Type':'application/x-www-form-urlencoded'}
              })
                  .then(response=>{
                if (response.status >= 200 && response.status < 300) {
                  this.uName = response.data[0].name
                  this.department = response.data[0].department
                  this.uID = response.data[0].ID
                  this.mail = response.data[0].mail
                  this.phone = response.data[0].phone
                  this.sex = response.data[0].sex

                } else {
                  console.log(response.message);
                }
              })
                  .catch(function (error) {
                console.log(error);
              })
            },
            getApply0:function (pagenum, pagesize){
            this.axios.post('/daily/model_from_php/getApply0.php',data,{
              headers:{'Content-Type':'application/x-www-form-urlencoded'}
            })
                .then(response=>{
                  if (response.status >= 200 && response.status < 300) {
                    this.tableData0 = response.data
                    this.totals0 = this.tableData0.length
                    this.tableData0 = this.tableData0.slice((pagenum - 1) * pagesize, pagenum * pagesize)
                    // console.log(this.tableData0)
                  } else {
                    console.log(response.message);
                  }
                })
                .catch(function (error) {
                  console.log(error);
                })
          },
            getApply1:function (pagenum, pagesize){
            this.axios.post('/daily/model_from_php/getApply1.php',data,{
              headers:{'Content-Type':'application/x-www-form-urlencoded'}
            })
                .then(response=>{
                  if (response.status >= 200 && response.status < 300) {
                    this.tableData1 = response.data
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
            getApply2:function (pagenum, pagesize){
              this.axios.post('/daily/model_from_php/getApply2.php',data,{
                headers:{'Content-Type':'application/x-www-form-urlencoded'}
              })
                  .then(response=>{
                if (response.status >= 200 && response.status < 300) {
                  this.tableData2 = response.data
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
            //查看信息用
            check(info) {
            this.dialogVisible = true
            this.dialogInfo = info
            },
            // 子组件传过来的数据
            dialogVisibles(v) {
              this.dialogVisible = v
              console.log(v)
            },
          // 分页数据绑定
          handleCurrentChange0(val) {
            this.currentPage1 = val
            this.getApply0(val, this.pagesize0)
          },
          handleCurrentChange1(val) {
            this.currentPage1 = val
            this.getApply0(val, this.pagesize1)
          },
          handleCurrentChange2(val) {
            this.currentPage2 = val
            this.getApply0(val, this.pagesize2)
          }
        }

    }
</script>

<style scoped>
.info{
    padding-left: 200px;
    padding-top: 100px;
}
.show-info{

}

.button{
    display: flow;
    margin-top: 0.5%;
    margin-left: 85%;
}

.pic{
    height:100%;
    width:30%;
    float:left;
}
.pic1{
    margin-top: 30%;
    display: flex;
    justify-content: center;
    align-items: center;
}
.detail{
    height:100%;
    width:70%;
    float:left;
}
.el-row {
    margin-bottom: 20px;
}

.el-col {
    border-radius: 4px;
}

.bg-purple {
    background: #d3dce6;
}
.bg-purple-light {
    background: #e5e9f2;
}
.grid-content {
  padding: 5px 10px;
    border-radius: 4px;
    min-height: 36px;
    margin: 0px 5px;
}
.applying{
    float:left;
}
.failed{
    float:left;
}
.history{
    float:left;
}
.search{
    width: 20%;
    padding-left: 60%;
}
.button{
    padding-left: 1%;
}
.search1{
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
}
    .menu{
        width: 100%;
        height: 100%;
        background:url("../assets/img/bg.png");
        background-size: 100%;
    }
</style>