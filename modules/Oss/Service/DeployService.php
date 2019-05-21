<?php
/**
 * Created by PhpStorm.
 * User: zeyu
 * Date: 2019/4/23
 * Time: 13:36
 */

namespace Ugs\Service;


use Plume\Util\HttpUtils;

class DeployService extends BaseService
{
    public function __construct($app)
    {
        parent::__construct($app, '');
    }

    public function getRuler($rule_id){
        $conf = $this->getConfigValue("growth");
        $url = $conf['domain'].$conf['get_action_rule_byid'];
        $params = array('rule_id' => $rule_id);
        $result = HttpUtils::http_post($url, $params);
        if($result['status']){
            $content = json_decode($result['content'], true);
            if($content['code'] == 0){
                $data = $content['data'];
                $rt = array('result' => 0, 'data' => $data, 'message' => "ok");
                return $rt;
            }else{
                $this->log("getRuler fail", $content);
                $msg = isset($content['msg'])?  $content['msg'] : $content['message'];
                $rt = array('result' => 20,  'message' => $msg);
                return $rt;
            }
        }
        $result['url'] = $url;
        $result['params'] = $params;
        $this->log("getRuler", $result);
        $rt = array('result' => 50, 'message' => "error");
        return $rt;
    }

    /**
     * 添加行为规则
     * @param $datas
     * @return array
     */
    public function addClassRuler($datas){
        $rt = $this->pkgClassRulerParams($datas);
        $this->log("addClassRuler data", $rt);
        if(isset($rt['result'])){
            return $rt;
        }
        $url = $rt['url'];
        $params = $rt['params'];
        $result = HttpUtils::http_post($url, $params);
        if($result['status']){
            $content = json_decode($result['content'], true);
            if($content['code'] == 0){
                $this->log("addClassRuler success", $content);
                $rt = array('result' => 0,  'message' => "ok");
                return $rt;
            }else{
                $this->log("addClassRuler fail", $content);
                $msg = isset($content['msg'])?  $content['msg'] : $content['message'];
                $rt = array('result' => 20,  'message' => $msg);
                return $rt;
            }
        }
        $result['url'] = $url;
        $result['params'] = $params;
        $this->log("addClassRuler or update", $result);
        $rt = array('result' => 50, 'message' => "http error");
        return $rt;
    }

    /**
     * 打包参数
     * @param $datas
     * @return array
     */
    private function pkgClassRulerParams($datas){
        $conf = $this->getConfigValue("growth");
        $url = $conf['domain'].$conf['add_class_ruler'];
        $params = array('instance_id' => $datas['instance_id'], 'rule_name' => $datas['rule_name'], 'rule_desc' => $datas['rule_desc']);
        $params['class_id'] = $datas['class_id'];
        $params['add_flag'] = $datas['add_flag'];
        $params['random_flag'] = $datas['random_flag'];
        $params['score_low'] = $datas['score_low'];
        if($datas['random_flag'] == 0){
            if(!is_numeric($datas['score_high'])){
                return array('result' => "30", 'message' => "params error");
            }
            $params['score_high'] = $datas['score_high'];
        }
        if($datas['class_id'] == 8){
            if(!is_numeric($datas['range_high']) || !is_numeric($datas['range_low'])){
                return array('result' => "30", 'message' => "params error");
            }
            $params['range_low'] = $datas['range_low'];
            $params['range_high'] = $datas['range_high'];
        }
        if(isset($datas['rule_id']) && !empty($datas['rule_id'])){
            $url = $conf['domain'].$conf['update_class_ruler'];
            $params['rule_id'] = $datas['rule_id'];
        }else{
            $params['action_id'] = $datas['action_id'];
        }
        return array('url' => $url, 'params' => $params);
    }
    /**
     * 行为列表
     * @param $module_name
     * @return array
     */
    public function clazzList($module_name){
        $params = array('module_name' => $module_name);
        $conf = $this->getConfigValue("growth");
        $url = $conf['domain'].$conf['get_class_list'];
        $result = HttpUtils::http_post($url, $params);
        if($result['status']){
            $content = json_decode($result['content'], true);
            if($content['code'] == 0){
                $data = $content['data'];
                $tmps = array();
                foreach ($data as $item){
                    $tmp = $item;
                    $tmp['title'] = $item['action_name_cn'];
                    $tmp['id'] = $item['action_name'];
                    $tmp['show'] = $item['action_name'];
                    $tmp['hasClick'] = true;
                    $tmps[] = $tmp;
                }
                $rt = array('result' => 0, 'data' => $tmps, 'message' => "ok");
                return $rt;
            }else{
                $this->log("clazzList fail", $content);
                $msg = isset($content['msg'])?  $content['msg'] : $content['message'];
                $rt = array('result' => 20,  'message' => $msg);
                return $rt;
            }
        }
        $result['url'] = $url;
        $result['params'] = $params;
        $this->log("clazzList", $result);
        $rt = array('result' => 50, 'message' => "error");
        return $rt;
    }

    /**
     * 规则类型列表
     * @param $action_id
     * @return array
     */
    public function clazzRuler($action_id){
        $params = array('action_id' => $action_id);
        $conf = $this->getConfigValue("growth");
        $url = $conf['domain'].$conf['get_class_ruler'];
        $result = HttpUtils::http_post($url, $params);
        if($result['status']){
            $content = json_decode($result['content'], true);
            if($content['code'] == 0){
                $data = $content['data'];
                $rt = array('result' => 0, 'data' => $data, 'message' => "ok");
                return $rt;
            }else{
                $this->log("clazzRuler fail", $content);
                $msg = isset($content['msg'])?  $content['msg'] : $content['message'];
                $rt = array('result' => 20,  'message' => $msg);
                return $rt;
            }
        }
        $result['url'] = $url;
        $result['params'] = $params;
        $this->log("clazzList", $result);
        $rt = array('result' => 50, 'message' => "error");
        return $rt;
    }
}