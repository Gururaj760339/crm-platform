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
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->string('file_name');
            $table->string('file_url');
            $table->unsignedBigInteger('file_size');
            $table->enum('related_to_type', ['lead', 'contact', 'deal', 'company']);
            $table->integer('related_to_id');
            $table->unsignedBigInteger('uploaded_by');
            $table->timestamps();
            $table->foreign('uploaded_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
