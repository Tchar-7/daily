<template>
  <el-dialog :visible.sync="dialogVisible" :before-close="cancelDialog">
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

      <el-form-item v-show="dialogInfo.state == 1">
        <h4>申请失败反馈：</h4>
        <p class="info">{{dialogInfo.comment}}</p>
      </el-form-item>
    </el-form>

    <div slot="footer" class="dialog-footer">
      <el-button @click="cancelDialog">取 消</el-button>
      <el-button type="primary" @click="cancelDialog">确 定</el-button>
    </div>
  </el-dialog>
</template>

<script>
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
  methods: {
    // 修改父组件传过来的值
    cancelDialog() {
      // console.log(this.dialogInfo)
      this.$emit('update:dialogVisible', false)
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