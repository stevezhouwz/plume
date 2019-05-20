/**
 * Created by zeyu on 2018/5/25.
 */;
 var pageEvent = {};
 $(function () {
     function initPageEvent(cb){
         //分页事件
         $(".role-page>ul").find(".li").each(function(){
             if(!$(this).hasClass("active")){
                 $(this).on('click', function(){
                     if(cb){
                         cb($(this).attr('href'));
                     }else{
                         location.href = $(this).attr('href');
                     }
                 });
             }
         });
         $(".role-page>ul").find(".li-go").on('click', function(){
             var page = $(this).parent().find(".page-num").val();
             page -=0;
             page = Math.ceil(page);
             if(!page){
                 console.log(page);
                 return;
             }
             if(isNaN(page)){
                 console.log(page);
                 return;
             }
             var href = $(this).attr('url')+ page;
             var params = $(this).attr('params');
             if(params){
                 href += params;
             }
             if(cb){
                 cb(href);
             }else{
                 location.href = href;
             }
         });
     }
     //获取参数
     function getParamsByUrl(url){
         var params = {};
         if(url){
             var start = url.lastIndexOf("?"); //最有一次出现的位置
             if(start > 0){
                 var pUrl = url.substr(start+1, url.length);
                 var pUrls = pUrl.split("&");
                 for (var i=0; i< pUrls.length;i++){
                     var pl = pUrls[i];
                     var num = pl.indexOf('=');
                     if(num > 0 && num < pl.length){
                         var pls = pl.split('=');
                         params[pls[0]] = pls[1];
                     }
                 }
             }
         }
         return params;
     };
     pageEvent.init = initPageEvent;
     pageEvent.getParamsByUrl = getParamsByUrl;
 });

