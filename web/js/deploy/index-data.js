/**
 * Created by zeyu on 2019/4/22.
 */
var tabDatas =  {
        'list': [
            {'title': "登录",'id': "login", 'show': 'login', 'click': true},{'title': "学习",'id': "study", 'show': 'study','click': true},
            {'title': "考试",'id': "exam", 'show': 'exam','click': true},{'title': "直播",'id': "living", 'show': 'living',},
            {'title': "作业",'id': "homework", 'show': 'homework'},{'title': "一战到底",'id': "standing", 'show': 'standing'}
        ],
        'show': ""
};
var baseData = {
    'ruleName': {'title': "规则名称", 'disc': "请输入规则名称", 'value': "", 'type': 1, 'key': "rule_name", 'text': "",'error': "请输入规则名称!",'maxlength': 20},
    'ruleDidc': { 'title': "规则描述", 'disc': "请输入规则描述", 'value': "", 'type': 1, 'key': "rule_desc", 'text': "",'error': "请输入规则描述!",'maxlength': 50},
    'addSubAttr': { 'title': "加减属性", 'disc': "", 'value': "0", 'type': 2, 'id': "AttributeSelect", 'key': "add_flag",
        'choose':{'minValue': "",'maxValue': ""},'select': [
        {'title': "加分", 'value': "0", 'type': 1}, {'title': "减分", 'value': "1", 'type': 1} ]},
    'assign': { 'title': "赋值方式", 'disc': "", 'value': "0", 'type': 2, 'id': "AssignSelect", 'key': "random_flag",
        'choose':{'minValue': "",'maxValue': ""},'select': [
            { 'title': "固定", 'value': "1", 'type': 1, 'child': [ {'title': "设定分值", 'value': "", 'disc': "请输入分值", 'type': 1,
                'text':"",'error': "设定分值", 'key': "score_low", 'number': 1000},] },
            { 'title': "随机", 'value': "0", 'type': 1, 'child': [
                {'title': "设定分值", 'value': "", 'min': "请输入分值下限", 'number': 1000, 'max': "请输入分值上限", 'type': 4,'error': "请输入正确的分值上下限",
                    'minKey':"score_low",'maxKey': "score_high",'minText':"",'maxText': ""}, ] } ] },
    'ruleType': { 'title': "规则类型", 'value': "-1", 'type': 2, 'id': "TypeSelect", 'key':"class_id",'error':"请选择规则类型",
        'choose':{'minValue': "",'maxValue': ""},'select': [
            {'title': "请选择规则类型", 'value': "-1", 'type': 1},
            {'title': "首次", 'value': "1", 'type': 1},
            {'title': "每次", 'value': "0", 'type': 1,/* 'child': [
            {'title': "得分占比", 'value': "", 'min': "请得分占比下限", 'max': "请输入得分占比上限", 'type': 4,'error': "请输入得分占比上下限",
                    'minKey':"range_low",'maxKey': "range_high",'minText':"",'maxText': ""}
                {'title': "设定参数", 'value': "", 'disc': "请设定参数", 'number': 1000,'type': 3, 'text':"",'error': "请设定参数", 'key': "range_low",'params': "天"}] */},
            {'title': "每日首次", 'value': "2", 'type': 1},
            {'title': "连续", 'value': "3", 'type': 1, 'child': [ {'title': "设定参数", 'value': "", 'type': 3, 'params': "天",'number': 1000}  ] },
            {  'title': "累计", 'value': "4", 'type': 1, 'child': [{'title': "周期类型", 'value': "", 'type': 2, 'id': "loginCycleSelect", 'select': [
                {'title': "周", 'value': "1", 'type': 1}, {'title': "月", 'value': "2", 'type': 1} ]
            }, {'title': "设定参数", 'value': "", 'type': 3, 'params': "天",'number': 1000} ] },
            {'title': "未做", 'value': "5", 'type': 1},
            { 'title': "连续未做", 'value': "6", 'type': 1, 'child': [ {'title': "设定参数", 'value': "", 'type': 3, 'params': "天",'number': 1000} ] },
            { 'title': "累计未做", 'value': "7", 'type': 1, 'child': [{ 'title': "周期类型", 'value': "", 'type': 2, 'id': "loginCycleSelect", 'select': [
                {'title': "周", 'value': "1", 'type': 1}, {'title': "月", 'value': "2", 'type': 1} ]
            }, {'title': "设定参数", 'value': "", 'type': 3, 'params': "天",'number': 1000} ] },
            {'title': "区间", 'value': "8", 'type': 1, 'child': [
            {'title': "得分占比", 'value': "", 'min': "请得分占比下限", 'max': "请输入得分占比上限", 'type': 4,'error': "请输入正确的得分占比上下限",
                    'minKey':"range_low",'maxKey': "range_high",'minText':"",'maxText': "",'number': 1000}  ] },
        ], 'get': function(id){
                var tmp = null;
                for(var i=0;i<this.select.length;i++){
                    var item = this.select[i];
                    if(item.value == id){
                        tmp = item;
                        break;
                    }
                }
                return tmp;
    }}
};
