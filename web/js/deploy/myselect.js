/**
 * Created by zeyu on 2018/4/16.
 */
;$(function(){
    function select(element, options){
        var self = this;
        var opts = {
            m_select_w: 200, //外层宽
            m_select_h: 39, //外层高
            m_select_bg_color: '#F0F0F0', //背景颜色
            m_select_border_color: '#ddd', //边框颜色
            m_select_border_size: 1, //边框大小
            s_select_left: 20, //左边距(内容离左边框的距离)
            s_select_size: 12, //内容字体大小
            s_select_color: '#333', //内容字体颜色
            s_select_arrow_color: '#676767', //三角点头颜色
            s_select_arrow_size: 6, //三角箭头宽度
            s_select_arrow_right: 10, //三角箭头离右边框距离
            s_ul_z_index: 10, //层级(下拉列表)
            s_ul_size: 12, //字体大小
            s_ul_color: '#333', //字体颜色
            s_ul_border_color: '#ddd', //外边框颜色
            s_ul_border_size: 1, //外边框大小
            s_ul_bg_color: '#fff', //背景颜色
            s_ul_li_h: 34, //li高度
            s_ul_li_left: 20, //内容左边距
            s_ul_li_border_color: '#ddd', //边线颜色
            s_ul_li_border_size: 1, //边线大小
            s_ul_li_hover_color: '#49aecb', //hover上去的内容颜色
            s_ul_li_hover_bg_color: '#F7F7F7', //hover上去的背景颜色
        };
        $.extend(opts, options);  //合并参数
        self.ele = element;
        if(self.ele.length > 0){
            self.select = self.ele[0];
        }
        this.init = function(){
            //init html
            if(self.select){
                offEvent();//解绑
                removeSelect(); //移除
                var select = self.select;
                select.style = "display: none;"+select.style;
                createSelect();
                initSelectEvent();  // init
                initWinEvent();
            }
            return this;
        };
        this.setValue = function(value){
            if(value.length <= 0){
                return this;
            }
            $(self.select).val(value);
            $(self.select).find("option[selected=selected]").removeAttr("selected");
            $(self.select).find("option[value="+value+"]").attr('selected', "selected");
            $(self.select).parent().find(".m-select>ul").find("li").removeAttr('selected');
            $(self.select).parent().find(".m-select>ul").find("li").removeClass('active');
            $(self.select).parent().find(".m-select>ul").find("li").css({'color': opts.s_ul_color, 'background-color': opts.s_ul_bg_color});
            var target = $(self.select).parent().find(".m-select>ul").find("li[value="+value+"]");
            //设置选中状态
            $(target).css({'color': opts.s_ul_li_hover_color, 'background-color': opts.s_ul_li_hover_bg_color});
            $(target).attr('selected', "selected");
            $(target).addClass('active');
            $(self.select).parent().find(".s-select>.s-value").text($(target).text());
            $(self.select).find("option[selected=selected]").trigger('click');
        };
        this.setFirstSelected = function(){
            $(self.select).find("option[selected=selected]").removeAttr("selected");
            $(self.select).find("option").first().attr('selected', "selected");
            $(self.select).val($(self.select).find("option").first().val());
            $(self.select).parent().find(".m-select>ul").find("li").removeAttr('selected');
            $(self.select).parent().find(".m-select>ul").find("li").css({'color': opts.s_ul_color, 'background-color': opts.s_ul_bg_color});
            var target = $(self.select).parent().find(".m-select>ul").find("li").first();
            $(target).css({'color': opts.s_ul_li_hover_color, 'background-color': opts.s_ul_li_hover_bg_color});
            $(target).attr('selected', "selected");
            $(self.select).parent().find(".s-select>.s-value").text($(target).text());
            $(self.select).find("option[selected=selected]").trigger('click');
        };
        function initSelectEvent(){
            $(self.select).parent().find(".m-select>.s-select").on('click', inputArrowClick);
            $(self.select).parent().find(".m-select").find(".s-ul>.s-li").on('click', liClick);
            //hover
            $(self.select).parent().find(".m-select").find(".s-ul>.s-li").hover(function(e){
                $(this).css({'color': opts.s_ul_li_hover_color, 'background-color': opts.s_ul_li_hover_bg_color});
                e.stopPropagation();
            }, function (e) {
                if(!$(this).hasClass('active')){
                    $(this).css({'color': opts.s_ul_color, 'background-color': opts.s_ul_bg_color});
                }
                e.stopPropagation();
            });
        }
        function removeSelect() {
            $(self.select).parent().find(".m-select").remove();
        }
        function offEvent(){
            $(self.select).parent().find(".m-select>.s-select").off('click', inputArrowClick);
            $(self.select).parent().find(".m-select").find(".s-ul>.s-li").off('click', liClick);
            $(window).off('click', winClick);
        }
        function initWinEvent(){
            $(window).on('click', winClick);
        }
        function winClick(e){
            $(self.select).parent().find(".m-select").find("ul").slideUp(300);
            e.stopPropagation();
        }
        //input arrow click
        function inputArrowClick(e){
            var targets = $(".m-select").find(".s-ul");
            var target = $(this).parent().find(".s-ul");
            for(var i=0;i<targets.length;i++){
                if(target != targets[i]){
                    $(targets[i]).slideUp(300);
                }
            }
            var display = $(target).css('display');
            if(display == "block"){
                $(target).slideUp(300);
            }else{
                $(target).slideDown(300);
            }
            e.stopPropagation();
        }
        //li click
        function liClick(e){
            var value = $(this).attr("value");
            var text = $(this).text();
            var parent = $(this).parent().parent();
            $(this).parent().find('li').removeAttr('selected');
            $(this).parent().find('li').removeClass('active');
            $(this).parent().find('li').css({'color': opts.s_ul_color, 'background-color': opts.s_ul_bg_color});
            //设置选中状态
            $(this).css({'color': opts.s_ul_li_hover_color, 'background-color': opts.s_ul_li_hover_bg_color});
            $(this).attr('selected', "selected");
            $(this).addClass('active');
            $(parent).find(".s-value").text(text);
            $(self.select).find("option[selected=selected]").removeAttr("selected");
            $(self.select).val(value);
            $(self.select).find("option[value='"+value+"']").attr('selected', "selected");
            $(parent).find("ul").slideUp(300);
            $(self.select).find("option[selected=selected]").trigger('click');
            e.stopPropagation();
        }
        //创建
        function createSelect(){
            var node = $(self.select).parent();
            var options = $(self.select).children();
            var selected = $(self.select).val();
            $(node).append('<div class="m-select"></div>');  //外层框
            var target = $(node).find('.m-select');
            $(target).append('<div class="s-select"><input type="hidden" ><span class="s-value"></span><i class="icon"></i></div>');  //显示
            //下拉部分
            $(target).append('<ul class="s-ul"> </ul>');
            var ul =  $(target).find('ul');
            for(var i = 0; i< options.length; i++){
                var option = options[i];
                if($(option).is('option')){
                    var value = $(option).attr('value');
                    var text = $(option).text();
                    var attr = "";
                    if( selected == value){
                        attr = "  selected='selected'  ";
                        $(target).find(".s-select>input[type=hidden]").val(value);
                        $(target).find(".s-select>.s-value").text(text);
                    }
                    var html = "<li class='s-li'  "+attr+ " value='"+value+"'>"+text+"</li>";
                    $(ul).append(html);
                }
            }
            //替换参数,将用户的参数替换原有的参数
            //外层
            $(target).css({'line-height': (opts.m_select_h-2)+"px",'border': opts.m_select_border_size+"px solid "+opts.m_select_border_color,
                'background-color': opts.m_select_bg_color,'width':opts.m_select_w+"px",'height': opts.m_select_h+"px"});
            //显示内层
            $(target).find(".s-select").css({'line-height': (opts.m_select_h-2)+"px", 'font-size': opts.s_select_size+"px",
                'color': opts.s_select_color, 'padding-left': opts.s_select_left+"px",'width':opts.m_select_w+"px",'height': opts.m_select_h+"px"});
            $(target).find(".s-select>.icon").css({'border-top': opts.s_select_arrow_size +"px solid "+opts.s_select_arrow_color,
                'border-left': opts.s_select_arrow_size +"px solid transparent", 'border-right': opts.s_select_arrow_size +"px solid transparent",
                'margin-top': "-"+(opts.s_select_arrow_size/2).toFixed(2)+"px", 'right': opts.s_select_arrow_right+"px",
                'border-radius': opts.s_select_arrow_size +"px"
            });
            //下拉列表
            $(target).find(".s-ul").css({'top': opts.m_select_h+"px",'font-size': opts.s_ul_size+"px", 'background-color': opts.s_ul_bg_color,
                'z-index': opts.s_ul_z_index, 'border': opts.s_ul_border_size+"px solid " +opts.s_ul_border_color,
                'width': opts.m_select_w+"px"});
            $(target).find(".s-ul>.s-li").css({'line-height': (opts.s_ul_li_h-1)+"px", 'padding-left': opts.s_ul_li_left+"px",
                'color': opts.s_ul_color, 'border-bottom': opts.s_ul_li_border_size+"px solid "+opts.s_ul_li_border_color,
                'height': opts.s_ul_li_h+"px"});
            $(target).find(".s-ul>.s-li").last().css({'border-bottom': "none"});
            $(ul).find("li[selected=selected]").addClass('active');
            $(ul).find("li[selected=selected]").css({'color': opts.s_ul_li_hover_color, 'background-color': opts.s_ul_li_hover_bg_color});
            if($(self.select).find("option[selected=selected]").length <= 0){
                self.setFirstSelected();
            }
            $(self.select).find("option[selected=selected]").trigger('click');
        }
    };
    $.fn["rselect"] = function(options) {
        return (new select(this, options)).init();
    };
});