<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'event' => 'required',
            'point' => 'required',
            'start' => 'required|date',
            'end' => 'required|date',
        ];
    }
    
    public function messages() {
        return [
            'name.required' => 'กรุณาระบุหัวข้อกิจกรรม',
            'event.required' => 'กรุณาระบุรายละเอียดของกิจกรรม',
            'point.required' => 'กรุณาระบุจำนวนพ้อยเมื่อผ่านกิจกรรม',
            'start.required' => 'กรุณาระบุวันเริ่มต้นกิจกรรม',
            'start.date' => 'รูปแบบวันเริ่มต้นกิจกรรมไม่ถูกต้อง',
            'end.required' => 'กรุณาระบุวันสิ้นสุดเริ่มกรรม',
            'end.date' => 'รูปแบบวันสิ้นสุกกิจกรรมไม่ถูกต้อง',
        ];
    }
}
