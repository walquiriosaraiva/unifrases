<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Idiomas extends Model
{
    protected $table = 'idioma';

    public $timestamps = false;

    protected $fillable = [
        'nome', 'encoding', 'collateaux', 'status', 'imagem'
    ];

}
