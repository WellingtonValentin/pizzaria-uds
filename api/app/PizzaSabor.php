<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PizzaSabor extends Model
{

    protected $table = 'pizza_sabor';

    protected $fillable = ['descricao','tempo_adicional'];

    protected $hidden = ['status','created_at','updated_at'];

    public function pedido()
    {
        return $this->hasMany('App\Pedido');
    }

}
