<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });



// Route::apiResource('post','Api\PostController');

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth/',
], function ($router) {
    Route::post('login', 'Api\AuthController@login')->name('api.login');
    Route::post('logout', 'Api\AuthController@logout')->name('api.logout');
    Route::post('refresh', 'Api\AuthController@refresh')->name('api.refresh');
    Route::post('me', 'Api\AuthController@me')->name('api.auth.me');

});

Route::group(['middleware'=>['apiJwt']],function(){
    // Route::get('post','Api\PostController@index');
});