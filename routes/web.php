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
Route::get('{slug}', 'PageController@show');

Route::get('', 'HomeController@index')->name('home');

Route::get('/selected', function () {
    return view('public.pages.product-selected-page');
});


Route::get('user/extended', function () {
    return view('public.pages.extended-warranty-page');
});

Route::post('locations/fetch', 'LocationFetchController@fetch')->name('public.locations.fetch');
Route::post('contactus/message', 'MessageController@sendmessage')->name('contactus.message');

Route::group(['middleware' => ['auth']],function(){
		Route::get('user/profile', 'PageController@profile')->name('user.profile');
		Route::get('user/fetch', 'UserController@fetchDetails')->name('user.fetch.details');
		Route::post('user/update/{id}', 'UserController@update')->name('user.update');
		Route::post('user/updatepassword/{id}', 'UserController@updatepassword')->name('user.update.password');
		Route::get('user/basic/', 'PageController@basic')->name('user.basic');
		Route::get('user/basic/{id}', 'PageController@basic')->name('user.basic.id');
		Route::get('product/fetch/basic', 'Admins\ProductController@warrantyproductfetch')->name('fetch.product');
		Route::post('product/basic', 'UserController@oneyearwarranty')->name('apply.oneyear.warranty');
		Route::get('user/products', 'UserController@userproduct')->name('user.products');
		Route::post('user/products/fetch', 'UserProductFetchController@fetch')->name('user.products.fetch');
		Route::get('user/checkout/{id}', 'Admins\InvoiceController@checkout')->name('checkout');
		Route::get('checkout/fetch/{id}', 'Admins\InvoiceController@checkoutfetch')->name('checkout.fetch');
		Route::post('checkout/process', 'CheckoutController@processCheckout')->name('checkout.process');
		Route::post('ipay/process', 'CheckoutController@ipayProcess')->name('ipay.process');
		Route::post('ipay/return', 'CheckoutController@ipayReturn')->name('ipay.return');
		Route::get('user/extended', 'PageController@extended')->name('user.extended');
		Route::get('user/extended/{id}', 'PageController@extended')->name('user.extended.id');
		Route::post('user/extended', 'UserController@extendedwarranty')->name('apply.extended.warranty');
});

Route::get('products/view/{id}', 'Admins\ProductController@view')->name('view.product');
Route::post('products/fetch', 'ProductFetchController@fetch')->name('public.products.fetch');
Route::post('products/fetch/filters', 'ProductFetchController@fetchFilters')->name('public.products.filters');
Route::get('products/category/{id}', 'Admins\CategoryController@viewAllProduct')->name('category.all.product');
Route::get('product/manual/{id}', 'Admins\ProductController@downloadmanual')->name('download.manual');

Route::group(['middleware' => ['guest']],function(){
		Route::get('user/signup', 'PageController@signup')->name('signup');
		Route::post('user/register', 'Auth\RegisterController@create')->name('register');
		Route::get('/user/verification/{token}', 'UserController@verifyAccount')->name('email.verification');
		
		Route::get('user/forgot/password', function(){
			return view('auth.passwords.email');
		})->name('forgot.password');

		Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.reset');
});

Route::get('user/logout', function(){
    \Auth::logout();
    return redirect()->route('home');
})->name('user.logout');


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

	Route::get('dashboard', 'DashboardController@index')->name('dashboard');
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

	/**====================================
	 * @Activity Log Controllers
	 ======================================*/
	Route::get('activity-logs', 'ActivityLogController@index')->name('activity-logs.index');

	/**
	 * @Acitivity Fetch Controllers
	 */
	Route::post('activity-logs/fetch/q', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch');


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
	 * APPLICATION
	 ****************/
	Route::get('applications', 'InvoiceController@index')->name('application');
	Route::get('application/edit/{id}', 'InvoiceController@edit')->name('application.approve');
	Route::post('application/update/{id}', 'InvoiceController@update')->name('application.update');
	Route::delete('application/destroy/{id}', 'InvoiceController@destroy')->name('application.destroy');
	Route::post('application/restore/{id}', 'InvoiceController@restore')->name('application.restore');

	Route::post('applications/fetch/q', 'InvoiceFetchController@fetch')->name('applications.fetch');
	Route::post('applications/fetch/q?archive=1', 'InvoiceFetchController@fetch')->name('applications.archive');
	Route::post('application/fetch/q', 'InvoiceFetchController@fetch')->name('application.fetch');
	Route::post('application/fetch/application/{id?}', 'InvoiceFetchController@fetchItem')->name('application.fetch');

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
	Route::get('product/upload', 'ProductController@upload')->name('product.upload');
	Route::post('products/upload', 'ProductController@uploadproduct')->name('products.upload');
	Route::get('product/featured/{product}', 'ProductController@featuredproduct')->name('product.featured');

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
	Route::get('category/upload', 'CategoryController@upload')->name('category.upload');
	Route::post('categories/upload', 'CategoryController@uploadcategory')->name('categories.upload');

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
	Route::get('type/upload', 'TypeController@upload')->name('type.upload');
	Route::post('types/upload', 'TypeController@uploadtype')->name('types.upload');

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

	Route::get('faqs', 'FaqController@index')->name('faqs.index');
	Route::get('faqs/create', 'FaqController@create')->name('faqs.create');
	Route::post('faqs/store', 'FaqController@store')->name('faqs.store');
	Route::get('faqs/{id}', 'FaqController@edit')->name('faqs.edit');
	Route::post('faqs/{id}', 'FaqController@update')->name('faqs.update');
	Route::delete('faqs/{id}', 'FaqController@destroy')->name('faqs.destroy');
	Route::post('faqs/restore/{user}', 'FaqController@restore')->name('faqs.restore');

	Route::post('faqs/fetch/q', 'FaqFetchController@fetch')->name('faqs.fetch');
	Route::post('faqs/fetch/q?archive=1', 'FaqFetchController@fetch')->name('faqs.archive');
	Route::post('faqs/fetch/q?faqs={id}', 'FaqFetchController@fetch')->name('faqs.fetch.page');
	Route::post('faqs/fetch/faqs/{id?}', 'FaqFetchController@fetchItem')->name('faq.fetch');

	Route::get('contacts', 'ContactUsController@index')->name('contacts.index');
	Route::get('contacts/create', 'ContactUsController@create')->name('contacts.create');
	Route::post('contacts/store', 'ContactUsController@store')->name('contacts.store');
	Route::get('contacts/{id}', 'ContactUsController@edit')->name('contacts.edit');
	Route::post('contacts/{id}', 'ContactUsController@update')->name('contacts.update');
	Route::delete('contacts/{id}', 'ContactUsController@destroy')->name('contacts.destroy');
	Route::post('contacts/restore/{user}', 'ContactUsController@restore')->name('contacts.restore');

	Route::post('contacts/fetch/q', 'ContactUsFetchController@fetch')->name('contacts.fetch');
	Route::post('contacts/fetch/q?archive=1', 'ContactUsFetchController@fetch')->name('contacts.archive');
	Route::post('contacts/fetch/q?contacts={id}', 'ContactUsFetchController@fetch')->name('contacts.fetch.page');
	Route::post('contacts/fetch/contacts/{id?}', 'ContactUsFetchController@fetchItem')->name('contact.fetch');

	Route::get('locations', 'LocationController@index')->name('locations.index');
	Route::get('locations/create', 'LocationController@create')->name('locations.create');
	Route::post('locations/store', 'LocationController@store')->name('locations.store');
	Route::get('locations/{id}', 'LocationController@edit')->name('locations.edit');
	Route::post('locations/{id}', 'LocationController@update')->name('locations.update');
	Route::delete('locations/{id}', 'LocationController@destroy')->name('locations.destroy');
	Route::post('locations/restore/{user}', 'LocationController@restore')->name('locations.restore');

	Route::post('locations/fetch/q', 'LocationFetchController@fetch')->name('locations.fetch');
	Route::post('locations/fetch/positions', 'LocationFetchController@fetchPositions')->name('locations.fetch-positions');
	Route::post('locations/fetch/q?archive=1', 'LocationFetchController@fetch')->name('locations.fetch.archive');
	Route::post('locations/fetch/q?page_id={id}', 'LocationFetchController@fetch')->name('locations.fetch.page');
	Route::post('locations/fetch/locations/{id?}', 'LocationFetchController@fetchItem')->name('location.fetch');

	Route::get('discounts', 'DiscountController@index')->name('discounts');
	Route::get('discount/create', 'DiscountController@create')->name('discount.create');
	Route::post('discount/store', 'DiscountController@store')->name('discount.store');
	Route::get('discount/{id}', 'DiscountController@edit')->name('discount.edit');
	Route::post('discount/{id}', 'DiscountController@update')->name('discount.update');
	Route::delete('discount/{id}', 'DiscountController@destroy')->name('discount.destroy');
	Route::post('discount/restore/{user}', 'DiscountController@restore')->name('discount.restore');

	Route::post('discounts/fetch/q', 'DiscountFetchController@fetch')->name('discounts.fetch');
	Route::post('discounts/fetch/q?archive=1', 'DiscountFetchController@fetch')->name('discounts.archive');
	Route::post('discount/fetch/q?discount={id}', 'DiscountFetchController@fetch')->name('discount.fetch.page');
	Route::post('discount/fetch/discount/{id?}', 'DiscountFetchController@fetchItem')->name('discount.fetch');

	Route::get('users', 'UserController@index')->name('users.index');
	Route::get('users/create', 'UserController@create')->name('users.create');
	Route::get('users/{id}', 'UserController@edit')->name('users.edit');
	Route::delete('users/{id}', 'UserController@destroy')->name('users.destroy');
	Route::post('users/restore/{user}', 'UserController@restore')->name('users.restore');

	Route::post('users/fetch/q', 'UserFetchController@fetch')->name('users.fetch');
	Route::post('users/fetch/q?archive=1', 'UserFetchController@fetch')->name('users.fetch.archive');
	Route::post('users/fetch/users/{id?}', 'UserFetchController@fetchItem')->name('user.fetch');


	/****************
	 * EMPLOYEE
	 ****************/
	Route::get('employees', 'EmployeeController@index')->name('employee.index');
	Route::get('employee/create', 'EmployeeController@create')->name('employee.create');
	Route::post('employee/store', 'EmployeeController@store')->name('employee.store');
	Route::get('employee/{id}', 'EmployeeController@edit')->name('employee.edit');
	Route::post('employee/{id}', 'EmployeeController@update')->name('employee.update');
	Route::delete('employee/{id}', 'EmployeeController@destroy')->name('employee.destroy');
	Route::post('employee/restore/{employee}', 'EmployeeController@restore')->name('employee.restore');

	Route::post('employees/fetch/q', 'EmployeeFetchController@fetch')->name('employees.fetch');
	Route::post('employees/fetch/q?archive=1', 'EmployeeFetchController@fetch')->name('employees.archive');
	Route::post('employees/fetch/employees/{id?}', 'EmployeeFetchController@fetchItem')->name('employee.fetch');
});
