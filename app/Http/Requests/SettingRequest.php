<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest {

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
            'iddorm' => 'required|min:13|max:13',
            'name_th' => 'required',
            'name_en' => 'required',
            'phone' => 'required|min:9|max:10',
            'email' => 'required',
            'address' => 'required',
            'rate_water' => 'required',
            'rate_elec' => 'required',
            'due' => 'required',
            'die' => 'required',
            'pay' => 'required',
            'pay_limit' => 'required',
            'logo' => 'mimes:jpeg,bmp,png',
        ];
    }

    public function messages() {
        return [
            'iddorm.required' => 'กรุณาระบุแลขที่เสียภาษี',
            'iddorm.min' => 'เลขที่เสียภาษีต้องประกอบด้วยตัวเลข 13 ตัวเท่านั้น',
            'iddorm.max' => 'เลขที่เสียภาษีต้องประกอบด้วยตัวเลข 13 ตัวเท่านั้น',
            'name_th.required' => 'กรุณาระบุชื่อสถานประกอบการ(ภาษาไทย)',
            'name_en.required' => 'กรุณาระบุชื่อสถานประกอบการ(ภาษาอังกฤษ)',
            'phone' => 'กรุณาระบุหมายเลขติดต่อ',
            'phone.min' => 'หมายเลขโทรศัพน์ต้องประกอบด้วยตัวเลข 9-10 ตัวเท่านั้น',
            'phone.max' => 'หมายเลขโทรศัพน์ต้องประกอบด้วยตัวเลข 9-10 ตัวเท่านั้น',
            'email.required' =>  'กรุณาระบุอีเมลล์ของสถานประกอบการ',
            'address.required' => 'กรุณาระบุสถานที่อยู่ของสถานประกอบการ',
            'rate_water.required' => 'กรุณาระบุเรทการคำนวนค่าน้ำปาปา',
            'rate_elec.required' => 'กรุณาระบุเรทการคำนวนค่าไฟฟ้า',
            'due.required' => 'กรุณาระบุวันครบกำหนดชำระ',
            'die.required' => 'กรุณาระบุวันสิ้นสุดการกำหนดชำระ',
            'pay.required' => 'กรุณาระบุค่าปรับที่เกิดขึ้นต่อวัน',
            'pay_limit.required' => 'กรุณาระบุค่าปรับสูงสุดที่เกิดขึ้นต่อเดือน',
            'logo.mimes' => 'รูปแบบไฟล์โลโก้ไม่ถูกต้อง',
        ];
    }

}
