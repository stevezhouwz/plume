/**
 * Created by liubingbing on 2019/4/19.
 */
new Vue({
    el:'#js_base_content',
    data(){
        return {
            input: '',
            search:'',
            selectValue:'',
            action_id:'',
            module_name:$("#js_moudle_name").val(),  //行为名称
            dataTotal:1,    //数据总条目数
            page_rows:10,//一页显示数据条数
            currentPage:1,//分页当前页码
            tableData:[],  //初始化数据列表
            classTab:[]    //行为名称
        }
    },
    created(){
        let _this = this;
        let data = {
            page:1,
            page_rows:this.page_rows
        };
        /*获取行为名称列表数据*/
        this.$http.post('/ugs/rulebases/rules',
            {'module_name':this.module_name},
            {emulateJSON:true}).then(function (res) {
                if(res.body.code == '200'){
                    let data = JSON.parse(res.body.content);
                    _this.classTab = data.data;
                }
            },function (res) {
                console.log('数据获取失败');
            });
        /*获取初始化数据*/
        this.$http.post('/ugs/rulebases/init',data,{emulateJSON:true}).then(function(res){
            // console.log(res.body);
            if(res.body.code == '200'){
                let data = JSON.parse(res.body.content);
                _this.tableData = data.data;
                _this.dataTotal = data.total_count  //数据总条数
                // _this.currentPage = 1;
                // console.log(data.data);
            }
        },function(res){
            console.log("获取数据失败！");
        });
    },
    methods:{
        tableRowClassName(row, rowIndex) {
            if (rowIndex === 1) {
                return 'warning-row';
            } else if (rowIndex === 3) {
                return 'success-row';
            }
            return '';
        },
        handleChange(index,row){
            let _this = this;
            if(row.status){     //启用
                row.status = true;
                popupalert('是否启用该规则','alert',function () {
                    _this.pubFunction().operRules({rule_id:row.rule_id,status:'1'});
                    row.status = true;
                },true,function () {
                    row.status = false;
                });
            }else{      //禁用
                row.status = false;
                popupalert('是否禁用该规则','alert',function () {
                    _this.pubFunction().operRules({rule_id:row.rule_id,status:'2'});
                    row.status = false;
                },true,function () {
                    row.status = true;
                });
            }
        },
        /*当前编辑操作*/
         editHandle(row){
             // console.log(row);
             popupalert("是否修改该规则？",'alert',function () {
                 window.location.href = '/ugs/deploy/index?action_id=' + row.action_id + '&rule_id=' + row.rule_id;
             });
         },
        /*分页显示，当前页码*/
        handleCurrentChange(page) {
            this.pubFunction().pubData(this.action_id,page);
        },
        selectChange(action_id){
            this.currentPage = 1;
            this.action_id = action_id;
            this.pubFunction().pubData(action_id);
        },
        /*提供额外需要的函数*/
        pubFunction(){
            let _this = this;
            return {
                /*提供禁用 启用 操作的方法*/
                operRules(data){
                    _this.$http.post('/ugs/rulebases/oper',data,{emulateJSON:true}).then(function (res) {
                        if(res.body.code == '200'){
                            popupalert('操作成功!','message');
                        }
                    },function (res) {
                        popupalert('操作失败!','error');
                        console.log('操作失败');
                    })
                },
                /*公共调用获取数据*/
                pubData(action_id,page=1){
                    let data = {
                        action_id : action_id,//这里添加action_id
                        page:page,
                        page_rows:_this.page_rows
                    };
                    // console.log(data);return;
                    _this.$http.post('/ugs/rulebases/init',data,{emulateJSON:true}).then(function(res){
                        if(res.body.code == '200'){
                            let data = JSON.parse(res.body.content);
                            _this.tableData = data.data;
                            _this.dataTotal = data.total_count;  //数据总条数
                            _this.currentPage = page;
                        }
                    },function(res){
                        console.log("数据查询错误"+res);
                    });
                }
            }
        },
        /*分页显示，当前页码*/
        handleCurrentChange(page) {
            this.pubFunction().pubData(this.action_id,page);
        },
    },
    computed:{
        newTableData(){
            if(!this.tableData) return [];
            let _this = this;
            let arr = [...(this.tableData)];//扩展内容到新的数组
            arr.forEach(item=>{
                if(item.status === '0'){
                    item.status = false
                }else if(item.status === '1'){
                    item.status = true
                }else if(item.status === '2'){
                    item.status = false
                }

                if(item.add_flag === '0'){
                    item.add_flag = '加分';
                }else if(item.add_flag === '1'){
                    item.add_flag = '减分';
                }

                if(item.random_flag === '1'){
                    item.score = item.score_low;
                }else{
                    item.score = item.score_low +'~'+item.score_high;
                }

                if(item.random_flag === '0'){
                    item.r_flag = '随机';
                }else if(item.random_flag === '1'){
                    item.r_flag = '固定';
                }
            });
            return arr;
        }
    }
})