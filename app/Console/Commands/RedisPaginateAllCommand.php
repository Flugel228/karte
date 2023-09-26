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
use Illuminate\Support\Facades\Cache;
use function Psy\debug;

class RedisPaginateAllCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:paginate:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Paginating all models';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $numberOfElements = Category::all()->count();
        $quantity = 10;
        $numberOfPages = $numberOfElements % $quantity !== 0 ? intdiv($numberOfElements, $quantity) + 1 : $numberOfElements / $quantity;
        for ($page = 1; $page <= $numberOfPages; $page++) {
            Cache::put("categories:paginate:$page", Category::paginate($quantity, ['*'], 'page', $page));
        }

        $numberOfElements = Color::all()->count();
        $numberOfPages = $numberOfElements % $quantity !== 0 ? intdiv($numberOfElements, $quantity) + 1 : $numberOfElements / $quantity;
        for ($page = 1; $page <= $numberOfPages; $page++) {
            Cache::put("colors:paginate:$page", Color::paginate($quantity, ['*'], 'page', $page));
        }

        $numberOfElements = Tag::all()->count();
        $numberOfPages = $numberOfElements % $quantity !== 0 ? intdiv($numberOfElements, $quantity) + 1 : $numberOfElements / $quantity;
        for ($page = 1; $page <= $numberOfPages; $page++) {
            Cache::put("tags:paginate:$page", Tag::paginate($quantity, ['*'], 'page', $page));
        }

        $numberOfElements = User::all()->count();
        $numberOfPages = $numberOfElements % $quantity !== 0 ? intdiv($numberOfElements, $quantity) + 1 : $numberOfElements / $quantity;
        for ($page = 1; $page <= $numberOfPages; $page++) {
            Cache::put("users:paginate:$page", User::paginate($quantity, ['*'], 'page', $page));
        }

        $numberOfElements = Product::all()->count();
        $numberOfPages = $numberOfElements % $quantity !== 0 ? intdiv($numberOfElements, $quantity) + 1 : $numberOfElements / $quantity;
        for ($page = 1; $page <= $numberOfPages; $page++) {
            Cache::put("products:paginate:$page", Product::paginate($quantity, ['*'], 'page', $page));
        }

        $quantity = 12;
        $numberOfPages = $numberOfElements % $quantity !== 0 ? intdiv($numberOfElements, $quantity) + 1 : $numberOfElements / $quantity;
        for ($page = 1; $page <= $numberOfPages; $page++) {
            Cache::put("products:shop:paginate:$page", Product::paginate($quantity, ['*'], 'page', $page));
        }
    }
}
