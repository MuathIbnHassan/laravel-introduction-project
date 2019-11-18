<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('test', function () {
    // If the Content-Type and Accept headers are set to 'application/json', 
    // this will return a JSON structure. This will be cleaned up later.
    return "yes";
});



// Route::get('/tags', 'TagController@index'); 
// Route::get('tags?{taggable_id}&{taggable_name}', 'TagController@show');
//? ^^ TODO: to be in web.php ^^



// Route::get('tags?{taggable_id}&{taggable_name}', 'TagController@getTags');

Route::get('tags/employee/{employee_id}', 'TagController@getEmployeeTags');
Route::get('tags/company/{company_id}', 'TagController@getCompanyTags');

Route::post('tags/employee/{tag_name}/{employee_id}', 'TagController@setEmployeeTags');
Route::post('tags/company/{tag_name}/{company_id}', 'TagController@setCompanyTags');

Route::delete('tags/employee/{tag_name}/{employee_id}',  'TagController@unlinkEmployeeTag');
Route::delete('tags/company/{tag_name}/{company_id}',  'TagController@unlinkCompanyTag');


Route::delete('tags/{tag_id}',  'TagController@deleteTag')->name('tag.delete');
