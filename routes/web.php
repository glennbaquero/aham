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

Auth::routes();
// Route::get('{slug}', 'PageController@show')->nme('slug');

Route::get('', 'HomeController@index')->name('home');

/****************************************
 * Login & Register  					*
 ****************************************/

Route::name('admin.')
->prefix('admin')
->namespace('Admins')
->group(function() {
	Route::get('login', 'Auth\LoginController@showLoginForm')->name('login.show');
	Route::post('login', 'Auth\LoginController@login')->name('login');
	Route::get('password/email', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.email.show');
	Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
	Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset.show');
	Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.reset');
});


/****************************************
 * ADMIN ROUTES 						*
 ****************************************/
Route::name('admin.')
->prefix('admin')
->middleware('admin_auth')
->namespace('Admins')
->group(function() {

	Route::get('/', 'DashboardController@index')->name('dashboard');
	Route::get('logout', 'Auth\LoginController@logout')->name('logout');

	/****************
	 * ADMINISTRATOR
	 ****************/
	Route::get('administrators', 'AdminController@index')->name('administrator');
	Route::get('administrator/create', 'AdminController@create')->name('administrator.create');
	Route::post('administrator/store', 'AdminController@store')->name('administrator.store');
	Route::get('administrator/view/edit/{id}', 'AdminController@edit')->name('administrator.edit');
	Route::post('administrator/update/{id}', 'AdminController@update')->name('administrator.update');
	Route::delete('administrator/destroy/{id}', 'AdminController@destroy')->name('administrator.destroy');
	Route::post('administrator/restore/{role}', 'AdminController@restore')->name('administrator.restore');

	Route::post('administrators/fetch/q', 'AdminFetchController@fetch')->name('administrators.fetch');
	Route::post('administrators/fetch/q?archive=1', 'AdminFetchController@fetch')->name('administrators.archive');
	Route::post('administrators/fetch/role/{id?}', 'AdminFetchController@fetchItem')->name('administrator.fetch');

	/****************
	 * PERMISSION
	 ****************/
	Route::post('permissions/update/{id}', 'PermissionController@update')->name('permissions.update');
	Route::post('permission/fetch/role/{id}', 'PermissionFetchController@fetchItem')->name('permissions.fetch');


	/****************
	 * ROLE
	 ****************/
	Route::get('roles', 'RoleController@index')->name('roles');
	Route::get('roles/create', 'RoleController@create')->name('roles.create');
	Route::post('roles/store', 'RoleController@store')->name('roles.store');
	Route::get('roles/view/edit/{id}', 'RoleController@edit')->name('roles.edit');
	Route::post('roles/update/{id}', 'RoleController@update')->name('role.update');
	Route::delete('roles/destroy/{id}', 'RoleController@destroy')->name('role.destroy');
	Route::post('roles/restore/{role}', 'RoleController@restore')->name('role.restore');

	Route::post('roles/fetch/q', 'RoleFetchController@fetch')->name('roles.fetch');
	Route::post('roles/fetch/q?archive=1', 'RoleFetchController@fetch')->name('roles.archive');
	Route::post('roles/fetch/role/{id?}', 'RoleFetchController@fetchItem')->name('role.fetch');


	Route::get('requests', 'RepairServiceRequestController@index')->name('request');
	Route::get('request/create', 'RepairServiceRequestController@create')->name('request.create');
	Route::post('request/store', 'RepairServiceRequestController@store')->name('request.store');
	Route::get('request/view/edit/{id}', 'RepairServiceRequestController@edit')->name('request.edit');
	Route::post('request/update/{id}', 'RepairServiceRequestController@update')->name('request.update');
	Route::delete('request/destroy/{id}', 'RepairServiceRequestController@destroy')->name('request.destroy');
	Route::post('request/restore/{id}', 'RepairServiceRequestController@restore')->name('request.restore');

	Route::post('requests/fetch/q', 'RepairServiceRequestFetchController@fetch')->name('requests.fetch');
	Route::post('requests/fetch/q?archive=1', 'RepairServiceRequestFetchController@fetch')->name('requests.archive');
	Route::post('requests/fetch/request/{id?}', 'RepairServiceRequestFetchController@fetchItem')->name('request.fetch');
	Route::post('requests/fetch/user', 'RepairServiceRequestFetchController@fetchUserInvoiceItems')->name('request.invoice');


	/****************
	 * PRODUCT
	 ****************/
	Route::post('product-image/{id}', 'ProductImageController@destroy')->name('product-image.destroy');

	Route::get('products', 'ProductController@index')->name('products.index');
	Route::get('product/edit/{id}', 'ProductController@edit')->name('product.edit');
	Route::get('product/create', 'ProductController@create')->name('product.create');
	Route::post('product/store', 'ProductController@store')->name('product.store');
	Route::post('product/update/{id}', 'ProductController@update')->name('product.update');
	Route::delete('product/{id}', 'ProductController@destroy')->name('product.destroy');
	Route::post('product/restore/{user}', 'ProductController@restore')->name('product.restore');

	Route::post('products/fetch/q', 'ProductFetchController@fetch')->name('products.fetch');
	Route::post('products/fetch/q?archive=1', 'ProductFetchController@fetch')->name('products.archive');
	Route::post('products/fetch/{id?}', 'ProductFetchController@fetchItem')->name('product.fetch');


	/****************
	 * CATEGORY
	 ****************/
	Route::get('categories', 'CategoryController@index')->name('categories.index');
	Route::get('categories/edit/{id}', 'CategoryController@edit')->name('categories.edit');
	Route::get('categories/create', 'CategoryController@create')->name('categories.create');
	Route::post('categories/store', 'CategoryController@store')->name('categories.store');
	Route::post('categories/update/{id}', 'CategoryController@update')->name('categories.update');
	Route::delete('categories/{id}', 'CategoryController@destroy')->name('categories.destroy');
	Route::post('categories/restore/{user}', 'CategoryController@restore')->name('categories.restore');

	Route::post('categories/fetch/q', 'CategoryFetchController@fetch')->name('categories.fetch');
	Route::post('categories/fetch/q?archive=1', 'CategoryFetchController@fetch')->name('categories.archive');
	Route::post('categories/fetch/{id?}', 'CategoryFetchController@fetchItem')->name('category.fetch');


	/****************
	 * TYPE
	 ****************/
	Route::get('types', 'TypeController@index')->name('types.index');
	Route::get('types/edit/{id}', 'TypeController@edit')->name('types.edit');
	Route::get('types/create', 'TypeController@create')->name('types.create');
	Route::post('types/store', 'TypeController@store')->name('types.store');
	Route::post('types/update/{id}', 'TypeController@update')->name('types.update');
	Route::delete('types/{id}', 'TypeController@destroy')->name('types.destroy');
	Route::post('types/restore/{user}', 'TypeController@restore')->name('types.restore');

	Route::post('types/fetch/q', 'TypeFetchController@fetch')->name('types.fetch');
	Route::post('types/fetch/q?archive=1', 'TypeFetchController@fetch')->name('types.archive');
	Route::post('types/fetch/{id?}', 'TypeFetchController@fetchItem')->name('type.fetch');

	Route::post('image/store', 'ProductImageController@store')->name('image.store');


	/****************
	 * CMS
	 ****************/
	Route::get('carousel', 'CarouselController@index')->name('carousel.index');
	Route::get('carousel/edit/{id}', 'CarouselController@edit')->name('carousel.edit');
	Route::get('carousel/create', 'CarouselController@create')->name('carousel.create');
	Route::post('carousel/store', 'CarouselController@store')->name('carousel.store');
	Route::post('carousel/update/{id}', 'CarouselController@update')->name('carousel.update');
	Route::delete('carousel/destroy/{id}', 'CarouselController@destroy')->name('carousel.destroy');
	Route::post('carousel/restore/{id}', 'CarouselController@restore')->name('carousel.restore');

	Route::post('carousel/{id}', 'CarouselImageController@destroy')->name('carousel.destroy');

	Route::post('carousels/fetch/q', 'CarouselFetchController@fetch')->name('carousels.fetch');
	Route::post('carousels/fetch/q?archive=1', 'CarouselFetchController@fetch')->name('carousels.archive');
	Route::post('carousels/fetch/carousel/{id?}', 'CarouselFetchController@fetchItem')->name('carousel.fetch');

	Route::get('pages', 'PageController@index')->name('pages.index');
	Route::get('pages/create', 'PageController@create')->name('pages.create');
	Route::post('pages/store', 'PageController@store')->name('pages.store');
	Route::get('pages/{id}', 'PageController@edit')->name('pages.edit');
	Route::post('pages/{id}', 'PageController@update')->name('pages.update');
	Route::delete('pages/{id}', 'PageController@destroy')->name('pages.destroy');
	Route::post('pages/restore/{user}', 'PageController@restore')->name('pages.restore');

	Route::post('pages/fetch/q', 'PageFetchController@fetch')->name('pages.fetch');
	Route::post('pages/fetch/q?archive=1', 'PageFetchController@fetch')->name('pages.fetch.archive');
	Route::post('pages/fetch/pages/{id?}', 'PageFetchController@fetchItem')->name('page.fetch');


	Route::get('page-items', 'PageItemController@index')->name('page-items.index');
	Route::get('page-items/create', 'PageItemController@create')->name('page-items.create');
	Route::post('page-items/store', 'PageItemController@store')->name('page-items.store');
	Route::get('page-items/{id}', 'PageItemController@edit')->name('page-items.edit');
	Route::post('page-items/{id}', 'PageItemController@update')->name('page-items.update');
	Route::delete('page-items/{id}', 'PageItemController@destroy')->name('page-items.destroy');
	Route::post('page-items/restore/{user}', 'PageItemController@restore')->name('page-items.restore');

	Route::post('page-items/fetch/q', 'PageItemFetchController@fetch')->name('page-items.fetch');
	Route::post('page-items/fetch/q?archive=1', 'PageItemFetchController@fetch')->name('page-items.fetch.archive');
	Route::post('page-items/fetch/q?page_id={id}', 'PageItemFetchController@fetch')->name('page-items.fetch.page');
	Route::post('page-items/fetch/page-items/{id?}', 'PageItemFetchController@fetchItem')->name('page-item.fetch');
});
