<template>
    <div class="table">
        <el-tabs v-model="activeName" @tab-click="handleClick">
            <el-tab-pane label="签到情况表" name="first">
                <div class="table1">
                    <div class="title1">
                        <h1>请选择班级和学院</h1>
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
                                placeholder="请选择班级">
                            <el-option
                                    v-for="item in options2"
                                    :key="item.value"
                                    :label="item.label"
                                    :value="item.value">
                            </el-option>
                        </el-select>
                    </div>
                </div>
            </el-tab-pane>
            <el-tab-pane label="成员查询" name="second">
                <div class="table2">
                    <div class="title2">
                        <h1>请选择学院和学号</h1>
                    </div>
                    <div class="input2">
<!--                        <el-select v-model="value1" multiple placeholder="请选择学院">-->
<!--                            <el-option-->
<!--                                    v-for="item in options1"-->
<!--                                    :key="item.value"-->
<!--                                    :label="item.label"-->
<!--                                    :value="item.value">-->
<!--                            </el-option>-->
<!--                        </el-select>-->
                        <el-input v-model="idInput" placeholder="请输入学号"></el-input>
                    </div>
                </div>
            </el-tab-pane>
        </el-tabs>
        <div class="button">
            <router-link :to=chaxun2url><el-button type="primary" v-on:click="changeURL">查询</el-button></router-link>
        </div>
      <router-view  :key="$route.fullPath"></router-view>
    </div>
</template>
<script>

    export default {
        name: "Tongji",
      created() {
      },
      methods: {
            handleClick(tab, event) {
              console.log(tab, event);
            },
        changeURL:function (){
          if(this.idInput!=''){
          this.chaxun2url = "/Qiandao1/"+this.idInput}
          console.log(this.chaxun2url)
        }
        },
        data() {
            return {
                activeName: 'second',
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
                },{
                    value: '选项6',
                    label: '信息工程学院 '
                }
                ],
                options2: [{
                    value: '选项1',
                    label: '1901'
                }, {
                    value: '选项2',
                    label: '1902'
                }, {
                    value: '选项3',
                    label: '1903'
                }, {
                    value: '选项4',
                    label: '1903'
                }, {
                    value: '选项5',
                    label: '1904 '
                },{
                    value: '选项6',
                    label: '1905 '
                }
                ],
                value1: [],
                value2: [],
                idInput: '',
                chaxun2url:'/Tongji'
            }
        }
    }
</script>

<style scoped>
    .table{
        padding-top: 10%;
        padding-left: 15%;
    }
    .el-button{
        margin-left: 35%;
        margin-top: 1%;
    }
    .table1{
        padding-top: 5%;
        padding-left: 20%;
        float:left;
    }
    .table2{
        padding-top: 5%;
        padding-left: 20%;
    }
    .el-input{
        width:30%;
        padding-left: 2%;
    }
    .title1{
        padding-left: 10%;
    }
    .title2{
        padding-left: 8%;
    }

</style>