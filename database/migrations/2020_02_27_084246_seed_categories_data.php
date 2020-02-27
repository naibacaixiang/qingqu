<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class SeedCategoriesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $categories = [
            [
                'name'        => '公告',
                'description' => '站点公告',
                'slug'        => 'notice',
                'type'        => 'default',
                'order_by'    => '0',
            ],
            [
                'name'        => '壁纸',
                'description' => '电脑壁纸、手机壁纸',
                'slug'        => 'wallpaper',
                'type'        => 'image',
                'order_by'    => '0',
            ],

        ];

        DB::table('categories')->insert($categories);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
