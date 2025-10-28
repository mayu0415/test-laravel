<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Support\Str;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::all();

        foreach (range(1, 25) as $i) {
            Contact::create([
                'last_name' => '山田',
                'first_name' => '太郎' . $i,
                'gender' => rand(1, 3),
                'email' => 'test' . $i . '@example.com',
                'tel' => '0901234567' . $i,
                'address' => '東京都新宿区' . $i . '丁目',
                'building_name' => 'サンプルビル' . $i,
                'category_id' => $categories->random()->id,
                'detail' => '商品の交換についての詳細内容' . $i,
            ]);
        }
    }
}
