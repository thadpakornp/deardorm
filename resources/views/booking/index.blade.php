@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">เพิ่มข้อมูลการจองห้องพัก</div>

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

                    {!! Form::open(['url' => 'booking', 'method' => 'post']) !!}

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ชื่อผู้จอง') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('name',null,['class' => 'form-control']) !!}
                        </div>
                        
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('เบอร์ติดต่อ') }}</label>
                        
                        <div class="col-md-4">
                            {!! Form::text('mobile',null,['class' => 'form-control']) !!}
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ห้องพักที่ต้องการจอง') }}</label>

                        <div class="col-md-10">
                            <select name="room" class="form-control">
                                <option value="">โปรดเลือกห้องพัก</option>
                                @foreach($room as $r)
                                <option value="{{ $r->name }}">{{ $r->name }} [{{ $r->type }}] [{{ $r->floor }}] [{{ $r->price }}]</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('วันที่เข้าพัก') }}</label>

                        <div class="col-md-10">
                            {!! Form::date('checkin', \Carbon\Carbon::now()->toDateString(),['class' => 'form-control']) !!}
                        </div>

                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-12 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('เพิ่มข้อมูลการจองห้องพัก') }}
                            </button>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>

            <br/>

            <div class="card ">
                <div class="card-header">รายการจองห้องพัก จำนวน {{ $count }} รายการ</div>

                @if($count != 0)
                <div class="card-body">
                    @if (session('status_room'))
                    <div class="alert alert-{{ session('alert_room') }}" role="alert">
                        {{ session('status_room') }}
                    </div>
                    @endif
                    <table class="table">
                        <thead>
                        <th>เลขที่จอง</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th>เบอร์ติดต่อ</th>
                        <th>ห้อง</th>
                        <th>วันที่เข้าพัก</th>
                        <th>บันทึกเมื่อ</th>
                        <th>สถานะ</th>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $booking->booking }}</td>
                                <td>{{ $booking->name }}</td>
                                <td>{{ $booking->mobile }}</td>
                                <td>{{ $booking->room }}</td>
                                <td>{{ $booking->checkin }}</td>
                                <td>{{ $booking->created_at }}</td>
                                <td>
                                    @if($booking->status == 0)<font color="orange">รอชำระเงิน</font>@endif
                                    @if($booking->status == 1)<font color="green">ปกติ</font>@endif
                                    @if($booking->status == 2)<font color="blue">ทำสัญญาแล้ว</font>@endif
                                    @if($booking->status == 3)<font color="red">ยกเลิก</font>@endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $bookings->render() !!}
                </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
