<template>

    <div>
        <div>
            <a href="Menu.vue">返回</a>
        </div>

        <el-tabs v-model="activeName">
                <div class="1">

                    <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="demo-ruleForm" label-position ="top">
                        <el-form-item label="姓名" prop="name">
                            <el-input v-model="ruleForm.name"></el-input>
                        </el-form-item>

                        <el-form-item label="学号/工号" prop="id">
                            <el-input v-model="ruleForm.name"></el-input>
                        </el-form-item>

                        <el-form-item label="性别  ">
                            <el-radio-group v-model="ruleForm.resource">
                                <el-radio label="男"></el-radio>
                                <el-radio label="女"></el-radio>
                            </el-radio-group>
                        </el-form-item>

                        <el-form-item label="类别  ">
                            <el-radio-group v-model="ruleForm.resource">
                                <el-radio label="内地本科生"></el-radio>
                                <el-radio label="内地研究生"></el-radio>
                                <el-radio label="港澳台学生"></el-radio>
                                <el-radio label="留学生"></el-radio>
                                <el-radio label="内地成教育学生"></el-radio>
                                <el-radio label="教职工"></el-radio>
                                <el-radio label="其他"></el-radio>
                            </el-radio-group>
                        </el-form-item>

                        <el-form-item label="手机号码">
                            <el-input v-model="ruleForm.desc"></el-input>
                        </el-form-item>

                        <el-form-item label="通行开始时间">
                            <el-date-picker
                                    v-model="value3"
                                    type="datetime"
                                    placeholder="选择日期时间"
                                    default-time="12:00:00">
                            </el-date-picker>
                        </el-form-item>

                        <el-form-item label="通行结束时间">
                            <el-date-picker
                                    v-model="value3"
                                    type="datetime"
                                    placeholder="选择日期时间"
                                    default-time="12:00:00">
                            </el-date-picker>
                        </el-form-item>

                        <el-form-item label="是否离开杭州">
                            <el-radio-group v-model="ruleForm.resource">
                                <el-radio label="是"></el-radio>
                                <el-radio label="否"></el-radio>
                            </el-radio-group>
                        </el-form-item>

                        <el-form-item label="申请理由">
                            <el-input v-model="ruleForm.desc"></el-input>
                        </el-form-item>

                        <el-form-item label="是否在外留宿">
                            <el-radio-group v-model="ruleForm.resource">
                                <el-radio label="是"></el-radio>
                                <el-radio label="否"></el-radio>
                            </el-radio-group>
                        </el-form-item>

                        <el-form-item label="杭州健康码”状态">
                            <el-radio-group v-model="ruleForm.resource">
                                <el-radio label="红码"></el-radio>
                                <el-radio label="黄码"></el-radio>
                                <el-radio label="绿码"></el-radio>
                                <el-radio label="橙码"></el-radio>
                            </el-radio-group>
                        </el-form-item>

                        <el-form-item>
                            <el-button type="primary" @click="submitForm('ruleForm')">提交</el-button>
                            <el-button @click="resetForm('ruleForm')">重置</el-button>
                        </el-form-item>
                    </el-form>

                </div>
        </el-tabs>
    </div>
</template>

<script>
    export default {
        name: "Chuxiao",
        data() {
            return {
                value: '',
                value3: '',

                nowDateTime: '',
                activeName: 'second',
                ruleForm: {
                    name: '',
                    region: '',
                    date1: '',
                    date2: '',
                    delivery: false,
                    type: [],
                    resource: '',
                    desc: ''
                },
                rules: {
                    name: [
                        {required: true, message: '请输入姓名', trigger: 'blur'},
                        {min: 3, max: 5, message: '长度在 3 到 5 个字符', trigger: 'blur'}
                    ],
                    id: [
                        {required: true, message: '请输入学号/工号', trigger: 'blur'},
                        {min: 3, max: 5, message: '长度在 3 到 5 个字符', trigger: 'blur'}
                    ],
                }
            };
        },

        methods: {
            handleClick(tab, event) {
                console.log(tab, event);
            },
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        alert('submit!');
                    } else {
                        console.log('error submit!!');
                        return false;
                    }
                });
            },
            resetForm(formName) {
                this.$refs[formName].resetFields();
            },

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