<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    private const ROLE_CLIENT = 0;
    private const ROLE_ADMIN = 1;

    /**
     * @return string[]
     */
    public static function getRoles(): array
    {
        return [
            self::ROLE_CLIENT => 'Клиент',
            self::ROLE_ADMIN => 'Админ',
        ];
    }

    private const GENDER_MALE = 0;
    private const GENDER_FEMALE = 1;

    /**
     * @return string[]
     */
    public static function getGenders(): array
    {
        return [
            self::GENDER_MALE => 'Мужчина',
            self::GENDER_FEMALE => 'Женщина',
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'role',
        'gender',
        'address',
        'telephone',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getEmailVerifiedAsCarbonAttribute(): string
    {
        return Carbon::parse($this->email_verified_at)->format('F d,Y • H:i');
    }

    public function getCreatedAsCarbonAttribute(): string
    {
        return Carbon::parse($this->created_at)->format('F d,Y • H:i');
    }

    /**
     * @return string
     */
    public function getUpdatedAsCarbonAttribute(): string
    {
        return Carbon::parse($this->updated_at)->format('F d,Y • H:i');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function likedProducts(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_user_likes', 'user_id', 'product_id');
    }

    public function commentedProducts(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_user_comments', 'user_id', 'product_id');
    }

    public function orderedProducts(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_user_orders', 'user_id', 'product_id');
    }
}
