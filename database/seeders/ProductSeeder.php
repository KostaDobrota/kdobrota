<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // Zelene masline
            [
                'category_name' => 'Zelene masline',
                'products' => [
                    [
                        'name' => 'Zelene masline Manzanilla',
                        'description' => 'Španske Manzanilla masline, poznate po svojoj čvrstoj teksturi i blagom ukusu. Idealne za salate i predjela. Pakovanje od 250g.',
                        'price' => 399.99,
                        'stock' => 50,
                        'image_path' => 'products/manzanilla.jpg',
                        'is_featured' => true
                    ],
                    [
                        'name' => 'Zelene masline Nocellara',
                        'description' => 'Premium italijanske Nocellara del Belice masline, sa karakterističnim hrskavim mesom i blagim ukusom. Savršene uz sir i vino. Pakovanje od 200g.',
                        'price' => 449.99,
                        'stock' => 40,
                        'image_path' => 'products/nocellara.jpg',
                        'is_featured' => true
                    ],
                    [
                        'name' => 'Zelene masline Gordal',
                        'description' => 'Krupne španske Gordal masline, poznate kao "kraljice maslina" zbog svoje veličine. Blago slankaste sa punim ukusom. Pakovanje od 300g.',
                        'price' => 499.99,
                        'stock' => 30,
                        'image_path' => 'products/gordal.jpg',
                        'is_featured' => true
                    ],
                    [
                        'name' => 'Zelene masline sa začinskim biljem',
                        'description' => 'Sveže zelene masline marinirane sa mediteranskim začinskim biljem (timijan, ruzmarin, lovorov list) i belim lukom. Pakovanje od 250g.',
                        'price' => 429.99,
                        'stock' => 45,
                        'image_path' => 'products/herb-olives.jpg',
                        'is_featured' => false
                    ]
                ]
            ],
            // Crne masline
            [
                'category_name' => 'Crne masline',
                'products' => [
                    [
                        'name' => 'Crne masline Kalamata',
                        'description' => 'Tradicionalne grčke crne masline sa karakterističnim ljubičastim tonom i bogatim ukusom.',
                        'price' => 15.99,
                        'stock' => 60,
                        'image_path' => null,
                        'is_featured' => false
                    ],
                    [
                        'name' => 'Crne masline Niçoise',
                        'description' => 'Male francuske crne masline intenzivnog ukusa, idealne za salate i soseve.',
                        'price' => 16.99,
                        'stock' => 35,
                        'image_path' => null,
                        'is_featured' => false
                    ],
                    [
                        'name' => 'Sušene crne masline',
                        'description' => 'Prirodno sušene crne masline sa koncentrisanim ukusom, savršene kao dodatak jelima.',
                        'price' => 18.99,
                        'stock' => 30,
                        'image_path' => null,
                        'is_featured' => false
                    ]
                ]
            ],
            // Maslinovo ulje
            [
                'category_name' => 'Maslinovo ulje',
                'products' => [
                    [
                        'name' => 'Extra devičansko maslinovo ulje Premium',
                        'description' => 'Vrhunsko extra devičansko maslinovo ulje prve klase, dobijeno hladnim ceđenjem najkvalitetnijih maslina.',
                        'price' => 29.99,
                        'stock' => 100,
                        'image_path' => null,
                        'is_featured' => false
                    ],
                    [
                        'name' => 'Organsko maslinovo ulje',
                        'description' => 'Sertifikovano organsko extra devičansko maslinovo ulje, proizvedeno bez pesticida i veštačkih đubriva.',
                        'price' => 34.99,
                        'stock' => 80,
                        'image_path' => null,
                        'is_featured' => false
                    ],
                    [
                        'name' => 'Maslinovo ulje sa začinskim biljem',
                        'description' => 'Extra devičansko maslinovo ulje infuzirano mediteranskim začinskim biljem.',
                        'price' => 24.99,
                        'stock' => 70,
                        'image_path' => null,
                        'is_featured' => false
                    ]
                ]
            ],
            // Punjene masline
            [
                'category_name' => 'Punjene masline',
                'products' => [
                    [
                        'name' => 'Masline punjene bademom',
                        'description' => 'Zelene masline punjene celim bademom, tradicionalni mediteranski delikates.',
                        'price' => 17.99,
                        'stock' => 40,
                        'image_path' => null,
                        'is_featured' => false
                    ],
                    [
                        'name' => 'Masline punjene paprikom',
                        'description' => 'Sočne zelene masline punjene crvenom paprikom, blago pikantnog ukusa.',
                        'price' => 15.99,
                        'stock' => 45,
                        'image_path' => null,
                        'is_featured' => false
                    ],
                    [
                        'name' => 'Masline punjene belim lukom',
                        'description' => 'Zelene masline punjene svežim belim lukom, savršen spoj ukusa.',
                        'price' => 16.99,
                        'stock' => 35,
                        'image_path' => null,
                        'is_featured' => false
                    ]
                ]
            ],
            // Specijalni proizvodi
            [
                'category_name' => 'Specijalni proizvodi',
                'products' => [
                    [
                        'name' => 'Tapenade od maslina',
                        'description' => 'Tradicionalni mediteranski namaz od crnih maslina sa začinskim biljem.',
                        'price' => 9.99,
                        'stock' => 55,
                        'image_path' => null,
                        'is_featured' => false
                    ],
                    [
                        'name' => 'Maslinov sapun',
                        'description' => 'Prirodni sapun napravljen od maslinovog ulja, bogat antioksidansima.',
                        'price' => 7.99,
                        'stock' => 65,
                        'image_path' => null,
                        'is_featured' => false
                    ],
                    [
                        'name' => 'Krema od maslinovog ulja',
                        'description' => 'Hidratantna krema za negu kože sa maslinovim uljem i prirodnim ekstraktima.',
                        'price' => 19.99,
                        'stock' => 40,
                        'image_path' => null,
                        'is_featured' => false
                    ]
                ]
            ]
        ];

        foreach ($products as $categoryProducts) {
            $category = Category::where('name', $categoryProducts['category_name'])->first();
            
            if ($category) {
                foreach ($categoryProducts['products'] as $product) {
                    Product::create([
                        'category_id' => $category->id,
                        'name' => $product['name'],
                        'slug' => Str::slug($product['name']),
                        'description' => $product['description'],
                        'price' => $product['price'],
                        'stock' => $product['stock'],
                        'image_path' => $product['image_path'],
                        'is_featured' => $product['is_featured']
                    ]);
                }
            }
        }
    }
}
