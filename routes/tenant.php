<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/
// user api


Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        // App\Models\Tenant::all()->runForEach(function () {
        //     App\Models\User::factory()->create();
        // });
        // return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');

    });
    Route::get('/register', function () {
        return view('usertenantregister');
    });
    Route::get('/login', function () {
        return view('usertenantlogin');
    });
    Route::get('/profile','App\Http\Controllers\UserLoginRegisterController@profile');
    Route::post('tenant/user/register','App\Http\Controllers\UserLoginRegisterController@register');
    Route::post('tenant/user/login','App\Http\Controllers\UserLoginRegisterController@login');
    Route::post('tenant/user/profile','App\Http\Controllers\UserLoginRegisterController@profileImage');
    Route::post('tenant/user/update','App\Http\Controllers\UserLoginRegisterController@update');


});
// end user api
// domain api

Route::post('tenant/register','App\Http\Controllers\TenantRegisterController@register');

Route::post('tenant/login','App\Http\Controllers\TenantRegisterController@login');
Route::get('tenant/domain/login', function () {
            return view('tenantlogin');
        });
// end domain api

