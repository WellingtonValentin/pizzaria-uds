<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(array('prefix' => 'api'), function()
{

    Route::get('/', function () {
        return response()->json(['message' => 'Pizzaria UDS - API', 'status' => 'Connected']);;
    });

    Route::resource('pizza_tamanho', 'PizzaTamanhoController');
    Route::resource('pizza_sabor', 'PizzaSaborController');
    Route::resource('pizza_personalizacao', 'PizzaPersonalizacaoController');
    Route::resource('pizza_montagem', 'PizzaController');

    Route::get('pedido', 'PedidoController@index');
    Route::get('pedido/{id}', 'PedidoController@show');

    Route::get('pedido_montagem', 'PizzaController@pizzaMontagem');
    Route::get('pedido_personalizacao', 'PizzaController@pizzaPersonalizacao');

    Route::post('pedido_montagem', 'PedidoController@store');
    Route::post('pedido_personalizacao/{id}', 'PedidoController@update');

});

Route::get('/', function () {
    return redirect('api');
});