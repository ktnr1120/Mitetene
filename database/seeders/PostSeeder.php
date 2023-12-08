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
        // テストデータの挿入
        for ($i = 1; $i <= 5; $i++) {
            DB::table('posts')->insert([
                'User_ID' => 1, // 仮のユーザーIDを指定
                'Children_ID' => 1, // 仮のChildren_IDを指定
                'Date' => now(), // 現在の日付を指定
                'title' => "Test Post $i", // テスト用のタイトル
                'body' => "This is a test post body. Number: $i", // テスト用の本文
                'created_at' => now(),
                'updated_at' => now(),
                'IsDelete' => 0,
            ]);
        }
    }
}
