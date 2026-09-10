<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Registro;
use Illuminate\Http\Request;

class RegistroController extends Controller
{
    public function registrar_entrada_html()
    {
        return view('registrar_entrada');
    }

    public function historico(Request $request)
    {
        $query = Registro::with('aluno')->orderByDesc('data')->orderByDesc('horario');

        if ($request->filled('nome')) {
            $query->whereHas('aluno', function ($q) use ($request) {
                $q->where('nome', 'like', '%' . $request->nome . '%');
            });
        }

        if ($request->filled('turma')) {
            $query->whereHas('aluno', function ($q) use ($request) {
                $q->where('turma', $request->turma);
            });
        }

        if ($request->filled('data')) {
            $query->whereDate('data', $request->data);
        }

        $registros = $query->get();

        return view('historico', compact('registros'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'turma' => 'required|string|in:9º ano A,9º ano B,1º ano A,1º ano B,2º ano A,2º ano B,3º ano A,3º ano B',
            'horario' => 'required|string|in:12:00,12:10,12:20,12:30,12:40,12:50,13:00',
            'atividade' => 'required|string|in:Personaliza,Academia,Prepara ENEM,Outros',
            'observacao' => 'nullable|string|max:1000|required_if:atividade,Outros',
        ]);

        $aluno = null;

        if ($request->filled('aluno_id')) {
            $aluno = Aluno::find($request->aluno_id);
        } elseif ($request->filled('id_rfid')) {
            $aluno = Aluno::where('id_rfid', $request->id_rfid)->first();
        } else {
            $aluno = Aluno::where('nome', $request->nome)
                ->where('turma', $request->turma)
                ->first();
        }

        if (! $aluno) {
            return response()->json([
                'erro' => 's',
                'mensagem' => 'Aluno não encontrado. Cadastre o aluno antes de registrar a entrada.',
            ], 200);
        }

        $registro = Registro::create([
            'aluno_id' => $aluno->id,
            'horario' => $request->horario,
            'atividade' => $request->atividade,
            'data' => now()->toDateString(),
            'status' => 'registrado',
            'observacao' => $request->observacao,
        ]);

        return response()->json([
            'erro' => 'n',
            'mensagem' => 'Entrada registrada com sucesso!',
            'registro' => $registro,
        ], 200);
    }
}
