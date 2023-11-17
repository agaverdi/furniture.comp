<?php

namespace App\Http\Requests\backend\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
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
    public function rules() :array
    {
        return [
            'name' => 'required|string',
            'parent_category_id' => 'required|exists:category,id',
            'sub_category_id' => 'required|exists:category,id',
            'description' => 'required',

            'price' => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'discount'=>'numeric|min:1|nullable',
            'is_stock' => 'required|in:0,1|size:1',
            'stars' => 'required|numeric|between:1,5',
            'path1' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'path2' => 'image|mimes:jpeg,png,jpg|max:2048',
            'path3' => 'image|mimes:jpeg,png,jpg|max:2048',
            'path4' => 'image|mimes:jpeg,png,jpg|max:2048',
            'path5' => 'image|mimes:jpeg,png,jpg|max:2048',
            'path6' => 'image|mimes:jpeg,png,jpg|max:2048',

            'set_name1'=>'string',
            'set_price1'=>'numeric|min:1|between:0.00,9999.00',
            'set_discount1'=>'numeric|min:1|between:0.00,9999.00',
            'count1'=>'numeric|min:1',

            'set_name2'=>'nullable|string',
            'set_price2'=>'nullable|numeric|min:1|between:0.00,9999.00',
            'set_discount2'=>'nullable|nullable|numeric|min:1|between:0.00,9999.00',
            'count2'=>'nullable|numeric|min:1',


            'set_name3'=>'nullable|string',
            'set_price3'=>'nullable|numeric|min:1|between:0.00,9999.00',
            'set_discount3'=>'nullable|nullable|numeric|min:1|between:0.00,9999.00',
            'count3'=>'nullable|numeric|min:1',

            'set_name4'=>'nullable|string',
            'set_price4'=>'nullable|numeric|min:1|between:0.00,9999.00',
            'set_discount4'=>'nullable|nullable|numeric|min:1|between:0.00,9999.00',
            'count4'=>'nullable|numeric|min:1',

             'set_name5'=>'nullable|string',
             'set_price5'=>'nullable|numeric|min:1|between:0.00,9999.00',
             'set_discount5'=>'nullable|nullable|numeric|min:1|between:0.00,9999.00',
             'count5'=>'nullable|numeric|min:1',


             'set_name6'=>'nullable|string',
             'set_price6'=>'nullable|numeric|min:1|between:0.00,9999.00',
             'set_discount6'=>'nullable|nullable|numeric|min:1|between:0.00,9999.00',
             'count6'=>'nullable|numeric|min:1',
        ];
    }
}
