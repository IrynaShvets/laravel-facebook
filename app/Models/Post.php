<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Filterable;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'body',
        'image',
    ];

    protected $guarded = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function setImageAttribute($value)
    {
        if ($value instanceof UploadedFile) {
            $filename = date('d-m-Y') . '_' . $value->getClientOriginalName();
            Storage::put("posts/{$filename}", file_get_contents($value));
            $this->attributes['image'] = "posts/{$filename}";
        } else {
            $this->attributes['image'] = $value;
        }
    }

    public function getImageAttribute ($value) {
        if ($value) {
            return Storage::url($value);
        }
        return null;
    }
}
