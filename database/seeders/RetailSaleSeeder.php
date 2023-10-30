<?php

namespace Database\Seeders;

use App\Models\RetailSale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RetailSaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RetailSale::factory()->count(10)->create();
    }
}
