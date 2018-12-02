<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountRequest extends FormRequest {

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
            'discount' => 'required',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'กรุณาระบุชื่อส่วนลด',
            'discount.required' => 'กรุณาาะบุส่วนลด',
        ];
    }

}
