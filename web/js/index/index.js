/**
 * Created by liubingbing on 2019/4/22.
 */
let vm = new Vue({
    el:'#js_base_content',
    data(){
        return {
            selectValue:'',
            searchInput:'',
            tableData:[],//数据源
            dataTotal:'',    //总的数据条数
            currentPage:1,//分页当前页码
            page_rows:10,//一页显示数据条数
        }
    },
    created(){
        let _this = this;
        let data = {
            page:1,
            page_rows:this.page_rows
        };
        this.$http.post('/ugs/index/init',data,{emulateJSON:true}).then(function(res){
            // console.log(res.body);
            if(res.body.code == '200'){
                let data = JSON.parse(res.body.content);
                _this.tableData = data.data;
                _this.dataTotal = data.total_count;  //数据总条数
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
        /*下拉状态选择*/
        selectChange(val){
            this.pubFunction().pubData();
        },
        /*规则管理*/
        ruleManage(){
           window.location.href='/ugs/rulebases/index';
        },
        /*搜索输入框查询*/
        ruleSearch(){
            this.pubFunction().pubData();
        },
        /*分页显示，当前页码*/
        handleCurrentChange(page) {
            this.pubFunction().pubData(page);
        },
        /*提供额外需要的函数*/
        pubFunction(){
            let _this = this;
            return {
                    /*将时间戳转换为日期格式*/
                    timestampToTime(timestamp) {
                        var date = new Date(timestamp * 1000);//时间戳为10位需*1000，时间戳为13位的话不需乘1000
                        var Y = date.getFullYear() + '-';
                        var M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
                        var D = (date.getDate() < 10 ? '0'+(date.getDate()) : date.getDate()) + ' ';
                        var h = (date.getHours() < 10 ? '0'+date.getHours():date.getHours()) + ':';
                        var m = (date.getMinutes() < 10 ? '0'+date.getMinutes():date.getMinutes()) + ':';
                        var s = date.getSeconds() < 10 ? '0'+date.getSeconds():date.getSeconds();
                        return Y+M+D+h+m+s;
                    },
                    /*公共调用获取数据*/
                    pubData(page=1){
                        let data = {
                            search : _this.searchInput.trim(),
                            status : _this.selectValue,
                            page : page,
                            page_rows:_this.page_rows
                        };
                        _this.$http.post('/ugs/index/init',data,{emulateJSON:true}).then(function(res){
                            // console.log(res.body);
                            if(res.body.code == '200'){
                                let data = JSON.parse(res.body.content);
                                // console.log(data);
                                _this.tableData = data.data;
                                _this.dataTotal = data.total_count  //数据总条数
                                _this.currentPage = page;
                            }
                        },function(res){
                            console.log("数据查询错误"+res);
                        });
                    }
            }
        },
    },
    computed:{
        newTableData(){
            if(!this.tableData) return [];
            let _this = this;
            let arr = [...(this.tableData)];//扩展内容到新的数组
            arr.forEach(item=>{
                if(item.status === '0'){
                    item.status = '未启用'
                }else if(item.status === '1'){
                    item.status = '启用'
                }else if(item.status === '2'){
                    item.status = '禁用'
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
                item.update_time = _this.pubFunction().timestampToTime(item.update_time);
            });
            return arr;
        }
    }
});
