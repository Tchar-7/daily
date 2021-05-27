<template>

    <div class="table">
                <div class="1">
                    <div class="title">
                        <h1>销假申请</h1>

                        <dic class = "return">
                            <el-button type="text" @click="Menu()">返回个人界面</el-button>
                        </dic>

                    </div>
                    <div class="xiaojia">
                        <el-table :data="tableData" style="width: 100%" max-height="250">

                            <el-table-column prop="jilu" label="请假记录ID" width="100%">
                              <template slot-scope="scope">
                                <span>{{scope.row.ID}}</span>
                              </template>
                            </el-table-column>

                          <el-table-column prop="address" label="出差地点" width="100%">
                            <template slot-scope="scope">
                              <span>{{scope.row.business_address}}</span>
                            </template>
                          </el-table-column>

                          <el-table-column prop="time" label="开始时间" width="100%">
                            <template slot-scope="scope">
                              <span>{{scope.row.start_time}}</span>
                            </template>
                          </el-table-column>

                          <el-table-column prop="time" label="结束时间" width="100%">
                            <template slot-scope="scope">
                              <span>{{scope.row.end_time}}</span>
                            </template>
                          </el-table-column>

                            <el-table-column label="操作" width="100%">
                                <template slot-scope="scope">
                                  <el-button @click="xiaojia(scope.row.ID)">申请销假</el-button>
                                </template>
                            </el-table-column>
                        </el-table>
                    </div>
                </div>
    </div>
</template>

<script>
// import axios from 'axios';
// eslint-disable-next-line no-unused-vars
import Qs from 'qs'
    export default{
        name: "TeacherXiaojia",
        data() {
            return{
                tableData: [

                ]
            }

        },
      created() {
        this.show()
      },
      methods: {
          Menu() {
              this.$router.push('/Menu');
          },
          xiaojia(val){
            var data = Qs.stringify({'ID': val,'userID':localStorage.getItem('userID')})
            console.log(data)
            this.axios.post('/daily/model_from_php/DoXiaojia.php',data,{
              headers:{'Content-Type':'application/x-www-form-urlencoded'}
            })
                .then(response=>{
                  if (response.status >= 200 && response.status < 300) {
                        console.log(response.data)
                  } else {
                    console.log(response.message);
                  }
                })
                .catch(function (error) {
                  console.log(error);
                })
            this.show()
          },
          show(){
            var data = Qs.stringify({'userID': localStorage.getItem('userID')})
            this.axios.post('/daily/model_from_php/ShowForXiaojia.php',data,{
                headers:{'Content-Type':'application/x-www-form-urlencoded'}
              })
                  .then(response=>{
                    if (response.status >= 200 && response.status < 300) {
                        console.log(response.data)
                      this.tableData=response.data
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
    .el-form-item{
        font-weight: bold;
    }
    .el-input{
        width:500px;
        height:5px;
    }
    .title{
        padding-top: 2%;
        padding-left: 43%;
        font-family: 幼圆;
    }
    .return{
        padding-left: 2%;
    }
    .xiaojia{
        margin-top: 2%;
        padding-left: 30%;
    }
    .table{
        margin-top: -1.5%;
        width: 100%;
        height: 650px;
        background:url("../assets/img/bg.png");
        background-size: 100%;
        background-attachment: fixed;
    }
    .el-table{
        background-color: transparent;
    }
</style>