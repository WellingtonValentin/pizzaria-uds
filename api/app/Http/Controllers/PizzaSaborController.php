<?php

namespace App\Http\Controllers;

use App\PizzaSabor;
use Illuminate\Http\Request;

class PizzaSaborController extends Controller
{

    public function index()
    {
        $pizzaSabor = PizzaSabor::get();
        return response()->json($pizzaSabor);
    }

}
