<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', 'MainController@index');
Route::get('/home', 'MainController@groups');


/********************************************************
*							GROUPS
*********************************************************/

Route::get('groups', ['middleware' => 'auth', 'uses' => 'MainController@groups']);
Route::get('getGroups', ['middleware' => 'auth', 'uses' => 'MainController@getGroups']);
Route::get('archivedGroups', ['middleware' => 'auth', 'uses' => 'MainController@archivedGroup']);
Route::get('archiveGroup/{gid}', ['middleware' => 'auth', 'uses' => 'MainController@archiveGroup']);
Route::get('activateGroup/{gid}', ['middleware' => 'auth', 'uses' => 'MainController@activateGroup']);
Route::get('deleteGroup/{gid}', ['middleware' => 'auth', 'uses' => 'MainController@deleteGroup']);
Route::any('createGroup', ['middleware' => 'auth', 'uses' => 'MainController@createGroup']);


/********************************************************
*							TASKS
*********************************************************/

Route::get('getTasks/{gid}', ['middleware' => 'auth', 'uses' => 'MainController@getTasks']);
Route::any('createTask/{gid}', ['middleware' => 'auth', 'uses' => 'MainController@createTask']);
Route::get('statusTask/{gid}', ['middleware' => 'auth', 'uses' => 'MainController@statusTask']);
Route::get('deleteTask/{gid}', ['middleware' => 'auth', 'uses' => 'MainController@deleteTask']);


/********************************************************
*							AUTH
*********************************************************/

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

