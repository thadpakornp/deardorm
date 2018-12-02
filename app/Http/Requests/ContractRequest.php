<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContractRequest extends FormRequest {

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
            'water' => 'required',
            'power' => 'required',
            'term' => 'required',
            'start' => 'required|date',
        ];
    }

    public function messages() {
        return [
            'id.required' => 'กรุณาระบุชื่อผู้ทำสัญญา',
            'room.required' => 'กรุณาระบุห้องที่ต้องการทำสัญญา',
            'water.required' => 'กรุณาระบุปะปาเริ่มต้น',
            'power.required' => 'กรุณาระบุไฟฟ้าเริ่มต้น',
            'term.required' => 'กรุณาระบุอายุสัญญา',
            'start.required' => 'กรุณากำหนดวันเริมต้นสัญญา',
            'start.date' => 'รูปแบบวันเริ่มต้นสัญญาไม่ถูกต้อง',
        ];
    }

}
