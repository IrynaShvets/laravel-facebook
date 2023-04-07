<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'body',
        'image',
    ];

    protected $guarded = false;

    // public function boot() 
    // {
        
    // }

    protected function serializeDate(DateTimeInterface $dates)
    {
        return $dates->format('Y-m-d');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function setImageAttribute($value)
    {
        $this->attributes['image'] = 'images/' . date('d-m-Y')."_".$value->getClientOriginalName();
    }

    public function getImageUrlAttribute ($value) {
        if ($value) {
            return Storage::url($value);
        }
        return null;
    }

}
