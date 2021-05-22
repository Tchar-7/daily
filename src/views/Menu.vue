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
                <el-menu-item index="2-1">销假</el-menu-item>
                <el-menu-item index="2-2" @click="Chuxiao()">出校申请</el-menu-item>
            </el-submenu>
            <button v-on:click="logOut()">登出</button>
    </el-menu>
    <div class="info">
    <el-tabs  v-model="activeName" @tab-click="handleClick">
        <el-tab-pane label="个人信息" name="first">
            <div class="show-info"
                 >
                <div class="pic"> <!--头像-->
                    <img src="../assets/img/img.jpg"/>
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
            <div class="apply">
                <div class="applying">
                    <h4 align="center">办理中</h4>
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
                </div>
                <div class="failed">
                    <h4 align="center">办理失败</h4>
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
                </div>
                <div class="history">
                    <h4 align="center">历史办理</h4>
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
                </div>
            </div>
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
                activeName: 'second',
                uName:'',
                department:'',
                uID:'',
                mail:'',
                phone:'',
                sex:'',
                tableData0: [],
                tableData1: [],
                tableData2: []
            };

        },
        created() {
          this.getInfo()
          this.getApply0()
          this.getApply1()
          this.getApply2()
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
            getApply0:function (){
            this.axios.post('/daily/model_from_php/getApply0.php',data,{
              headers:{'Content-Type':'application/x-www-form-urlencoded'}
            })
                .then(response=>{
                  if (response.status >= 200 && response.status < 300) {
                    this.tableData0 = response.data;
                  } else {
                    console.log(response.message);
                  }
                })
                .catch(function (error) {
                  console.log(error);
                })
          },
            getApply1:function (){
            this.axios.post('/daily/model_from_php/getApply1.php',data,{
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
            getApply2:function (){
              this.axios.post('/daily/model_from_php/getApply2.php',data,{
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
.pic{
    height:100%;
    width:30%;
    float:left;
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
</style>