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
// Route::get('{slug}', 'PageController@show')->name('slug');

Route::get('', 'HomeController@index')->name('home');

/****************************************
 * SUPER ADMIN ROUTES					*
 ****************************************/
Route::name('admin.')
->prefix('admin')
->namespace('Admins')
->group(function() {
	Route::get('login', 'Auth\LoginController@showLoginForm')->name('login.show');
	Route::post('login', 'Auth\LoginController@login')->name('login');
});


/****************************************
 * REGULAR ADMIN ROUTES					*
 ****************************************/
Route::prefix('admin')
->middleware('admin_auth')
->namespace('Admins')
->group(function() {

	Route::name('admin.')
	->group(function() {
		Route::get('/', 'DashboardController@index')->name('dashboard');
		Route::get('logout', 'Auth\LoginController@logout')->name('logout');

		/****************
		 * PERMISSION
		 ****************/
		Route::get('permission', 'PermissionController@index')->name('permission');

		Route::get('roles', 'RoleController@index')->name('roles');
		Route::get('roles/create', 'RoleController@create')->name('roles.create');
		Route::post('roles/store', 'RoleController@store')->name('roles.store');
		Route::get('roles/view/edit/{id}', 'RoleController@edit')->name('roles.edit');
		Route::get('roles/view/{id}', 'RoleController@view')->name('roles.view');
		Route::post('roles/update/{id}', 'RoleController@update')->name('role.update');
		Route::post('roles/destroy/{id}', 'RoleController@destroy')->name('role.destroy');

		Route::post('roles/fetch', 'RoleFetchController@fetch')->name('roles.fetch');
		Route::post('roles/fetch/role/{id?}', 'RoleFetchController@fetchItem')->name('role.fetch');
	});
	/****************
	 * PRODUCT
	 ****************/
	Route::post('product-image/{id}', 'ProductImageController@destroy')->name('product-image.destroy');

	Route::get('products', 'ProductController@index')->name('regular.products.index');
	Route::get('product/edit/{id}', 'ProductController@edit')->name('regular.product.edit');
	Route::get('product/create', 'ProductController@create')->name('regular.product.create');
	Route::post('product/store', 'ProductController@store')->name('regular.product.store');
	Route::post('product/update/{id}', 'ProductController@update')->name('regular.product.update');
	Route::delete('product/{id}', 'ProductController@destroy')->name('regular.product.destroy');
	Route::post('product/restore/{user}', 'ProductController@restore')->name('regular.product.restore');

	Route::post('products/fetch/q', 'ProductFetchController@fetch')->name('regular.products.fetch');
	Route::post('products/fetch/q?archive=1', 'ProductFetchController@fetch')->name('regular.products.archive');
	Route::post('products/fetch/{id?}', 'ProductFetchController@fetchItem')->name('regular.product.fetch');


	/****************
	 * CATEGORY
	 ****************/
	Route::get('categories', 'CategoryController@index')->name('regular.categories.index');
	Route::get('categories/edit/{id}', 'CategoryController@edit')->name('regular.categories.edit');
	Route::get('categories/create', 'CategoryController@create')->name('regular.categories.create');
	Route::post('categories/store', 'CategoryController@store')->name('regular.categories.store');
	Route::post('categories/update/{id}', 'CategoryController@update')->name('regular.categories.update');
	Route::delete('categories/{id}', 'CategoryController@destroy')->name('regular.categories.destroy');
	Route::post('categories/restore/{user}', 'CategoryController@restore')->name('regular.categories.restore');

	Route::post('categories/fetch/q', 'CategoryFetchController@fetch')->name('regular.categories.fetch');
	Route::post('categories/fetch/q?archive=1', 'CategoryFetchController@fetch')->name('regular.categories.archive');
	Route::post('categories/fetch/{id?}', 'CategoryFetchController@fetchItem')->name('regular.category.fetch');


	/****************
	 * TYPE
	 ****************/
	Route::get('types', 'TypeController@index')->name('regular.types.index');
	Route::get('types/edit/{id}', 'TypeController@edit')->name('regular.types.edit');
	Route::get('types/create', 'TypeController@create')->name('regular.types.create');
	Route::post('types/store', 'TypeController@store')->name('regular.types.store');
	Route::post('types/update/{id}', 'TypeController@update')->name('regular.types.update');
	Route::delete('types/{id}', 'TypeController@destroy')->name('regular.types.destroy');
	Route::post('types/restore/{user}', 'TypeController@restore')->name('regular.types.restore');

	Route::post('types/fetch/q', 'TypeFetchController@fetch')->name('regular.types.fetch');
	Route::post('types/fetch/q?archive=1', 'TypeFetchController@fetch')->name('regular.types.archive');
	Route::post('types/fetch/{id?}', 'TypeFetchController@fetchItem')->name('regular.type.fetch');

	Route::post('image/store', 'ProductImageController@store')->name('regular.image.store');


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

	Route::post('carousels/fetch/q', 'CarouselFetchController@fetch')->name('regular.carousels.fetch');
	Route::post('carousels/fetch/q?archive=1', 'CarouselFetchController@fetch')->name('regular.carousels.archive');
	Route::post('carousels/fetch/carousel/{id?}', 'CarouselFetchController@fetchItem')->name('regular.carousel.fetch');

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
