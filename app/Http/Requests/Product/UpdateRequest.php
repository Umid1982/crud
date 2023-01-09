<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name_uz' => 'required|string',
            'measurement_id' => 'required|integer',
            'price' => 'required|numeric',
            'department_id' => 'required|integer',
            'barcode' => 'required|string',
            'name_ru' => 'required|string',
            'name_en' => 'required|string',
            'image' => 'required|string',
        ];
    }
}