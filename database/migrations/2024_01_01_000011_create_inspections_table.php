<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration {
    public function up(): void {
        Schema::create('inspections', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('unit_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('inspector_id')->constrained('users')->cascadeOnDelete();
            $table->dateTime('scheduled_date');
            $table->dateTime('completed_date')->nullable();
            $table->enum('type', ['move_in', 'move_out', 'routine', 'emergency'])->default('routine');
            $table->json('checklist')->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['scheduled', 'completed', 'cancelled'])->default('scheduled');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('inspections'); }
};
