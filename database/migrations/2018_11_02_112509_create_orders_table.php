<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->comment('用户id');
            $table->integer('shop_id')->comment('商家id');
            $table->string('sn')->comment('订单编号');
            $table->string('provence')->comment('省');
            $table->string('city')->comment('市');
            $table->string('area')->comment('县');
            $table->string('detail_address')->comment('详细地址');
            $table->string('tel')->comment('电话');
            $table->string('name')->comment('收货人');
            $table->decimal('total')->comment('总价');
            $table->integer('status')->comment('状态：-1已取消，0待支付，1代发货，2待确认，3完成');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
