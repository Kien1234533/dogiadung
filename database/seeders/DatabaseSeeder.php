<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // category product
        DB::table('product_categories')->insert([
            'category_name' => 'Man',
        ]);
        DB::table('product_categories')->insert([
            'category_name' => 'Woman',
        ]);
        DB::table('product_categories')->insert([
            'category_name' => 'Children',
        ]);
        DB::table('product_categories')->insert([
            'category_name' => 'Infant',
        ]);
        // category blog
        DB::table('blog_categories')->insert([
            'category_name' => 'Fashion',
        ]);
        DB::table('blog_categories')->insert([
            'category_name' => 'Market',
        ]);
        DB::table('blog_categories')->insert([
            'category_name' => 'News',
        ]);
        DB::table('blog_categories')->insert([
            'category_name' => 'Hot',
        ]);
        // color
        DB::table('colors')->insert([
            'color_name' => 'White',
            'color_code' => '#fff',
        ]);
        DB::table('colors')->insert([
            'color_name' => 'Black',
            'color_code' => '#000',
        ]);
        DB::table('colors')->insert([
            'color_name' => 'Orange',
            'color_code' => '#ffa500',
        ]);
        DB::table('colors')->insert([
            'color_name' => 'Red',
            'color_code' => '#ff0000',
        ]);
        DB::table('colors')->insert([
            'color_name' => 'Pink',
            'color_code' => '#ffc0cb',
        ]);
        DB::table('colors')->insert([
            'color_name' => 'Green',
            'color_code' => '#008000',
        ]);
        DB::table('colors')->insert([
            'color_name' => 'Purple',
            'color_code' => '#800080',
        ]);
        DB::table('colors')->insert([
            'color_name' => 'Blue',
            'color_code' => '#0000ff',
        ]);
        DB::table('colors')->insert([
            'color_name' => 'Gray',
            'color_code' => '#888',
        ]);
        // size
        DB::table('sizes')->insert([
            'size_name' => 'X-Small',
        ]);
        DB::table('sizes')->insert([
            'size_name' => 'Small',
        ]);
        DB::table('sizes')->insert([
            'size_name' => 'Medium',
        ]);
        DB::table('sizes')->insert([
            'size_name' => 'Large',
        ]);
        DB::table('sizes')->insert([
            'size_name' => 'X-Large',
        ]);
        DB::table('sizes')->insert([
            'size_name' => 'XX-Large',
        ]);
        DB::table('sizes')->insert([
            'size_name' => '29',
        ]);
        DB::table('sizes')->insert([
            'size_name' => '30',
        ]);
        DB::table('sizes')->insert([
            'size_name' => '31',
        ]);
        DB::table('sizes')->insert([
            'size_name' => '32',
        ]);
        DB::table('sizes')->insert([
            'size_name' => '33',
        ]);
        DB::table('sizes')->insert([
            'size_name' => '34',
        ]);
        DB::table('sizes')->insert([
            'size_name' => '1-3M(50)',
        ]);
        DB::table('sizes')->insert([
            'size_name' => '3-8M(60)',
        ]);
        DB::table('sizes')->insert([
            'size_name' => '8-12M(70)',
        ]);
        DB::table('sizes')->insert([
            'size_name' => '12-18M(80)',
        ]);
        DB::table('sizes')->insert([
            'size_name' => '18-24M(90)',
        ]);
        DB::table('sizes')->insert([
            'size_name' => '18-24M(90)',
        ]);
        DB::table('sizes')->insert([
            'size_name' => '3-4Y(100)',
        ]);
        DB::table('sizes')->insert([
            'size_name' => '4-5Y(110)',
        ]);
        DB::table('sizes')->insert([
            'size_name' => '6-7Y(120)',
        ]);
        DB::table('sizes')->insert([
            'size_name' => '8-9Y(130)',
        ]);
        DB::table('sizes')->insert([
            'size_name' => '10-11Y(140)',
        ]);
        DB::table('sizes')->insert([
            'size_name' => '12-13Y(150)',
        ]);
        DB::table('sizes')->insert([
            'size_name' => '14Y(160)',
        ]);
        // voucher
        DB::table('vouchers')->insert([
            'code' => 'SALE150K',
            'name' => 'Giảm đơn 150k',
            'querytext' => "Cho đơn hàng tối thiểu 999k",
            'query' => 999000,
            'discount_amount' => 150000,
            'quantity' => 150
        ]);
        DB::table('vouchers')->insert([
            'code' => 'SALE100K',
            'name' => 'Giảm đơn 100k',
            'querytext' => "Cho đơn hàng tối thiểu 700k",
            'query' => 700000,
            'discount_amount' => 100000,
            'quantity' => 300
        ]);
        DB::table('vouchers')->insert([
            'code' => 'SALE50K',
            'name' => 'Giảm đơn 50k',
            'querytext' => "Cho đơn hàng tối thiểu 500k",
            'query' => 500000,
            'discount_amount' => 50000,
            'quantity' => 999
        ]);
    }
}
