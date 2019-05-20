/**
 * Created by zhou on 2017/5/3.
 * 自适应js
 */
window.myWidth = 0;
selfAdaption();
function selfAdaption(correctScale) {
    var dpr, rem, scale;
    var docEl = document.documentElement;
    var fontEl = document.createElement('style');
    var metaEl = document.querySelector('meta[name="divport"]');
    dpr = window.devicePixelRatio || 1;
    scale = 1 / dpr;
    if (!window.myWidth) {
        window.myWidth = $(window).width()
    }
    rem = window.myWidth / 10;
    if (correctScale) {
        scale = correctScale
    } else {
        scale = 1 / dpr
    }
    docEl.setAttribute('data-dpr', dpr);
    docEl.firstElementChild.appendChild(fontEl);
    fontEl.innerHTML = 'html{font-size:' + rem + 'px !important;}';
    window.rem2px = function (v) {
        v = parseFloat(v);
        return v * rem
    };
    window.px2rem = function (v) {
        v = parseFloat(v);
        return v / rem
    };
    window.dpr = dpr;
    window.rem = rem
}