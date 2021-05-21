<template>
    <el-tabs v-model="activeName" @tab-click="handleClick">
        <el-tab-pane label="签到情况表" name="first">
            <el-select v-model="value" placeholder="请选择">
                <el-option
                        v-for="item in options"
                        :key="item.value"
                        :label="item.label"
                        :value="item.value">
                </el-option>
            </el-select>
        </el-tab-pane>
        <el-tab-pane label="成员查询" name="second">

        </el-tab-pane>
    </el-tabs>
</template>

<script>
    export default {
        name: "Tongji",
        methods: {
            handleClick(tab, event) {
                console.log(tab, event);
            }
        },
        data() {
            return {
                activeName: 'second',
                options: [{
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
                value: ''
            }
        }
    }
</script>

<style scoped>

</style>