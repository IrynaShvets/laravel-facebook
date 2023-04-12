<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'image' => $this->image,
            // 'friends' => $this->whenPivotLoaded('friends', function () {
            //     return $this->pivot->friends;
            // }),
            'created_at' => $this->created_at->format('d.m.Y'),
            'updated_at' => $this->updated_at->format('d.m.Y'),
            'friends' => $this->friends->map(function ($friend) {
                    return [
                        'id' => $friend->id,
                        'name' => $friend->name,
                        'email' => $friend->email,
                        'image' => $this->image,
                    ];
            })
        ];
    }
}


