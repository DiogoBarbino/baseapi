<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('acl/user','Acl\UserController');
Route::get('acl/user/{user}/roles','Acl\UserController@roles')->name('user.roles');
Route::put('acl/user/{user}/roles/sync','Acl\UserController@rolesSync')->name('user.rolesSync');

Route::resource('acl/role','Acl\RoleController');
Route::get('acl/role/{role}/permissions','Acl\RoleController@permissions')->name('role.permissions');
Route::put('acl/role/{role}/permissions/sync','Acl\RoleController@permissionsSync')->name('role.permissionsSync');

Route::resource('acl/permission','Acl\PermissionController');