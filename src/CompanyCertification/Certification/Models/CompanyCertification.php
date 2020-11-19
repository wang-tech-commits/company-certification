<?php

namespace MrwangTc\CompanyCertification\Certification\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;
use MrwangTc\CompanyCertification\Certification\Traits\CompanyCertificationTrait;

class CompanyCertification extends Model
{
    use CompanyCertificationTrait,
        DefaultDatetimeFormat;

    const CERTIFICATION_CHECK  = 0;
    const CERTIFICATION_PASS   = 1;
    const CERTIFICATION_REJECT = 2;

    const STATUS = [
        0 => '审核中',
        1 => '认证通过',
        2 => '驳回',
    ];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(config('companycertification.user_model'));
    }

    protected function getCodeTypeTextAttribute()
    {
        return config('companycertification.company_code')[$this->code_type];
    }

    protected function getStatusTextAttribute()
    {
        return CompanyCertification::STATUS[$this->status];
    }

}
