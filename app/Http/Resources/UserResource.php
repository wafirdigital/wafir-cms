<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Product;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $products = Product::where(['user_id' => $this->id])->get();
        return [
            'id' => $this->id,
            'type' => 'users',
            'attributes' => [
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password,
                'products' => $products
            ]
        ];
    }
}
