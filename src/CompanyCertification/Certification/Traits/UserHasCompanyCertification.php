<?php

namespace MrwangTc\CompanyCertification\Certification\Traits;

use Illuminate\Database\Eloquent\Relations\HasOne;
use MrwangTc\CompanyCertification\Certification\Models\CompanyCertification;

trait UserHasCompanyCertification
{
    public function companyCertification() :HasOne
    {
        return $this->hasOne(CompanyCertification::class);
    }

    public function getIsCompanyVerifiedAttribute()
    {
        return $this->companyCertification && ($this->companyCertification->status == 1);
    }
}