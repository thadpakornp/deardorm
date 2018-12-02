<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaillingRequest extends FormRequest {

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
            'topic' => 'required',
            'texts' => 'required',
        ];
    }

    public function messages() {
        return [
            'topic.required' => 'กรุณาระบุหัวข้อการส่ง',
            'texts.required' => 'กรุณาระบุรายละเอียดการส่ง',
        ];
    }

}
