<?php

namespace App\Http\Requests\backend\SubShipping;

use Illuminate\Foundation\Http\FormRequest;

class SubShippingUpdateRequest extends FormRequest
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
            'parent_shipping_id'    => 'required|exists:shipping,id',
            'name'                  => 'required|string',
            'postal_code'           => 'required|string',
            'shipping_price'        => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'is_work'               => 'required|numeric|in:0,1',
        ];
    }
}
