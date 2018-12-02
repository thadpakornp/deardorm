<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BankRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'name' => 'required',
            'number' => 'required',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'กรุณาระบุชื่อธนาคาร',
            'number.required' => 'กรุณาระบุหมายเลขบัญชีธนาคาร',
        ];
    }

}
