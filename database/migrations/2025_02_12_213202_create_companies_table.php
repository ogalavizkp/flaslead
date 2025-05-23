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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();

            $table->enum('type', ['persona', 'empresa'])->default('empresa'); // Tipo de entidad
            $table->string('name')->unique();
            $table->string('trade_name')->nullable(); // Nombre comercial
            $table->string('identification_type'); // Tipo de identificación
            $table->string('identification')->unique(); // Número de identificación
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->text('address')->nullable();
            $table->string('country')->nullable(); // Ciudad
            $table->string('city')->nullable(); // Ciudad
            $table->string('phone')->nullable();
            $table->string('phone2')->nullable();
            $table->string('phone3')->nullable();

            // Clasificación de la empresa dentro del CRM
            $table->enum('category', ['prospecto', 'oportunidad', 'cliente', 'proveedor', 'revendedor'])->default('prospecto');
            $table->enum('status', ['activo', 'inactivo', 'en negociacion'])->default('activo'); // Estado de la cuenta

            // Información adicional
            $table->integer('employees')->nullable(); // Número de empleados
            $table->string('revenue_range')->nullable(); // Rango de ingresos
            
          
                        $table->unsignedBigInteger('created_by')->nullable(); // o sin nullable si siempre va a estar
            $table->unsignedBigInteger('updated_by')->nullable(); // o sin nullable si siempre va a estar

            
            $table->text('notes')->nullable(); // Notas adicionales

            // Relación con la tabla accounts
            $table->foreignId('account_id')->nullable()->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
