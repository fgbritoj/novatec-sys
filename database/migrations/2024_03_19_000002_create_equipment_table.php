<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->string('type'); // computer, laptop, printer, etc.
            $table->string('brand');
            $table->string('model');
            $table->string('serial_number')->nullable();
            $table->text('description')->nullable();
            $table->text('problem_description')->nullable();
            $table->string('status')->default('pending'); // pending, in_progress, completed, delivered
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
}; 