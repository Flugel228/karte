<?php

namespace App\Http\Resources\API\Shop;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user' => CommentedUserResource::make($this->commentedUser),
            'title' => $this->title,
            'comment' => $this->comment,
            'rate' => $this->rate,
            'date' => $this->dateAsCarbon,
        ];
    }
}
