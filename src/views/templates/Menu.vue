<template>

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
            <el-menu-item index="2-1">信息填报</el-menu-item>
            <el-menu-item index="2-2">签到信息</el-menu-item>
        </el-submenu>
        <el-submenu index="3">
            <template slot="title">其他</template>
            <el-menu-item index="2-1">销假</el-menu-item>
            <el-menu-item index="2-2">出校申请</el-menu-item>
        </el-submenu>
        <el-menu-item index="3" disabled>消息中心</el-menu-item>

    </el-menu>
</template>

<script>
    export default {
        name:"Menu",
        data() {
            return {
                activeIndex2: '1'
            };
        },
        methods: {
            handleSelect(key, keyPath) {
                console.log(key, keyPath);
            }
        }
    }
</script>

<style scoped>

</style>