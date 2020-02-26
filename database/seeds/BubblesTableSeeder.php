<?php

use Illuminate\Database\Seeder;
use App\Models\Bubble;
use App\Models\User;

class BubblesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_ids = ['1'];
        $faker = app(Faker\Generator::class);

        $bubbles = factory(\App\Models\Bubble::class)->times(666)->make()->each(function ($bubble) use ($faker, $user_ids) {
            $bubble->user_id = $faker->randomElement($user_ids);
        });

        Bubble::insert($bubbles->toArray());
    }
}
