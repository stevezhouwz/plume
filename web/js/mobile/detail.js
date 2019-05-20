$(function () {
    app.init();
})
var app = new Vue({
    el: '.explain-body',
    data: {
        scoreData: "",//数据
        page:1, //当前页
        pageSize:"",//分页个数
        page_rows:10,//每页显示多少个
        isShow:false,
        isLoad:false,
        isText:"已全部加载"
    },
    methods: {
        init:function () {
            var user_id = $("#user_id").val();
            var comp_id = $("#comp_id").val();
            var action_id = $("#action_id").val();
            var rule_name = $("#rule_name").val();
            var rule_id = $("#rule_id").val();
            app.load(user_id,comp_id,action_id,rule_name,rule_id,1,10);
            setTimeout(function () {
                app.showEvent();
            },500);
        },
        load:function (user_id,comp_id,action_id,rule_name,rule_id,page,page_rows) {
            $.ajax({
                url:"/ugs/mobile/loadDetail",
                type:'post',
                data:{user_id:user_id,comp_id:comp_id,action_id:action_id,rule_name:rule_name,rule_id:rule_id,page:page,page_rows:page_rows},
                dataType:'json',
                success:function (res) {
                    console.log(res);
                    app.scoreData = [];
                    if(res.data){
                        app.scoreData = res.data;
                        if(!app.pageSize){
                            app.pageSize = res.pageSize;
                        }
                        app.isLoad = false;
                        $("#list-height").unbind('scroll');
                        app.pageEvent();
                    }
                },
                error:function (e) {
                    console.log('error:'+e);
                }
            });
        },
        pageEvent:function () {

            $("#list-height").scroll(function () {
                var scrollHeight = document.getElementById("list-height").scrollHeight;
                var scrollTop = document.getElementById("list-height").scrollTop;
                var clientHeight = document.getElementById("list-height").clientHeight;
                if (scrollHeight - clientHeight == scrollTop) {
                        if(app.page < app.pageSize){
                            app.page++;
                            var user_id = $("#user_id").val();
                            var comp_id = $("#comp_id").val();
                            var action_id = $("#action_id").val();
                            var rule_name = $("#rule_name").val();
                            var rule_id = $("#rule_id").val();
                            app.isLoad = true;
                            if(app.page > 10){
                                app.isLoad = false;
                                app.isText = "加载已达上限";
                                app.isShow = true;
                                setTimeout(function () {
                                    app.isShow = false;
                                },1000);
                                return;
                            }else {
                                app.load(user_id, comp_id, action_id, rule_name, rule_id, 1, app.page * app.page_rows);
                            }
                        }else {
                            app.isLoad = false;
                            if(app.scoreData.length >=100){
                                app.isText = "加载已达上限";
                            }else{
                                app.isText = "已全部加载";
                            }
                            app.isShow = true;
                            setTimeout(function () {
                                app.isShow = false;
                            },1000);
                        }
                }else{
                    app.isShow = false;
                }
            })
        },
        showEvent : function () {
            if(app.pageSize > app.page){
                app.isText = "上拉加载更多";
                app.isShow = true;
            }else{
                app.isShow = false;
            }
        }
    }
})