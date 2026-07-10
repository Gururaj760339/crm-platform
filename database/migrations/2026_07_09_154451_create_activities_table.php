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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['task', 'call', 'meeting', 'email']);
            $table->string('subject');
            $table->string('description');
            $table->enum('related_to_type', ['lead', 'contact', 'deal', 'company']);
            $table->unsignedBigInteger('related_to_id');
            $table->unsignedBigInteger('assigned_to');
            $table->string('due_date');
            $table->enum('status', ['pending', 'completed', 'cancelled']);
            $table->timestamps();
            $table->index('related_to_type', 'related_to_id');
            $table->foreign('assigned_to')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
