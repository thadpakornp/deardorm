<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingContractRequest extends FormRequest {

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
            'id' => 'required',
            'room' => 'required',
            'term' => 'required',
            'start' => 'required|date',
        ];
    }

    public function messages() {
        return [
            'id.required' => 'กรุณาเลือกผู้ทำสัญญา',
            'room.required' => 'ห้องที่ทำสัญญาต้องไม่เป็นค่าว่าง',
            'term.required' => 'กรุณาเลือกอายุสัญญา',
            'start.required' => 'กรุณาเลือกวันริ่มต้นสัญญา',
            'start.date' => 'รูปแบบวันเริ่มต้นสัญญาไม่ถูกต้อง',
        ];
    }

}
