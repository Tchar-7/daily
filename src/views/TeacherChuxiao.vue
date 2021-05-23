<template>

    <div>
        <div>
            <a href="templates/Menu.vue">返回</a>
        </div>

        <el-tabs v-model="activeName">
                <div class="1">

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
                                type="datetime"
                                placeholder="选择日期时间"
                                default-time="12:00:00">
                            </el-date-picker>
                          </el-form-item>

                          <el-form-item label="通行结束时间">
                            <el-date-picker
                                v-model="ruleForm.finish[index]"
                                type="datetime"
                                placeholder="选择日期时间"
                                default-time="12:00:00">
                            </el-date-picker>
                          </el-form-item>

                          <p v-if="ruleForm.start[index]>ruleForm.finish[index]">起始时间不能晚于结束时间</p>

                        </div>
                        <el-button @click="add()">增加记录</el-button>
                        <el-button @click="pop()">删除记录</el-button>


                        <el-form-item>
                            <el-button type="primary" @click="submitForm()">提交</el-button>
                            <el-button @click="resetForm()">重置</el-button>
                        </el-form-item>
                    </el-form>

                </div>
        </el-tabs>
    </div>
</template>

<script>
// import axios from 'axios';
// eslint-disable-next-line no-unused-vars
import Qs from 'qs'
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

      methods: {
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

        formateDate:function (datetime) {
          function addDateZero(num) {
            return (num < 10 ? '0' + num : num)
          }
          const d = new Date(datetime)
          const formatdatetime = d.getFullYear() + '-' + addDateZero(d.getMonth() + 1) + '-' + addDateZero(d.getDate()) + ' ' + addDateZero(d.getHours()) + ':' + addDateZero(d.getMinutes()) + ':' + addDateZero(d.getSeconds())
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
</style>