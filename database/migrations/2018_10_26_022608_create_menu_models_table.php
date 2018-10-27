<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->increments('id');

            $table->string('goods_name')->comment("商品名称");
            $table->integer('cate_id')->comment("类型id");
            $table->integer('rating')->comment("评分");
            $table->decimal('goods_price')->comment("商品价格");
            $table->text('goods_content')->comment("商品内容");
            $table->integer('month_sales')->comment("销量");
            $table->integer('rating_count')->comment("评分比率");
            $table->string('title')->comment("标题");
            $table->integer('satisfy_count')->comment("好评数");
            $table->integer('satisfy_rate')->comment("好评率");
            $table->string('goods_img')->comment("图片");


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
        Schema::dropIfExists('menu_models');
    }
}
