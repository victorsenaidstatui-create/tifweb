<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CozinhaCadastroTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_registers_kitchen_data(): void
    {
        $response = $this->postJson('/api/cadastro_usuario', [
            'nome' => 'Ana Souza',
            'turma' => '3A',
            'horario' => '08:30',
            'atividade' => 'Preparar salada',
            'observacao' => 'Trazer avental e touca',
        ]);

        $response->assertOk();
        $response->assertJsonPath('erro', 'n');

        $this->assertDatabaseHas('cozinha_tif', [
            'nome' => 'Ana Souza',
            'turma' => '3A',
            'horario' => '08:30',
            'atividade' => 'Preparar salada',
            'observacao' => 'Trazer avental e touca',
        ]);
    }
}
