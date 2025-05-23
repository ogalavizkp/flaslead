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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Nombre de la cuenta
            $table->string('nit')->unique(); // Código de cuenta único
            $table->text('description')->nullable(); // Descripción opcional

            
                        $table->unsignedBigInteger('created_by')->nullable(); // o sin nullable si siempre va a estar
            $table->unsignedBigInteger('updated_by')->nullable(); // o sin nullable si siempre va a estar


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
