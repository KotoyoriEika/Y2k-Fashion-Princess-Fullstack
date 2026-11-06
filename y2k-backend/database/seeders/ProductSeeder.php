<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Coach Tabby Wedge Shoes',
                'description' => 'Chic and cute! perfect for a walk at the beach, the mall, craft shop, ANYWHERE!',
                'category_id' => 1,
                'price' => 1500000,
                'stock' => 10,
                'img' => 'products/coach-tabbys-wedge-shoes.jpg',
                'specifications' => ['Brand' => 'Coach', 'Color' => 'Black', 'Material' => 'Leather'],
            ],
            [
                'name' => 'Capri jeans',
                'description' => 'The legendary capri pants, in jeans! Perfect to stay chic in the humid summer.',
                'category_id' => 3,
                'price' => 450000,
                'stock' => 20,
                'img' => 'products/jeans.jpg',
                'specifications' => ['Brand' => 'Levi', 'Color' => 'Washed Blue', 'Material' => 'Jeans'],
            ],
            [
                'name' => 'Pink Babydoll Top',
                'description' => 'Pink, cute, and sweet! Be the personification of a cotton candy with this cotton made babydoll top.',
                'category_id' => 2,
                'price' => 250000,
                'stock' => 14,
                'img' => 'products/pink-babydoll-top.jpg',
                'specifications' => ['Brand' => 'Hollister', 'Color' => 'Pink', 'Material' => 'Cotton, Polyester'],
            ],
            [
                'name' => 'Pink Zebra Pattern Sunglasses',
                'description' => 'No more hurting your eyes with this pair of hilton-esque sunglasses.',
                'category_id' => 4,
                'price' => 75000,
                'stock' => 93,
                'img' => 'products/pink-zebra-pattern-sunglasses.jpg',
                'specifications' => ['Brand' => 'Zara', 'Color' => 'Black, Pink', 'Material' => 'Plastic'],
            ],
            [
                'name' => 'Skull Vectorbloom Top',
                'description' => 'Are you trying to look mysterious and sexy? Skull vectorbloom will make you look as cold as an iceberg.',
                'category_id' => 2,
                'price' => 450000,
                'stock' => 45,
                'img' => 'products/Skull-vectorbloom-top.jpg',
                'specifications' => ['Brand' => 'Abercrombie & Fitch', 'Color' => 'Black, Blue, Teal', 'Material' => 'Cotton, Polyester'],
            ],
            [
                'name' => 'Vectorbloom Foldover Pants',
                'description' => 'Too tired to dress up? Try this one! Be chic without trying at all.',
                'category_id' => 3,
                'price' => 150000,
                'stock' => 23,
                'img' => 'products/vectorbloom-foldover.jpg',
                'specifications' => ['Brand' => 'Abercrombie & Fitch', 'Color' => 'Black, Pink', 'Material' => 'Spandex, Cotton'],
            ],
        ];

        foreach ($products as $p) {
            DB::table('products')->insert([
                'name' => $p['name'],
                'slug' => Str::slug($p['name']),
                'description' => $p['description'],
                'category_id' => $p['category_id'],
                'price' => $p['price'],
                'stock' => $p['stock'],
                'img' => $p['img'],
                'specifications' => json_encode($p['specifications']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}