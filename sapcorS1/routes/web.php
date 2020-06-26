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
})->name('welcome');

Route::post('/nuevoEnfoque','sitio1Controller@agregaEnfoque')->name('nuevoEnfoque.agregar');
Route::get('/nuevoEnfoque', 'sitio1Controller@vistaEnfoque')->name('nuevoEnfoque');
Route::post('/estudiante','sitio1Controller@loginEstudiante')->name('estudiante.login');
Route::get('/estudiante', 'sitio1Controller@vistaEstudiante')->name('estudiante');
Route::get('/listaEstudiantes', 'sitio1Controller@listaEstudiantes')->name('listaEstudiantes');
Route::get('/principal/{idEstudiante}', 'sitio1Controller@vistaMenu')->name('vistaMenu');
Route::get('/listaPacientes/{idEstudiante}', 'sitio1Controller@listaPacientes')->name('listaPacientes');
Route::post('/historial','sitio1Controller@verHistorial')->name('listaPacientes.ver');
Route::post('/registroConsulta','sitio1Controller@agregaConsulta')->name('registroConsulta.agregar');
Route::get('/registroConsulta/{idEstudiante}', 'sitio1Controller@vistaConsulta')->name('registroConsulta');