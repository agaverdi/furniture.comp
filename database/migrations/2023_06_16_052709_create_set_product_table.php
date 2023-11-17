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
        Schema::create('set_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('set_product_id');
            $table->string('set_name', 100);
            $table->string('set_slug',160);
            $table->decimal('set_price',6,2);
            $table->integer('count')->default(1);
            $table->decimal('set_discount',6,2)->nullable();
            $table->integer('set_key')->nullable();
            $table->foreign('set_product_id')
                ->references('id')
                ->on('product')
                ->onDelete('cascade');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('set_product');
    }
};
