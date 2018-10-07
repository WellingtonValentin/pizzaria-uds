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

    Route::resource('pedido', 'PedidoController');
    Route::resource('pizza_tamanho', 'PizzaTamanhoController');
    Route::resource('pizza_sabor', 'PizzaSaborController');
    Route::resource('pizza_personalizacao', 'PizzaPersonalizacaoController');
    Route::resource('pizza_montagem', 'PizzaController');
    Route::get('pizza_montagem', 'PizzaController@pizzaMontagem');
    Route::get('pizza_personalizacao', 'PizzaController@pizzaPersonalizacao');

});

Route::get('/', function () {
    return redirect('api');
});