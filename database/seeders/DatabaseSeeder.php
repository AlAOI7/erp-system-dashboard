<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // إنشاء مستخدم افتراضي
        $user = User::create([
            'name' => 'مدير النظام',
            'email' => 'admin@erp.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // إنشاء فئات تجريبية
        $categories = [
            ['name' => 'إلكترونيات', 'description' => 'الأجهزة الإلكترونية'],
            ['name' => 'ملابس', 'description' => 'الملابس والأزياء'],
            ['name' => 'أثاث', 'description' => 'الأثاث المنزلي'],
            ['name' => 'كتب', 'description' => 'الكتب والمطبوعات'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // إنشاء منتجات تجريبية
        $products = [
            [
                'name' => 'لابتوب ديل',
                'sku' => 'LAP001',
                'description' => 'لابتوب ديل بمواصفات عالية',
                'price' => 2500.00,
                'quantity' => 15,
                'category_id' => 1
            ],
            [
                'name' => 'هاتف سامسونج',
                'sku' => 'PHN001',
                'description' => 'هاتف ذكي من سامسونج',
                'price' => 1800.00,
                'quantity' => 8,
                'category_id' => 1
            ],
            [
                'name' => 'تيشيرت قطني',
                'sku' => 'TSH001',
                'description' => 'تيشيرت قطني مريح',
                'price' => 50.00,
                'quantity' => 25,
                'category_id' => 2
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}