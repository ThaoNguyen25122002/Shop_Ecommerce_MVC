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
        // $table->unsignedBigInteger('id_category')->nullable()->after('id'); // Giả sử cột id là khóa chính của bảng
        // $table->unsignedBigInteger('id_brand')->nullable()->after('id_category');

        // Thêm ràng buộc khóa ngoại
        if (!Schema::hasColumn('products', 'id_category')) {
            $table->unsignedBigInteger('id_category')->nullable();
            $table->foreign('id_category')->references('id')->on('categories')->onDelete('cascade');
        }
        
        if (!Schema::hasColumn('products', 'id_brand')) {
            $table->unsignedBigInteger('id_brand')->nullable();
            $table->foreign('id_brand')->references('id')->on('brands')->onDelete('cascade');
        }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
             // Xóa ràng buộc khóa ngoại
        $table->dropForeign(['id_category']);
        $table->dropForeign(['id_brand']);

        // Xóa cột nếu không cần thiết
        $table->dropColumn('id_category');
        $table->dropColumn('id_brand');
        });
    }
};
