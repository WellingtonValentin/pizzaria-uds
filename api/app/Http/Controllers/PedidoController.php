<?php

namespace App\Http\Controllers;

use App\Pedido;
use App\PizzaPersonalizacao;
use App\PizzaTamanho;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{

    public function index()
    {
        $pedido = Pedido::with(['tamanho','sabor','personalizacao'])->get();
        return response()->json($pedido);
    }

    public function show($id)
    {
        $pedido = Pedido::with(['tamanho','sabor','personalizacao'])
            ->find($id);



        if(!$pedido) {
            return response()->json([
                'message'   => 'Pedido não encontrado',
            ], 404);
        }

        $pedido['situacao'] = 'Finalizado';

        $pedido->save();

        $valor_total = $pedido->tamanho()->sum('valor');
        $valor_total += $pedido->personalizacao()->sum('valor');
        $pedido['valor_total'] = $valor_total;

        $tempo_total = $pedido->tamanho()->sum(DB::raw('TIME_TO_SEC( `tempo_adicional` )'));
        $tempo_total += $pedido->sabor()->sum(DB::raw('TIME_TO_SEC( `tempo_adicional` )'));
        $tempo_total += $pedido->personalizacao()->sum(DB::raw('TIME_TO_SEC( `tempo_adicional` )'));
        $pedido['tempo_total'] = date('H:i', mktime(0, 0,$tempo_total));

        return response()->json($pedido);
    }

    public function store(Request $request)
    {
        $post = $request->all();

        if(!isset($post['tamanho']) || !isset($post['tamanho']['id'])) {
            return response()->json([
                'message'   => 'Tamanho é obrigatório!',
            ], 400);
        }
        if(!isset($post['sabor']) || !isset($post['sabor']['id'])) {
            return response()->json([
                'message'   => 'Sabor é obrigatório!',
            ], 400);
        }
        if(!PizzaTamanho::find($post['tamanho']['id'])) {
            return response()->json([
                'message'   => 'Favor informar um tamanho válido!',
            ], 400);
        }
        if(!PizzaTamanho::find($post['sabor']['id'])) {
            return response()->json([
                'message'   => 'Favor informar um sabor válido!',
            ], 400);
        }


        $post['fk_tamanho_pizza'] = $post['tamanho']['id'];
        $post['fk_sabor_pizza'] = $post['sabor']['id'];
        $post['situacao'] = 'Montagem';


        $pedido = new Pedido();
        $pedido->fill($post);
        $pedido->save();

        return response()->json(['id' => $pedido['id']], 201);

    }

    public function update(Request $request, $id)
    {

        $pedido = Pedido::find($id);

        if(!$pedido) {
            return response()->json([
                'message'   => 'Pedido não encontrado',
            ], 404);
        }


        $request['situacao'] = 'Personalização';
        $pedido->fill($request->all());
        $pedido->save();

        foreach ($request->personalizacao as $line){
            $personalizacao[] = $line['id'];
        }

        $personalizacao = PizzaPersonalizacao::find($personalizacao);
        $pedido->personalizacao()->sync($personalizacao);

        return response()->json(['id' => $pedido['id']], 201);
    }

}
