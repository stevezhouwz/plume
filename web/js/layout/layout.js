var layout = new hrLayout();
layout.init();
function hrLayout() {
    var self = this;
    self.init = function () {
        self.sideEvent();
        self.changeUrl();
    };
    self.sideEvent = function () {
        $(".hr-item-a").click(function () {
            var parent = $(this).parent();
            if(parent.hasClass("open")) {
                parent.removeClass("open");
                parent.find(".hr-vertical-menu").hide();
            }else {
                parent.addClass("open");
                parent.find(".hr-vertical-menu").show();
            }
        })
    };

    self.clearUrl = function (path) {
        var k = path.indexOf("?");
        if(k){
            path = path.split("?");
        }
        path = path[0];
        path = path.replace(/^\//, "");
        path = path.replace(/\/$/, "");
        path = path.split("/");
        for (var i = 0; i < path.length; i ++ ) {
            path[i] = path[i].toLowerCase();
        }
        return path;
    };
    self.changeUrl = function () {
        var cp = self.clearUrl(window.location.href);
        $(".hr-vertical-menu a").each(function () {
            var cp2 = self.clearUrl($(this).attr("href"));
            if (cp[cp.length - 1] == cp2[cp2.length - 1] && cp[cp.length - 2] == cp2[cp2.length - 2]) {
                $(this).parent().parent().addClass("open");
                $(this).parent().show();
                $(this).parent().parent().find(".hr-vertical-menu").show();
                $(this).addClass("active");
            }
        })
    };
    self.urlOpen = function (name) {
        $(".hr-vertical-menu a").each(function () {
                var name1 = $(this).find("span").text();
                if(name1 == name){
                    $(this).parent().parent().addClass("open");
                    $(this).parent().show();
                    $(this).parent().parent().find(".hr-vertical-menu").show();
                    $(this).addClass("active");
                }
        })
    };
}