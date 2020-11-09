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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/prueba', function () {
    return "probando salto de lina con '\n' no funciona";
});

Route::get('/post/{id}', function ($id) {
    return "La ID del post es:" . $id;

});

Route::get('/post/{category}/{author}', function ($category, $author) {
    return "La categoria es: " . $category . " of " . $author;

});

Route::get('/Hola', 'Home\HomeController@Hola');

Route::get('/insert', 'Home\HomeController@insert');
Route::get('/edit', 'Home\HomeController@edit');
Route::get('/read', 'Home\HomeController@read');
Route::get('/delete', 'Home\HomeController@delete');

Route::resource('user', 'Home\UserController');


Route::get('/import', 'Home\HomeController@importfile');
Route::post('/import', 'Home\HomeController@importExcel');

Route::get('/importAsignatura', 'Asignatura\AsignaturaController@importfileAsignatura');
Route::post('/importAsignatura', 'Asignatura\AsignaturaController@importExcelAsignatura');


