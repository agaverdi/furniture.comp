<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('checkout', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('company',150)->nullable();
            $table->string('address',255)->nullable();
            $table->string('city',120)->nullable();
            $table->string('email',120)->nullable();
            $table->string('phone',120)->nullable();
            $table->text('order_text')->nullable();
            $table->string('product_ids',150)->nullable();
            $table->integer('sub_shipping_id')->nullable();
            $table->float('total',10,2)->nullable();
            $table->string('coupon',16)->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checkout');
    }
};
