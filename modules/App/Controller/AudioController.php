<?php

namespace App\Controller;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use Plume\Core\Controller;

class AudioController extends Controller
{

    // 请求参数key
     const KEY_APP_KEY = "appkey";
     const KEY_FILE_LINK = "file_link";
     const KEY_VERSION = "version";
     const KEY_ENABLE_WORDS = "enable_words";
    // 响应参数key
     const KEY_TASK_ID = "TaskId";
     const KEY_STATUS_TEXT = "StatusText";
     const KEY_RESULT = "Result";
    // 状态值
     const STATUS_SUCCESS = "SUCCESS";
     const STATUS_RUNNING = "RUNNING";
     const STATUS_QUEUEING = "QUEUEING";


    function submitFileTransRequest($appKey, $fileLink) {
        // 获取task json字符串，包含appkey和file_link参数等；
        // 新接入请使用4.0版本，已接入(默认2.0)如需维持现状，请注释掉该参数设置
        // 设置是否输出词信息，默认为false，开启时需要设置version为4.0
        $taskArr = array(self::KEY_APP_KEY => $appKey, self::KEY_FILE_LINK => $fileLink, self::KEY_VERSION => "4.0", self::KEY_ENABLE_WORDS => FALSE);
        $task = json_encode($taskArr);

        try {
            // 提交请求，返回服务端的响应
            $submitTaskResponse = AlibabaCloud::nlsFiletrans()
                ->v20180817()
                ->submitTask()
                ->withTask($task)
                ->request();

            // 获取录音文件识别请求任务的ID，以供识别结果查询使用
            $taskId = NULL;
            $statusText = $submitTaskResponse[self::KEY_STATUS_TEXT];
            if (strcmp(self::STATUS_SUCCESS, $statusText) == 0) {
                $taskId = $submitTaskResponse[self::KEY_TASK_ID];
            }
            return $taskId;
        } catch (ClientException $exception) {
            // 获取错误消息
            print_r($exception->getErrorMessage());
        } catch (ServerException $exception) {
            // 获取错误消息
            print_r($exception->getErrorMessage());
        }
    }


    function getFileTransResult($taskId) {
        $result = NULL;
        while (TRUE) {
            try {

                $getResultResponse = AlibabaCloud::nlsFiletrans()
                    ->v20180817()
                    ->getTaskResult()
                    ->withTaskId($taskId)
                    ->request();

                $statusText = $getResultResponse[self::KEY_STATUS_TEXT];
                if (strcmp(self::STATUS_RUNNING, $statusText) == 0 || strcmp(self::STATUS_QUEUEING, $statusText) == 0) {
                    // 继续轮询
                    sleep(3);
                }
                else {
                    if (strcmp(self::STATUS_SUCCESS, $statusText) == 0) {
                        $result = $getResultResponse;
                    }
                    // 退出轮询
                    break;
                }
            } catch (ClientException $exception) {
                // 获取错误消息
                print_r($exception->getErrorMessage());
            } catch (ServerException $exception) {
                // 获取错误消息
                print_r($exception->getErrorMessage());
            }
        }
        return $result;
    }

    /**
     * 功能：1、阿里云语音识别为文字接口
     * @return mixed
     * @throws ClientException
     */
    public function indexAction(){
        $this->api();
        $accessKeyId = "LTAIQqL13WHU9JkA";
        $accessKeySecret = "Iiqj2kANqCY9lo7QGAZb4Emp0vWKfB";
        $appKey = "KwRKmbtdBB0JM9r3";
//        $fileLink = "http://nhds.oss-cn-hangzhou.aliyuncs.com/picture-wall/audio/kaimushi/test_81429855.mp3";
        $file = $_FILES['file'];

        $filename = time () . '@' . ".mp3";
        move_uploaded_file ( $file["tmp_name"],  $_SERVER ['DOCUMENT_ROOT'] . "/upload/mp3/" . $filename );
        $fileLink ="https://". $_SERVER['HTTP_HOST'] . "/upload/mp3/" . $filename;
        AlibabaCloud::accessKeyClient($accessKeyId, $accessKeySecret)
            ->regionId("cn-shanghai")
            ->asGlobalClient();

        $this->log("请求",['path'=>$fileLink]);

        $taskId = $this->submitFileTransRequest($appKey, $fileLink);
        $this->log("请求taskId",['taskId'=>$taskId]);
        if($taskId){
            $result = $this->getFileTransResult($taskId);
            $this->log("请求result",['result'=>$result]);
            $result = json_decode($result,true);
            $text = isset($result['Result']['Sentences'][0]['Text'])?$result['Result']['Sentences'][0]['Text']:"您说什么我听不清楚";
        }else{
            $text = "您说什么我听不清楚";
        }

       return $this->result(array('text'=>$text))->json()->response();
    }


}