<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{

    protected $table = 'pedido';

    protected $fillable = ['codigo','situacao'];

    protected $hidden = ['status','created_at','updated_at','fk_tamanho_pizza','fk_sabor_pizza'];

    public function tamanho()
    {
        return $this->hasOne('App\PizzaTamanho', 'id', 'fk_tamanho_pizza');
    }


    public function sabor()
    {
        return $this->hasOne('App\PizzaSabor', 'id','fk_sabor_pizza');
    }

}
