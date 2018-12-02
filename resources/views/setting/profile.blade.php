@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">แก้ไขข้อมูลส่วนตัว</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-{{ session('alert') }}" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    
                    @if (session('statuss'))
                    <div class="alert alert-{{ session('alertt') }}" role="alert">
                        {{ session('statuss') }}
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

                    {!! Form::model($user,['url' => 'customer/'.$user->id, 'files' => true, 'method' => 'put']) !!}
                    
                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('อีเมลล์') }}</label>
                        
                        <div class="col-md-4">
                            @if(Auth::user()->profile != 'admin')
                            {!! Form::text('email', isset($user->email) ? $user->email : null,['class' => 'form-control', 'readonly']) !!}
                            <p><font color="red">หากต้องการเปลี่ยนกรุณาติดต่อ Super Admin</font></p>
                            @endif
                            @if(Auth::user()->profile == 'admin')
                            {!! Form::text('email', isset($user->email) ? $user->email : null,['class' => 'form-control']) !!}
                            @endif
                        </div>
                        
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('หมายเลขบัตร') }}</label>

                        <div class="col-md-4">
                            @if(Auth::user()->profile != 'admin')
                            {!! Form::text('idcard', isset($user->profiles->idcard) ? $user->profiles->idcard : '0000000000000',['class' => 'form-control','readonly']) !!}
                            <p><font color="red">หากข้อมูลไม่ถูกต้อง กรุณาติดต่อ Super Admin</font></p>
                            @endif
                            @if(Auth::user()->profile == 'admin')
                            {!! Form::text('idcard', isset($user->profiles->idcard) ? $user->profiles->idcard : '0000000000000',['class' => 'form-control']) !!}
                            @endif
                        </div>
                        
                    </div>
                    
                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ชื่อ-นามสกุล') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('name', isset($user->name) ? $user->name : null,['class' => 'form-control']) !!}
                        </div>

                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ชื่อเล่น') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('nickname', isset($user->profiles->nickname) ? $user->profiles->nickname : null,['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('เบอร์โทรติดต่อ') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('mobile', isset($user->profiles->mobile) ? $user->profiles->mobile : null,['class' => 'form-control']) !!}
                        </div>

                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('วันเดือนปี เกิด') }}</label>

                        <div class="col-md-4">
                            {!! Form::date('hbd', isset($user->profiles->hbd) ? $user->profiles->hbd : null,['class' => 'form-control']) !!}
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('อาชีพ') }}</label>

                        <div class="col-md-10">
                            {!! Form::text('career', isset($user->profiles->career) ? $user->profiles->career : null,['class' => 'form-control']) !!}
                        </div>

                    </div>
                    
                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ที่อยู่') }}</label>

                        <div class="col-md-10">
                            {!! Form::text('address', isset($user->profiles->address) ? $user->profiles->address : null,['class' => 'form-control']) !!}
                        </div>

                    </div>
                    
                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ระดับสิทธิ์ใช้งาน') }}</label>

                        <div class="col-md-10">
                            {!! Form::select('profile', ['user' => 'User', 'admin' => 'Admin'], isset($user->profile) ? $user->profile : User, ['class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('รูปภาพประจำตัว') }}</label>

                        <div class="col-md-4">
                            {!! Form::file('img', null,['class' => 'form-control']) !!}
                            @if(isset($user->profiles->img))
                                <img src="{{ asset('images/'.$user->profiles->img) }}" width="50" height="50">
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-12 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('ยืนยันการแก้ไขข้อมูล') }}
                            </button>
                            <a href="{{ url('customer') }}" class="btn btn-danger">ย้อนกลับหน้าเดิม</a>
                        </div>
                    </div>


                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
