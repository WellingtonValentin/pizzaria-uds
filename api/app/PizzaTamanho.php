<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PizzaTamanho extends Model
{

    protected $table = 'pizza_tamanho';

    protected $fillable = ['descricao','valor','tempo_adicional'];

    protected $hidden = ['status','created_at','updated_at'];

    public function pedido()
    {
        return $this->hasMany('App\Pedido');
    }

}
