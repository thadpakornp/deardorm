<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingPaymentRequest extends FormRequest {

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
            'paid' => 'required',
            'price' => 'required',
        ];
    }

    public function messages() {
        return [
            'paid.required' => 'กรุณาเลือกประเภทการชำระ',
            'price.required' => 'กรุณาระบุยอดที่ต้องการชำระ',
        ];
    }

}
