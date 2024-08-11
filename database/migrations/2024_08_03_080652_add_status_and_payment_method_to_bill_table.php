<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Bills;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bills', function (Blueprint $table) {
             $table->string('status_bill')->default(Bills::CHO_XAC_NHAN);
             $table->string('status_payment_method')->default(Bills::CHUA_THANH_TOAN);
             $table->double('moneyProduct');
             $table->double('moneyShip');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bills', function (Blueprint $table) {
             // Xóa cột trạng thái
             $table->dropColumn('status_bill');

             // Xóa cột phương thức thanh toán
             $table->dropColumn('status_payment_method');
             $table->dropColumn('moneyProduct');
             $table->dropColumn('moneyShip');
        });
    }
};
