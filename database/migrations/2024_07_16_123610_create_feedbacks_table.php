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
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->string('nameUser');
            $table->string('emailUser');
            $table->string('phoneUser');
            $table->text('content');
            $table->unsignedBigInteger('status_feedbacks_id')->nullable();
            $table->foreign('status_feedbacks_id')->references('id')->on('status_feedbacks')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedbacks');
    }
};
