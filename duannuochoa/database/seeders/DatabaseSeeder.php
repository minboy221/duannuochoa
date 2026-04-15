<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Roles
        \Illuminate\Support\Facades\DB::table('roles')->updateOrInsert(
            ['role_id' => 1], ['role_name' => 'Admin']
        );
        \Illuminate\Support\Facades\DB::table('roles')->updateOrInsert(
            ['role_id' => 2], ['role_name' => 'User']
        );

        // Seed Admin Account
        \Illuminate\Support\Facades\DB::table('users')->updateOrInsert(
            ['email' => 'admin@gmail.com'],
            [
                'username' => 'admin',
                'full_name' => 'Administrator',
                'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
                'role_id' => 1,
                'created_at' => \Carbon\Carbon::now(),
            ]
        );
        \App\Models\Role::firstOrCreate(['role_name' => 'Admin']);
        \App\Models\Role::firstOrCreate(['role_name' => 'Staff']);
        \App\Models\Role::firstOrCreate(['role_name' => 'Customer']);

        
        // Seed Categories
        $cat1 = \App\Models\Category::firstOrCreate(['name' => 'Nước hoa Nam'], ['description' => 'Các loại nước hoa dành cho nam giới']);
        $cat2 = \App\Models\Category::firstOrCreate(['name' => 'Nước hoa Nữ'], ['description' => 'Các loại nước hoa dành cho nữ giới']);
        \App\Models\Category::firstOrCreate(['name' => 'Nước hoa Unisex'], ['description' => 'Các loại nước hoa dành cho cả nam và nữ']);

        // Seed Brands
        $brand1 = \App\Models\Brand::firstOrCreate(['name' => 'Dior'], ['logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/a/a8/Dior_Logo.svg']);
        $brand2 = \App\Models\Brand::firstOrCreate(['name' => 'Chanel'], ['logo_url' => 'https://upload.wikimedia.org/wikipedia/en/thumb/9/92/Chanel_logo_interlocking_cs.svg/1200px-Chanel_logo_interlocking_cs.svg.png']);

        // Seed some products
        $p1 = \App\Models\Product::firstOrCreate(
            ['name' => 'Sauvage Eau de Parfum'],
            [
                'category_id' => $cat1->category_id,
                'brand_id' => $brand1->brand_id,
                'description' => 'Hương thơm nam tính, mạnh mẽ.',
                'base_price' => 2500000
            ]
        );

        // Seed variants
        \App\Models\ProductVariant::firstOrCreate(
            ['product_id' => $p1->product_id, 'volume_id' => 100],
            ['price' => 3200000, 'stock_quantity' => 50, 'color' => 'Xanh đen']
        );
        \Illuminate\Support\Facades\DB::table('roles')->insert([
            ['role_id' => 1, 'role_name' => 'Admin'],
            ['role_id' => 2, 'role_name' => 'User'],
        ]);
        
        \App\Models\ProductVariant::firstOrCreate(
            ['product_id' => $p1->product_id, 'volume_id' => 50],
            ['price' => 2100000, 'stock_quantity' => 20, 'color' => 'Xanh đen']
        );
    }
}
