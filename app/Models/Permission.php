<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    protected $guarded = false;

    public function users()
    {
        return $this->belongsToMany(User::class, 'permmission_users', 'permmission_id', 'user_id')->using(PermissionUser::class);
    }
}
