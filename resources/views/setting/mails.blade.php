@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">บริการส่งอีเมลล์</div>

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

                    {!! Form::model($user, ['url' => 'sent_email', 'method' => 'post']) !!}

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ผู้รับ EMAIL') }}</label>

                        <div class="col-md-10">
                            <select name = "email" class="form-control">
                                <option value="*">ถึงผู้รับทุกคนที่มีอีเมลล์ในระบบ</option>
                                @foreach($user as $u)
                                <option value="{{ $u->email }}">{{ $u->name }} [{{ $u->email }}]</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ชื่อเรื่อง') }}</label>

                        <div class="col-md-10">
                            {!! Form::text('topic', null,['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('รายละเอียดการส่ง') }}</label>

                        <div class="col-md-10">
                            {!! Form::textarea('texts', null,['class' => 'form-control' , 'rows' => '3']) !!}
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-12 offset-md-5">
                            <button type="submit" class="btn btn-primary">
                                {{ __('ส่งอีเมลล์') }}
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
