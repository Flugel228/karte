<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory, Filterable;

    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, float, string>
     */
    protected $fillable = [
        'title',
        'quantity',
        'price',
        'description',
        'additional',
        'category_id',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function colors(): BelongsToMany
    {
        return $this->belongsToMany(Color::class, 'color_products', 'product_id', 'color_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id');
    }

    public function images(): BelongsToMany
    {
        return $this->belongsToMany(Image::class, 'image_products', 'product_id', 'image_id');
    }

    public function likedUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'product_user_likes', 'product_id', 'user_id');
    }

    public function commentedUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'product_user_comments', 'product_id', 'user_id');
    }

    public function productComments(): HasMany
    {
        return $this->hasMany(ProductUserComment::class, 'product_id', 'id');
    }

    public function usersOrdered(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'product_user_orders', 'product_id', 'user_id');
    }
}
