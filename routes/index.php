<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');

Route::group(['middleware' => ['auth:api']], function () {
    $this->get('/me', function (Request $request) {
        return $request->user();
    });

    $this->resource('/users', 'UserController', [
        'except' => ['create', 'store', 'edit']
    ]);

    $this->resource('/clients', 'ClientController', [
        'except' => ['create', 'edit']
    ]);

    $this->resource('/lendings', 'LendingController', [
        'except' => ['create', 'edit']
    ]);

    $this->get('/installments', 'InstallmentController@index');
});
