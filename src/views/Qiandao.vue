<template>
    <div class="whole">
        <div align="center">
            <h2>本月签到统计</h2>
        </div>
        <div class="message">
            <el-row>
                <el-col><div class="text">姓名</div></el-col>
            </el-row>
            <el-row>
                <el-col><div class="text">签到天数</div></el-col>
            </el-row>
            <el-row>
                <el-col><div class="text">缺勤天数</div></el-col>
            </el-row>
        </div>
        <br>
        <div class="cal">
            <el-calendar v-model="value">
            </el-calendar>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Qiandao",
        data() {
            return {
                value: new Date()
            }
        }
    }
</script>

<style scoped>
    .text{
        padding-left: 35%;
        padding-top: 3%;
    }
    .message{
        margin: 0 auto;
    }
    .cal{
        padding-top: 5%;
        padding-left: 20%;
        padding-right: 20%;
    }
</style>