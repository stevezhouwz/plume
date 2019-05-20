/**
 * Created by zeyu on 2019/4/22.
 */

$(function(){

    function trim(value){
        return $.trim(value);
    }
    var comp_id = trim($("#comp_id").val());
    var rule_id = trim($("#rule_id").val());
    var action_id = trim($("#action_id").val());

    function goBack(){
        var url = "/ugs/rulebases/index?module_name=education&instance_id="+comp_id;
        location.href = url;
    }
    $(".btn-crumb").on('click', goBack);
    new Vue({
        el: "#tabRuler",
        data:{
            'comp_id': comp_id,
            'rule_id': rule_id,
            'action_id': action_id,
            'tabList': {'list':[],'show':""},
            'list': [],
            'listShow': false,
            'item': "",
            'editData': {},
            'eidt': false,
            'goBack': "/ugs/rulebases/index?module_name=education&instance_id="+comp_id,
        },
        methods:{
            cancel: function(item){
                location.href = this.goBack;
            },
            save: function(data){
                var self = this;
                data['action_id'] = this.item.action_id;
                data['instance_id'] = this.comp_id;
                if(self.rule_id.length > 0){
                    data['rule_id'] = this.rule_id;
                }
                var url = "/ugs/deploy/saveruler";
                popupalert("正在保存", "loading",'','');
                this.ajax(url, data, function(rt){
                    stopLoading();
                    setTimeout(function(){
                        if(rt.result == 0){
                            popupalert("正在保存", "message", function(){
                                location.href = self.goBack;
                            });
                        }else{
                            popupalert("保存失败", "error",'','');
                        }
                    }, 650)
                });
            },
            show: function(item){
                this.item = item;
                var url = "/ugs/deploy/clazzruler";
                var params = {'action_id': item.action_id};
                var self =this;
                self.list = [];
                self.listShow = false;
                this.ajax(url, params, function(rt){
                    if(rt.result != 0){
                        popupalert("初始化失败!", "error",'','');
                        console.log("init data failed");
                        return ;
                    }
                    var list = rt.data;
                    var ruleList = [];
                    var tmpName = self.clone(baseData.ruleName);
                    var tmpDisc = self.clone(baseData.ruleDidc);
                    var tempAttr =  self.clone(baseData.addSubAttr);
                    var tmpAssign =  self.clone(baseData.assign);
                    var tmps = {};
                    tmps.title = baseData.ruleType.title;
                    tmps.value = baseData.ruleType.value;
                    tmps.type = baseData.ruleType.type;
                    tmps.id = baseData.ruleType.id;
                    tmps.key = baseData.ruleType.key;
                    tmps.error = baseData.ruleType.error;
                    tmps.choose = self.clone(baseData.ruleType.choose);
                    tmps.select = [];
                    var select = [];
                    var tmp = baseData.ruleType.get(-1);
                    if(tmp){
                        select.push(tmp)
                    }
                    for(var i=0;i<list.length;i++){
                        var d = list[i];
                        var tmp = baseData.ruleType.get(d.class_id);
                        if(tmp){
                            select.push(tmp)
                        }
                    }
                    tmps.select = self.clone(select);
                    if(self.edit){
                        tmpName.text = self.editData.rule_name;
                        tmpDisc.text = self.editData.rule_desc;
                        tempAttr.value = self.editData.add_flag;
                        tmpAssign.value = self.editData.random_flag;
                        self.$set(tmpAssign.choose, 'minValue', self.editData.score_low);
                        self.$set(tmpAssign.choose, 'maxValue', self.editData.score_high);
                        tmps.value = self.editData.class_id;
                        self.$set(tmps.choose, 'minValue', self.editData.range_low);
                        self.$set(tmps.choose, 'maxValue', self.editData.range_high);
                    }
                    ruleList.push(tmpName);
                    ruleList.push(tmpDisc);
                    ruleList.push(tmps);
                    ruleList.push(tempAttr);
                    ruleList.push(tmpAssign);
                    self.list = ruleList;
                    self.listShow = true;
                });
            },
            ajax: function(url, params, cb){
                $.ajax({
                    url: url,
                    type: "post",
                    datatype: "json",
                    data: params,
                    success: function(rt){if(cb){cb(rt);}else{console.log(rt);}},
                    error: function(e){console.log(e);}
                });
            },
            clone: function(obj){
                var self = this;
                return (function(){
                    var type = typeof obj;
                    if(type === 'object' || type === 'array'){
                        var result = {};
                        if(obj instanceof Array){
                            result = [];
                        }
                        //克隆
                        for(key in obj){
                            result[key] = self.clone(obj[key]);
                        }
                        return result;
                    }
                    var temp = obj;
                    return temp;
                })();
            },
        },
        mounted: function(){
            var self = this;
            this.$nextTick(function(){
                //
               //初始化数据
                var url = "/ugs/deploy/clazzlist";
                self.ajax(url, '', function(rt){
                    if(rt.result != 0){
                        popupalert("初始化失败!", "error",'','');
                        console.log("init data failed");
                        return ;
                    }
                    var list = rt.data;
                    var obj = {};
                    //
                    if(self.action_id.length > 0 && self.rule_id.length >0){
                        self.edit = true;
                        var tmp = null;
                        for(var i=0;i<list.length;i++){
                            if(list[i].action_id == self.action_id){
                                tmp = list[i];
                            }else{
                                list[i].hasClick = false;
                            }
                        }
                        obj.list = list;
                        obj.show = tmp ? tmp.show : "";
                        self.tabList = obj;
                        var url = "/ugs/deploy/singleruler";
                        var params = {'rule_id': self.rule_id};
                        self.ajax(url, params, function(rt){
                            if(rt.result == 0){
                                self.editData = rt.data;
                                self.show(tmp);
                                return ;
                            }
                            popupalert("初始化失败!", "error",'','');
                        });
                    }else{
                        obj.list = list;
                        obj.show = list.length>0 ? list[0].show : "";
                        self.tabList = obj;
                        if(list.length > 0){
                            self.show(list[0]);
                        }
                    }
                });
            });
        },
        components: {
            'list-btn': tab_list,
            'component-list': component,
        }
    });
});
