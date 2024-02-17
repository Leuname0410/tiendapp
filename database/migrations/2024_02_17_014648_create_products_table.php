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

            $table->bigIncrements('id');
            $table->unsignedBigInteger('brand_id');
            $table->string('product_name', 30)->nullable(false);
            $table->enum('size', ['s', 'm', 'l'])->nullable(false);
            $table->integer('inventory_quantity')->nullable(false);
            $table->date('shipment_date')->nullable(false);
            $table->text('observations')->nullable(false);
            $table->timestamps();

            $table->foreign('brand_id')->references('brand_id')->on('brands');

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
