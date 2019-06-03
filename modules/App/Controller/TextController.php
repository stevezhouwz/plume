<?php

namespace App\Controller;


use App\Utils\AipSpeech;
use Plume\Core\Controller;
use TencentCloud\Aai\V20180522\AaiClient;
use TencentCloud\Aai\V20180522\Models\TextToVoiceRequest;
use TencentCloud\Common\Credential;
use TencentCloud\Common\Exception\TencentCloudSDKException;
use TencentCloud\Common\Profile\ClientProfile;
use TencentCloud\Common\Profile\HttpProfile;


class TextController extends Controller
{
    public function __construct($app){
        parent::__construct($app, null);
    }

    /**
     * 功能：1、文字转换为语音demo页面
     * @return mixed
     */
    public function indexAction(){
        $text = isset($_REQUEST['text'])?$_REQUEST['text']:"哈哈哈哈哈哈哈，终于实现了";
        try{
            $cred = new Credential("AKIDpSq2B114JIcinfwbFfo1C85KYkrNtCXe", "wmMDqIaeT6aYZv481g9PpJQTSLi1AOUQ");
            $httpProfile = new HttpProfile();
            $httpProfile->setEndpoint("aai.ap-guangzhou.tencentcloudapi.com");

            $clientProfile = new ClientProfile();
            $clientProfile->setHttpProfile($httpProfile);
            $client = new AaiClient($cred, "ap-guangzhou", $clientProfile);

            $req = new TextToVoiceRequest();

            $params = '{"Text":"'.$text.'","SessionId":"SessionId-123","ModelType":1}';
            $req->fromJsonString($params);

            $resp = $client->TextToVoice($req);
            $bae64 = json_decode($resp->toJsonString(),true);
            $src = "data:audio/mp3;base64,".$bae64['Audio'];
            return $this->result(array('src'=>$src))->response();
        }catch (TencentCloudSDKException $e){
            echo $e;
        }

    }

    /**
     * 功能：1、文字转语音接口(腾讯)
     * @return mixed
     */
    public function audioAction(){
        $this->api();
        $text = isset($_REQUEST['text'])?$_REQUEST['text']:"";
        if(!$text){
            return $this->result(array('result'=>1006,'param'=>'param is null'))->json()->response();
        }
        try{
            $cred = new Credential("AKIDpSq2B114JIcinfwbFfo1C85KYkrNtCXe", "wmMDqIaeT6aYZv481g9PpJQTSLi1AOUQ");
            $httpProfile = new HttpProfile();
            $httpProfile->setEndpoint("aai.ap-guangzhou.tencentcloudapi.com");

            $clientProfile = new ClientProfile();
            $clientProfile->setHttpProfile($httpProfile);
            $client = new AaiClient($cred, "ap-guangzhou", $clientProfile);

            $req = new TextToVoiceRequest();

            $params = '{"Text":"'.$text.'","SessionId":"SessionId-123","ModelType":1}';

            $req->fromJsonString($params);

            $resp = $client->TextToVoice($req);
            $bae64 = json_decode($resp->toJsonString(),true);
            $src = "data:audio/mp3;base64,".$bae64['Audio'];
            $content = base64_decode($bae64['Audio']);

            $newfileName = time () . '@' . ".mp3";
            $path = $_SERVER ['DOCUMENT_ROOT'] . "/upload/mp3/";
            file_put_contents($path.$newfileName, $content);
            $fileLink ="https://". $_SERVER['HTTP_HOST'] . "/upload/mp3/" . $newfileName;
            return $this->result(array('src'=>$fileLink))->json()->response();
        }catch (TencentCloudSDKException $e){
            echo $e;
        }

    }

}