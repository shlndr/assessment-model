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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/add_model', function () {
    return view('addmodel');
});

Route::get('models', 'ModelController@index');
Route::get('models/add', 'ModelController@add');
Route::get('models/edit', 'ModelController@edit');
Route::post('models/save', 'ModelController@save');
Route::get('models/get-variables', 'ModelController@getVariables');
Route::get('models/edit-get-variables', 'ModelController@editgetVariables');
Route::get('/models/downloadpdf', 'ModelController@getDownload');
Route::get('/models/downloadexcel', 'ModelController@downloadexcel');
Route::post('models/summary', 'SummaryController@index');
Route::post('summary/rationale', 'SummaryController@getRationale');
Route::get('models/get-summary', 'SummaryController@getdata');
Route::get('summary/generate-pdf', 'SummaryController@generatePdf');
Route::post('summary/upload', 'SummaryController@uploadImage');
Route::post('summary/save-image', 'SummaryController@loadImage');
