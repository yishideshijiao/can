<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_categories', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->unique()->comment("名称");
            $table->integer('shop_id')->comment("所属商家id");
            $table->integer('hao_id')->comment("菜品编号id");
            $table->string('describe')->comment("描述");
            $table->boolean('is_selected')->default(1)->comment("默认显示");

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
        Schema::dropIfExists('menu_categories');
    }
}
