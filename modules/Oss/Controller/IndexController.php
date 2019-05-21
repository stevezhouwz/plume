<?php

namespace Oss\Controller;

use OSS\Core\OssException;
use OSS\OssClient;
use Plume\Core\Controller;
use Oss\Utils\Ossupload;

class IndexController extends Controller
{

    public function __construct($app){
        parent::__construct($app, null);
    }

    public function indexAction(){

    }

    public function testAction(){
        $this->api();
        $accessKeyId = 'LTAIQqL13WHU9JkA';
        $accessKeySecret = 'Iiqj2kANqCY9lo7QGAZb4Emp0vWKfB';
        $endpoint = 'http://oss-cn-hangzhou.aliyuncs.com';
        $bucket = 'http-xiyou';
        $object = 'index.php';
        $filePath = __FILE__;
        try{
            $oss = new OssClient($accessKeyId, $accessKeySecret, $endpoint);
            $res = $oss->uploadFile($bucket,$object,$filePath);
            print_r($res);die;
        }catch(OssException $e){
            printf(__FUNCTION__ . "createBucket failed: FAILED\n");
            printf($e->getMessage() . "\n");
            return null;
        }

    }
    public function uploadAction(){
        $this->api();
        if(!$_FILES['file']){
            $res = array(
                'result' => 1009,
                'msg'    => 'params is null'
            );
            return $this->result($res)->json()->response();
        }
        $file = $_FILES['file'];
        $name = $file['name'];
        $filePath = $file['tmp_name'];
        $type = $file['type'];
        print_r($file);
        $oss = new Ossupload();
//        print_r($oss->getOssClient());die;
        $res = $oss->uploadFile($name,$filePath,$type);
        return $this->result(array('data'=>$res))->json()->response();
    }
}