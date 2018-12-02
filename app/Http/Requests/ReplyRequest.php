<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReplyRequest extends FormRequest {

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
            'contact' => 'required',
        ];
    }

    public function messages() {
        return [
            'email.required' => 'กรุณาระบุอีเมลล์',
            'email.email' => 'รูปแบบอีเมลล์ไม่ถูกต้อง',
            'contact.required' => 'กรุณาระบุรายละเอียดที่ต้องการตอบกลับ',
        ];
    }

}
