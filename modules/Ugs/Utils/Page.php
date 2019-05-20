<?php
/**
 * Created by PhpStorm.
 * User: zhou
 * Date: 2018/11/7
 * Time: 14:23
 */

namespace Ugs\Utils;

Class Page{
    /**
     * 数组分页函数  核心函数  array_slice
     * 用此函数之前要先将数据库里面的所有数据按一定的顺序查询出来存入数组中
     * $count   每页多少条数据
     * $page   当前第几页
     * $array   查询出来的所有数组
     * order 0 - 不变     1- 反序
     * 分页的html可以自己封装，在进行调用
     *
     */

    public function page_array($count,$page,$array,$order,$url){
        $page=(empty($page))?'1':$page; #判断当前页面是否为空 如果为空就表示为第一页面
        $start=($page-1)*$count; #计算每次分页的开始位置
        if($order==1){
            $array=array_reverse($array);
        }
        $totals=count($array);
        $countPage=ceil($totals/$count); #计算总页面数
        $pageData=array();
        $pageData=array_slice($array,$start,$count);
        $pageHtml = $this->createPage($countPage);
        return array("pageData"=>$pageData,"pageNum"=>$totals,"countPage"=>$countPage,"pageHtml"=>$pageHtml);  #返回查询数据
    }
    /**
     * 分页及显示函数
     * $countpage 全局变量，照写
     * $url 当前url
     */
    public function show_array($countPage,$url){
        $page=empty($_GET['page'])?1:$_GET['page'];
        if($page > 1){
            $uppage=$page-1;
        }else{
            $uppage=1;
        }

        if($page < $countPage){
            $nextpage=$page+1;
        }else{
            $nextpage=$countPage;
        }

        $str='<div>';
        $str.="<span>共  {$countPage}  页 / 第 {$page} 页</span>";
        $str.="<span><a href='$url?page=1'>   首页  </a></span>";
        $str.="<span><a href='$url?page={$uppage}'> 上一页  </a></span>";
        $str.="<span><a href='$url?page={$nextpage}'>下一页  </a></span>";
        $str.="<span><a href='$url?page={$countPage}'>尾页  </a></span>";
        $str.='</div>';
        return $str;
    }

    /**
     * 功能：1、创建分页html
     * @param $pageNum
     * @return string
     */
    public function createPage($pageNum){
        $pageIndex = empty($_GET['page'])?1:$_GET['page'];
        if($pageNum<=0){
            $html = "";
            return $html;
        }
        $href = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $href = preg_replace('/&*'.'page'.'=\d*/', '', $href);
        $href = str_replace('%', '#', $href);
        if (! strstr($href, '?')) {
            $href .= '?';
        }
        if (substr($href, - 1) != '?') {
            $href .= '&';
        }
        $html = '';
        $i = 1;
        if(($pageIndex/10) >= 1){
            $i = $pageIndex-5;
            if(($i+10) >$pageNum){
                $length = $pageNum;
            }else{
                $length = $i+10;
            }
        }else {
            if($pageNum>=10){
                $length = 10;
            }else {
                $length = $pageNum;
            }
        }
        if($pageIndex > 1){
            $uppage=$pageIndex-1;
        }else{
            $uppage=1;
        }

        if($pageIndex < $pageNum){
            $nextpage=$pageIndex+1;
        }else{
            $nextpage=$pageNum;
        }


        for($i;$i <=$length;$i++) {
            $pager = "page=";
            if ($pageIndex == $i) {
                $html .= "<li class='active'><span>{$i}<span class='sr-only'></span></span></li>";
            } else {
                $html .= "<li><a href='{$href}{$pager}{$i}'>{$i}</a></li>";
            }
        }
        $uppage = 1;
        $html = "<ul class='pagination'><li><a href='{$href}{$pager}{$uppage}'>首页</a></li>" . $html;
        $html .= "<li><a href='{$href}{$pager}{$pageNum}'>尾页</a></li></ul>";
        return $html;
    }

    /**
     * 功能：1、分页
     * @param $page    //当前页
     * @param $pageSize   //总页数
     * @param $showPage   //中间显示个数（目前规范为7）
     * @param $pageSelf   //分页的链接url
     * @param array $category  分页后跟的参数
     * @return string
     */
    public function pageBar($page,$pageSize,$showPage,$pageSelf,$category = array()){
        $totalPage = $pageSize;    //获取总页数
        $pageOffset = ($showPage - 1) / 2;    //页码偏移量
        $pageBanner = "";
        $start = 1;    //开始页码
        $end = $totalPage;    //结束页码
        $params = '';
        if(!empty($category)){
            foreach ($category as $key => $value){
                if($value !== '') {
                    $params = $params . '&' . $key . '=' . $value;
                }
            }
        }

        if($pageSize <= 4){
            for($i = $start ; $i <= $end ; $i++){    //循环出页码
                if($i == $page){
                    $pageBanner .= "<span class='li active'>".$i."</span>";
                }else{
                    $pageBanner .= "<li class='li' href='".$pageSelf."?page=".$i.$params."'>".$i."</li>";
                }
            }
            return $pageBanner;
        }
        if($page > 1 && $totalPage>3){
            $pageBanner .= "<li class='li pro' href='".$pageSelf."?page=".($page - 1).$params."'>< </li>";
        }
        if($totalPage > $showPage){    //当总页数大于显示页数时
            if($page > $pageOffset + 1){    //当当前页大于页码偏移量+1时
                $pageBanner .= "<li class='li' href='".$pageSelf."?page=1".$params."'>1</li>";
                if($page != 3){
                    $pageBanner .= "<span class='dian'>...</span>";
                }
            }
            if($page > $pageOffset){        //当当前页大于页码偏移量时 开始页码变为当前页-偏移页码
                $start = $page - $pageOffset;
                $end = $totalPage > $page + $pageOffset ?  $page + $pageOffset : $totalPage;
                //如果当前页数+偏移量大于总页数 那么$end为总页数
            }else{
                $start = 1;
                $end = $totalPage > $showPage ? $showPage : $totalPage;
            }
            if($page + $pageOffset > $totalPage){
                $start = $start - ($page + $pageOffset - $end);
            }
        }
        for($i = $start ; $i <= $end ; $i++){    //循环出页码
            if($i == $page){
                $pageBanner .= "<span class='li active'>".$i."</span>";
            }else{
                $pageBanner .= "<li class='li' href='".$pageSelf."?page=".$i.$params."'>".$i."</li>";
            }
        }
        if($totalPage > $showPage && $totalPage > $page + $pageOffset){    //当总页数大于页码显示页数时 且总页数大于当前页+偏移量
            if($page != $totalPage-2){
                $pageBanner .= "<span class='dian'>...</span>";
            }
            $pageBanner .= "<li class='li' href='".$pageSelf."?page=".$totalPage.$params."'>".$totalPage."</li>";
        }
        if($page < $totalPage && $totalPage>3){
            $pageBanner .= "<li class='li next' href='".$pageSelf."?page=".($page + 1).$params."'> ></li>";
        }
        $pageBanner .= "<span class='page-span'>跳转至：</span>";
        $pageBanner .= "<input type='text' class='page-num' ><li class='li-go' params='".$params."' url='".$pageSelf."?page="."' myMax='".$totalPage."'>GO</li>";
        return $pageBanner;
    }
}
