@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="card">
                <div class="card-header">ตอบกลับปัญหาลูกค้า</div>
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
                    {!! Form::open(['url' => 'inbox/', 'method' => 'post']) !!}
                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ส่งถึง') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('email', $contacts->email,['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('รายละเอียด') }}</label>

                        <div class="col-md-10">
                            {!! Form::textarea('inbox', null,['class' => 'form-control' ,'rows' => '3']) !!}
                        </div>
                    </div>
                    <input type="hidden" name="id" value="{{ $contacts->id }}">
                    <div class="form-group row mb-0">
                        <div class="col-md-12 offset-md-5">
                            <button type="submit" class="btn btn-primary">
                                {{ __('ส่งอีเมลล์ตอบกลับ') }}
                            </button>
                            <a href="{{ url('inbox') }}" class="btn btn-danger">ย้อนกลับหน้าเดิม</a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <br/>
            
            <div class="card">
                <div class="card-header">รายละเอียดการแจ้งปัญหา</div>

                <div class="card-body">
                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('อีเมลล์ติดต่อกลับ') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('email', $contacts->email,['class' => 'form-control', 'readonly']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('รายละเอียด') }}</label>

                        <div class="col-md-10">
                            {!! Form::textarea('contact', Crypt::decryptString($contacts->contact),['class' => 'form-control' ,'rows' => '3', 'readonly']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ผู้รับผิดชอบ') }}</label>

                        <div class="col-md-10">
                            {!! Form::text('received', $contacts->received,['class' => 'form-control', 'readonly']) !!}
                        </div>
                    </div>
                </div>
            </div>
            @if(isset($inboxs))
            @foreach ($inboxs as $inbox)
            <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ส่งถึง') }}</label>

                        <div class="col-md-4">
                            {{ $inbox->email }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('รายละเอียด') }}</label>

                        <div class="col-md-10">
                            {{ Crypt::decryptString($inbox->inbox) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('วันและเวลาที่ตอบกลับ') }}</label>

                        <div class="col-md-10">
                            {{ $inbox->created_at }}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
