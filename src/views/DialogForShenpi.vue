<template>
  <el-dialog :visible.sync="dialogVisible" :before-close="cancelDialog">
    <el-form class="form">
      <el-form-item>
        <h5>反馈意见：</h5>
        <p class="advise">{{dialogInfo.recordID}}</p>
      </el-form-item>
      <el-form-item>

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

</style>