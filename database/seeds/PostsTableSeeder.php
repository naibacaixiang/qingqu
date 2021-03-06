<?php

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;

class PostsTableSeeder extends Seeder
{
    public function run()
    {
        // 所有用户 ID 数组，如：[1,2,3,4]
        $user_ids = User::all()->pluck('id')->toArray();

        // 所有分类 ID 数组，如：[1,2,3,4]
        $category_ids = Category::all()->pluck('id')->toArray();

        $types = ['bubble','image','post'];

        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        $posts = factory(Post::class)
            ->times(100)
            ->make()
            ->each(function ($post, $index)
            use ($user_ids, $category_ids, $types,$faker)
            {
                // 从用户 ID 数组中随机取出一个并赋值
                $post->user_id = $faker->randomElement($user_ids);

                // 话题分类，同上
                $post->category_id = $faker->randomElement($category_ids);

                $post->type = $faker->randomElement($types);
            });

        Post::insert($posts->toArray());
    }

}

