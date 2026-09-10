<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Aluno extends Model
{
    protected $table = 'alunos';

    protected $fillable = [
        'nome',
        'turma',
        'id_rfid',
    ];

    public function registros(): HasMany
    {
        return $this->hasMany(Registro::class, 'aluno_id');
    }
}
