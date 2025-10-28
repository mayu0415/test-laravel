<?php

namespace Database\Seeders;

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
        $categories = [
            '商品について',
            '商品の交換について',
            '返品について',
            'その他',
        ];

        foreach ($categories as $category) {
            Category::create(['content' => $category]);
        }
    }
}
