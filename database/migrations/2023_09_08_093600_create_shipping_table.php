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
        Schema::create('shipping', function (Blueprint $table) {
            $table->id();
            $table->string('shipping_name', 145)->unique();
            $table->unsignedBigInteger('parent_shipping_id')->nullable();
            $table->integer('is_work')->default(1);
            $table->string('slug', 140)->unique();
            $table->string('postal_code',150)->nullable();
            $table->integer('shipping_price')->nullable();
            $table->foreign('parent_shipping_id')
                ->references('id')
                ->on('shipping')
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
        Schema::dropIfExists('shipping');
    }
};
