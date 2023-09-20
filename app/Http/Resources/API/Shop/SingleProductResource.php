<?php

namespace App\Http\Resources\API\Shop;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SingleProductResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'category' => $this->category->title,
            'images' => ImageResource::collection($this->images),
            'colors' => ColorResource::collection($this->colors),
            'tags' => TagResource::collection($this->tags),
            'likedUsers' => UserResource::collection($this->likedUsers),
            'productComments' => CommentResource::collection($this->productComments),
        ];
    }
}
