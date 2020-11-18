<?php

use MrwangTc\CompanyCertification\Certification\Models\CompanyCertification;

return [
    /**
     * 关联用户模型
     */
    'user_model'      => App\Models\User::class,

    /**
     * 企业代码类型
     */
    'company_code'    => [
        1 => '统一社会信用代码',
        2 => '组织机构代码',
        3 => '工商注册号',
    ],

    /**
     * 开启接口自动验证，为真时才走验证接口
     */
    'open_api_verify' => true,

    'verified_class' => new CompanyCertification(),

    /**
     * 调用阿里云市场个人认证接口的配置信息
     */
    'app_code'             => '',
    'app_url'              => '',

];