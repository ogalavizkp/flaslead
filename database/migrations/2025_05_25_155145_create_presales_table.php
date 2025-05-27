<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('presales', function (Blueprint $table) {
            $table->id();
            // Asunto de la reunión
            $table->string('meeting_subject')->nullable();

            $table->string('portfolio')->nullable(); // Multiple portfolios separated by commas



            $table->timestamp('start_date');
            $table->timestamp('end_date')->nullable();


            $table->enum('task_type', ['Advisory', 'Feasibility', 'Support']);
            // Usuario comercial responsable (Ej: ejecutivo de ventas)
            $table->foreignId('commercial_id')->constrained('users');

            // Usuario técnico o de implementación asignado a la tarea
            $table->foreignId('assigned_to')->constrained('users');

            $table->unsignedBigInteger('created_by')->nullable(); // o sin nullable si siempre va a estar
            $table->unsignedBigInteger('updated_by')->nullable(); // o sin nullable si siempre va a estar

            $table->text('description')->nullable();
            $table->text('history')->nullable();

            $table->enum('priority', ['high', 'medium', 'low'])->default('medium');

            $table->foreignId('company_id')->nullable()->constrained()->onDelete('set null');
            $table->text('notification_emails')->nullable(); // Multiple emails separated by commas

            $table->enum('status', [
                'pending',
                'in_progress',
                'postponed',
                'returned_not_viable',
                'returned_incomplete_info',
                'completed',
                'expired'
            ])->default('pending');


            $table->decimal('sla', 5, 2)->default(95.00); // SLA in percentage

            $table->integer('expired_time')->default(0); // Expired time in minutes
            $table->foreignId('account_id')->nullable()->constrained()->onDelete('cascade'); // Relación con accounts (empresa)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('presales');
    }
};
