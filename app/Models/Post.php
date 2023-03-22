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

    protected $dates = [
        'email_verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'body',
        'image',
    ];

    protected $guarded = false;

    protected function serializeDate(DateTimeInterface $dates)
    {
        return $dates->format('Y-m-d');
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getIsImageAttribute() 
    {
        return Storage::url($this->image);
    }
}
