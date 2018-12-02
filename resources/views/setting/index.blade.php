@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">ตั้งค่าพื้นฐานระบบ</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-{{ session('alert') }}" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if($errors->count() > 0)
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    {!! Form::model($setting,['url' => 'setting', 'files' => true, 'method' => 'post']) !!}
                    
                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('เลขที่ผู้เสียภาษี') }}</label>
                        
                        <div class="col-md-10">
                            {!! Form::text('iddorm', isset($setting->iddorm) ? $setting->iddorm : null,['class' => 'form-control']) !!}
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ชื่อสถานประกอบการ(TH)') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('name_th', isset($setting->name_th) ? $setting->name_th : null,['class' => 'form-control']) !!}
                        </div>
                        
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ชื่อสถานประกอบการ(EN)') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('name_en', isset($setting->name_en) ? $setting->name_en : null,['class' => 'form-control']) !!}
                        </div>
                        
                    </div>
                    
                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('เบอร์โทรศัพน์') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('phone', isset($setting->phone) ? $setting->phone : null,['class' => 'form-control']) !!}
                        </div>
                        
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('อีเมลล์ติดต่อ') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('email', isset($setting->email) ? $setting->email : null,['class' => 'form-control']) !!}
                        </div>
                        
                    </div>
                    
                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ที่อยู่สถานประกอบการ') }}</label>
                        
                        <div class="col-md-10">
                            {!! Form::text('address', isset($setting->address) ? $setting->address : null,['class' => 'form-control']) !!}
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ค่าน้ำปะปา/หน่วย') }}</label>

                        <div class="col-md-2">
                            {!! Form::text('rate_water', isset($setting->rate_water) ? $setting->rate_water : null,['class' => 'form-control']) !!}
                        </div>
                        
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ค่าไฟฟ้า/หน่วย') }}</label>

                        <div class="col-md-2">
                            {!! Form::text('rate_elec', isset($setting->rate_elec) ? $setting->rate_elec : null,['class' => 'form-control']) !!}
                        </div>
                        
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ภาษีมูลค่าเพิ่ม') }}</label>

                        <div class="col-md-2">
                            {!! Form::text('vat', isset($setting->vat) ? $setting->vat : '0',['class' => 'form-control']) !!}
                        </div>
                        
                    </div>
                    
                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ครบกำหนดชำระ') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('due', isset($setting->due) ? $setting->due : null,['class' => 'form-control']) !!}
                        </div>
                        
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('สิ้นสุดกำหนดชำระ') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('die', isset($setting->die) ? $setting->die : null,['class' => 'form-control']) !!}
                        </div>
                        
                    </div>
                    
                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ค่าปรับ/วัน') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('pay', isset($setting->pay) ? $setting->pay : null,['class' => 'form-control']) !!}
                        </div>
                        
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ค่าปรับสูงสุด/เดือน') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('pay_limit', isset($setting->pay_limit) ? $setting->pay_limit : null,['class' => 'form-control']) !!}
                        </div>
                        
                    </div>
                    
                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ชื่อผู้ประกอบการ') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('contract', isset($setting->contract) ? $setting->contract : null,['class' => 'form-control']) !!}
                        </div>
                        
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ชื่อเจ้าของบัญชี') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('bank', isset($setting->bank) ? $setting->bank : null,['class' => 'form-control']) !!}
                        </div>
                        
                    </div>
                    
                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('รูปภาพโลโก้') }}</label>

                        <div class="col-md-4">
                            {!! Form::file('logo', null,['class' => 'form-control']) !!}
                            @if(isset($setting->logo))
                                <img src="{{ asset('images/'.$setting->logo) }}" width="50" height="50">
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group row mb-0">
                        <div class="col-md-12 offset-md-5">
                            <button type="submit" class="btn btn-primary">
                                {{ __('บันทึกการตั้งค่า') }}
                            </button>
                        </div>
                    </div>


                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
