<template>

    <div class="table">

        <el-tabs>
                <div class="1">
                    <div class="title">
                        <h1>出差申请</h1>

                        <dic class = "return">
                            <el-button type="text" @click="Menu()">返回个人界面</el-button>
                        </dic>

                    </div>
                    <div class="chuchai">
                        <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="demo-ruleForm" label-position ="top">
                            <el-form-item label="姓名" prop="name">
                                <el-input v-model="ruleForm.name"></el-input>
                            </el-form-item>

                            <el-form-item label="工号" prop="userID">
                                <el-input v-model="ruleForm.userID"></el-input>
                            </el-form-item>

                            <el-form-item label="性别  ">
                                <el-radio-group v-model="ruleForm.sex">
                                    <el-radio label="男"></el-radio>
                                    <el-radio label="女"></el-radio>
                                </el-radio-group>
                            </el-form-item>


                            <el-form-item label="手机号码">
                                <el-input v-model="ruleForm.phone"></el-input>
                            </el-form-item>

                            <div v-for="index in num" :key="index">

                                <el-form-item label="出差地址">
                                    <el-input v-model="ruleForm.address[index]"></el-input>
                                </el-form-item>

                                <el-form-item label="通行开始时间">
                                    <el-date-picker
                                            v-model="ruleForm.start[index]"
                                            type="date"
                                            placeholder="选择日期时间"
                                            value-format="yyyy-MM-dd">
                                    </el-date-picker>
                                </el-form-item>

                                <el-form-item label="通行结束时间">
                                    <el-date-picker
                                            v-model="ruleForm.finish[index]"
                                            type="date"
                                            placeholder="选择日期时间"
                                            value-format="yyyy-MM-dd">
                                    </el-date-picker>
                                </el-form-item>

                                <p v-if="ruleForm.start[index]>ruleForm.finish[index]">起始时间不能晚于结束时间</p>

                            </div>

                            <el-form-item>
                                    <el-button type="success" icon="el-icon-check" circle v-if="this.num.length<3" @click="add()"></el-button>
                                    <!--<el-button v-if="this.num.length<3" @click="add()">增加记录</el-button>-->
                                    <!--<el-button v-if="this.num.length>1" @click="pop()">删除记录</el-button>-->
                                    <el-button type="danger" icon="el-icon-delete" circle v-if="this.num.length>1" @click="pop()"></el-button>

                            </el-form-item>

                          <el-form-item>
                            <el-button type="primary" @click="submitForm()">提交</el-button>
                            <el-button @click="resetForm()">重置</el-button>
                          </el-form-item>


                        </el-form>
                    </div>



                </div>
        </el-tabs>
    </div>
</template>

<script>
// import axios from 'axios';
// eslint-disable-next-line no-unused-vars
import Qs from 'qs'
import router from "@/router";
    export default{
        name: "TeacherChuxiao",
        data() {

            return {
                num:[0],
                ruleForm: {
                    name: '',
                    sex:'',
                    userID:'',
                    start:['','',''],
                    finish:['','',''],
                    category:'',
                    left:'',
                    address:['','',''],
                    phone: '',
                    urldata:Qs.stringify({'userID': localStorage.getItem('userID')})
                },
                rules: {
                    name: [
                        {required: true, message: '请输入姓名', trigger: 'blur'},
                        {min: 3, max: 5, message: '长度在 3 到 5 个字符', trigger: 'blur'}
                    ],
                  userID: [
                        {required: true, message: '请输入学号/工号', trigger: 'blur'},
                        {min: 12, max: 12, message: '长度为12', trigger: 'blur'}
                    ],
                }
            };
        },

      created() {
        this.check()
        // localStorage.setItem('page','/TeacherChuxiao')
      },
      methods: {

          Menu() {
              this.$router.push('/Menu');
          },

        check() {
          this.axios.post('/daily/model_from_php/Teacher_out_check.php',this.ruleForm.urldata,{
            headers:{'Content-Type':'application/x-www-form-urlencoded'}
          })
              .then(response=>{
                console.log(response.data)
                if(response.data=='正在假期中，请先销假'){
                  this.$message.error('正在假期中，请先销假');
                  // eslint-disable-next-line no-unused-vars
                  setTimeout(valid => {
                    router.replace('/Menu')
                  }, 1000);

                }
              })
              .catch(function (error) {
                console.log(error);
              })
        },
          resetForm(){
            Object.assign(this.$data,this.$options.data())
          },

          add(){
            var number=this.num.length;
            if(number<3){
              this.num.push(number)
            }
          },

          pop(){
          var number=this.num.length;
          if(number>1){
            this.num.pop();
          }
        },

        arraytime:function (array){
          for(var i=0;i<array.length;i++){
            array[i]=this.formateDate(array[i]);
          }
          return array;
        },

        formateDate:function (date) {
          function addDateZero(num) {
            return (num < 10 ? '0' + num : num)
          }
          const d = new Date(date)
          const formatdatetime = d.getFullYear() + '-' + addDateZero(d.getMonth() + 1) + '-' + addDateZero(d.getDate())
          return formatdatetime
        },
        submitForm() {
          this.$refs.ruleForm.validate(valid => {
            if(valid){
              const qs = require('qs');
              this.axios({
                method:"post",
                url:'/daily/model_from_php/TeacherChuxiao.php',

                headers:{
                  'Content-type': 'application/x-www-form-urlencoded'
                },
                params: {
                  'num':String(this.num.length),
                  'identity':localStorage.getItem('userIdentity'),
                  'name':this.ruleForm.name,
                  'sex':this.ruleForm.sex,
                  'userID':this.ruleForm.userID,
                  'start':this.arraytime(this.ruleForm.start),
                  'finish':this.arraytime(this.ruleForm.finish),
                  'category':this.ruleForm.category,
                  'left':this.ruleForm.left,
                  'address':this.ruleForm.address,
                  'phone': this.ruleForm.phone,
                },
                paramsSerializer: function(params) {
                  return qs.stringify(params, {arrayFormat: 'indices'})
                }
              })
                  // eslint-disable-next-line no-unused-vars
                  .then((valid) => {
                    console.log(valid.data)
                    this.$message.success('填报成功');
                    router.push('/Menr')
                  })
            }else {
              this.$message.error('请填写正确信息');
              console.log('error submit!!');
              return false;

            }
          });
        },
      },
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
        padding-top: -1%;
        padding-left: 48%;
        font-family: 幼圆;
    }
    .return{
        padding-left: 4%;
    }
    .chuchai{
        padding-left: 35%;
    }
    .table{
        width: 100%;
        height: 100%;
        background:url("../assets/img/bg.png");
        background-size: 100%;
        background-attachment: fixed;
    }
</style>