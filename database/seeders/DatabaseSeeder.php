<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Color;
use App\Models\Image;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(50)->create();
        Category::factory(50)->create();
        $colors = Color::factory(50)->create();
        $tags = Tag::factory(50)->create();
        $images = Image::factory(150)->create();
        $products = Product::factory(50)->create();

        foreach ($products as $product) {
            $tagIds = $tags->random(3)->pluck('id');
            $colorIds = $colors->random(5)->pluck('id');
            $imageIds = $images->random(3)->pluck('id');

            $product->tags()->attach($tagIds);
            $product->colors()->attach($colorIds);
            $product->images()->attach($imageIds);
        }

    }
}
