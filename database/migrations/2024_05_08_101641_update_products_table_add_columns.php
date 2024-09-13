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
            //
            $table->foreign('id_category')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('id_brand')->references('id')->on('brands')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        $table->dropForeign(['id_category']);
        $table->dropForeign(['id_brand']);
        
        // Xóa cột sau khi ràng buộc khóa ngoại đã bị hủy bỏ
        $table->dropColumn('option');
        $table->dropColumn('discount_percentage');
        $table->dropColumn('company');
        $table->dropColumn('detail');
        $table->dropColumn('id_brand');
        });
    }
};
