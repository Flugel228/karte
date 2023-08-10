<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'path',
        'url',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'image_products', 'image_id', 'product_id');
    }
}
