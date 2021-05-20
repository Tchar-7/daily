<template>
  <div class="login-wrap">
    <div class="ms-title">每日一报系统</div>
    <div class="ms-content">浙江工业大学<br>防疫期间<br>签到销假系统</div>
    <div class="ms-login">
      <el-form :model="param" :rules="rules" ref="login" label-width="30px" class="ms-content" >

        <el-form-item prop="username">
          <el-input v-model="param.username" placeholder="username">
            <el-button slot="prepend" icon="el-icon-lx-people"></el-button>
          </el-input>
        </el-form-item>

        <el-form-item prop="password">
          <el-input
              type="password"
              placeholder="password"
              v-model="param.password"
              @keyup.enter.native="submitForm()">
            <el-button slot="prepend" icon="el-icon-lx-lock"></el-button>
          </el-input>
        </el-form-item>
        <el-form-item>
          <el-radio-group v-model="param.radio">
            <el-radio :label="1">学生</el-radio>
            <el-radio :label="2">教职工</el-radio>
            <el-radio :label="3">管理员</el-radio>
          </el-radio-group>
        </el-form-item>


        <div class="login-btn">
          <el-button type="primary" @click="submitForm()">登录</el-button>
        </div>
      </el-form>

    </div>
  </div>
</template>
<script>
export default {
  name: "Login",
  data: function() {
    return {
      param: {
        username: '',
        password: '',
        radio: '1',
      },
      rules: {
        username: [{ required: true, message: '请输入用户名', trigger: 'blur' }],
        password: [{ required: true, message: '请输入密码', trigger: 'blur' }],
      },
    };
  },
  methods: {

    submitForm() {
      this.$refs.login.validate(valid => {
        if (valid) {
          this.$message.success('登录成功');
          localStorage.setItem('ms_username', this.param.username);
          this.$router.push('/');
        } else {
          this.$message.error('请输入账号和密码');
          console.log('error submit!!');
          return false;
        }
      });
    },
  },
}
</script>

<style scoped>
.login-wrap {
  position: relative;
  width: 100%;
  height: 1000px;
  background:url("../assets/img/login-bg.jpg");
  background-size: 100%;
}
.ms-title {
  width: 100%;
  line-height: 50px;
  text-align: center;
  font-size: 20px;
  border-bottom: 1px solid #ddd;
}
.ms-login {
  margin: 0 auto;
  /*text-align: center;*/
  width: 400px;
  /*margin: -190px 0 0 -175px;*/
  border-radius: 5px;
  background: rgba(255, 255, 255, 0.3);

}
.ms-content {
  padding: 30px 30px;
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
  color: #fff;
}
</style>