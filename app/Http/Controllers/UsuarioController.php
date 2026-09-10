<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    public function cadastro_usuario_html(Request $request)
    {
        return view('cadastro_usuario');
    }

    public function cadastro_usuario(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'turma' => 'required|string|max:50',
            'horario' => 'required|string|max:20',
            'atividade' => 'required|string|max:255',
            'observacao' => 'nullable|string|max:1000',
        ]);

        try {
            $usuario = new Usuario();
            $usuario->nome = $request->nome;
            $usuario->turma = $request->turma;
            $usuario->horario = $request->horario;
            $usuario->atividade = $request->atividade;
            $usuario->observacao = $request->observacao;
            $usuario->save();

            return response()->json(['erro' => 'n', 'mensagem' => 'Cadastro realizado com sucesso'], 200);
        } catch (\Exception $e) {
            return response()->json(['erro' => 's', 'mensagem' => 'Erro ao cadastrar: ' . $e->getMessage()], 200);
        }
    }
}
