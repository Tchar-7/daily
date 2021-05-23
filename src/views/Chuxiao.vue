<template>

    <div>
      <h1 class="returnButton">每日信息填报</h1>
        <div>
            <a href="Menu.vue" class="returnButton">返回</a>
        </div>

        <el-tabs v-model="activeName">
                <div class="1">

                    <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="demo-ruleForm" label-position ="top">
                        <el-form-item label="姓名" prop="name">
                            <el-input v-model="ruleForm.name"></el-input>
                        </el-form-item>

                        <el-form-item label="学号" prop="userID">
                            <el-input v-model="ruleForm.userID"></el-input>
                        </el-form-item>

                        <el-form-item label="性别  ">
                            <el-radio-group v-model="ruleForm.sex">
                                <el-radio label="男"></el-radio>
                                <el-radio label="女"></el-radio>
                            </el-radio-group>
                        </el-form-item>

                        <el-form-item label="类别  ">
                            <el-radio-group v-model="ruleForm.category">
                                <el-radio label="内地本科生"></el-radio>
                                <el-radio label="内地研究生"></el-radio>
                                <el-radio label="港澳台学生"></el-radio>
                                <el-radio label="留学生"></el-radio>
                                <el-radio label="内地成教育学生"></el-radio>
                                <el-radio label="其他"></el-radio>
                            </el-radio-group>
                            <el-input v-if="ruleForm.category=='其他'" v-model="ruleForm.other"/>
                        </el-form-item>


                        <el-form-item label="手机号码">
                            <el-input v-model="ruleForm.phone"></el-input>
                        </el-form-item>

                        <el-form-item label="通行开始时间">
                            <el-date-picker
                                    v-model="ruleForm.start"
                                    type="datetime"
                                    placeholder="选择日期时间"
                                    default-time="12:00:00">
                            </el-date-picker>
                        </el-form-item>

                        <el-form-item label="通行结束时间">
                            <el-date-picker
                                    v-model="ruleForm.finish"
                                    type="datetime"
                                    placeholder="选择日期时间"
                                    default-time="12:00:00">
                            </el-date-picker>
                        </el-form-item>

                        <p v-if="ruleForm.start>ruleForm.finish">起始时间不能晚于结束时间</p>

                        <el-form-item label="是否离开杭州">
                            <el-radio-group v-model="ruleForm.left">
                                <el-radio label="是"></el-radio>
                                <el-radio label="否"></el-radio>
                            </el-radio-group>
                        </el-form-item>

                        <el-form-item label="申请理由">
                            <el-input v-model="ruleForm.reason"></el-input>
                        </el-form-item>

                        <el-form-item label="是否在外留宿">
                            <el-radio-group v-model="ruleForm.stay">
                                <el-radio label="是"></el-radio>
                                <el-radio label="否"></el-radio>
                            </el-radio-group>
                        </el-form-item>

                        <el-input
                            v-model="ruleForm.address"
                            v-if="ruleForm.stay=='是'"
                            placeholder="具体地址"/>

                        <el-form-item label="杭州健康码”状态">
                            <el-radio-group v-model="ruleForm.color">
                                <el-radio label="红码"></el-radio>
                                <el-radio label="黄码"></el-radio>
                                <el-radio label="绿码"></el-radio>
                                <el-radio label="橙码"></el-radio>
                            </el-radio-group>
                        </el-form-item>

                        <el-form-item>
                            <el-button type="primary" @click="submitForm('ruleForm')">提交</el-button>
                            <el-button @click="resetForm()">重置</el-button>
                        </el-form-item>
                    </el-form>

                </div>
        </el-tabs>
    </div>
</template>

<script>
    export default {
        name: "Chuxiao",
        data() {
            return {
                ruleForm: {
                    name: '',
                    sex:'',
                    userID:'',
                    start:'',
                    finish:'',
                    category:'',
                    left:'',
                    reason:'',
                    other:'',
                    stay:'',
                    address:'',
                    phone: '',
                    color:''
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
              this.axios({
                method:"post",
                url:'/daily/model_from_php/apply_for_out.php',

                headers:{
                  'Content-type': 'application/x-www-form-urlencoded'
                },
                params: {
                  'identity':localStorage.getItem('userIdentity'),
                  'name':this.ruleForm.name,
                  'sex':this.ruleForm.sex,
                  'userID':this.ruleForm.userID,
                  'start':this.formateDate(this.ruleForm.start),
                  'finish':this.ruleForm.finish,
                  'category':this.ruleForm.category,
                  'left':this.ruleForm.left,
                  'reason':this.ruleForm.reason,
                  'other':this.ruleForm.other,
                  'stay':this.ruleForm.stay,
                  'address':this.ruleForm.address,
                  'phone': this.ruleForm.phone,
                  'color':this.ruleForm.color
                }
              })
                  // eslint-disable-next-line no-unused-vars
                  .then((valid) => {

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
    .el-tabs {
      margin-left: 35%;
      margin-right: 30%;
    }

    .returnButton {
      margin-left: 35%;
    }
</style>