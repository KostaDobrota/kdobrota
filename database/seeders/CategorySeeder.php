<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Zelene masline',
                'description' => 'Sveže zelene masline različitih sorti'
            ],
            [
                'name' => 'Crne masline',
                'description' => 'Zrele crne masline različitih sorti'
            ],
            [
                'name' => 'Maslinovo ulje',
                'description' => 'Extra devičansko maslinovo ulje'
            ],
            [
                'name' => 'Punjene masline',
                'description' => 'Masline punjene paprikom, bademom ili drugim dodacima'
            ],
            [
                'name' => 'Specijalni proizvodi',
                'description' => 'Posebni proizvodi od maslina'
            ]
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description']
            ]);
        }
    }
}
