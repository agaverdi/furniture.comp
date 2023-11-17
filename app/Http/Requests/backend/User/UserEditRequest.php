<?php

namespace App\Http\Requests\backend\User;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
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
            'name'      => 'required|string|min:3',
            'address'   => 'nullable|string|max:200',
            'phone'     => ['nullable','string','max:30','regex:/^\+994\s?(?:10|50|55|99|51|70|77|60|12)\s?(?:\d{7}|\d{6}\s?\d{4}|\d{3}\s?\d{3}\s?\d{4}|\d{3}\s?\d{2}\s?\d{2}\s?\d{2})$/'],
            'mobile'    => ['nullable','string','max:30','regex:/^\+994\s?(?:10|50|55|99|51|70|77|60|12)\s?(?:\d{7}|\d{6}\s?\d{4}|\d{3}\s?\d{3}\s?\d{4}|\d{3}\s?\d{2}\s?\d{2}\s?\d{2})$/'],
            'image'     => 'nullable|image',
            'position'  => 'nullable|string|max:30',
        ];
    }
}
