<?php

namespace App\Http\Requests\Department;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name_uz'=>'required|string',
            'printer'=>'required|string',
            'filial_id'=>'required|integer',
            'name_ru'=>'required|string',
            'name_en'=>'required|string',
        ];
    }
}
