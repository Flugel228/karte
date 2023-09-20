<?php

namespace App\Http\Resources\API\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'role' => $this->role,
            'gender' => $this->gender,
            'address' => $this->address,
            'telephone' => $this->telephone,
            'email' => $this->email,
            'email_verified_at' => $this->emailVerified,
            'created_at' => $this->created,
            'updated_at' => $this->updated,
        ];
    }
}
