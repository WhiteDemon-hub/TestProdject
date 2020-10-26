<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes(['register' => false,
'reset' => false]);
Route::get('logout','Auth\LoginController@logout');

Route::get('/', 'PanelNavigateController@home');
Route::get('/auth', 'PanelNavigateController@auth');
Route::get('/panel', 'PanelNavigateController@index');
Route::get('/slider_reader', 'PanelNavigateController@slider');
Route::get('/plants_reader', 'PanelNavigateController@plants');

Route::post('/send', 'MailController@send');

Route::resource('/site', 'SiteController');

Route::resource('/slider', 'SliderController');
Route::post('/slider/cancel', 'SliderController@cancel');

Route::resource('/plants', 'PlantsController');
Route::post('/plants/cancel', 'PlantsController@cancel');