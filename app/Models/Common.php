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

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
