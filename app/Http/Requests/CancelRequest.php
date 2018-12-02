<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CancelRequest extends FormRequest {

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
            'power' => 'required',
            'water' => 'required',
        ];
    }

    public function messages() {
        return [
            'power.required' => 'กรุณาระบุไฟฟ้าหน่วยสุดท้าย',
            'water.required' => 'กรุณาระบุน้ำปะปาหน่วยสุดท้าย',
        ];
    }

}
