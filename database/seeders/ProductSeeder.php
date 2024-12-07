<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [];

        for ($i = 1; $i <= 500; $i++) {
            $products[] = [
                'product_code' => 'PROD-' . Str::random(6),
                'name' => 'Product ' . $i,
                'description' => 'This is a description for Product ' . $i,
                'price' => rand(100, 10000) / 100,
                'customer_id' => Customer::inRandomOrder()->first()->id,
            ];
        }

        Product::insert($products);
    }
}
