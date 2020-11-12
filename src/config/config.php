<?php

return [
    /**
     * 关联用户模型
     */
    'user_model' => App\Models\User::class,

    /**
     * 企业代码类型
     */
    'company_code' => [
        1 => '统一社会信用代码',
        2 => '组织机构代码',
        3 => '工商注册号',
    ],
];