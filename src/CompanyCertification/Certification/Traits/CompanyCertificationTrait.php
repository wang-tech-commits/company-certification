<?php

namespace MrwangTc\CompanyCertification\Certification\Traits;


use MrwangTc\CompanyCertification\Certification\Models\CompanyCertification;

trait CompanyCertificationTrait
{
    public function pass()
    {
        if ($this->status != CompanyCertification::CERTIFICATION_CHECK) {
            return false;
        }
        $this->status = CompanyCertification::CERTIFICATION_PASS;

        return $this->save();
    }

    public function reject($reason)
    {
        if ($this->status != CompanyCertification::CERTIFICATION_CHECK) {
            return false;
        }
        $this->status = CompanyCertification::CERTIFICATION_REJECT;
        $this->reason = $reason;

        return $this->save();
    }
}