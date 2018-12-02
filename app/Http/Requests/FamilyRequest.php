<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FamilyRequest extends FormRequest {

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
            'relationship' => 'required',
            'mobile' => 'required',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'กรุณาระบุชื่อผู้ติดต่อได้',
            'relationship.required' => 'กรุณาระบุความสัมพันธ์',
            'mobile.required' => 'กรุณาระบุหมายเลขติดต่อ',
        ];
    }

}
