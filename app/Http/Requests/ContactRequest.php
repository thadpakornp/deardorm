<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest {

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
            'email' => 'required|email',
            'contact' => 'required|min:30',
        ];
    }

    public function messages() {
        return [
            'email.required' => 'กรุณาระบุอีเมลล์ติดต่อกลับ',
            'email.email' => 'รูปแบบอีเมลล์ไม่ถูกต้อง',
            'contact.required' => 'กรุณาระบุรายละเอียดของปัญหา',
            'contact.min' => 'กรุณาระบุข้อความให้มากกว่า 30 ตัวอักษร',
        ];
    }

}
