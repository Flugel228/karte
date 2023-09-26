<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductUserLike extends Model
{
    use HasFactory;

    protected $table = 'product_user_likes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int>
     */
    protected $fillable = [
      'user_id',
      'product_id'
    ];

}
