<?php

namespace Database\Seeders;

use App\Models\Seller;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Seller::create([
            'name' => 'Seller',
            'username' => 'seller',
            'email' => 'seller@gmail.com',
            'password' => Hash::make('12345')
        ]);
    }
}
