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

use App\IpAddress;
use App\Institution;
use App\License;
use App\Application;
use App\Server;
use App\Person;

Route::get('/', function () {
    $data = [
        'page_title' => 'Dashboard',
        'people'    => Institution::scopeCompanyables(Person::with('institution'))->get(),
        'licenses'    => Institution::scopeCompanyables(License::with('institution'))->get(),
        'applications'    => Institution::scopeCompanyables(Application::with('institution'))->get(),
        'servers'    => Institution::scopeCompanyables(Server::with('institution'))->get(),
    ];
    return view('welcome', $data);
});

//Auth::routes();

//Auth route
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
// $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// $this->post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
// $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
// $this->post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/home', 'HomeController@index')->name('home');
Route::middleware('web', 'auth')->group(function() {
    Route::get('profile', 'UsersController@getProfile')->name('profile');
    Route::post('profile', 'UsersController@updateProfile')->name('profile.store');
//    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    //users
    Route::prefix('users')->middleware('authorize:user.b')->group(function() {
        Route::get('/', 'UsersController@index')->name('users');
        Route::get('api.index', 'UsersController@getDataTable')->name('users.index');
        Route::get('read/{id}', 'UsersController@show')->middleware('authorize:user.r')->name('users.read');
        Route::get('add', 'UsersController@create')->middleware('authorize:user.a')->name('users.add');
        Route::post('add', 'UsersController@store')->middleware('authorize:user.a')->name('users.store');
        Route::get('edit/{id}', 'UsersController@edit')->middleware('authorize:user.e')->name('users.edit');
        Route::post('edit/{id}', 'UsersController@update')->middleware('authorize:user.e')->name('users.update');
        Route::post('delete', 'UsersController@destroy')->middleware('authorize:user.d')->name('users.delete');
    });

    //Persons
    Route::prefix('persons')->middleware('authorize:person.b')->group(function() {
        Route::get('/', 'PersonsController@index')->name('persons');
        Route::get('api.index', 'PersonsController@getDataTable')->name('persons.index');
        Route::get('read/{id}', 'PersonsController@show')->middleware('authorize:person.r')->name('persons.read');
        Route::get('add', 'PersonsController@create')->middleware('authorize:person.a')->name('persons.add');
        Route::post('add', 'PersonsController@store')->middleware('authorize:person.a')->name('persons.store');
        Route::get('edit/{id}', 'PersonsController@edit')->middleware('authorize:person.e')->name('persons.edit');
        Route::post('edit/{id}', 'PersonsController@update')->middleware('authorize:person.e')->name('persons.update');
        Route::post('delete', 'PersonsController@destroy')->middleware('authorize:person.d')->name('persons.delete');
    });

    //Licenses
    Route::prefix('licenses')->middleware('authorize:license.b')->group(function() {
        Route::get('/', 'LicensesController@index')->name('licenses');
        Route::get('api.index', 'LicensesController@getDataTable')->name('licenses.index');
        Route::get('read/{id}', 'LicensesController@show')->middleware('authorize:license.r')->name('licenses.read');
        Route::get('add', 'LicensesController@create')->middleware('authorize:license.a')->name('licenses.add');
        Route::post('add', 'LicensesController@store')->middleware('authorize:license.a')->name('licenses.store');
        Route::get('edit/{id}', 'LicensesController@edit')->middleware('authorize:license.e')->name('licenses.edit');
        Route::post('edit/{id}', 'LicensesController@update')->middleware('authorize:license.e')->name('licenses.update');
        Route::post('delete', 'LicensesController@destroy')->middleware('authorize:license.d')->name('licenses.delete');
    });

    //Subdomains
    Route::prefix('subdomains')->middleware('authorize:subdomain.b')->group(function() {
        Route::get('/', 'SubdomainsController@index')->name('subdomains');
        Route::get('api.index', 'SubdomainsController@getDataTable')->name('subdomains.index');
        Route::get('read/{id}', 'SubdomainsController@show')->middleware('authorize:subdomain.r')->name('subdomains.read');
        Route::get('add', 'SubdomainsController@create')->middleware('authorize:subdomain.a')->name('subdomains.add');
        Route::post('add', 'SubdomainsController@store')->middleware('authorize:subdomain.a')->name('subdomains.store');
        Route::get('edit/{id}', 'SubdomainsController@edit')->middleware('authorize:subdomain.e')->name('subdomains.edit');
        Route::post('edit/{id}', 'SubdomainsController@update')->middleware('authorize:subdomain.e')->name('subdomains.update');
        Route::post('delete', 'SubdomainsController@destroy')->middleware('authorize:subdomain.d')->name('subdomains.delete');
    });

    //IP Address
    Route::prefix('ip_addresses')->middleware('authorize:ip_address.b')->group(function() {
        Route::get('/', 'IP_AddressesController@index')->name('ip_addresses');
        Route::get('api.index', 'IP_AddressesController@getDataTable')->name('ip_addresses.index');
        Route::get('read/{id}', 'IP_AddressesController@show')->middleware('authorize:ip_address.r')->name('ip_addresses.read');
        Route::get('add', 'IP_AddressesController@create')->middleware('authorize:ip_address.a')->name('ip_addresses.add');
        Route::post('add', 'IP_AddressesController@store')->middleware('authorize:ip_address.a')->name('ip_addresses.store');
        Route::get('edit/{id}', 'IP_AddressesController@edit')->middleware('authorize:ip_address.e')->name('ip_addresses.edit');
        Route::post('edit/{id}', 'IP_AddressesController@update')->middleware('authorize:ip_address.e')->name('ip_addresses.update');
        Route::post('delete', 'IP_AddressesController@destroy')->middleware('authorize:ip_address.d')->name('ip_addresses.delete');
    });

    //IP Address
    Route::prefix('applications')->middleware('authorize:application.b')->group(function() {
        Route::get('/', 'ApplicationsController@index')->name('applications');
        Route::get('api.index', 'ApplicationsController@getDataTable')->name('applications.index');
        Route::get('read/{id}', 'ApplicationsController@show')->middleware('authorize:application.r')->name('applications.read');
        Route::get('add', 'ApplicationsController@create')->middleware('authorize:application.a')->name('applications.add');
        Route::post('add', 'ApplicationsController@store')->middleware('authorize:application.a')->name('applications.store');
        Route::get('edit/{id}', 'ApplicationsController@edit')->middleware('authorize:application.e')->name('applications.edit');
        Route::post('edit/{id}', 'ApplicationsController@update')->middleware('authorize:application.e')->name('applications.update');
        Route::post('delete', 'ApplicationsController@destroy')->middleware('authorize:application.d')->name('applications.delete');
    });

    //Servers
    Route::prefix('servers')->middleware('authorize:application.b')->group(function() {
        Route::get('/', 'ServersController@index')->name('servers');
        Route::get('api.index', 'ServersController@getDataTable')->name('servers.index');
        Route::get('read/{id}', 'ServersController@show')->middleware('authorize:server.r')->name('servers.read');
        Route::get('add', 'ServersController@create')->middleware('authorize:server.a')->name('servers.add');
        Route::post('add', 'ServersController@store')->middleware('authorize:server.a')->name('servers.store');
        Route::get('edit/{id}', 'ServersController@edit')->middleware('authorize:server.e')->name('servers.edit');
        Route::post('edit/{id}', 'ServersController@update')->middleware('authorize:server.e')->name('servers.update');
        Route::post('delete', 'ServersController@destroy')->middleware('authorize:server.d')->name('servers.delete');
    });

    //Servers
    Route::prefix('logs')->middleware('authorize:superuser')->group(function() {
        Route::get('/', 'LogActivitiesController@index')->name('logs');
        Route::get('api.index', 'LogActivitiesController@getDataTable')->name('logs.index');
        Route::get('read/{id}', 'LogActivitiesController@show')->name('logs.read');
//        Route::get('add', 'ServersController@create')->middleware('authorize:server.a')->name('servers.add');
//        Route::post('add', 'ServersController@store')->middleware('authorize:server.a')->name('servers.store');
//        Route::get('edit/{id}', 'ServersController@edit')->middleware('authorize:server.e')->name('servers.edit');
//        Route::post('edit/{id}', 'ServersController@update')->middleware('authorize:server.e')->name('servers.update');
//        Route::post('delete', 'ServersController@destroy')->middleware('authorize:server.d')->name('servers.delete');
    });

//    Route::group([
//        'prefix' => 'ip_addresses',
//        'middleware' => 'authorize:ip_address.b'
//    ], function(IpAddress $ipAddress) {
//        Route::get('/', [
//           'uses' => 'IP_AddressesController@index',
//            'as'    => 'ip_addresses',
//        ]);
//    });

});
