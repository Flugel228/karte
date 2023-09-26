<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductUserComment extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'product_user_comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int,string>
     */
    protected $fillable = [
        'product_id',
        'user_id',
        'comment',
        'rate',
        'title',
    ];

    public function commentedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getDateAsCarbonAttribute()
    {
        return Carbon::parse($this->updated_at)->format('m d,Y • H:i');
    }
}
