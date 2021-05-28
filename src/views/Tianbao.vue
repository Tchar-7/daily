<template>

    <div class="table">
      <div class="title">
          <h1>每日信息填报</h1>

          <dic class = "return">
              <el-button type="text" @click="Menu()">返回个人界面</el-button>
          </dic>

      </div>


        <el-tabs v-model="activeName" @tab-click="handleClick">
            <el-tab-pane label="基础信息" name="first">
                <div class="1">

                    <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="demo-ruleForm" label-position ="top">
                        <el-form-item label="姓名" prop="name">
                            <el-input v-model="ruleForm.name"></el-input>
                        </el-form-item>

                        <el-form-item label="学号/工号" prop="userID">
                            <el-input v-model="ruleForm.userID"></el-input>
                        </el-form-item>

                        <el-form-item label="性别">
                            <el-radio-group v-model="ruleForm.sex" prop="sex">
                                <el-radio label="男"></el-radio>
                                <el-radio label="女"></el-radio>
                            </el-radio-group>
                        </el-form-item>

                        <el-form-item label="所属校区">
                            <el-radio-group v-model="ruleForm.campus">
                                <el-radio label="屏峰校区"></el-radio>
                                <el-radio label="朝晖校区"></el-radio>
                                <el-radio label="莫干山校区"></el-radio>
                                <el-radio label="其他"></el-radio>
                            </el-radio-group>
                        </el-form-item>

                        <el-form-item label="类别  ">
                            <el-radio-group v-model="ruleForm.category">
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
                            <el-select v-model="ruleForm.departments" placeholder="请选择">
                                <el-option
                                        v-for="item in options"
                                        :key="item.value"
                                        :label="item.label"
                                        :value="item.value">
                                </el-option>
                            </el-select>
                        </el-form-item>

                        <el-form-item label="籍贯">
                            <el-input v-model="ruleForm.location1"></el-input>
                        </el-form-item>

                        <el-form-item label="户籍所在地">
                            <el-input v-model="ruleForm.location2"></el-input>
                        </el-form-item>

                        <el-form-item label="手机号码">
                            <el-input v-model="ruleForm.phone"></el-input>
                        </el-form-item>

                    </el-form>

                </div>
            </el-tab-pane>

            <el-tab-pane label="每日信息" name="second">
                <div class="2">

                    <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="demo-ruleForm" label-position ="top">

                        <el-form-item label="今天是否在校园内" prop="resource">
                            <el-radio-group v-model="ruleForm.inside">
                                <el-radio label="今天在校园内"></el-radio><br>
                                <el-radio label="已离校，在杭州租房"></el-radio><br>
                                <el-radio label="已返乡"></el-radio>
                            </el-radio-group>
                        </el-form-item>

                        <el-form-item label="身体和心理状况" prop="resource">
                            <el-radio-group v-model="ruleForm.health">
                                <el-radio label="正常"></el-radio><br>
                                <el-radio label="不适"></el-radio>
                                <el-input v-if="ruleForm.health=='不适'" v-model="ruleForm.healthinf"></el-input>
                            </el-radio-group>
                        </el-form-item>


                        <el-form-item label="今日体温">
                            <el-input v-model="ruleForm.temperature"></el-input>
                        </el-form-item>

                        <el-form-item label="杭州健康码”状态">
                            <el-radio-group v-model="ruleForm.color">
                                <el-radio label="红码"></el-radio>
                                <el-radio label="黄码"></el-radio>
                                <el-radio label="绿码"></el-radio>
                                <el-radio label="橙码"></el-radio>
                            </el-radio-group>
                        </el-form-item>

                      <el-form-item v-if="ruleForm.inside=='已返乡'">

                        <p>若未返乡请勿填写</p>

                        <el-form-item label="返乡时间">
                          <el-date-picker
                              v-model="ruleForm.back"
                              type="datetime"
                              placeholder="选择日期时间"
                              default-time="12:00:00">
                          </el-date-picker>
                        </el-form-item>

                        <el-form-item label="乘坐何种交通工具（请填写相应的班号、车牌号）">
                          <el-checkbox-group v-model="ruleForm.traffic">
                            <el-checkbox label="飞机" ></el-checkbox>
                            <el-input v-model="ruleForm.plane" v-if="isInArray(ruleForm.traffic,'飞机')"></el-input><br>
                            <el-checkbox label="火车" ></el-checkbox>
                            <el-input v-model="ruleForm.train" v-if="isInArray(ruleForm.traffic,'火车')"></el-input><br>
                            <el-checkbox label="客车" ></el-checkbox>
                            <el-input v-model="ruleForm.bus" v-if="isInArray(ruleForm.traffic,'客车')"></el-input><br>
                            <el-checkbox label="轮船" ></el-checkbox>
                            <el-input v-model="ruleForm.ship" v-if="isInArray(ruleForm.traffic,'轮船')"></el-input><br>
                            <el-checkbox label="自驾车" ></el-checkbox>
                            <el-input v-model="ruleForm.car" v-if="isInArray(ruleForm.traffic,'自驾车')"></el-input><br>
                            <el-checkbox label="其他" ></el-checkbox>
                            <el-input v-model="ruleForm.other" v-if="isInArray(ruleForm.traffic,'其他')"></el-input>
                          </el-checkbox-group>
                        </el-form-item>

                      </el-form-item>



                    </el-form>

                </div>
            </el-tab-pane>

            <el-tab-pane label="额外信息" name="third">
                <div class="3">

                    <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="demo-ruleForm" label-position ="top">
                        <el-form-item label="紧急联系人姓名" prop="name">
                            <el-input v-model="ruleForm.name2"></el-input>
                        </el-form-item>

                        <el-form-item label="紧急联系人手机号码">
                            <el-input v-model="ruleForm.phone2"></el-input>
                        </el-form-item>

                        <el-form-item label="当前居住地点">
                            <el-input v-model="ruleForm.address"></el-input>
                        </el-form-item>

                        <el-form-item label="当前居住地点是否属于中高风险区">
                            <el-radio-group v-model="ruleForm.risk">
                                <el-radio label="是"></el-radio>
                                <el-radio label="否"></el-radio>
                            </el-radio-group>
                        </el-form-item>

                        <el-form-item label="是否隔离（是则补充隔离方式与地点）" prop="resource">
                            <el-radio-group v-model="ruleForm.isolation">
                                <el-radio label="否"></el-radio>
                                <el-radio label="是"></el-radio>
                                <el-input v-if="ruleForm.isolation=='是'" v-model="ruleForm.isolationplace"></el-input>><br>
                            </el-radio-group>
                        </el-form-item>

                        <el-form-item label="是否确诊" prop="resource">
                            <el-radio-group v-model="ruleForm.confirm">
                                <el-radio label="正常"></el-radio><br>
                                <el-radio label="已确诊"></el-radio><br>
                                <el-radio label="确诊已治愈"></el-radio><br>
                            </el-radio-group>
                        </el-form-item>

                        <el-form-item label="是否疑似（是则补充医院与接触人员信息）" prop="resource">
                            <el-radio-group v-model="ruleForm.like">
                                <el-radio label="否"></el-radio>
                                <el-radio label="是"></el-radio>
                                <el-input v-if="ruleForm.like=='是'" v-model="ruleForm.likeinf"></el-input>
                            </el-radio-group>
                        </el-form-item>

                        <el-form-item label="核酸检测结果为">
                            <el-radio-group v-model="ruleForm.test">
                                <el-radio label="阴性"></el-radio>
                                <el-radio label="阳性"></el-radio>
                                <el-radio label="未检测"></el-radio>
                            </el-radio-group>
                        </el-form-item>

                        <el-form-item label="家人是否隔离或疑似（是则补充）" prop="resource">
                            <el-radio-group v-model="ruleForm.like2">
                                <el-radio label="否"></el-radio>
                                <el-radio label="是"></el-radio>
                                <el-input v-if="ruleForm.like2=='是'" v-model="ruleForm.like2inf"></el-input>
                            </el-radio-group>
                        </el-form-item>

                        <el-form-item label="是否14内与确诊人员接触（是则补充时间地点人员信息）" prop="resource">
                            <el-radio-group v-model="ruleForm.touch">
                                <el-radio label="否"></el-radio>
                                <el-radio label="是"></el-radio>
                                <el-input v-if="ruleForm.touch=='是'" v-model="ruleForm.touchinf"></el-input>
                            </el-radio-group>
                        </el-form-item>

                        <el-form-item label="是否14内去过中高风险地区（是则补充时间地点信息）" prop="resource">
                            <el-radio-group v-model="ruleForm.gotorisk">
                                <el-radio label="否"></el-radio>
                                <el-radio label="是"></el-radio>
                                <el-input v-if="ruleForm.gotorisk=='是'" v-model="ruleForm.gotoriskinf"></el-input>
                            </el-radio-group>
                        </el-form-item>

                    </el-form>

                </div>
            </el-tab-pane>

            <el-tab-pane label="回国信息" name="fourth">
                <div class="3">

                    <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="demo-ruleForm" label-position ="top">


                        <div class="huiguo1">

                        <el-form-item label="是否14天内从境外回国">
                            <el-radio-group v-model="ruleForm.backfrom">
                                <el-radio label="是"></el-radio>
                                <el-radio label="否"></el-radio>
                            </el-radio-group>
                        </el-form-item>

                        </div>

                        <div class = "huiguo2" v-if="ruleForm.backfrom=='是'">

                      <el-form-item v-if="ruleForm.backfrom=='是'">

                        <el-form-item label="境外回国时间">
                          <el-date-picker
                              v-model="ruleForm.backfromtime"
                              type="datetime"
                              placeholder="选择日期时间"
                              default-time="12:00:00">
                          </el-date-picker>
                        </el-form-item>

                        <el-form-item label="从哪个国家返回">
                          <el-input v-model="ruleForm.country"></el-input>
                        </el-form-item>

                        <el-form-item label="乘坐何种交通工具（请填写相应的班号、车牌号）">
                          <el-checkbox-group v-model="ruleForm.traffic2">
                            <el-checkbox label="飞机" ></el-checkbox>
                            <el-input v-model="ruleForm.plane2" v-if="isInArray(ruleForm.traffic2,'飞机')"></el-input><br>
                            <el-checkbox label="火车" ></el-checkbox>
                            <el-input v-model="ruleForm.train2" v-if="isInArray(ruleForm.traffic2,'火车')"></el-input><br>
                            <el-checkbox label="客车" ></el-checkbox>
                            <el-input v-model="ruleForm.bus2" v-if="isInArray(ruleForm.traffic2,'客车')"></el-input><br>
                            <el-checkbox label="轮船" ></el-checkbox>
                            <el-input v-model="ruleForm.ship2" v-if="isInArray(ruleForm.traffic2,'轮船')"></el-input><br>
                            <el-checkbox label="自驾车" ></el-checkbox>
                            <el-input v-model="ruleForm.car2" v-if="isInArray(ruleForm.traffic2,'自驾车')"></el-input><br>
                            <el-checkbox label="其他" ></el-checkbox>
                            <el-input v-model="ruleForm.other2" v-if="isInArray(ruleForm.traffic2,'其他')"></el-input>
                          </el-checkbox-group>
                        </el-form-item>

                      </el-form-item>

                        </div>

                    </el-form>

                </div>
            </el-tab-pane>

            <el-tab-pane label="承诺书" name="fifth">
                <div class = "4">
                    <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="demo-ruleForm" label-position ="top">
                        <div class="chengnuo">
                            <h1>承诺书</h1>
                        </div>
                        <div class="neirong">
                            <p>我承诺：严格遵照学校在防疫期间的规定和要求，认真填写每日一报，数据真实可信.</p>
                            <p>I promise strictly abide by the school's regulations and requirements during the epidemic prevention period,and submin my health daily report seriously and truthfully.</p>
                        </div>
                        <div class="check">
                            <el-checkbox v-model="ruleForm.agree" label="同意签订承诺书"></el-checkbox>
                        </div>

                        <div class="buttongr">
                            <el-form-item>
                                <el-button type="primary" @click="check">提交</el-button>
                                <el-button @click="resetForm()">重置</el-button>
                            </el-form-item>
                        </div>

                    </el-form>
                </div>
            </el-tab-pane>
        </el-tabs>

    </div>

</template>

<script>
import router from "@/router";
import Qs from "qs";
    export default {
        name: "ruleForm",
        data() {
            return {
                options: [{
                    value: '计算机科学与技术学院、软件学院',
                    label: '计算机科学与技术学院、软件学院'
                }, {
                  value: '人文学院',
                  label: '人文学院'
                }, {
                    value: '机械学院',
                    label: '机械学院'
                },
                  {value: '材料科学与工程学院',
                    label: '材料科学与工程学院'
                },{
                    value: '药学院',
                    label: '药学院'
                  },{
                    value: '机械工程学院',
                    label: '机械工程学院 '
                  }, {
                    value: '信息工程学院',
                    label: '信息工程学院 '
                  },{
                    value: '化工学院',
                    label: '化工学院'
                }, {
                    value: '经济学院',
                    label: '经济学院'
                }, {
                    value: '理学院',
                    label: '理学院'
                },{
                    value: '健行学院',
                    label: '健行学院'
                  }],
                value: '',
                value3: '',

                nowDateTime: '',
                activeName: 'first',
                checked:[],
                nownowDateTime:'',
                abc:true,
                ruleForm: {
                    name: '',
                    userID:'',
                    sex:'',
                    campus:'',
                    category:'',
                    departments:'',
                    location1:'',
                    location2:'',
                    phone:'',
                    inside:'',
                    health:'',
                    healthinf:'',
                    temperature:'',
                    color:'',
                    back:'NULL',
                    traffic:[],
                    plane:'',
                    train:'',
                    bus:'',
                    ship:'',
                    car:'',
                    other:'',
                    name2:'',
                    phone2:'',
                    address:'',
                    risk:'',
                    isolation:'',
                    isolationplace:'',
                    confirm:'',
                    like:'',
                    test:'',
                    like2:'',
                    touch:'',
                    likeinf:'',
                    like2inf:'',
                    touchinf:'',
                    gotorisk:'',
                    gotoriskinf:'',
                    backfrom:'',
                    backfromtime:'NULL',
                    country:'',
                    traffic2:[],
                    plane2:'',
                    train2:'',
                    bus2:'',
                    ship2:'',
                    car2:'',
                    other2:'',
                    plane0:'',
                    train0:'',
                    bus0:'',
                    ship0:'',
                    car0:'',
                    other0:'',
                    agree:'',
                    urldata:Qs.stringify({'userID': localStorage.getItem('userID')})
                },
                rules: {
                    name: [
                        {required: true, message: '请输入姓名', trigger: 'blur'},
                        {min: 2, max: 5, message: '长度在 3 到 5 个字符', trigger: 'blur'}
                    ],
                    userID: [
                        {required: true, message: '请输入学号/工号', trigger: 'blur'},
                        {min: 12, max: 12, message: '长度为12', trigger: 'blur'}
                    ],
                    sex: [{required: true, message: '请选择', trigger: 'blur'}]
                }
            };
        },
        created() {
          this.getInfo();
        },
      methods: {

          Menu() {
              this.$router.push('/Menu');
          },

          check(){
            if(
                this.ruleForm.name=='' ||
                this.ruleForm.userID=='' ||
                this.ruleForm.sex=='' ||
                this.ruleForm.campus=='' ||
                this.ruleForm.category=='' ||
                this.ruleForm.departments=='' ||
                this.ruleForm.location1=='' ||
                this.ruleForm.location2=='' ||
                this.ruleForm.phone=='' ||
                this.ruleForm.inside=='' ||
                this.ruleForm.health=='' ||
                this.ruleForm.temperature=='' ||
                this.ruleForm.color=='' ||
                this.ruleForm.name2=='' ||
                this.ruleForm.phone2=='' ||
                this.ruleForm.address=='' ||
                this.ruleForm.risk=='' ||
                this.ruleForm.isolation=='' ||
                this.ruleForm.confirm=='' ||
                this.ruleForm.like=='' ||
                this.ruleForm.test=='' ||
                this.ruleForm.like2=='' ||
                this.ruleForm.touch=='' ||
                this.ruleForm.gotorisk=='' ||
                this.ruleForm.backfrom=='' ||
                this.ruleForm.agree==''
            ){
              this.$message.error('信息不能为空');
            }
            else if(
                (
                    this.ruleForm.health=='不适'
                    &&
                    this.ruleForm.healthinf==''
                )
                ||
                (
                    this.ruleForm.inside=='已返乡'
                    &&
                    (
                        this.ruleForm.back==''
                        ||
                        this.ruleForm.traffic==[]
                        ||
                        (
                            this.isInArray(this.ruleForm.traffic,'飞机')
                            &&
                            this.ruleForm.plane==''
                        )
                        ||
                        (
                            this.isInArray(this.ruleForm.traffic,'火车')
                            &&
                            this.ruleForm.train==''
                        )
                        ||
                        (
                            this.isInArray(this.ruleForm.traffic,'客车')
                            &&
                            this.ruleForm.bus==''
                        )
                        ||
                        (
                            this.isInArray(this.ruleForm.traffic,'轮船')
                            &&
                            this.ruleForm.ship==''
                        )
                        ||
                        (
                            this.isInArray(this.ruleForm.traffic,'自驾车')
                            &&
                            this.ruleForm.car==''
                        )
                        ||
                        (
                            this.isInArray(this.ruleForm.traffic,'其他')
                            &&
                            this.ruleForm.other==''
                        )
                    )
                )
                ||
                (
                    this.ruleForm.isolation=='是'
                    &&
                    this.ruleForm.isolationplace==''
                )
                ||
                (
                    this.ruleForm.like=='是'
                    &&
                    this.ruleForm.likeinf==''
                )
                ||
                (
                    this.ruleForm.like2=='是'
                    &&
                    this.ruleForm.like2inf==''
                )
                ||
                (
                    this.ruleForm.touch=='是'
                    &&
                    this.ruleForm.touchinf==''
                )
                ||
                (
                    this.ruleForm.gotorisk=='是'
                    &&
                    this.ruleForm.gotoriskinf==''
                )
                ||
                (
                    this.backfrom=='是'
                    &&
                    (
                        this.ruleForm.backfromtime==''
                        ||
                        this.ruleForm.country==''
                        ||
                        this.ruleForm.traffic2==[]
                        ||
                        (
                            this.isInArray(this.ruleForm.traffic2,'飞机')
                            &&
                            this.ruleForm.plane2==''
                        )
                        ||
                        (
                            this.isInArray(this.ruleForm.traffic2,'火车')
                            &&
                            this.ruleForm.train2==''
                        )
                        ||
                        (
                            this.isInArray(this.ruleForm.traffic2,'客车')
                            &&
                            this.ruleForm.bus2==''
                        )
                        ||
                        (
                            this.isInArray(this.ruleForm.traffic2,'轮船')
                            &&
                            this.ruleForm.ship2==''
                        )
                        ||
                        (
                            this.isInArray(this.ruleForm.traffic2,'自驾车')
                            &&
                            this.ruleForm.car2==''
                        )
                        ||
                        (
                            this.isInArray(this.ruleForm.traffic2,'其他')
                            &&
                            this.ruleForm.other2==''
                        )
                    )
                )
            ){
              this.$message.error('信息不能为空');
            }
            else{
              this.submitForm()
            }
          },

          isInArray(arr,value){
            for(var i = 0; i < arr.length; i++){
              if(value === arr[i]){
                return true;
              }
            }
            return false;
          },

          formateDate:function (datetime) {
            function addDateZero(num) {
              return (num < 10 ? '0' + num : num)
            }
            const d = new Date(datetime)
            const formatdatetime = d.getFullYear() + '-' + addDateZero(d.getMonth() + 1) + '-' + addDateZero(d.getDate()) + ' ' + addDateZero(d.getHours()) + ':' + addDateZero(d.getMinutes()) + ':' + addDateZero(d.getSeconds())
            return formatdatetime
          },

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
            travel1(){
                var str="";
                if(this.isInArray(this.ruleForm.traffic,"飞机")){
                  str=str+"飞机："+this.ruleForm.plane+"   ";
                }
                if(this.isInArray(this.ruleForm.traffic,"火车")){
                  str=str+"火车："+this.ruleForm.train+"   ";
                }
                if(this.isInArray(this.ruleForm.traffic,"客车")){
                  str=str+"客车："+this.ruleForm.bus+"   ";
                }
                if(this.isInArray(this.ruleForm.traffic,"轮船")){
                  str=str+"轮船："+this.ruleForm.ship+"   ";
                }
                if(this.isInArray(this.ruleForm.traffic,"自驾车")){
                  str=str+"自驾车："+this.ruleForm.car+"   ";
                }
                if(this.isInArray(this.ruleForm.traffic,"其他")){
                  str=str+"其他："+this.ruleForm.bus+"   ";
                }
                return str;
            },
            travel2(){
              var str="";
              if(this.isInArray(this.ruleForm.traffic2,"飞机")){
                str=str+"飞机："+this.ruleForm.plane2+"   ";
              }
              if(this.isInArray(this.ruleForm.traffic2,"火车")){
                str=str+"火车："+this.ruleForm.train2+"   ";
              }
              if(this.isInArray(this.ruleForm.traffic2,"客车")){
                str=str+"客车："+this.ruleForm.bus2+"   ";
              }
              if(this.isInArray(this.ruleForm.traffic2,"轮船")){
                str=str+"轮船："+this.ruleForm.ship2+"   ";
              }
              if(this.isInArray(this.ruleForm.traffic2,"自驾车")){
                str=str+"自驾车："+this.ruleForm.car2+"   ";
              }
              if(this.isInArray(this.ruleForm.traffic2,"其他")){
                str=str+"其他："+this.ruleForm.bus2+"   ";
              }
              return str;
            },
            submitForm() {
              if(this.isInArray(this.ruleForm.traffic2,'飞机')){
                this.ruleForm.plane0='飞机';
              }
              if(this.isInArray(this.ruleForm.traffic2,'火车')){
                this.ruleForm.train0='火车';
              }
              if(this.isInArray(this.ruleForm.traffic2,'客车')){
                this.ruleForm.bus0='客车';
              }
              if(this.isInArray(this.ruleForm.traffic2,'轮船')){
                this.ruleForm.ship0='轮船';
              }
              if(this.isInArray(this.ruleForm.traffic2,'自驾车')){
                this.ruleForm.car0='自驾车';
              }
              if(this.isInArray(this.ruleForm.traffic2,'其他')){
                this.ruleForm.other0='其他';
              }

              this.$refs.ruleForm.validate(valid => {
                if(valid){
                  this.axios({
                    method:"post",
                    url:'/daily/model_from_php/Tianbao.php',

                    headers:{
                      'Content-type': 'application/x-www-form-urlencoded'
                    },
                    params: {
                      'name': this.ruleForm.name,
                      'userID':this.ruleForm.userID,
                      'sex':this.ruleForm.sex,
                      'campus':this.ruleForm.campus,
                      'category':this.ruleForm.category,
                      'departments':this.ruleForm.departments,
                      'location1':this.ruleForm.location1,
                      'location2':this.ruleForm.location2,
                      'phone':this.ruleForm.phone,
                      'inside':this.ruleForm.inside,
                      'health':this.ruleForm.health,
                      'healthinf':this.ruleForm.healthinf,
                      'temperature':this.ruleForm.temperature,
                      'color':this.ruleForm.color,
                      'back':this.formateDate(this.ruleForm.back),
                      'traffic1':this.travel1(),
                      'traffic2':this.travel2(),
                      'name2':this.ruleForm.name2,
                      'phone2':this.ruleForm.phone2,
                      'address':this.ruleForm.address,
                      'risk':this.ruleForm.risk,
                      'isolation':this.ruleForm.isolation,
                      'isolationplace':this.ruleForm.isolationplace,
                      'confirm':this.ruleForm.confirm,
                      'like':this.ruleForm.like,
                      'test':this.ruleForm.test,
                      'like2':this.ruleForm.like2,
                      'touch':this.ruleForm.touch,
                      'likeinf':this.ruleForm.likeinf,
                      'like2inf':this.ruleForm.like2inf,
                      'touchinf':this.ruleForm.touchinf,
                      'gotorisk':this.ruleForm.gotorisk,
                      'gotoriskinf':this.ruleForm.gotoriskinf,
                      'backfrom':this.ruleForm.backfrom,
                      'backfromtime':this.formateDate(this.ruleForm.backfromtime),
                      'country':this.ruleForm.country,
                      'agree':this.ruleForm.agree,
                      'plane':this.ruleForm.plane0,
                      'train':this.ruleForm.train0,
                      'bus':this.ruleForm.bus0,
                      'ship':this.ruleForm.ship0,
                      'car':this.ruleForm.car0,
                      'other':this.ruleForm.other0,
                      'plane_inf':this.ruleForm.plane2,
                      'train_inf':this.ruleForm.train2,
                      'bus_inf':this.ruleForm.bus2,
                      'ship_inf':this.ruleForm.ship2,
                      'car_inf':this.ruleForm.car2,
                      'other_inf':this.ruleForm.other2
                    }
                  })
                      // eslint-disable-next-line no-unused-vars
                      .then((valid) => {
                        this.$message.success('提交成功');
                        // eslint-disable-next-line no-unused-vars
                        setTimeout(valid => {
                          router.replace('/Menu')
                        }, 600);
                        console.log(valid.data)
                      })
                }else {
                  this.$message.error('请填写正确信息');
                  console.log('error submit!!');
                  return false;
                }
              });
            },
        getInfo:function () {
          this.axios.post('/daily/model_from_php/Tianbao_inf.php',this.ruleForm.urldata,{
            headers:{'Content-Type':'application/x-www-form-urlencoded'}
          })
              .then(response=>{
                  if(response.data=='今日已经打卡'){
                    this.$message.success('今日已经打卡');
                    // eslint-disable-next-line no-unused-vars
                    setTimeout(valid => {
                      router.replace('/Menu')
                    }, 1000);
                    console.log(response.data)
                  }
                  else{
                    if (response.status >= 200 && response.status < 300) {
                      this.ruleForm.name=response.data.name
                      this.ruleForm.userID=response.data.ID
                      this.ruleForm.sex=response.data.sex
                      this.ruleForm.campus=response.data.campus
                      this.ruleForm.category=response.data.category
                      this.ruleForm.departments=response.data.department
                      this.ruleForm.location1=response.data.native_place
                      this.ruleForm.location2=response.data.registered_place
                      this.ruleForm.phone=response.data.phone
                      this.ruleForm.name2=response.data.Emergency_name
                      this.ruleForm.phone2=response.data.Emergency_phone
                      this.ruleForm.address=response.data.Current_Residence
                      this.ruleForm.risk=response.data.risk_areas
                      this.ruleForm.isolation=response.data.is_isolation
                      this.ruleForm.isolationplace=response.data.isolation_place
                      this.ruleForm.confirm=response.data.is_confirmed
                      this.ruleForm.like=response.data.is_suspected
                      this.ruleForm.test=response.data.NAT
                      this.ruleForm.like2=response.data.family
                      this.ruleForm.touch=response.data.touch_14
                      this.ruleForm.likeinf=response.data.suspect_inf
                      this.ruleForm.like2inf=response.data.family_inf
                      this.ruleForm.touchinf=response.data.touch_inf
                      this.ruleForm.gotorisk=response.data.go14
                      this.ruleForm.gotoriskinf=response.data.go_inf
                      this.ruleForm.backfrom=response.data.is_14back
                      this.ruleForm.backfromtime=response.data.back_time
                      this.ruleForm.country=response.data.where_back
                      this.ruleForm.plane2=response.data.plane_inf
                      this.ruleForm.train2=response.data.train_inf
                      this.ruleForm.bus2=response.data.bus_inf
                      this.ruleForm.ship2=response.data.ship_inf
                      this.ruleForm.car2=response.data.car_inf
                      this.ruleForm.other2=response.data.other_inf
                      this.ruleForm.plane0=response.data.plane
                      this.ruleForm.train0=response.data.train
                      this.ruleForm.bus0=response.data.bus
                      this.ruleForm.ship0=response.data.ship
                      this.ruleForm.car0=response.data.car
                      this.ruleForm.other0=response.data.other
                      if(this.ruleForm.plane0=='飞机'){
                        this.ruleForm.traffic2.push('飞机')
                      }
                      if(this.ruleForm.train0=='火车'){
                        this.ruleForm.traffic2.push('火车')
                      }
                      if(this.ruleForm.bus0=='客车'){
                        this.ruleForm.traffic2.push('客车')
                      }
                      if(this.ruleForm.ship0=='轮船'){
                        this.ruleForm.traffic2.push('轮船')
                      }
                      if(this.ruleForm.car0=='自驾车'){
                        this.ruleForm.traffic2.push('自驾车')
                      }
                      if(this.ruleForm.other0=='其他'){
                        this.ruleForm.traffic2.push('其他')
                      }
                      console.log(response.data)
                    }
                  }
              })
              .catch(function (error) {
                console.log(error);
              })
        },

        resetForm(){
          Object.assign(this.$data,this.$options.data())
        }
          // eslint-disable-next-line vue/no-dupe-keys


        }
    }
</script>

<style scoped>
    .return{
        margin-left: 7%;
    }

    .table{
        margin-top: -1.5%;
        width: 100%;
        height: 100%;
        padding-bottom: 20%;
        background:url("../assets/img/bg.png");
        background-size: 100%;
        background-attachment: fixed;

    }
    .title {
        padding-top: 2%;
        margin-left: 45%;
        font-family: 幼圆;
    }
    .el-form-item{
        font-weight: bold;
    }
    .el-input{
        width:500px;
        height:5px;
    }

    .el-tabs {
      margin-left: 35%;
      margin-right: 30%;
    }

    .returnButton {
      margin-left: 35%;
    }

    .el-radio {
      margin-top: 5px;
      margin-bottom: 5px;
    }
    .chengnuo{
        padding-top: 10%;
        padding-left: 35%;
    }
    .check
    {
        padding-top: 10%;
        padding-left: 20%;
    }
    .buttongr
    {
        padding-top: 10%;
        padding-left: 28%;
    }
    .huiguo1{
        height: 500px;
    }
    .huiguo2{
        margin-top: -85%;
    }


</style>