<?php

namespace App\Http\Requests;

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
     * @return array
     */
    public function rules()
    {
        return [
//            'name' => 'required|string',
//            'surname' => 'required|string',
//            'email' => 'required|string|email|unique:users',
//            'password' => 'required|min:6',
//            'confirm_password' => 'required|same:password',
            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => 'required',
            'password' => 'required',
            'confirm_password' => 'required',

        ];
    }

}
