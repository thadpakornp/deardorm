<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest {

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
            'idcard' => 'required|min:13|max:13',
            'nickname' => 'required',
            'hbd' => 'required|date',
            'mobile' => 'required|min:10|max:10',
            'address' => 'required',
            'img' => 'mimes:jpeg,bmp,png',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'กรุณาระบุชื่อและนามสกุล',
            'idcard.required' => 'กรุณาระบุหมายเลขบัตรประจำตัวประชาชน',
            'idcard.min' => 'หมายเลขบัตรประชาชนประกอบด้วยตัวเลข 13 ตัวเท่านั้น',
            'idcard.max' => 'หมายเลขบัตรประชาชนประกอบด้วยตัวเลข 13 ตัวเท่านั้น',
            'nickname.required' => 'กรุณาระบุชื่อเล่น',
            'hbd.required' => 'กรุณาระบุวันเดือนปี เกิด',
            'hbd.date' => 'รูปแบบข้อมูลวันเดือนปี เกิดที่ระบุไม่ถูกต้อง',
            'mobile.required' => 'กรุณาระบุหมายเลขโทรศัพน์ติดต่อกลับ',
            'mobile.min' => 'หมายเลขโทรศัพน์มือถือต้องประกอบด้วยตัวเลข 10 ตัวเท่านั้น',
            'mobile.max' => 'หมายเลขโทรศัพน์มือถือต้องประกอบด้วยตัวเลข 10 ตัวเท่านั้น',
            'address.required' => 'กรุณาระบุที่อยู่ที่สามารถติดต่อได้',
            'img.mimes' => 'ประเภทของไฟล์รูปภาพประจำตัวไม่ถูกต้อง',
        ];
    }

}
