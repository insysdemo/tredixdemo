<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Customer::create([
                'name' => 'Customer ' . $i,
                'email' => 'customer' . $i . '@example.com',
                'phone_number' => '98765432' . rand(10, 99),
            ]);
        }
    }
}
