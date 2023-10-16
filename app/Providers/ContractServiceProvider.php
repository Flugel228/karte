<?php

namespace App\Providers;

use App\Contracts\Repositories\CategoryRepositoryContract;
use App\Contracts\Repositories\ColorRepositoryContract;
use App\Contracts\Repositories\ImageRepositoryContract;
use App\Contracts\Repositories\ProductRepositoryContract;
use App\Contracts\Repositories\ProductUserCommentRepositoryContract;
use App\Contracts\Repositories\ProductUserOrderRepositoryContract;
use App\Contracts\Repositories\Proxy\CategoryRepositoryProxyContract;
use App\Contracts\Repositories\Proxy\ColorRepositoryProxyContract;
use App\Contracts\Repositories\Proxy\ImageRepositoryProxyContract;
use App\Contracts\Repositories\Proxy\ProductRepositoryProxyContract;
use App\Contracts\Repositories\Proxy\ProductUserCommentRepositoryProxyContract;
use App\Contracts\Repositories\Proxy\ProductUserOrderRepositoryProxyContract;
use App\Contracts\Repositories\Proxy\TagRepositoryProxyContract;
use App\Contracts\Repositories\Proxy\UserRepositoryProxyContract;
use App\Contracts\Repositories\TagRepositoryContract;
use App\Contracts\Repositories\UserRepositoryContract;
use App\Contracts\Services\CategoryServiceContract;
use App\Contracts\Services\ColorServiceContract;
use App\Contracts\Services\OrderServiceContract;
use App\Contracts\Services\ProductServiceContract;
use App\Contracts\Services\ShopServiceContract;
use App\Contracts\Services\TagServiceContract;
use App\Contracts\Services\UserServiceContract;
use App\Models\ProductUserComment;
use App\Repositories\CategoryRepository;
use App\Repositories\ColorRepository;
use App\Repositories\ImageRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ProductUserCommentRepository;
use App\Repositories\ProductUserOrderRepository;
use App\Repositories\Proxy\CategoryRepositoryProxy;
use App\Repositories\Proxy\ColorRepositoryProxy;
use App\Repositories\Proxy\ImageRepositoryProxy;
use App\Repositories\Proxy\ProductRepositoryProxy;
use App\Repositories\Proxy\ProductUserCommentRepositoryProxy;
use App\Repositories\Proxy\ProductUserOrderRepositoryProxy;
use App\Repositories\Proxy\TagRepositoryProxy;
use App\Repositories\Proxy\UserRepositoryProxy;
use App\Repositories\TagRepository;
use App\Repositories\UserRepository;
use App\Services\CategoryService;
use App\Services\ColorService;
use App\Services\OrderService;
use App\Services\ProductService;
use App\Services\ShopService;
use App\Services\TagService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class ContractServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
        $this->app->bind(UserRepositoryProxyContract::class, UserRepositoryProxy::class);
        $this->app->bind(UserServiceContract::class, UserService::class);
        $this->app->bind(CategoryRepositoryContract::class, CategoryRepository::class);
        $this->app->bind(CategoryRepositoryProxyContract::class, CategoryRepositoryProxy::class);
        $this->app->bind(CategoryServiceContract::class, CategoryService::class);
        $this->app->bind(ColorRepositoryContract::class, ColorRepository::class);
        $this->app->bind(ColorRepositoryProxyContract::class, ColorRepositoryProxy::class);
        $this->app->bind(ColorServiceContract::class, ColorService::class);
        $this->app->bind(TagRepositoryContract::class, TagRepository::class);
        $this->app->bind(TagRepositoryProxyContract::class, TagRepositoryProxy::class);
        $this->app->bind(TagServiceContract::class, TagService::class);
        $this->app->bind(ImageRepositoryContract::class, ImageRepository::class);
        $this->app->bind(ImageRepositoryProxyContract::class, ImageRepositoryProxy::class);
        $this->app->bind(ProductRepositoryContract::class, ProductRepository::class);
        $this->app->bind(ProductRepositoryProxyContract::class, ProductRepositoryProxy::class);
        $this->app->bind(ProductServiceContract::class, ProductService::class);
        $this->app->bind(ShopServiceContract::class, ShopService::class);
        $this->app->bind(ProductUserCommentRepositoryContract::class, ProductUserCommentRepository::class);
        $this->app->bind(ProductUserCommentRepositoryProxyContract::class, ProductUserCommentRepositoryProxy::class);
        $this->app->bind(ProductUserOrderRepositoryContract::class, ProductUserOrderRepository::class);
        $this->app->bind(ProductUserOrderRepositoryProxyContract::class, ProductUserOrderRepositoryProxy::class);
        $this->app->bind(OrderServiceContract::class, OrderService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
