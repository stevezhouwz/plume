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
namespace TencentCloud\Cdb\V20170320\Models;
use TencentCloud\Common\AbstractModel;

/**
 * @method string getInstanceId() 获取实例ID，格式如：cdb-c1nl9rpv，与云数据库控制台页面中显示的实例ID相同，可使用[查询实例列表](https://cloud.tencent.com/document/api/236/15872) 接口获取，其值为输出参数中字段 InstanceId 的值。
 * @method void setInstanceId(string $InstanceId) 设置实例ID，格式如：cdb-c1nl9rpv，与云数据库控制台页面中显示的实例ID相同，可使用[查询实例列表](https://cloud.tencent.com/document/api/236/15872) 接口获取，其值为输出参数中字段 InstanceId 的值。
 * @method string getDstIp() 获取目标IP。该参数和DstPort参数，两者必传一个。
 * @method void setDstIp(string $DstIp) 设置目标IP。该参数和DstPort参数，两者必传一个。
 * @method integer getDstPort() 获取目标端口，支持范围为：[1024-65535]。该参数和DstIp参数，两者必传一个。
 * @method void setDstPort(integer $DstPort) 设置目标端口，支持范围为：[1024-65535]。该参数和DstIp参数，两者必传一个。
 * @method string getUniqVpcId() 获取私有网络统一ID。
 * @method void setUniqVpcId(string $UniqVpcId) 设置私有网络统一ID。
 * @method string getUniqSubnetId() 获取子网统一ID。
 * @method void setUniqSubnetId(string $UniqSubnetId) 设置子网统一ID。
 */

/**
 *ModifyDBInstanceVipVport请求参数结构体
 */
class ModifyDBInstanceVipVportRequest extends AbstractModel
{
    /**
     * @var string 实例ID，格式如：cdb-c1nl9rpv，与云数据库控制台页面中显示的实例ID相同，可使用[查询实例列表](https://cloud.tencent.com/document/api/236/15872) 接口获取，其值为输出参数中字段 InstanceId 的值。
     */
    public $InstanceId;

    /**
     * @var string 目标IP。该参数和DstPort参数，两者必传一个。
     */
    public $DstIp;

    /**
     * @var integer 目标端口，支持范围为：[1024-65535]。该参数和DstIp参数，两者必传一个。
     */
    public $DstPort;

    /**
     * @var string 私有网络统一ID。
     */
    public $UniqVpcId;

    /**
     * @var string 子网统一ID。
     */
    public $UniqSubnetId;
    /**
     * @param string $InstanceId 实例ID，格式如：cdb-c1nl9rpv，与云数据库控制台页面中显示的实例ID相同，可使用[查询实例列表](https://cloud.tencent.com/document/api/236/15872) 接口获取，其值为输出参数中字段 InstanceId 的值。
     * @param string $DstIp 目标IP。该参数和DstPort参数，两者必传一个。
     * @param integer $DstPort 目标端口，支持范围为：[1024-65535]。该参数和DstIp参数，两者必传一个。
     * @param string $UniqVpcId 私有网络统一ID。
     * @param string $UniqSubnetId 子网统一ID。
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

        if (array_key_exists("DstIp",$param) and $param["DstIp"] !== null) {
            $this->DstIp = $param["DstIp"];
        }

        if (array_key_exists("DstPort",$param) and $param["DstPort"] !== null) {
            $this->DstPort = $param["DstPort"];
        }

        if (array_key_exists("UniqVpcId",$param) and $param["UniqVpcId"] !== null) {
            $this->UniqVpcId = $param["UniqVpcId"];
        }

        if (array_key_exists("UniqSubnetId",$param) and $param["UniqSubnetId"] !== null) {
            $this->UniqSubnetId = $param["UniqSubnetId"];
        }
    }
}
