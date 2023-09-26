<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductUserOrder extends Model
{
    use HasFactory, Filterable;

    /**
     * @var string
     */
    protected $table = 'product_user_orders';

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
