<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'type' => 'Post',
            'attributes' => [
                'title' => $this->title,
                'description' => $this->description,
                'source' => $this->source,
                'status' => $this->status,
            ]
        ];
    }
}
