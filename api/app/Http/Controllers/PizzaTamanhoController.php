<?php

namespace App\Http\Controllers;

use App\PizzaTamanho;
use Illuminate\Http\Request;

class PizzaTamanhoController extends Controller
{

    public function index()
    {
        $pizzaTamanho = PizzaTamanho::get();
        return response()->json($pizzaTamanho);
    }

}
