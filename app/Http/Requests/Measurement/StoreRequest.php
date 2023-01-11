<?php

namespace App\Http\Requests\Measurement;

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
    public function rules(): array
    {
        return [
            'name_uz'=>'required|string|max:100',
            'name_ru'=>'required|string|max:100',
            'name_en'=>'required|string|max:100',
        ];
    }
}
