<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomsRequest extends FormRequest {

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
            'price' => 'required',
            'type' => 'required',
            'floor' => 'required',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'กรุณาระบุชื่อห้อง',
            'price.required' => 'กรุณาระบุราคา',
            'type.required' => 'กรุณาเลือกประเภทห้อง',
            'floor.required' => 'กรุณาเลือกชั้น',
        ];
    }

}
