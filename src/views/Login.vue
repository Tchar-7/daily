<template>
  <div class="login-wrap">
    <div class="ms-title">每日一报系统</div>
    <div class="ms-logo">浙江工业大学<br>防疫期间<br>签到销假系统</div>
    <div class="ms-login">
      <el-form :model="param" :rules="rules" ref="login" label-width="30px" class="ms-content" >

        <el-form-item prop="userID">
          <el-input v-model="param.userID" placeholder="请输入学/工号">
            <el-button slot="prepend" icon="el-icon-lx-people"></el-button>
          </el-input>
        </el-form-item>

        <el-form-item prop="password">
          <el-input
              type="password"
              placeholder="请输入密码"
              v-model="param.password"
              @keyup.enter.native="submitForm()">
            <el-button slot="prepend" icon="el-icon-lx-lock"></el-button>
          </el-input>
        </el-form-item>

        <div class="ra">
          <el-form-item>
            <el-radio-group v-model="param.radio">
              <el-radio :label="1">学生</el-radio>
              <el-radio :label="2">教职工</el-radio>
              <el-radio :label="3">管理员</el-radio>
            </el-radio-group>
          </el-form-item>
        </div>


        <div class="login-btn">
          <el-button type="primary" @click="submitForm()">登录</el-button>
        </div>
      </el-form>

    </div>
  </div>
</template>
<script>
import router from "@/router";

export default {
  name: "Login",
  data: function() {
    return {
      param: {
        userID: '',
        password: '',
        radio: 1,
        users: []
      },
      rules: {
        userID: [{ required: true, message: '请输入学/工号', trigger: 'blur' }],
        password: [{ required: true, message: '请输入密码', trigger: 'blur' }],
      },
    };
  },
  methods: {

    submitForm() {
      this.$refs.login.validate(valid => {
        if(valid){
            this.axios({
              method:"post",
              url:'/daily/model_from_php/logInCheck.php',

              headers:{
                'Content-type': 'application/x-www-form-urlencoded'
              },
              params: {
                'userID': this.param.userID,
                'password':this.param.password,
                'identity':this.param.radio
              }
            })
            .then((valid) => {
              this.users = valid.data;    //将PHP返回数组的值付给users
              if(valid.data !='用户名或密码错误'){
                this.$message.success('登录成功');

                localStorage.setItem('userID', valid.data[0].ID);
                localStorage.setItem('userName', valid.data[0].userName);
                localStorage.setItem('userIdentity',valid.data[0].identity)

                  // eslint-disable-next-line no-unused-vars
                  setTimeout(valid => {
                    // this.$router.push('/Menu')
                    router.go(0)
                  }, 600);
              }
              else {
                this.$message.error('用户名或密码错误,请重新输入!');
              }

            })
        }else {
          this.$message.error('请输入学/工号和密码');
            console.log('error submit!!');
            return false;
        }
      });
    },
  },
}
</script>

<style scoped>
* {
  margin: 0;
  padding: 0;
}

.login-wrap {
  position: absolute;
  width: 100%;
  height: 100%;
  background:url("../assets/img/login-bg.jpg");
  background-size: 100%;
}
.ms-title {
  width: 100%;
  line-height: 50px;
  text-align: center;
  font-size: 35px;
  color: #000099;
  border-bottom: 1px solid #ddd;
  font-family: 幼圆;
}
.ms-logo {
  display: inline-block;
  margin-left: 15%;
  font-size: 40px;
  font-family: 幼圆;
  font-weight: bold;
}
.ms-login {
  display: inline-block;
  margin-left: 30%;
  margin-top: 10%;
  /*text-align: center;*/
  width: 400px;
  /*margin: -190px 0 0 -175px;*/
  border-radius: 5px;
  background: rgba(255, 255, 255, 0.3);
  text-align: center;

}
.ms-content {
  padding: 40px 30px;
  font-size: 30px;

}
.login-btn {
  text-align: center;
}
.login-btn button {
  width: 100%;
  height: 36px;
  margin-bottom: 10px;
}
.login-tips {
  font-size: 12px;
  line-height: 30px;
  color: #6699ff;
}
  .el-radio{
    color: #242f42;
  }

</style>