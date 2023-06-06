<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Product;
use App\Models\User;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $product = Product::findOrFail($this->product_id);
        $user = User::findOrFail($this->user_id);

        return [
            'id' => $this->id,
            'type' => 'bids',
            'attributes' => [
                'new_price' => $this->new_price,
                'user' => $user,
                'product' => $product,
            ]
        ];
    }
}
