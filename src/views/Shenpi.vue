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
                        label="申请理由">
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

</style>