<template>
  <div class="shenpi">
    <div class="title">
      <h1>申请审批</h1>
      <div class = "return">
        <el-button type="text" @click="Menu()">返回个人界面</el-button>
      </div>
    </div>
    <div class="info" >
      <el-table :data="tableData" style="width: 100%" >
        <el-table-column prop="name" label="流水号" width="180">
          <template slot-scope="scope">
            <span>{{scope.row.recordID}}</span>
          </template>
        </el-table-column>

        <el-table-column prop="name" label="申请人" width="180">
          <template slot-scope="scope">
            <span>{{scope.row.userName}}</span>
          </template>
        </el-table-column>

        <el-table-column prop="ID" label="学号" width="180">
          <template slot-scope="scope">
            <span>{{scope.row.userID}}</span>
          </template>
        </el-table-column>

        <el-table-column prop="applyName" label="申请事项" width="180">
          <template slot-scope="scope">
            <span>{{scope.row.applyName}}</span>
          </template>
        </el-table-column>

        <el-table-column label="操作" width="100">
          <template slot-scope="scope">
            <el-button @click="check(scope.row)">查看</el-button>
          </template>
        </el-table-column>
      </el-table>
    <div class="block">
      <el-pagination
          class="page"
          @size-change="handleSizeChange"
          @current-change="handleCurrentChange"
          :current-page="currentPage"
          :page-sizes="[10, 20, 30]"
          :page-size="pagesize"
          layout="total, sizes, prev, pager, next, jumper"
          :total="totals">
      </el-pagination>
    </div>
  </div>
  <component-dialog :dialogVisible="dialogVisible" :dialogInfo="dialogInfo" @update:dialogVisible="dialogVisibles"></component-dialog>
</div>
</template>

<script>
import componentDialog from './DialogForShenpi'

export default {
  name: "Shenpi",

  components: {
    componentDialog
  },

  data() {
    return {
      tableData: [],
      // 控制弹窗 显示
      dialogVisible: false,
      // 点击查看按钮 这条数据详细信息
      dialogInfo: {},
      // 分页
      totals: 0, //总条数
      currentPage: 1, //当前页数
      pagesize: 10, //页大小
    }
  },
  created() {
    this.getdata(this.currentPage, this.pagesize)
  },
  methods: {
    Menu() {
      this.$router.push('/Menu');
    },
    reflush() {
      this.getdata(this.currentPage, this.pagesize)
      // this.$forceUpdate()
    },
    getdata(pagenum, pagesize) {
      this.axios.post('/daily/model_from_php/ShowApply.php',{
        headers:{'Content-Type':'application/x-www-form-urlencoded'}
      })
          .then(response=>{
            if (response.status >= 200 && response.status < 300) {
              // console.log(response.data)
              this.tableData = response.data
              this.totals = this.tableData.length
              this.tableData = this.tableData.slice((pagenum - 1) * pagesize, pagenum * pagesize)
              console.log(response.data)
            } else {
              console.log(response.message);
            }
          })
          .catch(function (error) {
            console.log(error);
          })
    },
    check(info) {
      this.dialogVisible = true
      this.dialogInfo = info
    },
    // 子组件传过来的数据
    dialogVisibles(v) {
      this.dialogVisible = v
      console.log(v)
    },
    // 分页数据绑定
    handleSizeChange(val) {
      this.pagesize = val
      this.getdata(this.currentPage, val)
    },
    handleCurrentChange(val) {
      this.currentPage4 = val
      this.getdata(val, this.pagesize)
    }
  }
}
</script>

<style scoped>
.title{
  padding-left: 43%;
  font-family: 幼圆;
  padding-top: 1.5%;
}
.info{
  padding-left:20%;
  background-color: transparent;
}
.shenpi{
  width: 100%;
  height: 100%;
  margin: 0;
  padding: 0;
  background:url("../assets/img/bg.png");
  background-size: 100%;
  background-attachment: fixed;
}
.el-table{
  padding-top: 5%;
  background-color: transparent;
}
.return{
  padding-left: 3%;
}
  .block{
    padding-top: 10%;
    padding-bottom: 20%;
    padding-left: 15%;
  }

</style>