<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            ['category' => 'Shoes', 'created_at' => now(), 'updated_at' => now()],
            ['category' => 'Tops', 'created_at' => now(), 'updated_at' => now()],
            ['category' => 'Bottoms', 'created_at' => now(), 'updated_at' => now()],
            ['category' => 'Accessories', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}