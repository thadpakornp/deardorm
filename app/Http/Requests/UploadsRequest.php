<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadsRequest extends FormRequest {

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
            'files' => 'mimes:jpeg,bmp,png',
        ];
    }

    public function messages() {
        return [
            'files.mimes' => 'ประเภทของไฟล์รูปภาพไม่ถูกต้อง',
        ];
    }

}
