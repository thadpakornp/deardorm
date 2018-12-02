<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MoveRequest extends FormRequest {

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
            'roomnew' => 'required',
            'start' => 'required|date',
            'term' => 'required',
            'water' => 'required',
            'power' => 'required',
            'oldwater' => 'required',
            'oldpower' => 'required',
            'clear' => 'required',
        ];
    }

    public function messages() {
        return [
            'roomnew.required' => 'กรุณาเลือกห้องพักใหม่',
            'start.required' => 'กรุณาระบุวันเริ่มต้นสัญญา',
            'start.date' => 'รูปบบวันเริ่มต้นสัญญาไม่ถูกต้อง',
            'term.required' => 'กรุณาเลือกอายุสัญญา',
            'water.required' => 'กรุณาระบุปะปาเริ่มต้น',
            'power.required' => 'กรุณาระบุไฟฟ้าเริ่มต้น',
            'oldwater.required' => 'กรุณาระบุปะปาห้องเดิม',
            'oldpower.required' => 'กรุณาระบุไฟฟ้าห้องเดิม',
            'clear.required' => 'กรุณาระบุค่าทำความสะอาด',
        ];
    }

}
