<template>
    <div class="menu">
        <el-menu
                :default-active="activeIndex2"
                class="el-menu-demo"
                mode="horizontal"
                @select="handleSelect"
                background-color="#545c64"
                text-color="#fff"
                active-text-color="#ffd04b">

            <el-menu-item index="1">个人中心</el-menu-item>
            <el-submenu index="2">
                <template slot="title">每日一报</template>
                <el-menu-item index="2-1" @click="Tianbao()">信息填报</el-menu-item>
                <el-menu-item index="2-2" @click="Qiandao()">签到信息</el-menu-item>
            </el-submenu>
            <el-submenu index="3">
                <template slot="title">其他</template>
                <el-menu-item index="2-1">销假</el-menu-item>
                <el-menu-item index="2-2" @click="Chuxiao()">出校申请</el-menu-item>
            </el-submenu>

        </el-menu>
        <div class="info">
            <el-tabs v-model="activeName" @tab-click="handleClick">
                <el-tab-pane label="个人信息" name="first">
                    <div class="show-info"
                    >
                        <div class="pic"> <!--头像-->
                            <img src="../assets/img/img.jpg"/>
                        </div>
                        <div class="detail"><!--个人信息-->
                            <el-row>
                                <el-col :span="4"><div class="grid-content bg-purple-light">姓名</div></el-col>
                                <el-col :span="10"><div class="grid-content bg-purple">xx</div></el-col>
                            </el-row>
                            <el-row>
                                <el-col :span="4"><div class="grid-content bg-purple-light">所在部门</div></el-col>
                                <el-col :span="10"><div class="grid-content bg-purple">xx</div></el-col>
                            </el-row>
                            <el-row>
                                <el-col :span="4"><div class="grid-content bg-purple-light">学号/工号</div></el-col>
                                <el-col :span="10"><div class="grid-content bg-purple">xx</div></el-col>
                            </el-row>
                            <el-row>
                                <el-col :span="4"><div class="grid-content bg-purple-light">邮箱</div></el-col>
                                <el-col :span="10"><div class="grid-content bg-purple">xx</div></el-col>
                            </el-row>
                            <el-row>
                                <el-col :span="4"><div class="grid-content bg-purple-light">手机</div></el-col>
                                <el-col :span="10"><div class="grid-content bg-purple">xx</div></el-col>
                            </el-row>

                        </div>
                    </div>
                </el-tab-pane>
                <el-tab-pane label="个人申请" name="second">

                    <div class="search1">
                        <div class="search">
                            <el-input v-model="input" placeholder="请输人办理事项" id="search"></el-input>
                        </div>
                        <div class="button">
                            <el-button type="info" id="button">搜索</el-button>
                        </div>
                    </div>

                    <div class="apply">
                        <div class="applying">
                            <h4 align="center">办理中</h4>
                            <el-table
                                    :data="tableData"
                                    style="width: 100%">
                                <el-table-column
                                        prop="date"
                                        label="申请时间"
                                        width="180">
                                </el-table-column>
                                <el-table-column
                                        prop="name"
                                        label="办理事项"
                                        width="180">
                                </el-table-column>
                            </el-table>
                        </div>
                        <div class="failed">
                            <h4 align="center">办理失败</h4>
                            <el-table
                                    :data="tableData"
                                    style="width: 100%">
                                <el-table-column
                                        prop="date"
                                        label="申请时间"
                                        width="180">
                                </el-table-column>
                                <el-table-column
                                        prop="name"
                                        label="办理事项"
                                        width="180">
                                </el-table-column>
                            </el-table>
                        </div>
                        <div class="history">
                            <h4 align="center">历史办理</h4>
                            <el-table
                                    :data="tableData"
                                    style="width: 100%">
                                <el-table-column
                                        prop="date"
                                        label="申请时间"
                                        width="180">
                                </el-table-column>
                                <el-table-column
                                        prop="name"
                                        label="办理事项"
                                        width="180">
                                </el-table-column>
                            </el-table>
                        </div>
                    </div>
                </el-tab-pane>
            </el-tabs>
        </div>
        <div class="block">
            <span class="demonstration"></span>
            <el-pagination
                    layout="prev, pager, next"
                    :total="1000">
            </el-pagination>
        </div>
    </div>
</template>

<script>
    export default {
        name:"Menu",
        data() {
            return {
                activeIndex2: '1',
                activeName: 'second'
            };

        },
        methods: {
            handleSelect(key, keyPath) {
                console.log(key, keyPath);
            },
            handleClick(tab, event) {
                console.log(tab, event);
            },

            Tianbao() {
                this.$router.push('/Tianbao');
            },

            Chuxiao() {
                this.$router.push('/Chuxiao');
            },
            Qiandao() {
                this.$router.push('/Qiandao');
            }
        }
    }
</script>

<style scoped>
    .info{
        padding-left: 200px;
        padding-top: 100px;
    }
    .show-info{

    }
    .pic{
        height:100%;
        width:30%;
        float:left;
    }
    .detail{
        height:100%;
        width:70%;
        float:left;
    }
    .el-row {
        margin-bottom: 20px;
    &:last-child {
         margin-bottom: 0;
     }
    }
    .el-col {
        border-radius: 4px;
    }

    .bg-purple {
        background: #d3dce6;
    }
    .bg-purple-light {
        background: #e5e9f2;
    }
    .grid-content {
        border-radius: 4px;
        min-height: 36px;
    }
    .applying{
        float:left;
    }
    .failed{
        float:left;
    }
    .history{
        float:left;
    }
    .block{
        padding-left: 40%;
        padding-bottom: 10%;
    }
    .search{
        width: 20%;
        padding-left: 60%;
    }
    .button{
        padding-left: 1%;
    }
    .search1{
        display: flex;
        flex-direction: row;
        justify-content: flex-start;
    }
</style>