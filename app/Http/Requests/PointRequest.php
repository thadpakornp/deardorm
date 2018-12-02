<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PointRequest extends FormRequest
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
            'event' => 'required',
        ];
    }
    
    public function messages() {
        return [
            'id.required' => 'กรุณาเลือกผู้ได้รับรางวัล',
            'event.required' => 'กรุณาเลือกกิจกรรมที่ได้รับ',
        ];
    }
}
