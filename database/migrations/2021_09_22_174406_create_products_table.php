<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->references('id')->on('brands');
            $table->foreignId('category_id')->references('id')->on('categories');
            $table->foreignId('unit_id')->references('id')->on('units');
            $table->foreignId('size_id')->references('id')->on('sizes');
            $table->foreignId('color_id')->references('id')->on('colors');
            $table->string('name');
            $table->string('model', 100)->nullable();
            $table->string('product_code', 100)->nullable();
            $table->string('photo');
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
