<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration {
    public function up(): void {
        Schema::create('properties', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('owner_id')->constrained('users')->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('address');
            $table->string('city', 100);
            $table->string('state', 100)->nullable();
            $table->string('country', 100)->default('Kenya');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('type', 100);
            $table->decimal('price', 12, 2)->nullable();
            $table->text('description')->nullable();
            $table->json('amenities')->nullable();
            $table->enum('status', ['available', 'rented', 'maintenance'])->default('available');
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('properties'); }
};
