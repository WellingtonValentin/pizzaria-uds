<?php

namespace App\Http\Controllers;

use App\Pedido;
use App\PizzaPersonalizacao;
use App\PizzaSabor;
use App\PizzaTamanho;
use Illuminate\Http\Request;

class PizzaController extends Controller
{

    public function pizzaMontagem()
    {

        $pizzaTamanho = PizzaTamanho::where('status', 1)->orderBy('id', 'asc')->get();
        $pizzaSabor = PizzaSabor::where('status', 1)->orderBy('id', 'asc')->get();

        $opcoes['tamanhos'] = $pizzaTamanho->toArray();
        $opcoes['sabores'] = $pizzaSabor->toArray();
        return response()->json($opcoes);

    }

    public function pizzaPersonalizacao()
    {

        $pizzaPersonalizacao = PizzaPersonalizacao::where('status', 1)->orderBy('id', 'asc')->get();

        $opcoes['personalizacao'] = $pizzaPersonalizacao->toArray();
        return response()->json($opcoes);

    }
}
