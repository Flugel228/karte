<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    private const ROLE_CLIENT = 0;
    private const ROLE_ADMIN = 1;

    public static function getRoles(): array
    {
        return [
            self::ROLE_CLIENT => 'Клиент',
            self::ROLE_ADMIN => 'Админ',
        ];
    }

    private const GENDER_MALE = 0;
    private const GENDER_FEMALE = 1;

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
}
