<?php

namespace App\Http\Requests\backend\SubCategory;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'parent_category_id' => 'required|exists:category,id',
            'name' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'is_set'=>'required|numeric|in:0,1',
        ];
    }
}
