<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Community extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'user_id',
    ];

    protected $guarded = false;

    // protected static function boot()
    // {
    //     parent::boot();
    //     static::creating(function ($message) {
    //         if(Auth::check()) {
    //             $message->user_id = Auth::user()->id;
    //         }
    //     });
    // }

    // public function user(): BelongsTo
    // {
    //     return $this->belongsTo(User::class, 'user_id', 'id');
    // }

    // public function users()
    // {
    //     return $this->belongsToMany(User::class);
    // }


    // public function user(): BelongsTo
    // {
    //     return $this->belongsTo(User::class, 'user_id', 'id');
    // }
}
