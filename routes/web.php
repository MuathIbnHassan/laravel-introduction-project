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

// use Symfony\Component\Routing\Route; //!error message

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');


// Route::resource('/companies', 'CompaniesController');


Route::get('/companies', 'CompaniesController@index');

Route::get('companies/create', 'CompaniesController@create');

Route::post('companies', 'CompaniesController@store')->name('company.create');

Route::get('companies/{company_id}', 'CompaniesController@show');

Route::get('companies/{company_id}/edit', 'CompaniesController@edit');

Route::match(['put', 'patch'], 'companies/{company_id}', 'CompaniesController@update')->name('company.update');

Route::delete('companies/{company_id}',  'CompaniesController@destroy');


Route::get('/employees', 'EmployeesController@index');

Route::get('employees/create', 'EmployeesController@create');


Route::get('/employees/create?company_id={company_id}', 'EmployeesController@create');

Route::post('employees', 'EmployeesController@store')->name('employee.create');

Route::get('employees/{employee_id}', 'EmployeesController@show');

Route::get('employees/{employee_id}/edit', 'EmployeesController@edit');

Route::match(['put', 'patch'], 'employees/{employee_id}', 'EmployeesController@update')->name('employee.update');

Route::delete('employees/{employee_id}',  'EmployeesController@destroy');

Route::get('tags/{tag_name}', 'TAgController@tagIndex');
