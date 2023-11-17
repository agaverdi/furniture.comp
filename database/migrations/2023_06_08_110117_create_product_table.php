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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('slug',160);
            $table->integer('category_id');
            $table->unsignedBigInteger('sub_category_id');
            $table->text('description');
            $table->string('path1')->nullable();
            $table->string('path2')->nullable();
            $table->string('path3')->nullable();
            $table->string('path4')->nullable();
            $table->string('path5')->nullable();
            $table->string('path6')->nullable();
            $table->decimal('price',6,2);
            $table->decimal('discount_price',6,2)->nullable();
            $table->integer('stars')->default(3);
            $table->tinyInteger('is_stock')->default(1);
            $table->foreign('sub_category_id')
                ->references('id')
                ->on('category')
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
        Schema::dropIfExists('product');
    }
};
