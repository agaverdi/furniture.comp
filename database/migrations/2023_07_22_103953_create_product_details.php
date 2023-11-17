<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_details', function (Blueprint $table) {
            $table->id();
            //unique etmedim product_id ni
            $table->unsignedBigInteger('product_id');
            $table->boolean('slider')->default(0);
            $table->boolean('new_items')->default(0);
            $table->boolean('hot_sale_items')->default(0);
            $table->boolean('feature_items')->default(0);
            $table->boolean('discount_items')->default(0);

            $table->foreign('product_id')
                ->references('id')
                ->on('product')
                ->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_details');
    }
};
