<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChildrenSeeder extends Seeder
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
            DB::table('children')->insert([
                'User_ID' => 1, // 仮のユーザーIDを指定
                'child_Name' => "Child $i", // テスト用の子供の名前
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
