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
            $router->get('companycertification', 'CompanyCertificationController@index');
            $router->get('companycertification/create', 'CompanyCertificationController@index');
            $router->post('companycertification', 'CompanyCertificationController@store');
            $router->put('companycertification/{companycertification}', 'CompanyCertificationController@update');
        });
    }
}