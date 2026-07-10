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
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('contact_id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('pipeline_id');
            $table->unsignedBigInteger('stage_id');
            $table->decimal('amount');
            $table->string('currency');
            $table->string('expected_close_date');
            $table->enum('status', ['open', 'won', 'lost']);
            $table->string('lost_reason');
            $table->unsignedBigInteger('owner_id');
            $table->timestamps();
            $table->foreign('contact_id')->references('id')->on('contacts');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('pipeline_id')->references('id')->on('pipelines');
            $table->foreign('stage_id')->references('id')->on('pipeline_stages');
            $table->foreign('owner_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deals');
    }
};
