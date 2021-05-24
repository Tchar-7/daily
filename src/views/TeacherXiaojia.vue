<template>

    <div>
        <div>
            <a href="templates/Menu.vue">返回</a>
        </div>

        <el-tabs v-model="activeName">
                <div class="1">
                    <div class="title">
                        <h1>出差申请</h1>
                    </div>
                    <div class="history">
                        <el-table
                                :data="tableData"
                                style="width: 100%"
                                max-height="250">
                            <el-table-column
                                    prop="jilu"
                                    label="请假记录"
                                    width="120">
                            </el-table-column>
                            <el-table-column
                                    label="操作"
                                    width="120">
                                <template slot-scope="scope">
                                    <el-button
                                            @click.native.prevent="deleteRow(scope.$index, tableData)"
                                            type="text"
                                            size="small">
                                        销假
                                    </el-button>
                                </template>
                            </el-table-column>
                        </el-table>
                    </div>

                </div>
        </el-tabs>
    </div>
</template>

<script>
// import axios from 'axios';
// eslint-disable-next-line no-unused-vars
import Qs from 'qs'
    export default{
        name: "TeacherXiaojia",
        data() {
            return{
                tableData: [{
                    jilu:'1233'
                }, {
                    jilu: '111'
                }]
            }

        },
      created() {
        localStorage.setItem('page','/TeacherXiaojia')
      },
      methods: {
          delect()
          {

          }
      }
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