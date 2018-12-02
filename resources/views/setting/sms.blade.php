@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">ตั้งค่า SMS API [กรณีใช้งาน SMSGATEWAY.ME ให้กรอก TOKEN ในช่องรหัสผ่าน และ ID DEVICE ในช่องชื่อผู้ใช้งาน]</div>

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

                    {!! Form::model($sms,['url' => 'sms', 'files' => true, 'method' => 'post']) !!}

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ชื่อผู้ใช้งาน)') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('username', isset($sms->username) ? $sms->username : null,['class' => 'form-control']) !!}
                        </div>
                        
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ผู้ให้บริการ') }}</label>

                        <div class="col-md-4">
                            {!! Form::select('gateway', ['' => 'โปรดเลือกผู้ให้บริการ', 'THSMS.COM' => 'THSMS.COM (มีค่าบริการตามแพคเกจที่เลือก)', 'SMSGATEWAY.ME' => 'SMSGATEWAY.ME (ค่าบริการตามโปรโมชั่นมือถือ เชื่อมต่อ API ผ่านมือถือแอนดรอยเท่านั้น)'], isset($sms->gateway) ? $sms->gateway : null, ['class'=>'form-control']) !!}
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('รหัสผ่าน') }}</label>

                        <div class="col-md-4">
                            {!! Form::password('password', ['class' => 'form-control']) !!}
                        </div>
                        
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ยืนยันรหัสผ่าน') }}</label>

                        <div class="col-md-4">
                            {!! Form::password('repassword', ['class' => 'form-control']) !!}
                        </div>

                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-12 offset-md-5">
                            <button type="submit" class="btn btn-primary">
                                {{ __('บันทึก SMS') }}
                            </button>
                            <a class="btn btn-warning" href="{{ url('smstesting') }}">ทดสอบการเชื่อมต่อ</a>
                        </div>
                    </div>


                    {!! Form::close() !!}
                </div>
            </div>
            
            <br/>
            <div class="card">
                <div class="card-header">ตั้งค่า EMAIL กรุณาแจ้งผู้พัฒนาโปรแกรม เนื่องจากไม่สามารถดำเนินการตั้งค่าผ่านระบบได้</div>
            </div>
        </div>
    </div>
</div>
@endsection
