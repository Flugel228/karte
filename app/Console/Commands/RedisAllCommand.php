<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Color;
use App\Models\Image;
use App\Models\ImageProduct;
use App\Models\Product;
use App\Models\ProductTag;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class RedisAllCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all elements of models';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Cache::rememberForever('categories:all', function (): \Illuminate\Database\Eloquent\Collection {
            return Category::all();
        })->each(function ($category) {
            Cache::put("categories:$category->id", $category);
        });

        Cache::rememberForever('colors:all', function (): \Illuminate\Database\Eloquent\Collection {
            return Color::all();
        })->each(function ($color) {
            Cache::put("colors:$color->id", $color);
        });

        Cache::rememberForever('images:all', function (): \Illuminate\Database\Eloquent\Collection {
            return Image::all();
        })->each(function ($image) {
            Cache::put("images:$image->id", $image);
        });

        Cache::rememberForever('image_products:all', function (): \Illuminate\Database\Eloquent\Collection {
            return ImageProduct::all();
        })->each(function ($image_product) {
            Cache::put("image_products:$image_product->id", $image_product);
        });

        Cache::rememberForever('products:all', function (): \Illuminate\Database\Eloquent\Collection {
            return Product::all();
        })->each(function ($product) {
            Cache::put("products:$product->id", $product);
        });

        Cache::rememberForever('product_tags:all', function (): \Illuminate\Database\Eloquent\Collection {
            return ProductTag::all();
        })->each(function ($product_tag) {
            Cache::put("product_tags:$product_tag->id", $product_tag);
        });

        Cache::rememberForever('tags:all', function (): \Illuminate\Database\Eloquent\Collection {
            return Tag::all();
        })->each(function ($tag) {
            Cache::put("tags:$tag->id", $tag);
        });

        Cache::rememberForever('users:all', function (): \Illuminate\Database\Eloquent\Collection {
            return User::all();
        })->each(function ($user) {
            Cache::put("users:$user->id", $user);
        });
    }
}
