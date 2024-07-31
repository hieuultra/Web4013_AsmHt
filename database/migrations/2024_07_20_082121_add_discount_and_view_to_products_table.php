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
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('discount', 8, 2)->after('price')->nullable(); // Thêm cột discount sau cột price
            $table->unsignedInteger('view')->default(0)->after('sold'); // Thêm cột view sau cột sold
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('discount'); // Xóa cột discount khi rollback
            $table->dropColumn('view'); // Xóa cột view khi rollback
        });
    }
};
