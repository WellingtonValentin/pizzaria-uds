<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PizzaPersonalizacao extends Model
{

    protected $table = 'pizza_personalizacao';

    protected $fillable = ['descricao','valor','tempo_adicional'];

    protected $hidden = ['status','created_at','updated_at'];

}
