<?php

namespace MrwangTc\CompanyCertification\Certfication\Controller;

use Illuminate\Routing\Controller;
use Jason\Api;
use Jason\Api\Traits\ApiResponse;
use MrwangTc\CompanyCertification\Certification\Models\CompanyCertification;
use MrwangTc\CompanyCertification\Certification\Requests\CompanyCertificationRequest;
use MrwangTc\CompanyCertification\Certification\Resources\CertificationResource;

class CompanyCertificationController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $user = Api::user();

        return $this->success(new CertificationResource($user->companyCertification));
    }

    public function create()
    {
        $code = config('companycertification.company_code');
        return $this->success([
            'code_type' => $code,
        ]);
    }

    public function store(CompanyCertificationRequest $request)
    {
        $user = Api::user();
        if ($user->companyCertification) {
            return $this->failed('已有认证记录');
        }
        $result = CompanyCertification::create([
            'user_id'           => $user->id,
            'title'             => $request->title,
            'name'              => $request->name,
            'id_card'           => $request->id_card,
            'phone'             => $request->phone,
            'code_type'         => $request->code_type,
            'organization_code' => $request->organization_code,
            'status'            => CompanyCertification::CERTIFICATION_CHECK,
        ]);

        if ($result) {
            return $this->success('操作成功');
        } else {
            return $this->failed('操作失败');
        }
    }

    public function update(CompanyCertificationRequest $request, CompanyCertification $companycertification)
    {
        $user = Api::user();
        if ($user->is_company_verified) {
            return $this->failed('认证已通过，不能修改');
        }
        if ($user->companyCertification->id != $companycertification->id) {
            return $this->failed('未找到认证信息');
        }
        $result = $companycertification->update([
            'user_id'           => $user->id,
            'title'             => $request->title,
            'name'              => $request->name,
            'id_card'           => $request->id_card,
            'phone'             => $request->phone,
            'code_type'         => $request->code_type,
            'organization_code' => $request->organization_code,
            'status'            => CompanyCertification::CERTIFICATION_CHECK,
            'reason'            => '',
        ]);

        if ($result) {
            return $this->success('操作成功');
        } else {
            return $this->failed('操作失败');
        }
    }
}