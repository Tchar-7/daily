<template>
    <div class="shenpi">
        <div class="title">
            <h1>申请审批</h1>
        </div>
        <div class="info">
            <el-table
                    :data="tableData"
                    style="width: 100%">
                <el-table-column
                        prop="name"
                        label="姓名"
                        width="180">
                </el-table-column>
                <el-table-column
                        prop="sno"
                        label="学号"
                        width="180">
                </el-table-column>
                <el-table-column
                        prop="reason"
                        label="申请理由"
                        width="400%">
                </el-table-column>
            </el-table>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Shenpi",
        data() {
            return {
                tableData: [{

                }]
            }
        }
    }
</script>

<style scoped>
.title{
    padding-left: 43%;
}
    .info{
        padding-left:20%;
        background-color: transparent;
    }
    .shenpi{
        width: 100%;
        height: 100%;
        background:url("../assets/img/bg.png");
        background-size: 100%;
    }
.el-table{
    background-color: transparent;
}

</style>