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

Route::group(['prefix' => 'admin'], function(){

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

/****************************************
 * REGULAR ADMIN ROUTES					*
 ****************************************/
Route::group(['prefix' => 'regular-admin'], function(){
	/****************
	 * PRODUCT
	 ****************/
	Route::get('products', 'ProductController@index')->name('regular.products.index');
	Route::get('product/edit/{id}', 'ProductController@show')->name('regular.product.view');
	Route::get('product/create', 'ProductController@create')->name('regular.product.create');
	Route::post('product/store', 'ProductController@store')->name('regular.product.store');
	Route::post('product/update/{id}', 'ProductController@update')->name('regular.product.update');

	Route::post('products/fetch', 'Products\ProductFetchController@fetch')->name('regular.products.fetch');
	Route::post('products/fetch/{id?}', 'Products\ProductFetchController@fetchItem')->name('regular.products.fetch');

	/****************
	 * CATEGORY
	 ****************/
	Route::get('categories', 'CategoryController@index')->name('regular.categories.index');
	Route::get('categories/edit/{id}', 'CategoryController@show')->name('regular.categories.view');
	Route::get('categories/create', 'CategoryController@create')->name('regular.categories.create');
	Route::post('categories/store', 'CategoryController@store')->name('regular.categories.store');
	Route::post('categories/update/{id}', 'CategoryController@update')->name('regular.categories.update');

	Route::post('categories/fetch', 'Categories\CategoryFetchController@fetch')->name('regular.categories.fetch');
	Route::post('categories/fetch/{id?}', 'Categories\CategoryFetchController@fetchItem')->name('regular.categories.fetch');

	/****************
	 * TYPE
	 ****************/
	Route::get('types', 'TypeController@index')->name('regular.types.index');
	Route::get('types/edit/{id}', 'TypeController@show')->name('regular.types.view');
	Route::get('types/create', 'TypeController@create')->name('regular.types.create');
	Route::post('types/store', 'TypeController@store')->name('regular.types.store');
	Route::post('types/update/{id}', 'TypeController@update')->name('regular.types.update');

	Route::post('types/fetch', 'Types\TypeFetchController@fetch')->name('regular.types.fetch');
	Route::post('types/fetch/{id?}', 'Types\TypeFetchController@fetchItem')->name('regular.types.fetch');


	Route::post('image/store', 'ProductImageController@store')->name('regular.image.store');
});

Route::get('/admin/admin-users', function () {
    return view('admin.superadmin.administrator.index');
})->name('admin.admin');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
