<?php
/*
 * Copyright (c) 2017-2018 THL A29 Limited, a Tencent company. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *    http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
namespace TencentCloud\Bm\V20180423\Models;
use TencentCloud\Common\AbstractModel;

/**
 * @method string getInstanceId() 获取运行脚本的设备ID
 * @method void setInstanceId(string $InstanceId) 设置运行脚本的设备ID
 * @method string getErrorMsg() 获取失败原因
 * @method void setErrorMsg(string $ErrorMsg) 设置失败原因
 */

/**
 *运行失败的自定义脚本信息
 */
class FailedTaskInfo extends AbstractModel
{
    /**
     * @var string 运行脚本的设备ID
     */
    public $InstanceId;

    /**
     * @var string 失败原因
     */
    public $ErrorMsg;
    /**
     * @param string $InstanceId 运行脚本的设备ID
     * @param string $ErrorMsg 失败原因
     */
    function __construct()
    {

    }
    /**
     * 内部实现，用户禁止调用
     */
    public function deserialize($param)
    {
        if ($param === null) {
            return;
        }
        if (array_key_exists("InstanceId",$param) and $param["InstanceId"] !== null) {
            $this->InstanceId = $param["InstanceId"];
        }

        if (array_key_exists("ErrorMsg",$param) and $param["ErrorMsg"] !== null) {
            $this->ErrorMsg = $param["ErrorMsg"];
        }
    }
}
