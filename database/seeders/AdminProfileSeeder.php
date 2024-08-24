<?php

namespace Database\Seeders;

use App\Models\AdminVendor;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = User::where('email', 'vendor@gmail.com')->first();
        $vendor = new AdminVendor();
        $vendor->banner = 'uploads/1234.jpg';
        $vendor->phone = '1234567891';
        $vendor->email = 'admin@gmail.com';
        $vendor->address = 'Osmanpur';
        $vendor->description = 'shop description';
        $vendor->user_id = $user->id;
        $vendor->save();
    }
}
