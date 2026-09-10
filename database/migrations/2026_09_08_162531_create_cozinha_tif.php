<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('cozinha_tif')) {
            Schema::create('cozinha_tif', function (Blueprint $table) {
                $table->id();
                $table->string('nome');
                $table->string('turma');
                $table->string('horario');
                $table->string('atividade');
                $table->text('observacao')->nullable();
                $table->timestamps();
            });

            return;
        }

        Schema::table('cozinha_tif', function (Blueprint $table) {
            if (!Schema::hasColumn('cozinha_tif', 'nome')) {
                $table->string('nome')->after('id');
            }
            if (!Schema::hasColumn('cozinha_tif', 'turma')) {
                $table->string('turma')->after('nome');
            }
            if (!Schema::hasColumn('cozinha_tif', 'horario')) {
                $table->string('horario')->after('turma');
            }
            if (!Schema::hasColumn('cozinha_tif', 'atividade')) {
                $table->string('atividade')->after('horario');
            }
            if (!Schema::hasColumn('cozinha_tif', 'observacao')) {
                $table->text('observacao')->nullable()->after('atividade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cozinha_tif');
    }
};
