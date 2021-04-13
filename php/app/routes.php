<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//登录注销
Route::get('/login','UserController@login');
Route::post('/login','UserController@Dologin');
Route::get('/logout','UserController@logout');

//后台页面路由
Route::controller('/adm/user','UserController');
Route::controller('/adm/survey','SurveyController');
Route::get('/adm/show-chart','SurveyController@ShowChart');
Route::get('/adm','SurveyController@adminIndex');

//前台首页，问卷首页
Route::get('/{email?}', 'SurveyController@Survey');
Route::post('/', 'SurveyController@SubmitSurvey');

