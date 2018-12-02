@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">เปลี่ยนรหัสผ่านของ {{ Auth::user()->name }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-{{ session('alert') }}" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {!! Form::open(['url' => 'password/'.Auth::user()->id, 'method' => 'put']) !!}

                    <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('รหัสผ่านใหม่') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" minlength="6" required autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('ยืนยันรหัสผ่านใหม่') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="re_password" minlength="6" required>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('ยืนยันการเปลี่ยนรหัสผ่าน') }}
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
