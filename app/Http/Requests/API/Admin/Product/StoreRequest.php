<?php

namespace App\Http\Requests\API\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'additional' => 'required|string',
            'category_id' => 'required|integer',
            'color_ids' => 'required|array',
            'color_ids.*' => 'integer|exists:colors,id',
            'tag_ids' => 'array',
            'tag_ids.*' => 'integer|exists:tags,id',
            'images' => 'required|array',
            'images.*' => 'image|dimensions:min_width=255,min_height=310',
        ];
    }
}
