<?php
/**
 * Created by PhpStorm.
 * User: zhou
 * Date: 2019-05-21
 * Time: 14:03
 */
namespace Oss\Utils;

use OSS\Core\OssException;
use OSS\OssClient;


Class Ossupload{

    const endpoint = Config::OSS_ENDPOINT;
    const accessKeyId = Config::OSS_ACCESS_ID;
    const accessKeySecret = Config::OSS_ACCESS_KEY;
    const bucket = Config::OSS_TEST_BUCKET;
    const module = Config::OSS_MUDULE;
    const env = Config::OSS_ENV;

    /**
     * 功能：1、创建ossClient
     * @return \OSS\OssClient|null
     * @throws \OSS\Core\OssException
     */
    public static function getOssClient()
    {
        try {
            $ossClient = new  OssClient(self::accessKeyId, self::accessKeySecret, self::endpoint, false);
        } catch (OssException $e) {
            printf(__FUNCTION__ . "creating OssClient instance: FAILED\n");
            printf($e->getMessage() . "\n");
            return null;
        }
        return $ossClient;
    }

    /**
     * 功能：1、创建bucket
     *      name bucket名称、
     *      acl权限（private、public-read、public-read-write）
     * @param $name
     * @param $acl
     * @return null
     */
    public function createBucket($name,$acl){
        $pattern = "/^[a-z0-9][[a-z0-9\-]{1,61}[a-z0-9]$/";
        if(!preg_match($pattern, $name)) {
            return false;
        }

        try{
            if($this->getClient()->doesBucketExist($name))
                return false;
            $ossClient = self::getOssClient();
            $res = $ossClient->createBucket($name,$acl);
        }catch (OssException $e){
            printf(__FUNCTION__ . "createBucket failed: FAILED\n");
            printf($e->getMessage() . "\n");
            return null;
        }
        return $res;
    }

    /**
     * 功能：1、删除bucket
     * @param $name
     * @return bool
     * @throws \OSS\Core\OssException
     */
    public function deleteBucket($name){
        try {
           self::getOssClient()->deleteBucket($name);
        }catch (OssException $e) {
            return false;
        }

        return true;
    }

    /**
     * 功能：1、简单上传
     * @param $name
     * @param $filePath
     * @param $type
     * @return bool|null
     */
    public function uploadFile($name,$filePath,$type){

        $tmp = explode('/', $type);
        $type = $tmp[0];
        $filename = time().'@'.$name;
        $obiect = self::module."/".self::env."/".$type.'/'.$filename;
        $filePath = $filePath;

        try{
            $ossClient = self::getOssClient();
            $res = $ossClient->uploadFile(self::bucket,$obiect,$filePath);
        }catch (OssException $e){
            printf(__FUNCTION__ . "createBucket failed: FAILED\n");
            printf($e->getMessage() . "\n");
            return $e->getMessage();
        }
        return $res;
    }
}