<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AddKitchen extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => 'required',
            'name' => 'required',
        ];
    }

    /**
     *
     * @return type
     */
    public function messages()
    {
        return [
            'code.required' => "Mã nhà bếp không được để trống",
            'name.required' => "Tên nhà bếp không được để trống",
        ];
    }
}
