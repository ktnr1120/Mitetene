<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'User_ID' => 1,
            'Children_ID' => 1,
            'Date' => now(),
            'title' => "New Post",
            'body' => "This is a new post.",
            'created_at' => now(),
            'updated_at' => now(),
            'IsDelete' => 0,
        ]);
    }
}
