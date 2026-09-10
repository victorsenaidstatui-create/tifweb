<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    public function cadastro_aluno_html()
    {
        return view('cadastro_aluno');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'turma' => 'required|string|in:9º ano A,9º ano B,1º ano A,1º ano B,2º ano A,2º ano B,3º ano A,3º ano B',
            'id_rfid' => 'required|string|max:255|unique:alunos,id_rfid',
        ]);

        $aluno = Aluno::create([
            'nome' => $request->nome,
            'turma' => $request->turma,
            'id_rfid' => $request->id_rfid,
        ]);

        return response()->json([
            'erro' => 'n',
            'mensagem' => 'Aluno cadastrado com sucesso!',
            'aluno' => $aluno,
        ], 200);
    }
}
