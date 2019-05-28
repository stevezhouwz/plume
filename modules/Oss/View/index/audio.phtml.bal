<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
</head>
<style>
    html{height: 100%;}
    body{margin: 0;padding: 0;height: 100%;font-family: }
    .audio-content{height: 100%;text-align: center;}
    p{margin: 0;padding: 0;}
    .header{height: 80%;}
    .footer{height: 20%;}
    .time{color: #54b73a;font-size: 36px;}
    .time-content{padding-top: 50%;}
    .audio-btn{outline: none;cursor: pointer; width: 80%;height: 50px;background: #bababa;color: white;font-size: 18px;border-radius: 6px;margin-bottom: 8px;}
    .start-btn{background: #54b73a;}

</style>
<body>
<div class="audio-content">
    <div class="header">
        <div class="time-content">
            <p class="shibie"></p>
            <p class="time">
                00:00:00
            </p>
            <p class="text">请点击开始录音按钮录音~</p>
        </div>
    </div>
    <div class="footer">
        <button type="button" class="audio-btn start-btn">开始录音</button>
        <button type="button" class="audio-btn cancel">取消</button>
    </div>
</div>
</body>
<script src="https://cdn.bootcss.com/jquery/1.9.1/jquery.min.js"></script>
<script src="/js/index/recorder-core.js"></script>
<script src="/js/index/wav.js"></script>
<script>
    var audio = new audioEvent();
    audio.init();
    function audioEvent() {
        var self = this;
        var rec = Recorder({
            type:'wav',
        });
        self.status = 1;//录制状态：1：未开始；2：开始
        self.hour = 0;//时
        self.minute = 0;//分
        self.second = 0;//秒
        self.timer; //定时器
        self.time = "00:00:00";
        self.audio;
        self.init = function () {
            // self.open();
            self.event();
        };
        self.event = function(){
            $('.start-btn').click(self.start);
            $('.cancel').click(self.cancel);
        };
        self.open = function(){
            rec.open();//请求麦克风
        };
        self.start = function () {
            if(self.status == 1){
                rec.open(function () {
                    rec.start();//开始录音
                    self.change('结束录音',2);
                    self.status = 2;//修改录音状态
                    self.startTime();
                })
            }else if(self.status == 2){
                //停止录制
                self.clear();
                self.change('播放录音',1);
                rec.stop(function (blob,time) {
                    console.log(URL.createObjectURL(blob));
                    rec.close();//释放录音资源

                    self.audio=document.createElement("audio");
                    self.audio.controls=true;
                    $('.time-content').append(self.audio);

                    self.audio.src=URL.createObjectURL(blob);
                    self.status = 3;
                    self.send(blob);
                })
            }else if(self.status == 3){
                self.audio.play();
            }
        };
        self.change = function (text,type) {
            var obj = $('.start-btn');
            obj.text(text);
            if(type == 1){
                obj.css("background","#54b73a");
            }else if(type == 2){
                obj.css("background","#f54343");
            }else {
                obj.css("background","#bababa");
            }
        };
        self.clear = function () {
            window.clearInterval(self.timer);
            self.hour = 0;//时
            self.minute = 0;//分
            self.second = 0;//秒
        };
        self.startTime = function () {
            self.timer = setInterval(self.time,1000);
        };
        self.time = function () {
            self.second++;
            if(self.second >= 60){
                self.second = 0;
                self.minute++;
            }
            if(self.minute >= 60)
            {
                minute=0;
                self.hour++;
            }
            self.time = self.isjoin(self.hour)+":"+self.isjoin(self.minute)+":"+self.isjoin(self.second);
            $(".time").text(self.time);
        };
        self.isjoin = function (t) {
            return t < 10 ? "0" + t : t;
        };
        self.cancel = function () {
            self.status = 1;
            self.time = "00:00:00";
            $('audio').remove();
            $(".time").text(self.time);
            self.change('开始录音',1);
        };
        self.send = function (blob) {
            var form=new FormData();
            form.append("file",blob,"recorder.mp3");
            console.log(blob);
            var form=new FormData();
            form.append("file",blob,"recorder.mp3");
            $.ajax({
                url:'/oss/index/audioPost' //上传接口地址
                ,type:"POST"
                ,contentType:false //让xhr自动处理Content-Type header，multipart/form-data需要生成随机的boundary
                ,processData:false //不要处理data，让xhr自动处理
                ,data:form
                ,success:function(ret){
                    console.log('识别成功',ret);
                    $(".shibie").text(ret.data);
                }
                ,error:function(s){
                    console.error("上传失败",s);
                }
            });
        }
    }
</script>
</html>