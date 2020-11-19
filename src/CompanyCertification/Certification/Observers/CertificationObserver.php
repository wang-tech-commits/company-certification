<?php

namespace MrwangTc\CompanyCertification\Certification\Observers;

use MrwangTc\CompanyCertification\Certification\Contracts\VerifiedCertification;
use MrwangTc\CompanyCertification\Certification\Models\CompanyCertification;

class CertificationObserver
{
    public function creating(CompanyCertification $certification)
    {
        $certification->status = CompanyCertification::CERTIFICATION_CHECK;
    }

    public function created(CompanyCertification $certification)
    {
        $instance = config('companycertification.verified_class');
        if ($instance instanceof VerifiedCertification) {
            $instance->autoVerified($certification);
        }
    }
}
