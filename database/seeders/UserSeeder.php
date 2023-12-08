<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DateTime;

class UserSeeder extends Seeder
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
            DB::table('users')->insert([
                'name' => "Test User $i", // テスト用のユーザー名
                'email' => "test$i@example.com", // テスト用のメールアドレス
                'email_verified_at' => now(), // 現在の日時を指定
                'password' => Hash::make("password$i"), // テスト用のパスワード
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
