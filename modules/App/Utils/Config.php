<?php
namespace App\Utils;

/**
 * Class Config
 *
 * 执行Sample示例所需要的配置，用户在这里配置好Endpoint，AccessId， AccessKey和Sample示例操作的
 * bucket后，便可以直接运行RunAll.php, 运行所有的samples
 */
final class Config
{
    const OSS_ACCESS_ID = 'LTAIQqL13WHU9JkA';
    const OSS_ACCESS_KEY = 'Iiqj2kANqCY9lo7QGAZb4Emp0vWKfB';
    const OSS_ENDPOINT = 'http://oss-cn-hangzhou.aliyuncs.com';
    const OSS_TEST_BUCKET = 'http-xiyou';
    const OSS_MUDULE = 'xiyou';
    const OSS_ENV = 'dev';
}
