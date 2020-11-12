<?php

namespace MrwangTc\CompanyCertification\Certification\Requests;

use Illuminate\Foundation\Http\FormRequest;
use MrwangTc\UserCertification\Certification\Requests\IdCardRule;

class CompanyCertificationRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title'             => 'required',
            'name'              => 'required|min:2|max:5',
            'id_card'           => ['required', new IdCardRule()],
            'phone'             => 'required|phone:CN,mobile',
            'organization_code' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required'             => '企业名称必须填写',
            'name.required'              => '法人姓名必须填写',
            'name.min'                   => '法人姓名至少:min个字符',
            'name.max'                   => '法人姓名最多:max个字符',
            'id_card.required'           => '法人身份证号必须填写',
            'phone.required'             => '法人手机号必须填写',
            'phone.phone'                => '法人手机号校验不通过',
            'organization_code.required' => '组织代码必须填写',
        ];
    }
}