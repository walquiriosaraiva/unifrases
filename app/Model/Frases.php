<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Frases extends Model
{
    protected $table = 'frase';

    public $timestamps = false;

    protected $fillable = [
        'idioma', 'texto', 'status', 'codigo'
    ];

}
