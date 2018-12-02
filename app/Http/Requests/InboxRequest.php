<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InboxRequest extends FormRequest {

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
            'inbox' => 'required',
        ];
    }

    public function messages() {
        return [
            'email.required' => 'กรุณาระบุอีเมลล์ผู้รับ',
            'email.email' => 'รูปแบบอีเมลล์ไม่ถูกต้อง',
            'inbox.required' => 'กรุณาระบุรายละเอียดตอบกลับ',
        ];
    }

}
