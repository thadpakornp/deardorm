@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">เริ่มทำสัญญาจากเลขที่การจอง {{ $bookings->booking }} จองโดย  {{ $bookings->name }}</div>

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

                    {!! Form::model($bookings, ['url' => 'manage_booking', 'method' => 'post']) !!}

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ทำสัญญาโดย') }}</label>

                        <div class="col-md-10">
                            <select name= "id" class="form-control">
                                <option value="">โปรดเลือกผู้ทำสัญญา</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ห้องที่เริ่มสัญญา') }}</label>

                        <div class="col-md-10">
                             {!! Form::text('room',isset($bookings->room) ? $bookings->room : null,['class' => 'form-control', 'readonly']) !!}
                        </div>

                    </div>
                    
                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('หน่วยน้ำปะปาเริ่มต้น') }}</label>

                        <div class="col-md-4">
                             {!! Form::text('water', null, ['class' => 'form-control']) !!}
                        </div>
                        
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('หน่วยไฟฟ้าเริ่มต้น') }}</label>

                        <div class="col-md-4">
                             {!! Form::text('power', null, ['class' => 'form-control']) !!}
                        </div>

                    </div>
                    
                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('อายุสัญญา') }}</label>

                        <div class="col-md-10">
                            {!! Form::select('term', ['' => 'โปรดเลือกอายุสัญญา', '0' => 'รายวัน', '0' => 'รายเดือน', '6' => '6 เดือน', '12' => '12 เดือน', '18' => '18 เดือน', '24' => '24 เดือน'], 'โปรดเลือกอายุสัญญา',['class' => 'form-control']) !!}
                        </div>

                    </div>
                    
                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('วันเริ่มต้นสัญญา') }}</label>

                        <div class="col-md-4">
                             {!! Form::date('start', \Carbon\Carbon::now()->toDateString(), ['class' => 'form-control']) !!}
                        </div>
                        
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('สิ้นสุดสัญญา') }}</label>

                        <div class="col-md-4">
                             {!! Form::text('end', 'ถูกคำนวณโดยอัตโนมัติ', ['class' => 'form-control', 'readonly']) !!}
                        </div>

                    </div>
                    
                    <input type="hidden" name="booking" value="{{ $bookings->id }}">
                    <input type="hidden" name="price" value="{{ $bookings->price }}">
                    
                    <div class="form-group row mb-0">
                        <div class="col-md-12 offset-md-4">
                            @if($bookings->status != 2)
                            <button type="submit" class="btn btn-primary">
                                {{ __('บันทึกข้อมูลสัญญา') }}
                            </button>
                            @endif
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
