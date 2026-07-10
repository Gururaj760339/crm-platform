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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('company_name');
            $table->string('source');
            $table->enum('status', ['new', 'contacted', 'qualified', 'unqualified', 'converted']);
            $table->integer('score');
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('converted_contact_id')->nullable();
            $table->unsignedBigInteger('converted_deal_id')->nullable();
            $table->timestamps();
            $table->foreign('owner_id')->references('id')->on('users');
            $table->foreign('converted_contact_id')->references('id')->on('contacts');
            $table->foreign('converted_deal_id')->references('id')->on('deals');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
