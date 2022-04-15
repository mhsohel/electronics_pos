<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_sales', function (Blueprint $table) {
            $table->id();
            $table->string('invoiceID');
            $table->foreignId('showroom_id')->nullable();
            $table->foreignId('dealer_id')->nullable();
            $table->foreignId('product_id')->references('id')->on('products');
            $table->string('batchID');
            $table->decimal('mrp', $precision = 10, $scale = 2);
            $table->decimal('qty', $precision = 10, $scale = 2);
            $table->enum('discount_type', ['percent', 'fixed'])->default('percent');
            $table->decimal('discount', $precision = 10, $scale = 2);
            $table->decimal('total', $precision = 10, $scale = 2);
            $table->enum('warranty_type', ['warranty', 'guarantee'])->default('warranty');
            $table->string('warranty_period', 100)->nullable();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('grn', 100)->nullable();
            $table->enum('approval', ['yes', 'no'])->default('no');
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
        Schema::dropIfExists('main_sales');
    }
}
