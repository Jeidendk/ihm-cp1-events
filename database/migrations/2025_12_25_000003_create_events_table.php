<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('date');
            $table->time('time');
            $table->string('timezone')->default('UTC');
            $table->text('description')->nullable();
            $table->enum('status', ['planificado', 'confirmado'])->default('planificado');
            
            // Foreign Keys
            $table->foreignId('location_id')->nullable()->constrained('locations')->nullOnDelete();
            $table->foreignId('contact_id')->nullable()->constrained('contacts')->nullOnDelete();
            
            // Additional fields based on requirements
            $table->boolean('has_reminder')->default(false);
            $table->string('repetition')->nullable(); // daily, weekly, etc.
            $table->string('classification')->nullable(); // conference, workshop, etc.
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
