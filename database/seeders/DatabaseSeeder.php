<?php

namespace Database\Seeders;

use App\Models\RealEstate; 
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        RealEstate::factory(25)->create();
    }
}