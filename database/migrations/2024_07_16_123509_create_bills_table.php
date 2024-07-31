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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string('addressUser');
            $table->string('phoneUser');
            $table->string('nameUser');
            $table->string('emailUser');
            $table->decimal('totalPrice',10,2)->default(0);
            $table->unsignedInteger('paymentMethod')->default(0);
            $table->unsignedBigInteger('account_id')->nullable();
            $table->unsignedBigInteger('statusBill_id')->nullable();
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('set null');
            $table->foreign('statusBill_id')->references('id')->on('status_bills')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
