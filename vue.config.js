module.exports = {

    devServer:{
        host:'localhost',  // 本地主机
        port:8080,  // 端口号的配置
        open:true,  // 自动打开浏览器
        proxy:{
            '/daily': {   //  拦截以 /api 开头的接口
                target: 'http://121.4.31.156:80',//设置你调用的接口域名和端口号 别忘了加http
                changeOrigin: true,    //这里true表示实现跨域
                secure: false, // 如果是https接口，需要配置这个参数
                pathRewrite: {
                    '^/daily':'/daily' //相当于localhost/daily 变成 121.4.31.156/daily
                }
            },
            // 假如又有一个接口是：http://40.00.100.100:3002/get/list/add

            // 调用的时候直接  /get/list/add  就可以了
        }
    }
}