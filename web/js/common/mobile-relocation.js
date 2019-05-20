/**
 * Created by Musicbear on 2017/9/22.
 */
if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
    window.location = addressConfig + getPath();   //可以换成http地址
}


function getPath(){
    var url = window.location.href;
    var urlArr = url.split('/');
    if(urlArr) {
        var filename = urlArr[urlArr.length - 1];
        var path = '/item/'+filename;
    }
    return path;
}
