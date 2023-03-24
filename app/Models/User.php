<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';
    const ROLE_MODERATOR = 'moderator';
    const ROLE_DEVELOPER = 'developer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'role_id',
    ];

    protected $guarded = false;

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
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
//isAdmin
    public function isAuth()
    {
        $user = User::find(auth()->user()->id);
        if (asset($user->role()->first()->name)) {
            $role = $user->role()->first()->name;

            if ($role === self::ROLE_ADMIN) {
                return true;
            } elseif ($role === self::ROLE_USER) {
                return false;
            } else {
                return false;
            }
        }
    }

    public function isAuthCreate()
    {
        $user = User::find(auth()->user()->id);
        if (asset($user->role()->first()->name)) {
            $role = $user->role()->first()->name;
            if ($role === self::ROLE_ADMIN || $role === self::ROLE_MODERATOR || $role === self::ROLE_DEVELOPER) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function isAuthUpdate()
    {
        $user = User::find(auth()->user()->id);
        if (asset($user->role()->first()->name)) {
            $role = $user->role()->first()->name;
            if ($role === self::ROLE_ADMIN || $role === self::ROLE_MODERATOR || $role === self::ROLE_DEVELOPER) {
                return true;
            } else {
                return false;
            }
        }
    }
}
