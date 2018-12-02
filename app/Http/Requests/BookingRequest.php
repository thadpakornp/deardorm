<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest {

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
            'mobile' => 'required|min:9|max:10',
            'room' => 'required',
            'checkin' => 'required|date',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'กรุณาระบุชื่อผู้ที่ทำการจอง',
            'mobile.min' => 'เบอร์มือถือต้องประกอบด้วยตัวเลขขั้นต่ำ 9 ตัว',
            'mobile.max' => 'เบอร์มือถือต้องประกอบด้วยตัวเลขมากสุด 10 ตัว',
            'room.required' => 'กรุณาระบุห้องที่ต้องการจอง',
            'checkin.required' => 'กรุณาระบุวันที่เข้าพัก',
            'checkin.date' => 'รูปแบบวันที่เข้าพักไม่ถูกต้อง',
        ];
    }

}
