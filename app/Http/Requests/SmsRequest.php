<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SmsRequest extends FormRequest {

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
            'username' => 'required',
            'gateway' => 'required',
        ];
    }

    public function messages() {
        return [
            'username.required' => 'กรุณาระบุชื่อผู้ใช้งาน',
            'gateway.required' => 'โปรดเลือกผู้ให้บริการ',
        ];
    }

}
