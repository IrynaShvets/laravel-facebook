<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, Filterable;

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

    public function friends(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'friends' , 'user_id', 'friend_id');
    }
 
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function setImageAttribute($value)
    {
        if ($value instanceof UploadedFile) {
            $filename = date('d-m-Y') . '_' . $value->getClientOriginalName();
            Storage::put("users/{$filename}", file_get_contents($value));
            $this->attributes['image'] = "users/{$filename}";
        } else {
            $this->attributes['image'] = $value;
        }
    }

    public function getImageAttribute($value) {
        if ($value) {
            return Storage::url($value);
        }
        return null;
    }
   
}
