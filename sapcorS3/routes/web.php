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

Route::post('/psicologo','sitio3Controller@login')->name('psicologo.login');
Route::post('/registroPaciente','sitio3Controller@altaPaciente')->name('registroPaciente.altaPaciente');
Route::get('/registroPaciente', 'sitio3Controller@vistaPaciente')->name('registroPaciente');
Route::get('/nuevoPaciente', 'sitio3Controller@vistaNuevoPaciente')->name('nuevoPaciente');