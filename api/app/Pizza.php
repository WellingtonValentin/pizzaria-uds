<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{

    protected $fillable = ['descricao','valor','tempo_adicional'];

}
