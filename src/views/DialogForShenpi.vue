<template>
  <el-dialog :visible.sync="dialogVisible" :before-close="cancelDialog" append-to-body=“true”>
    <el-form class="form">

      <el-form-item>
        <h4>申请人姓名：</h4>
        <p class="info">  {{dialogInfo.userName}}</p>
      </el-form-item>

      <el-form-item>
        <h4>申请人学/工号：</h4>
        <p class="info">{{dialogInfo.userID}}</p>
      </el-form-item>

      <el-form-item>
        <h4>申请事项：</h4>
        <p class="info">{{dialogInfo.applyName}}</p>
      </el-form-item>

      <el-form-item>
        <h4>申请详细信息：</h4>
        <p class="info" v-html="dialogInfo.detail"></p>
      </el-form-item>
      <el-form-item>
        <h4>申请时间：</h4>
        <p class="info">{{dialogInfo.applyTime}}</p>
      </el-form-item>

      <el-form-item>
        <h4>是否通过：</h4>
        <el-radio-group v-model="tongguo">
          <el-radio value="2" label="是"></el-radio>
          <el-radio value="1" label="否"></el-radio>
        </el-radio-group>
      </el-form-item>

      <el-form-item>
        <h4>反馈：</h4>
        <el-input type="textarea" v-model="comment"></el-input>
      </el-form-item>
    </el-form>

    <div slot="footer" class="dialog-footer">
      <el-button @click="cancelDialog">取 消</el-button>
      <el-button type="primary" @click="doShenpi">审 批</el-button>
    </div>
  </el-dialog>
</template>

<script>
import Qs from "qs";

export default {
  name: "DialogForShenpi",
  props: {
    dialogVisible: {
      type: Boolean,
      default: false
    },
    dialogInfo: {
      type: Object,
      // eslint-disable-next-line vue/require-valid-default-prop
      default: {}
    },
  },
  data(){
    return{
      tongguo:'是',
      comment:''
    }
  },
  methods: {
    // 修改父组件传过来的值
    cancelDialog() {
      // console.log(this.dialogInfo)
      this.$emit('update:dialogVisible', false)
      //this.$router.go(0);
      this.$parent.reflush();//调用父类方法
    },
    doShenpi(){
      var data
      if(this.tongguo =='是') {
        data = Qs.stringify({
          'recordID': this.dialogInfo.recordID,
          'tongguo': 2,
          'comment': this.comment,
          'relativeID': this.dialogInfo.relativeID,
          'applyName':this.dialogInfo.applyName
        });
      }
      else {
        data = Qs.stringify({
          'recordID': this.dialogInfo.recordID,
          'tongguo': 1,
          'comment': this.comment,
          'relativeID': this.dialogInfo.relativeID,
          'applyName':this.dialogInfo.applyName
        });
      }
      this.axios.post('/daily/model_from_php/DoShenpi.php',data,{
        headers:{'Content-Type':'application/x-www-form-urlencoded'}
      })
          .then(response=>{
            if (response.status >= 200 && response.status < 300) {
              console.log(response.data)
              this.$message.success("审批成功")
              this.cancelDialog();
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
h4{
  margin: 0;
}
.info{
  margin: 0px 10px;
}
</style>