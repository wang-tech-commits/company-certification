<?php

namespace MrwangTc\CompanyCertification\Certification\Traits;

use GuzzleHttp\Client;
use MrwangTc\CompanyCertification\Certification\Models\CompanyCertification;

trait CompanyCertificationTrait
{

    protected $params       = [];

    protected $header       = [];

    protected $errorMessage = '';

    public function autoVerified($certification)
    {
        if (config('companycertification.open_api_verify') === true) {
            // 第三方接口调用
        }
    }

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

    protected function check($ComapnyName, $CreditCode, $LegalPersonName)
    {
        $apiUrl = config('companycertification.app_url');
        if (empty($apiUrl)) {
            $this->setErrorMessage('请配置接口地址');

            return false;
        }
        $apiCode = config('companycertification.app_code');
        if (empty($apiCode)) {
            $this->setErrorMessage('请配置接口Code');

            return false;
        }
        $this->setParams($ComapnyName, $CreditCode, $LegalPersonName);
        $this->setHeaders();
        $result = $this->dopost($apiUrl);
        try {

        } catch (\Exception $e) {
            return $result;
        }
    }

    protected function setParams($ComapnyName, $CreditCode, $LegalPersonName)
    {
        $this->params = [
            'ComapnyName'     => $ComapnyName,
            'CreditCode'      => $CreditCode,
            'LegalPersonName' => $LegalPersonName,
        ];
    }

    protected function setHeaders()
    {
        $this->header = [
            "Authorization" => 'APPCODE ' . config('companycertification.app_code'),
            "Accept"        => "application/json",
        ];
    }

    protected function dopost($url)
    {
        try {
            $Client   = new Client();
            $response = $Client->get($url . '?' . http_build_query($this->params), ['headers' => $this->header]);
            $result   = json_decode($response->getBody()->getContents());

            return $result;
        } catch (\Exception $e) {
            preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $e->getmessage(), $cn_name);
            $this->setErrorMessage($cn_name[0][0]);

            return false;
        }
    }

    protected function setErrorMessage($message)
    {
        $this->errorMessage = $message;
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

}