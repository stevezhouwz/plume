/**
 * Created by zeyu on 2019/4/22.
 */
var tab_list = {
    template:
        "<a class='list-btn' :class='{active: item.show == list.show,disabled: item.hasClick == false}' v-text='item.title' @click='show'></a>",
    props:['item','list'],
    methods: {
        show: function(event){
            event.stopPropagation();
            if(this.item.hasClick == false){
                return;
            }
            this.list.show = this.item.show;
            this.$emit('show', this.item);
        }
    },
    created: function(){
        var self = this;

    },
};
//类型1
var li_type1 = {
    template:
        "<div class='line' :class='{error: error}'>\
            <span class='line-title'>{{item.title}}:</span>\
            <div class='input'><input type='text' :placeholder='item.disc' @click='clear' @input='input' :maxlength='maxlength' v-model='item.text'></div>\
            <div class='clear'></div>\
            <span class='tip' v-text='item.error'></span>\
        </div>",
    props:['item','choose'],
    data: function(){
        return {
            error: false,
            maxlength: 20
        };
    },
    methods: {
        clear: function(event){
            event.stopPropagation();
            this.error = false;
        },
        input: function(event){
            if(this.item.number != undefined){
                var value = event.target.value;
                var val = this.number(value, 10000);
                this.item.text = val;
                event.target.value = val;
            }
        },
        number: function(value, max){
            var regular = [/[^\d]/g,/^0{2,}/g];
            value = value.replace(regular[0], '');
            value = value.replace(regular[1], '0');
            value = value.replace(/^(\-)*(\d+).*$/, '$1$2');
            if(value.length > 1){
                var ch = value.substr(0,1);
                if(ch == 0){
                    value = value.substr(1, value.length - 1);
                }
            }
            if(value * 1 > max){
                value = max;
            }
            return value
        }
    },
    created: function(){
        var self = this;
        if(self.choose != undefined){
            self.item.text = this.choose.minValue;
        }
        if(this.item.number == undefined){
            this.maxlength = this.item.maxlength;
        }
        this.$on('save', function(cb){
            var obj = {};
            if(self.item.text.length <= 0){
                self.error = true;
                obj.error = true;
                if(typeof cb === 'function'){
                    cb(obj);
                }
                return ;
            }
            var tem = {};
            obj.error = false;
            tem.key = self.item.key;
            tem.value = self.item.text;
            var data = [];
            data.push(tem);
            obj.data = data;
            if(typeof cb === 'function'){
                cb(obj);
            }
        });
    },
};
//类型3
var li_type3 = {
    template:
        "<div class='line' :class='{error: error}'>\
            <span class='line-title'>{{item.title}}:</span>\
            <div class='input'>\
                <input type='text' class='params' :placeholder='item.disc' @input='input' v-model='item.text' @click='clear' maxlength='50'>\
                <span class='params-type'>{{item.params}}</span>\
            </div>\
            <div class='clear'></div>\
            <span class='tip' v-text='item.error'></span>\
        </div>",
    props:['item', 'choose'],
    data: function(){
        return {
            error: false,
        };
    },
    methods: {
        clear: function(event){
            event.stopPropagation();
            this.error = false;
        },
        input: function(event){
            if(this.item.number != undefined){
                var value = event.target.value;
                var val = this.number(value, 10000);
                this.item.text = val;
                event.target.value = val;
            }
        },
        number: function(value, max){
            var regular = [/[^\d]/g,/^0{2,}/g];
            value = value.replace(regular[0], '');
            value = value.replace(regular[1], '0');
            value = value.replace(/^(\-)*(\d+).*$/, '$1$2');
            if(value.length > 1){
                var ch = value.substr(0,1);
                if(ch == 0){
                    value = value.substr(1, value.length - 1);
                }
            }
            if(value * 1 > max){
                value = max;
            }
            return value
        }
    },
    created: function(){
        var self = this;
        this.item.text = this.choose.minValue;
        this.$on('save', function(cb){
            var obj = {};
            if(self.item.text.length <= 0){
                self.error = true;
                obj.error = true;
                if(typeof cb === 'function'){
                    cb(obj);
                }
                return ;
            }
            var tem = {};
            obj.error = false;
            tem.key = self.item.key;
            tem.value = self.item.text;
            obj.data = [];
            obj.data.push(tem);
            if(typeof cb === 'function'){
                cb(obj);
            }
        });
    },
};
//类型4
var li_type4 = {
    template:
        "<div class='line' :class='{error: error}'>\
            <span class='line-title'>{{item.title}}:</span>\
            <div class='input'>\
                <div class='limit'><input type='text' :placeholder='item.min' @input='input(1, $event)' @click='clear' v-model='item.minText'></div>\
                <span class='symbol'>~</span>\
                 <div class='limit'><input type='text' :placeholder='item.max' @input='input(2, $event)' @click='clear' v-model='item.maxText'></div>\
            </div>\
            <div class='clear'></div>\
            <span class='tip' v-text='item.error'></span>\
        </div>",
    props:['item', 'choose'],
    data: function(){
        return {
            error: false,
        };
    },
    methods: {
        clear: function(event){
            event.stopPropagation();
            this.error = false;
        },
        input: function(index, event){
            if(this.item.number != undefined){
                var value = event.target.value;
                var val = this.number(value, 10000);
                if(index == 1){
                    this.item.minText = val;
                }else{
                    this.item.maxText = val;
                }
                event.target.value = val;
            }
        },
        number: function(value, max){
            var regular = [/[^\d]/g,/^0{2,}/g];
            value = value.replace(regular[0], '');
            value = value.replace(regular[1], '0');
            value = value.replace(/^(\-)*(\d+).*$/, '$1$2');
            if(value.length > 1){
                var ch = value.substr(0,1);
                if(ch == 0){
                    value = value.substr(1, value.length - 1);
                }
            }
            if(value * 1 > max){
                value = max;
            }
            return value
        }
    },
    created: function(){
        var self = this;
        this.item.minText = this.choose.minValue;
        this.item.maxText = this.choose.maxValue;
        if(this.choose.minValue * 1 >= this.choose.maxValue * 1){
            this.item.minText = "";
            this.item.maxText = "";
        }
        this.$on('save', function(cb){
            var obj = {};
            if(self.item.minText.length <= 0 || self.item.maxText.length <= 0){
                self.error = true;
                obj.error = true;
                if(typeof cb === 'function'){
                    cb(obj);
                }
                return ;
            }
            if(self.item.minText * 1 >= self.item.maxText * 1){
                self.error = true;
                obj.error = true;
                if(typeof cb === 'function'){
                    cb(obj);
                }
                return ;
            }
            obj.error = false;
            obj.data = [];
            obj.data.push({'key': self.item.minKey, 'value': self.item.minText});
            obj.data.push({'key': self.item.maxKey, 'value': self.item.maxText});
            if(typeof cb === 'function'){
                cb(obj);
            }
        });
    },
};

//类型2的子
var line_type1 = {
    template:
        "<div class='line' :class='{error: error}'>\
            <span class='line-title'>{{item.title}}:</span>\
            <div class='input'>\
                <select :id='item.id'>\
                    <option v-for='(option, index) in item.select':key='index' :value='option.value' v-text='option.title' @click='change(option,$event)'></option>\
                </select>\
            </div>\
            <div class='clear'></div>\
            <span class='tip' v-text='item.error'></span>\
        </div>",
    props:['item'],
    data: function(){
        return {
            ops:{
                m_select_h: 32,
                m_select_bg_color:"#f0f0f0",
                m_select_w:318,
                s_select_size:10,
                s_select_left:5,
                m_select_border_color: "#dadada"
            },
            selected: {},
            error: false
        };
    },
    created: function(){
        var self = this;
        this.$on('save', function(cb) {
            var obj = {};
            var value = self.selected.value;
            if (value == undefined || value < 0) {
                self.error = true;
                obj.error = true;
                if (typeof cb === 'function') {
                    cb(obj);
                }
                return;
            }
            var tem = {};
            obj.error = false;
            tem.key = self.item.key;
            tem.value = value;
            obj.data = [];
            obj.data.push(tem);
            if (typeof cb === 'function') {
                cb(obj);
            }
        });
    },
    methods: {
        change: function(option, event){
            event.stopPropagation();
            this.selected = option;
            this.error = false;
            this.$set(this.item, 'show', option);
        }
    },
    mounted: function(){
        var self = this;
        this.$nextTick(function(){
            $("#"+self.item.id).rselect(self.ops).setValue(self.item.value);
        });
    }
};
//类型2的子的子
var line_type_c = {
    template:
        "<div class='line' :class='{error: error}'>\
            <span class='line-title'>{{item.title}}:</span>\
            <div class='input'>\
                <select :id='item.id'>\
                    <option v-for='(option, index) in item.select':key='index' :value='option.value' v-text='option.title' @click='change(option,$event)'></option>\
                </select>\
            </div>\
            <div class='clear'></div>\
        </div>",
    props:['item'],
    created: function(){
        var self = this;
        this.$on('save', function(cb){
            console.log("我来了");
            var obj = {};
            var value = self.selected.value;
            if (value == undefined || value < 0) {
                self.error = true;
                obj.error = true;
                if (typeof cb === 'function') {
                    cb(obj);
                }
                return;
            }
            var tem = {};
            obj.error = false;
            tem.key = self.item.key;
            tem.value = value;
            obj.data = [];
            obj.data.push(tem);
            if (typeof cb === 'function') {
                cb(obj);
            }
        });
    },
    data: function(){
        return {
            ops:{
                m_select_h: 32,
                m_select_bg_color:"#f0f0f0",
                m_select_w:318,
                s_select_size:10,
                s_select_left:5,
                m_select_border_color: "#dadada"
            },
            selected: {},
            error: false
        };
    },
    methods: {
        change: function(option, event){
            event.stopPropagation();
            this.selected = option;
            this.error = false;
            this.$set(this.item, 'show', option);
        }
    },
    mounted: function(){
        var self = this;
        this.$nextTick(function(){
            $("#"+self.item.id).rselect(self.ops);
        });
    }
};
var li_type_2 = {
    template:
        "<li class='li'>\
            <type-1 ref='type1'  v-if='item.type==1' :item='item' :choose='choose'></type-1>\
            <line-type ref='type2' v-if='item.type==2' :item='item' :choose='choose'></line-type>\
            <type-3 ref='type3' v-if='item.type==3' :item='item' :choose='choose'></type-3>\
            <type-4 ref='type4' v-if='item.type==4' :item='item' :choose='choose'></type-4>\
        </li>",
    props:['item', 'choose'],
    methods:{
        has: function(item){
            if(item.show != undefined){
                if(item.show.child != undefined){
                    return true;
                }
            }
            return false;
        },
    },
    created: function(){
        var self = this;
        this.$on('save', function(cb){
            var type = "type"+self.item.type;
            if(self.item.type <= 4){
                self.$refs[type].$emit('save', function(rt){
                    if(typeof cb === 'function'){
                        cb(rt);
                    }
                });
            }else{
                console.log("类型错误");
            }
        });
    },
    components:{
        'type-1': li_type1,
        'type-3': li_type3,
        'type-4': li_type4,
        'line-type': line_type_c,
    }
};
//类型2的子
var ul_type2 = {
    template:
        "<ul class='list'>\
            <li-list v-for='(child, index) in item.child':key='index' :item='child' :choose='choose' ref='child'></li-list>\
        </ul>",
    props:['item','choose'],
    data: function(){
        return {
            saveData:[],
        };
    },
    methods: {
        setData: function(data){
            for(var i=0;i<data.length;i++){
                this.saveData.push(data[i]);
            }
        },
        getData: function(index, max, cb){
            var self = this;
            if(index >= max){
                cb({'error': false, 'data': this.saveData});
            }else{
                self.$refs['child'][index].$emit('save', function(rt){
                    if(rt.error == true){
                        cb(rt);
                    }else{
                        self.setData(rt.data);
                        index ++;
                        self.getData(index, max, cb);
                    }
                });
            }
        },
    },
    created: function(){
        var self = this;
        this.$on('save', function(cb){
            var max = self.$refs['child'].length;
            self.getData(0, max, cb);
        });
    },
    components:{
        'li-list': li_type_2,
    }
};
//按钮
var btn = {
    template: "<div class='list-btn'>\
            <a class='btn-a' @click='save'>保存并退出</a>\
            <a class='btn-a' @click='cancel'>取消并退出</a>\
       </div>",
    props: ['item'],
    methods: {
        save: function(event){
            event.stopPropagation();
            this.$emit('save', '');
        },
        cancel: function(event){
            event.stopPropagation();
            this.$emit('cancel', '');
        }
    }
};
var li_type = {
    template:
        "<li class='li'>\
            <type-1 ref='type1'  v-if='item.type==1' :item='item'></type-1>\
            <line-type ref='type2' v-if='item.type==2' :item='item'></line-type>\
            <ul-type ref='type21' v-if='has(item)' :item='item.show' :choose='item.choose'></ul-type>\
            <type-3 ref='type3' v-if='item.type==3' :item='item' :choose='item.choose'></type-3>\
            <type-4 ref='type4' v-if='item.type==4' :item='item' :choose='item.choose'></type-4>\
        </li>",
    props:['item'],
    data: function(){
        return {
            saveData: [],
        };
    },
    methods:{
        has: function(item){
            if(item.show != undefined){
                if(item.show.child != undefined){
                    return true;
                }
            }
            return false;
        },
        setData: function(items){
            for(var i=0;i<items.length;i++){
                var item = items[i];
                this.saveData.push(item);
            }
        },
        getData: function(type, index, max, cb){
            var self = this;
            if(index >= max){
                cb({'error': false, 'data': this.saveData});
            }else{
                if(self.$refs[type] == undefined){
                    cb({'error': false, 'data': this.saveData});
                    return ;
                }
                self.$refs[type].$emit('save', function(rt){
                    if(rt.error == true){
                        cb(rt);
                    }else{
                        self.setData(rt.data);
                        index ++;
                        type += ""+index;
                        self.getData(type, index, max, cb);
                    }
                });
            }
        },
    },
    created: function(){
        var self = this;
        this.$on('save', function(cb){
            self.saveData = [];
            var type = "type"+self.item.type;
            if(self.item.type == 2){
                self.getData(type, 0, 2, cb);
            }else{
                self.getData(type, 0, 1, cb);
            }
        });
    },
    components:{
        'type-1': li_type1,
        'type-3': li_type3,
        'type-4': li_type4,
        'line-type': line_type1,
        'ul-type': ul_type2,
    }
};
var component = {
    template:
        "<div class='item-list'>\
            <ul class='list'>\
                <li-list v-for='(item, index) in data':key='index' :item='item' ref='line'></li-list>\
            </ul>\
            <btn @save='save' @cancel='cancel'></btn>\
         </div>",
    props:['data'],
    data: function(){
        return {
            error: false,
            saveData: {},
        };
    },
    methods: {
        save: function(item){
            //保存
            var self = this;
            self.saveData = {};
            var max = self.$refs['line'].length;
            self.getData(0, max, function(rt){
                if(rt.error == false){
                    self.$emit('save', self.saveData);
                }else{
                    console.log(rt);
                }
            });
        },
        cancel: function(item){
            this.$emit('cancel', item)
        },
        setData: function(items){
            for(var i=0;i<items.length;i++){
               var key = items[i].key;
                this.saveData[key] = items[i].value;
            }
        },
        getData: function(index, max, cb){
            var self = this;
            if(index >= max){
                cb({'error': false});
            }else{
                self.$refs['line'][index].$emit('save', function(rt){
                    if(rt.error == true){
                        cb(rt);
                    }else{
                        self.setData(rt.data);
                        index ++;
                        self.getData(index, max, cb);
                    }
                });
            }
        },
    },
    components:{
        'li-list': li_type,
        'btn': btn
    }
};