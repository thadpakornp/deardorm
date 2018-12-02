@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">ชำระการจองห้องพัก ห้อง {{ $bookings->room }} โดย {{ $bookings->name }} เลขที่จอง {{ $bookings->booking }}</div>

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

                    {!! Form::open(['url' => 'manage_booking/payment/pay/'.$bookings->id, 'method' => 'post']) !!}

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ประเภทการชำระ') }}</label>

                        <div class="col-md-10">
                            {!! Form::select('paid', ['' => 'โปรดเลือกประเภทการชำระ', '0' => 'มัดจำค่าจองห้องพักส่วนหนึ่ง', '1' => 'ชำระค่าจองห้องพักเต็มจำนวน'], 'โปรดเลือกประเภทการชำระ', ['class' => 'form-control']) !!}
                        </div>

                    </div>
                    
                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ยอดที่ชำระ') }}</label>

                        <div class="col-md-10">
                            {!! Form::text('price', null, ['class' => 'form-control']) !!}
                        </div>

                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-12 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('ชำระการจองห้องพัก') }}
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
