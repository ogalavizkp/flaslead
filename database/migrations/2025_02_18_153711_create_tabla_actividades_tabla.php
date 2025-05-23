<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('actividades', function (Blueprint $table) {
            $table->id();

            $table->foreignId('account_id')->nullable()->constrained()->onDelete('cascade'); // Relación con accounts (empresa)

            // Relación polimórfica (opcional)
            $table->nullableMorphs('relacionable');

            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->enum('tipo', ['tarea', 'reunion', 'llamada', 'otro']);
            $table->enum('prioridad', ['alta', 'media', 'baja']);
            $table->boolean('estado')->default(false);
            $table->boolean('recordatorio')->default(false);
            $table->dateTime('recordatorio_fecha')->nullable();

             $table->unsignedBigInteger('created_by')->nullable(); // o sin nullable si siempre va a estar
            $table->unsignedBigInteger('updated_by')->nullable(); // o sin nullable si siempre va a estar

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('actividades');
    }
};
