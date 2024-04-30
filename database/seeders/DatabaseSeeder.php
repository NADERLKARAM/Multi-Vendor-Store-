<?php

namespace Database\Seeders;


use App\Models\Category;
use App\Models\Store;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         // Set memory limit
         ini_set('memory_limit', '1024M');
        // \App\Models\User::factory(10)->create();
        Category::factory(10)->create();
        Store::factory(5)->create();
        Product::factory(20)->create();
    }
}