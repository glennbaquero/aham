<?php

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
    return view('admin-master');
});


/****************************************
 * SUPER ADMIN ROUTES					*
 ****************************************/

Route::group(['prefix'=>'admin'], function(){

	/****************
	 * PERMISSION
	 ****************/
	Route::get('permission', 'PermissionController@index')->name('admin.permission');

	Route::get('roles', 'RoleController@index')->name('admin.roles');
	Route::get('roles/create', 'RoleController@create')->name('admin.roles.create');
	Route::post('roles/store', 'RoleController@store')->name('admin.roles.store');
	Route::get('roles/view/edit/{id}', 'RoleController@edit')->name('admin.roles.edit');
	Route::get('roles/view/{id}', 'RoleController@view')->name('admin.roles.view');
	Route::post('roles/update/{id}', 'RoleController@update')->name('admin.role.update');
	Route::post('roles/destroy/{id}', 'RoleController@destroy')->name('admin.role.destroy');

	Route::post('roles/fetch', 'Roles\RoleFetchController@fetch')->name('admin.roles.fetch');
	Route::post('roles/fetch/role/{id?}', 'Roles\RoleFetchController@fetchItem')->name('admin.role.fetch');
});

Route::get('/admin/admin-users', function () {
    return view('admin.superadmin.administrator.index');
})->name('admin.admin');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
