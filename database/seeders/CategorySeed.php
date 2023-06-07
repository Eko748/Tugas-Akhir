<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(
            [
                'id' => '1',
                'category_code' => 'A',
                'category_name' => 'IEEE'
            ]
        );
        Category::create(
            [
                'id' => '2',
                'category_code' => 'B',
                'category_name' => 'ACM'
            ],
        );
        Category::create(
            [
                'id' => '3',
                'category_code' => 'C',
                'category_name' => 'Springer'
            ],
        );
    }
}
