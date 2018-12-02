@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">แก้ไขข้อมูลการจองห้องพัก</div>

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

                    {!! Form::model($bookings, ['url' => 'manage_booking/'.$bookings->id, 'method' => 'put']) !!}

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ชื่อผู้จอง') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('name',isset($bookings->name) ? $bookings->name : null,['class' => 'form-control']) !!}
                        </div>

                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('เบอร์ติดต่อ') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('mobile',isset($bookings->mobile) ? $bookings->mobile : null,['class' => 'form-control']) !!}
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ห้องพักที่ต้องการจอง') }}</label>

                        <div class="col-md-10">
                            <select name="room" class="form-control">
                                <option value="{{ $bookings->room }}">{{ $bookings->room }}</option>
                                @foreach($room as $r)
                                <option value="{{ $r->name }}">{{ $r->name }} [{{ $r->type }}] [{{ $r->floor }}] [{{ $r->price }}]</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('วันที่เข้าพัก') }}</label>

                        <div class="col-md-10">
                            {!! Form::date('checkin', isset($bookings->checkin) ? $bookings->checkin : \Carbon\Carbon::now(),['class' => 'form-control']) !!}
                        </div>

                    </div>
                    <input type="hidden" name="rom" value="{{ $bookings->room }}" >
                    <div class="form-group row mb-0">
                        <div class="col-md-12 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('แก้ไขข้อมูลการจองห้องพัก') }}
                            </button>
                            <a href="{{ url('manage_booking') }}" class="btn btn-danger">ย้อนกลับหน้าเดิม</a>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
