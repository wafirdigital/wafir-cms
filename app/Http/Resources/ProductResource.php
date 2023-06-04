<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = User::findOrFail($this->user_id);
        return [
            'id' => $this->id,
            'type' => 'products',
            'attributes' => [
                'name' => $this->name,
                'model' => $this->model,
                'description' => $this->description,
                'starting_price' => $this->starting_price,
                'user' => $user,
            ]
        ];
    }
}
