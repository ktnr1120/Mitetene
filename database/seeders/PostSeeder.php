<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     
    public function index(Post $post)//インポートしたPostをインスタンス化して$postとして使用。
    {
        return $post->get();//$postの中身を戻り値にする。
    }
    public function run()
    {
        DB::table('posts')->insert([
            [
                'User_ID'     => 1,
                'Children_ID' => 101,
                'Date'        => '2023-12-03',
                'Weather'     => '晴れ',
                'Category'    => '成長',
                'title'       => 'サンプルタイトル1',
                'body'        => 'サンプル本文1',
                'created_at'  => now(),
                'updated_at'  => now(),
                'IsDelete'    => 0,
            ],
            [
                'User_ID'     => 2,
                'Children_ID' => 102,
                'Date'        => '2023-12-04',
                'Weather'     => '曇り',
                'Category'    => '発見',
                'title'       => 'サンプルタイトル2',
                'body'        => 'サンプル本文2',
                'created_at'  => now(),
                'updated_at'  => now(),
                'IsDelete'    => 0,
            ],
        ]);
    }
}
