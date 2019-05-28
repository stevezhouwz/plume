<?php

namespace Oss\Controller;

use OSS\Core\OssException;
use OSS\OssClient;
use Oss\Utils\AipSpeech;
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
        print_r($_FILES);die;
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


    public function audioAction(){

    }

    public function audioPostAction(){
        $this->api();

        $APP_ID = '16368044';
        $API_KEY = 'YG8mgG7kez73LGnpFkjiStTS';
        $SECRET_KEY = 'tjLxhVXYWdzGzHgUWXTIcq0ft6rv120V';
        $file = $_FILES['file'];
//        print_r($file);die;
        $filename = $file['name'];
        $path = $file['tmp_name'];
        $client = new AipSpeech($APP_ID, $API_KEY, $SECRET_KEY);

        $res = $client->asr(file_get_contents($path), 'wav', 16000, array(
            'dev_pid' => 1536,
        ));

        if($res['err_no'] == 0){
            $data = isset($res['result'][0])?$res['result'][0]:"";
            return $this->result(array('data'=>$data))->json()->response();
        }else{
            return $this->result(array('data'=>''))->json()->response();
        }
    }
}