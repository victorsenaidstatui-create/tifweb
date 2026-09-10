<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'cozinha_tif';

    protected $fillable = [
        'nome',
        'turma',
        'horario',
        'atividade',
        'observacao',
    ];
}
