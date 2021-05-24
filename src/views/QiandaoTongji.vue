<template>
<div>
    <div class="table1">
      <div class="title1">
        <h1>请选择学院和年级</h1>
      </div>
      <div class="input1">
        <el-select v-model="value1" multiple placeholder="请选择学院">
          <el-option
              v-for="item in options1"
              :key="item.value"
              :label="item.label"
              :value="item.value">
          </el-option>
        </el-select>

        <el-select
            v-model="value2"
            multiple
            collapse-tags
            style="margin-left: 20px;"
            placeholder="请选择年级">
          <el-option
              v-for="item in options2"
              :key="item.value"
              :label="item.label"
              :value="item.value">
          </el-option>
        </el-select>
      </div>
      <div class="button">
        <router-link :to=chaxun1url><el-button type="primary" v-on:click="changeURL">查询</el-button></router-link>
      </div>
      <router-view></router-view>
    </div>

    <div class="show">
      <el-tabs v-model="activeName1" @tab-click="handleClick">
        <el-tab-pane label="已签到" name="1">
          <el-table
              :data="tableData"
              style="width: 100%">
            <el-table-column
                prop="Sno"
                label="学号"
                width="180">
            </el-table-column>
            <el-table-column
                prop="name"
                label="姓名"
                width="180">
            </el-table-column>
          </el-table>
          <div class="block">
            <span class="demonstration"></span>
            <el-pagination
                layout="prev, pager, next"
                :total="50">
            </el-pagination>
          </div>
        </el-tab-pane>
        <el-tab-pane label="未签到" name="2">
          <el-table
              :data="tableData"
              style="width: 100%">
            <el-table-column
                prop="Sno"
                label="学号"
                width="180">
            </el-table-column>
            <el-table-column
                prop="name"
                label="姓名"
                width="180">
            </el-table-column>
          </el-table>
          <div class="block">
            <span class="demonstration"></span>
            <el-pagination
                layout="prev, pager, next"
                :total="50">
            </el-pagination>
          </div>
        </el-tab-pane>
        <el-tab-pane label="签到有误" name="3">
          <el-table
              :data="tableData"
              style="width: 100%">
            <el-table-column
                prop="Sno"
                label="学号"
                width="180">
            </el-table-column>
            <el-table-column
                prop="name"
                label="姓名"
                width="180">
            </el-table-column>
          </el-table>
          <div class="block">
            <span class="demonstration"></span>
            <el-pagination
                layout="prev, pager, next"
                :total="50">
            </el-pagination>
          </div>
        </el-tab-pane>
      </el-tabs>
    </div>
</div>
</template>

<script>
export default {
  name: "QiandaoTongji",
  data() {
    return {
      options1: [{
        value: '选项1',
        label: '计算机学院'
      }, {
        value: '选项2',
        label: '人文学院'
      }, {
        value: '选项3',
        label: '材料科学与工程学院'
      }, {
        value: '选项4',
        label: '药学院'
      }, {
        value: '选项5',
        label: '机械工程学院 '
      }, {
        value: '选项6',
        label: '信息工程学院 '
      }
      ],
      options2: [{
        value: '选项1',
        label: '20级'
      }, {
        value: '选项2',
        label: '19级'
      }, {
        value: '选项3',
        label: '18级'
      }, {
        value: '选项4',
        label: '17级'
      }
      ],
      value1: [],
      value2: [],
      activeName1:'2',
      chaxun1url:'QiandaoTongji'
    }
  },
  method:{
    handleClick(tab, event) {
      console.log(tab, event);
    },
    changeurl:function (){

    }
  }
}
</script>

<style scoped>

</style>