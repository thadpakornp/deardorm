<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'name' => 'required',
            'profile' => 'required',
        ];
    }
    
    public function messages() {
        return [
            'email.required' => 'กรุณาระบุอีเมลล์',
            'email.email' => 'รูปแบบอีกเมลล์ไม่ถูกต้อง',
            'name.required' => 'กรุณาระบุชื่อและนามสกุล',
            'profile.required' => 'กรุณาเลือกระดับสิทธิ์การใช้งาน',
        ];
    }
}
