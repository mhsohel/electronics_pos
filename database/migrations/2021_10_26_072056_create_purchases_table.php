<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('invoiceID');
            $table->foreignId('supplier_id')->references('id')->on('suppliers');
            $table->foreignId('product_id')->references('id')->on('products');
            $table->string('batchID');
            $table->decimal('cost_price', $precision = 10, $scale = 2);
            $table->decimal('mrp', $precision = 10, $scale = 2);
            $table->decimal('qty', $precision = 10, $scale = 2);
            $table->decimal('order_qty', $precision = 10, $scale = 2);
            $table->enum('discount_type', ['percent', 'fixed'])->default('percent');
            $table->decimal('discount', $precision = 10, $scale = 2);
            $table->decimal('total', $precision = 10, $scale = 2);
            // $table->enum('showroom_com_type', ['fixed', 'percent'])->default('fixed');
            // $table->decimal('showroom_com', $precision = 10, $scale = 2);
            // $table->enum('dealer_com_type', ['fixed', 'percent'])->default('fixed');
            // $table->decimal('dealer_com', $precision = 10, $scale = 2);
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
        Schema::dropIfExists('purchases');
    }
}
