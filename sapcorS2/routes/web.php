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

Route::post('/psicologo','sitio2Controller@login')->name('psicologo.login');
Route::get('/registroEstudiante/{idPsicologo}', 'sitio2Controller@registroEstudiante')->name('registroEstudiante');
Route::post('/registroEstudiante','sitio2Controller@altaEstudiante')->name('registroEstudiante.alta');
Route::get('/registroReporte/{idPsicologo}', 'sitio2Controller@registroReporte')->name('registroReporte');
Route::post('/registroReporte','sitio2Controller@altaReporte')->name('registroReporte.alta');
Route::get('/listaReportes/{idPsicologo}', 'sitio2Controller@listaReportes')->name('listaReportes');
Route::post('/listaReportes','sitio2Controller@verListaReportes')->name('listaReportes.ver');
Route::get('/listaConsultas/{idPsicologo}', 'sitio2Controller@listaConsultas')->name('listaConsultas');
Route::post('/listaConsultas','sitio2Controller@verListaConsultas')->name('listaConsultas.ver');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/principal/{idPsicologo}', 'sitio2Controller@vistaMenu')->name('vistaMenu');


