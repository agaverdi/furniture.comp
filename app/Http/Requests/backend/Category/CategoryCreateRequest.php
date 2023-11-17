<?php

namespace App\Http\Requests\backend\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() : array
    {
        return [
            'name'  => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}
