<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // テスト用のカテゴリレコードを挿入
        Category::create(['name' => '成長']);
        Category::create(['name' => '発見']);
        Category::create(['name' => '特技']);
        Category::create(['name' => '行事']);
        Category::create(['name' => '健康']);
    }
}
