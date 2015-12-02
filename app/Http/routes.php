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

Route::get('/', 'HomeController@index');

Route::post('auth/login', 'Auth\AuthController@authenticate');

Route::get("members", "MembersController@index");
Route::post("members", "MembersController@create");
Route::get("members/{id}", "MembersController@read");
Route::put("members/{id}", "MembersController@update");
Route::delete("members/{id}", "MembersController@delete");

Route::get("groups", "GroupsController@index");
Route::post("groups", "GroupsController@create");
Route::get("groups/{id}", "GroupsController@read");
Route::put("groups/{id}", "GroupsController@update");
Route::delete("groups/{id}", "GroupsController@delete");

Route::get("sunday_school_groups", "SundaySchoolGroupsController@index");
Route::post("sunday_school_groups", "SundaySchoolGroupsController@create");
Route::get("sunday_school_groups/{id}", "SundaySchoolGroupsController@read");
Route::put("sunday_school_groups/{id}", "SundaySchoolGroupsController@update");
Route::delete("sunday_school_groups/{id}", "SundaySchoolGroupsController@delete");
