<?php

namespace MrwangTc\CompanyCertification;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

class CompanyCertification
{
    public static function routes(string $prefix = '')
    {
        Route::group([
            'namespace' => '\MrwangTc\CompanyCertification\Certification\Controller',
            'prefix'    => $prefix,
        ], function (Router $router) {
            $router->get('certification/company', 'CompanyCertificationController@index');
            $router->get('certification/company/create', 'CompanyCertificationController@create');
            $router->post('certification/company', 'CompanyCertificationController@store');
            $router->put('certification/company/{companycertification}', 'CompanyCertificationController@update');
        });
    }
}