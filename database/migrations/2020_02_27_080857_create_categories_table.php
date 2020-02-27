<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index()->comment('名称');
            $table->string('slug')->comment('别名');
            $table->text('description')->nullable()->comment('描述');
            $table->string('type',20)->default('default')->comment('类型');
            $table->string('cover')->nullable()->comment('封面');
            $table->integer('post_count')->default(0)->comment('文章数');
            $table->tinyInteger('order_by')->default(0)->comment('排序');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
