<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Common extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];

    protected $guarded = false;

    // protected static function boot()
    // {
    //     // parent::boot();
    //     // static::creating(function ($common) {
    //     //     if(Auth::check()) {
    //     //         $common->user_id = Auth::user()->id;
    //     //     }
    //     // });
    // }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
