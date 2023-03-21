<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


//  Route::get('/employee','UserController@index');

//  Route::get('/employee', [UserController::class, 'index']);
//  Route::get('/employee/{id}', [UserController::class, 'getPostById']);
//  Route::post('/sign-up', [UserController::class, 'signUp']);
//  Route::get('/get-data', [UserController::class, 'getData']);
//  Route::delete('/get-data/{id}', [UserController::class, 'deleteData']);
//  Route::get('/get-data/{id}', [UserController::class, 'updateData']);
//  Route::post('/get-data', [UserController::class, 'updateIt']);
Route::post('/post', [UserController::class, 'postfile']);
Route::post('/deletedfile', [UserController::class, 'deletefile']);
Route::get('/download/{name}', [UserController::class, 'downloadfile']);
Route::get('/getname', [UserController::class, 'getFile']);


