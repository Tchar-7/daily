<template>

    <div>
        <div>
            <p>{{nownowDateTime}}</p>
            <a href="Menu">返回</a>
        </div>

        <el-tabs v-model="activeName" @tab-click="handleClick">
            <el-tab-pane label="基础信息" name="first">
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

                        <el-form-item label="所属校区">
                            <el-radio-group v-model="ruleForm.resource">
                                <el-radio label="屏峰校区"></el-radio>
                                <el-radio label="朝晖校区"></el-radio>
                                <el-radio label="莫干山校区"></el-radio>
                                <el-radio label="其他"></el-radio>
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


                        <el-form-item label="单位/院系">
                            <el-select v-model="value" placeholder="请选择">
                                <el-option
                                        v-for="item in options"
                                        :key="item.value"
                                        :label="item.label"
                                        :value="item.value">
                                </el-option>
                            </el-select>
                        </el-form-item>

                        <el-form-item label="籍贯">
                            <el-input v-model="ruleForm.name"></el-input>
                        </el-form-item>

                        <el-form-item label="户籍所在地">
                            <el-input v-model="ruleForm.name"></el-input>
                        </el-form-item>

                        <el-form-item label="手机号码">
                            <el-input v-model="ruleForm.name"></el-input>
                        </el-form-item>

                        <el-form-item>
                            <el-button type="primary" @click="submitForm('ruleForm')">提交</el-button>
                            <el-button @click="resetForm('ruleForm')">重置</el-button>
                        </el-form-item>
                    </el-form>

                </div>
            </el-tab-pane>

            <el-tab-pane label="每日信息" name="second">
                <div class="2">

                    <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="demo-ruleForm" label-position ="top">

                        <el-form-item label="今天是否在校园内" prop="resource">
                            <el-radio-group v-model="ruleForm.resource">
                                <el-radio label="今天在校园内"></el-radio><br>
                                <el-radio label="已离校，在杭州租房"></el-radio><br>
                                <el-radio label="已返乡"></el-radio>
                            </el-radio-group>
                        </el-form-item>

                        <el-form-item label="身体和心理状况" prop="resource">
                            <el-radio-group v-model="ruleForm.resource">
                                <el-radio label="正常"></el-radio><br>
                                <el-radio label="不适"></el-radio>
                                <el-input></el-input>
                            </el-radio-group>
                        </el-form-item>


                        <el-form-item label="今日体温">
                            <el-input></el-input>
                        </el-form-item>

                        <el-form-item label="杭州健康码”状态">
                            <el-radio-group v-model="ruleForm.resource">
                                <el-radio label="红码"></el-radio>
                                <el-radio label="黄码"></el-radio>
                                <el-radio label="绿码"></el-radio>
                                <el-radio label="橙码"></el-radio>
                            </el-radio-group>
                        </el-form-item>

                        <el-form-item label="返乡时间">
                            <el-date-picker
                                    v-model="value3"
                                    type="datetime"
                                    placeholder="选择日期时间"
                                    default-time="12:00:00">
                            </el-date-picker>
                        </el-form-item>

                        <el-form-item label="乘坐何种交通工具（请填写相应的班号、车牌号）">
                            <el-checkbox v-model="checked">飞机</el-checkbox>
                            <el-input></el-input><br>
                            <el-checkbox v-model="checked">火车</el-checkbox>
                            <el-input></el-input><br>
                            <el-checkbox v-model="checked">客车</el-checkbox>
                            <el-input></el-input><br>
                            <el-checkbox v-model="checked">轮船</el-checkbox>
                            <el-input></el-input><br>
                            <el-checkbox v-model="checked">自驾车</el-checkbox>
                            <el-input></el-input><br>
                            <el-checkbox v-model="checked">其他</el-checkbox>
                            <el-input></el-input>
                        </el-form-item>

                        <el-form-item>
                            <el-button type="primary" @click="submitForm('ruleForm')">提交</el-button>
                            <el-button @click="resetForm('ruleForm')">重置</el-button>
                        </el-form-item>
                    </el-form>

                </div>
            </el-tab-pane>

            <el-tab-pane label="额外信息" name="third">
                <div class="3">

                    <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="demo-ruleForm" label-position ="top">
                        <el-form-item label="紧急联系人姓名" prop="name">
                            <el-input v-model="ruleForm.name"></el-input>
                        </el-form-item>

                        <el-form-item label="紧急联系人手机号码">
                            <el-input v-model="ruleForm.name"></el-input>
                        </el-form-item>

                        <el-form-item label="当前居住地点">
                            <el-input v-model="ruleForm.name"></el-input>
                        </el-form-item>

                        <el-form-item label="当前居住地点是否属于中高风险区">
                            <el-radio-group v-model="ruleForm.resource">
                                <el-radio label="是"></el-radio>
                                <el-radio label="否"></el-radio>
                            </el-radio-group>
                        </el-form-item>

                        <el-form-item label="是否隔离（是则补充隔离方式与地点）" prop="resource">
                            <el-radio-group v-model="ruleForm.resource">
                                <el-radio label="否"></el-radio>
                                <el-radio label="是"></el-radio>
                                <el-input v-model="ruleForm.name"></el-input>><br>
                            </el-radio-group>
                        </el-form-item>

                        <el-form-item label="是否确诊" prop="resource">
                            <el-radio-group v-model="ruleForm.resource">
                                <el-radio label="正常"></el-radio><br>
                                <el-radio label="已确诊"></el-radio><br>
                                <el-radio label="确诊已治愈"></el-radio><br>
                                <el-input></el-input>
                            </el-radio-group>
                        </el-form-item>

                        <el-form-item label="是否疑似（是则补充医院与接触人员信息）" prop="resource">
                            <el-radio-group v-model="ruleForm.resource">
                                <el-radio label="否"></el-radio>
                                <el-radio label="是"></el-radio>
                                <el-input></el-input>
                            </el-radio-group>
                        </el-form-item>

                        <el-form-item label="核酸检测结果为">
                            <el-radio-group v-model="ruleForm.resource">
                                <el-radio label="阴性"></el-radio>
                                <el-radio label="阳性"></el-radio>
                                <el-radio label="未检测"></el-radio>
                            </el-radio-group>
                        </el-form-item>

                        <el-form-item label="家人是否隔离或疑似（是则补充）" prop="resource">
                            <el-radio-group v-model="ruleForm.resource">
                                <el-radio label="否"></el-radio>
                                <el-radio label="是"></el-radio>
                                <el-input></el-input>
                            </el-radio-group>
                        </el-form-item>

                        <el-form-item label="是否14内与确诊人员接触（是则补充时间地点人员信息）" prop="resource">
                            <el-radio-group v-model="ruleForm.resource">
                                <el-radio label="否"></el-radio>
                                <el-radio label="是"></el-radio>
                                <el-input></el-input>
                            </el-radio-group>
                        </el-form-item>

                        <el-form-item label="是否14内去过中高风险地区（是则补充时间地点信息）" prop="resource">
                            <el-radio-group v-model="ruleForm.resource">
                                <el-radio label="否"></el-radio>
                                <el-radio label="是"></el-radio>
                                <el-input></el-input>
                            </el-radio-group>
                        </el-form-item>

                        <el-form-item>
                            <el-button type="primary" @click="submitForm('ruleForm')">提交</el-button>
                            <el-button @click="resetForm('ruleForm')">重置</el-button>
                        </el-form-item>
                    </el-form>

                </div>
            </el-tab-pane>

            <el-tab-pane label="回国信息" name="fourth">
                <div class="3">

                    <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="demo-ruleForm" label-position ="top">


                        <el-form-item label="是否14天内从境外回国">
                            <el-radio-group v-model="ruleForm.resource">
                                <el-radio label="是"></el-radio>
                                <el-radio label="否"></el-radio>
                            </el-radio-group>
                        </el-form-item>

                        <el-form-item label="境外回国时间">
                            <el-date-picker
                                    v-model="value3"
                                    type="datetime"
                                    placeholder="选择日期时间"
                                    default-time="12:00:00">
                            </el-date-picker>
                        </el-form-item>

                        <el-form-item label="从哪个国家返回">
                            <el-input v-model="ruleForm.desc"></el-input>
                        </el-form-item>

                        <el-form-item label="乘坐何种交通工具（请填写相应的班号、车牌号）">
                            <el-checkbox v-model="checked">飞机</el-checkbox>
                            <el-input></el-input><br>
                            <el-checkbox v-model="checked">火车</el-checkbox>
                            <el-input></el-input><br>
                            <el-checkbox v-model="checked">客车</el-checkbox>
                            <el-input></el-input><br>
                            <el-checkbox v-model="checked">轮船</el-checkbox>
                            <el-input></el-input><br>
                            <el-checkbox v-model="checked">自驾车</el-checkbox>
                            <el-input></el-input><br>
                            <el-checkbox v-model="checked">其他</el-checkbox>
                            <el-input></el-input><br>
                        </el-form-item>

                        <el-form-item>
                            <el-button type="primary" @click="submitForm('ruleForm')">提交</el-button>
                            <el-button @click="resetForm('ruleForm')">重置</el-button>
                        </el-form-item>
                    </el-form>

                </div>
            </el-tab-pane>

            <el-tab-pane label="承诺书" name="fifth">
                <div class = "4">
                    <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="demo-ruleForm" label-position ="top">
                        <h1>承诺书</h1>
                        <p>我承诺：严格遵照学校在防疫期间的规定和要求，认真填写每日一报，数据真实可信</p>

                        <el-checkbox v-model="checked">同意签订承诺书</el-checkbox>

                        <el-form-item>
                            <el-button type="primary" @click="submitForm('ruleForm')">提交</el-button>
                            <el-button @click="resetForm('ruleForm')">重置</el-button>
                        </el-form-item>
                    </el-form>
                </div>
            </el-tab-pane>
        </el-tabs>

    </div>

</template>

<script>
    export default {
        name: "Tianbao",
        data() {
            return {
                options: [{
                    value: '选项1',
                    label: '计算机学院'
                }, {
                    value: '选项2',
                    label: '机械学院'
                }, {
                    value: '选项3',
                    label: '化工学院'
                }, {
                    value: '选项4',
                    label: '经济学院'
                }, {
                    value: '选项5',
                    label: '理学院'
                }],
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

            getTime(){
                var _this = this;
                let yy = new Date().getFullYear();
                let mm = new Date().getMonth()+1;
                let dd = new Date().getDate();
                let hh = new Date().getHours();
                let mf = new Date().getMinutes()<10 ? '0'+new Date().getMinutes() : new Date().getMinutes();
                let ss = new Date().getSeconds()<10 ? '0'+new Date().getSeconds() : new Date().getSeconds();
                _this.data.nowDateTime = yy+'年 '+mm+'月'+dd+'日 '+hh+':'+mf+':'+ss;
            },
            currentTime(){
                setInterval(this.getTime,500)
            },
            created() {
                this.currentTime();
            },

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