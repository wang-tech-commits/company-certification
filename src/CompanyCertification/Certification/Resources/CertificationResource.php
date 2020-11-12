<?php

namespace MrwangTc\CompanyCertification\Certification\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CertificationResource extends JsonResource
{
    public function toArray($request)
    {
        $status = ($this->status == 2) ? true : false;

        return [
            'certification_id'  => $this->id,
            'title'             => $this->title,
            'name'              => $this->name,
            'idcard'            => $this->id_card,
            'phone'             => $this->phone,
            'code_type_text'    => $this->code_type_text,
            'code_type'         => $this->code_type,
            'status'            => $this->status_text,
            'organization_code' => $this->organization_code,
            'reason'            => $this->when($status, function(){
                return $this->reason;
            }),
            'created_at'        => (string) $this->created_at,
            'updated_at'        => (string) $this->updated_at,
        ];
    }
}
