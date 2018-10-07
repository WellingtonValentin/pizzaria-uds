<?php

namespace App\Http\Controllers;

use App\PizzaPersonalizacao;
use Illuminate\Http\Request;

class PizzaPersonalizacaoController extends Controller
{

    public function index()
    {
        $pizzaPersonalizacao = PizzaPersonalizacao::get();
        return response()->json($pizzaPersonalizacao);
    }

}
