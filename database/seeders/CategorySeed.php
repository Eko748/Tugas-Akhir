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
                'category_code' => 'A',
                'category_name' => 'IEEE'
            ]
        );
        Category::create(
            [
                'category_code' => 'B',
                'category_name' => 'ACM'
            ],
        );
        Category::create(
            [
                'category_code' => 'C',
                'category_name' => 'Springer'
            ],
        );
    }
}
