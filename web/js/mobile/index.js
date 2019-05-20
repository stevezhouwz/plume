$(function () {
    app.init();

})
var app = new Vue({
    el: '.mobile-body',
    data: {
        scoreData: "",//数据
        page:1, //当前页
        pageSize:"",//分页个数
        page_rows:8,//每页显示多少个
        isShow:false,
        isLoad:false,
        isText:"已全部加载"
    },
    methods: {
        init:function () {
            app.load($("#user_id").val(),$("#comp_id").val(),1,8);
            setTimeout(function () {
                app.showEvent();
            },500);
        },
        load:function (user_id,comp_id,page,page_rows) {
            $.ajax({
                url:"/ugs/mobile/load",
                type:'post',
                data:{user_id:user_id,comp_id:comp_id,page:page,page_rows:page_rows},
                dataType:'json',
                success:function (res) {
                    console.log(res);
                    app.scoreData = [];
                    if(res.list){
                        app.scoreData = res.list;
                        if(!app.pageSize){
                            app.pageSize = res.pageSize;
                        }
                        $("#list-height").unbind('scroll');
                       app.scroll();
                    }
                },
                error:function (e) {
                    console.log('error:'+e);
                }
            });
        },
        scroll:function () {
            $("#list-height").scroll(function () {
                var scrollHeight = document.getElementById("list-height").scrollHeight;
                var scrollTop = document.getElementById("list-height").scrollTop;
                var clientHeight = document.getElementById("list-height").clientHeight;
                if(scrollHeight - clientHeight == scrollTop){
                        if(app.page < app.pageSize){
                            app.page++;
                            app.isLoad = true;
                            app.ajax($("#user_id").val(),$("#comp_id").val(),1,app.page*app.page_rows);
                        }else {
                            app.isLoad = false;
                            app.isText = "已全部加载";
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
        ajax:function (user_id,comp_id,page,page_rows) {
            $("#list-height").unbind("scroll");
            $.ajax({
                url:"/ugs/mobile/load",
                type:'post',
                data:{user_id:user_id,comp_id:comp_id,page:page,page_rows:page_rows},
                dataType:'json',
                success:function (res) {
                    console.log(res);
                    app.scoreData = [];
                    if(res.list){
                        app.scoreData = res.list;
                        if(!app.pageSize){
                            app.pageSize = res.pageSize;
                        }
                        app.isLoad = false;
                        app.scroll();
                    }
                },
                error:function (e) {
                    console.log('error:'+e);
                }
            });
        },
        detail:function (action_id,rule_name,rule_id) {
            var user_id = $("#user_id").val();
            var comp_id = $("#comp_id").val();
            var url = "/ugs/mobile/detail?user_id="+user_id+"&comp_id="+comp_id+"&action_id="+action_id+"&rule_name="+rule_name+"&rule_id="+rule_id;
            window.location.href = url;
        },
        explain:function () {
            var user_id = $("#user_id").val();
            var comp_id = $("#comp_id").val();
            var url = "/ugs/mobile/explain?user_id="+user_id+"&comp_id="+comp_id;
            window.location.href = url;
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