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
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descricao');
            $table->string('local');
            $table->dateTime('data_inicio');
            $table->dateTime('data_fim');
            $table->decimal('valor_inscricao', 8, 2);
            $table->string('chave_pix')->nullable();
            $table->foreignId('organizador_id')->constrained('users'); // Chave estrangeira para o usuário organizador
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
   public function down(): void
    {
        Schema::disableForeignKeyConstraints(); // <-- ADICIONE
        Schema::dropIfExists('eventos');
        Schema::enableForeignKeyConstraints(); // <-- ADICIONE
    }
};
