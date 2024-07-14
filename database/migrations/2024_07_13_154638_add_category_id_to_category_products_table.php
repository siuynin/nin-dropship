<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdToCategoryProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('category_products', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->after('id');

            // Nếu muốn thêm khóa ngoại
            // $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_products', function (Blueprint $table) {
            // Nếu đã thêm khóa ngoại
            // $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
}
