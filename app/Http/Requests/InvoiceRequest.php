<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            'id' => 'required',
            'water' => 'required',
            'power' => 'required',
        ];
    }
    
    public function messages() {
        return [
            'id.required' => 'กรุณาเลือกข้อมูลผู้เช่า',
            'water.required' => 'กรุณาบันทึกข้อมูลน้ำปะปา',
            'power.required' => 'กรุณาบันทึกข้อมูลไฟฟ้า',
        ];
    }
}
