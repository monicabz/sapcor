<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class sitio2TransactionsController extends Controller
{
    //
    public function prueba() {
        $configDb = [
			'driver'      => 'mysql',
			'host'        => env('DB_HOST', '127.0.0.1'),
			'port'        => env('DB_PORT', '3306'),
			'database'    => 'sapcors2',
			'username'    => env('DB_USERNAME', 'root'),
			'password'    => env('DB_PASSWORD', ''),
			'unix_socket' => env('DB_SOCKET', ''),
			'charset'     => 'utf8',
			'collation'   => 'utf8_unicode_ci',
			'prefix'      => '',
			'strict'      => true,
			'engine'      => null,
        ];

        \Config::set('database.connections.DB_Serverr', $configDb);

        $conexionSQL = \DB::connection('DB_Serverr');
        $datos = $conexionSQL->select('select * FROM psicologo');
        return $datos;
    }
}
