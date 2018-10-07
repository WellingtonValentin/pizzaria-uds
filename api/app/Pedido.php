<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{

    protected $table = 'pedido';

    protected $fillable = ['situacao','fk_tamanho_pizza','fk_sabor_pizza'];

    protected $hidden = ['status','created_at','updated_at','fk_tamanho_pizza','fk_sabor_pizza'];

    public function tamanho()
    {
        return $this->belongsTo('App\PizzaTamanho', 'fk_tamanho_pizza', 'id');
    }


    public function sabor()
    {
        return $this->belongsTo('App\PizzaSabor', 'fk_sabor_pizza','id');
    }

    public function personalizacao()
    {
        return $this->belongsToMany(PizzaPersonalizacao::class,'pedido_personalizacao','fk_pedido','fk_personalizacao');
    }

}
