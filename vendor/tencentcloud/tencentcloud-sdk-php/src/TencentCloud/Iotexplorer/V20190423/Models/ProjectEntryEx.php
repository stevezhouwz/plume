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
namespace TencentCloud\Iotexplorer\V20190423\Models;
use TencentCloud\Common\AbstractModel;

/**
 * @method integer getProjectId() 获取项目ID
 * @method void setProjectId(integer $ProjectId) 设置项目ID
 * @method string getProjectName() 获取项目名称
 * @method void setProjectName(string $ProjectName) 设置项目名称
 * @method string getProjectDesc() 获取项目描述
 * @method void setProjectDesc(string $ProjectDesc) 设置项目描述
 * @method integer getCreateTime() 获取项目创建时间，unix时间戳
 * @method void setCreateTime(integer $CreateTime) 设置项目创建时间，unix时间戳
 * @method integer getUpdateTime() 获取项目更新时间，unix时间戳
 * @method void setUpdateTime(integer $UpdateTime) 设置项目更新时间，unix时间戳
 * @method integer getProductCount() 获取产品数量
 * @method void setProductCount(integer $ProductCount) 设置产品数量
 * @method integer getNativeAppCount() 获取NativeApp数量
 * @method void setNativeAppCount(integer $NativeAppCount) 设置NativeApp数量
 * @method integer getWebAppCount() 获取WebApp数量
 * @method void setWebAppCount(integer $WebAppCount) 设置WebApp数量
 */

/**
 *项目详情
 */
class ProjectEntryEx extends AbstractModel
{
    /**
     * @var integer 项目ID
     */
    public $ProjectId;

    /**
     * @var string 项目名称
     */
    public $ProjectName;

    /**
     * @var string 项目描述
     */
    public $ProjectDesc;

    /**
     * @var integer 项目创建时间，unix时间戳
     */
    public $CreateTime;

    /**
     * @var integer 项目更新时间，unix时间戳
     */
    public $UpdateTime;

    /**
     * @var integer 产品数量
     */
    public $ProductCount;

    /**
     * @var integer NativeApp数量
     */
    public $NativeAppCount;

    /**
     * @var integer WebApp数量
     */
    public $WebAppCount;
    /**
     * @param integer $ProjectId 项目ID
     * @param string $ProjectName 项目名称
     * @param string $ProjectDesc 项目描述
     * @param integer $CreateTime 项目创建时间，unix时间戳
     * @param integer $UpdateTime 项目更新时间，unix时间戳
     * @param integer $ProductCount 产品数量
     * @param integer $NativeAppCount NativeApp数量
     * @param integer $WebAppCount WebApp数量
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
        if (array_key_exists("ProjectId",$param) and $param["ProjectId"] !== null) {
            $this->ProjectId = $param["ProjectId"];
        }

        if (array_key_exists("ProjectName",$param) and $param["ProjectName"] !== null) {
            $this->ProjectName = $param["ProjectName"];
        }

        if (array_key_exists("ProjectDesc",$param) and $param["ProjectDesc"] !== null) {
            $this->ProjectDesc = $param["ProjectDesc"];
        }

        if (array_key_exists("CreateTime",$param) and $param["CreateTime"] !== null) {
            $this->CreateTime = $param["CreateTime"];
        }

        if (array_key_exists("UpdateTime",$param) and $param["UpdateTime"] !== null) {
            $this->UpdateTime = $param["UpdateTime"];
        }

        if (array_key_exists("ProductCount",$param) and $param["ProductCount"] !== null) {
            $this->ProductCount = $param["ProductCount"];
        }

        if (array_key_exists("NativeAppCount",$param) and $param["NativeAppCount"] !== null) {
            $this->NativeAppCount = $param["NativeAppCount"];
        }

        if (array_key_exists("WebAppCount",$param) and $param["WebAppCount"] !== null) {
            $this->WebAppCount = $param["WebAppCount"];
        }
    }
}
