@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">บริการส่งข้อความ</div>

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

                    {!! Form::model($user, ['url' => 'sent_sms', 'method' => 'post']) !!}

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ผู้รับ SMS') }}</label>

                        <div class="col-md-10">
                            <select name = "mobile" class="form-control">
                                <option value="*">ถึงผู้รับทุกคนที่มีหมายเลขโทรศัพน์มือถือในระบบ</option>
                                @foreach($user as $u)
                                <option value="{{ $u->profiles->mobile }}">{{ $u->name }} [{{ $u->profiles->mobile }}]</option>
                                @endforeach
                            </select>
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
                                {{ __('ส่งข้อความ') }}
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
