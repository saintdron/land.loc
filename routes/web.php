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

Route::match(['get', 'post'], '/', ['uses' => 'IndexController@execute', 'as' => 'home']);
Route::get('/page/{alias}', ['uses' => 'PageController@execute', 'as' => 'page']);

Route::auth();

// admin
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
	Route::get('/', function() {

	});

	// admin/pages
	Route::group(['prefix' => 'pages'], function() {
		Route::get('/', ['uses' => 'PagesController@execute', 'as' => 'pages']);

		// admin/pages/add
		Route::match(['get', 'post'], '/add', ['uses' => 'PagesAddController@execute', 'as' => 'pagesAdd']);

		// admin/pages/edit/{page}
		Route::match(['get', 'post', 'delete'], '/edit/{page}',
					 ['uses' => 'PagesEditController@execute', 'as' => 'pagesEdit']);
	});

	// admin/portfolios
	Route::group(['prefix' => 'portfolios'], function() {
		Route::get('/', ['uses' => 'PortfoliosController@execute', 'as' => 'portfolios']);

		// admin/portfolios/add
		Route::match(['get', 'post'], '/add', ['uses' => 'PortfoliosAddController@execute', 'as' => 'portfoliosAdd']);

		// admin/portfolios/edit/{portfolio}
		Route::match(['get', 'post', 'delete'], '/edit/{portfolio}',
					 ['uses' => 'PortfoliosEditController@execute', 'as' => 'portfoliosEdit']);
	});

	// admin/services
	Route::group(['prefix' => 'services'], function() {
		Route::get('/', ['uses' => 'ServicesController@execute', 'as' => 'services']);

		// admin/services/add
		Route::match(['get', 'post'], '/add', ['uses' => 'ServicesAddController@execute', 'as' => 'servicesAdd']);

		// admin/services/edit/{service}
		Route::match(['get', 'post', 'delete'], '/edit/{service}',
					 ['uses' => 'ServicesEditController@execute', 'as' => 'servicesEdit']);
	});

});
