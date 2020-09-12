<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'Headphones',
            'description' => 'Deep & immersive sound',
            'price' => 25300,
            'preview_image' => 'headphones.jpg'
        ])->setStock(5);

        Product::create([
            'name' => 'Wheels Bike',
            'description' => 'Dual Disc Brakes 21 Speed Mens Bicycle',
            'price' => 38900,
            'preview_image' => 'bicycle.jpg'
        ])->setStock(2);

        Product::create([
            'name' => 'Mazda 3',
            'description' => 'Skyactiv-G 155-hp, 2.0 L DOHC 16-valve 4-cylinder engine',
            'price' => 2318100,
            'preview_image' => 'car.jpg'
        ])->setStock(1);

        Product::create([
            'name' => 'DJI Marvic Air 2',
            'description' => 'Takes power and portability to the next level',
            'price' => 79900,
            'preview_image' => 'drone.jpg'
        ])->setStock(11);

        Product::create([
            'name' => 'Metcon 6',
            'description' => 'Men\'s Woven Training Shorts',
            'price' => 12600,
            'preview_image' => 'footwear.jpg'
        ])->setStock(2);

        Product::create([
            'name' => 'Cannon Watch',
            'description' => 'Tapered, stadium-style indices are integrated into the dial ring',
            'price' => 18000,
            'preview_image' => 'watch.jpg'
        ])->setStock(56);
    }
}
