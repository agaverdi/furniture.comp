<?php

namespace App\Http\Requests\backend\Comment;

use Illuminate\Foundation\Http\FormRequest;

class CommentCreateRequest extends FormRequest
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
    public function rules()
    {
        return [
            'rating' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'comment' => 'required|string',
            'product_id'=>'integer',
            'slug'=>'string'
        ];
    }
}
