<?php

namespace App\Http\Controllers;

use App\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{

    public function index()
    {
        $pedido = Pedido::with(['tamanho','sabor'])->get();
        return response()->json($pedido);
    }

}
