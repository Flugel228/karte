<?php

namespace App\Http\Requests\API\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'string|max:255',
            'quantity' => 'integer',
            'price' => 'numeric',
            'description' => 'string',
            'additional' => 'string',
            'category_id' => 'integer',
            'color_ids' => 'array',
            'color_ids.*' => 'integer|exists:colors,id',
            'tag_ids' => 'array',
            'tag_ids.*' => 'integer|exists:tags,id',
            'images' => 'array',
            'images.*' => 'image|dimensions:width=255,height=310',
        ];
    }
}
