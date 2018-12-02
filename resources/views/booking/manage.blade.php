@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">จัดการรายการจองห้องพัก</div>

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
                        <th>แก้ไขล่าสุด</th>
                        <th>สถานะ</th>
                        <th>การกระทำ</th>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $booking->booking }} <a href="{{ url('manage_booking/booking/'.$booking->id) }}" target="_blank"><img src="{{ asset('images/archive.png') }}"></a></td>
                                <td>{{ $booking->name }}</td>
                                <td>{{ $booking->mobile }}</td>
                                <td>{{ $booking->room }}</td>
                                <td>{{ $booking->checkin }}</td>
                                <td>{{ $booking->updated_at }}</td>
                                <td>
                                    @if($booking->status == 0)<font color="orange">รอชำระเงิน</font><br/><a href="{{ url('manage_booking/payment/'.$booking->id) }}" class="btn"><img src="{{ asset('/images/get-money.png') }}"></a>@endif
                                    @if($booking->status == 1)<font color="green">ปกติ</font>@endif
                                    @if($booking->status == 2)<font color="blue">ทำสัญญาแล้ว</font>@endif
                                    @if($booking->status == 3)<font color="red">ยกเลิก</font>@endif
                                </td>
                                <td>
                                    @if($booking->status == 0)
                                    {!! Form::open(['url' => 'manage_booking/'.$booking->id.'/edit', 'method' => 'get']) !!}
                                    <button type="submit">
                                        <img src="{{ asset('/images/document.png') }}">
                                    </button>
                                    {!! Form::close() !!}
                                    {!! Form::open(['url' => 'manage_booking/'.$booking->id, 'method' => 'delete']) !!}
                                    <button type="submit">
                                        <img src="{{ asset('/images/cancel.png') }}">
                                    </button>
                                    {!! Form::close() !!}
                                    @endif
                                    
                                    @if($booking->status == 1)
                                    {!! Form::open(['url' => 'manage_booking/'.$booking->id, 'method' => 'get']) !!}
                                    <button type="submit">
                                        <img src="{{ asset('/images/contract.png') }}">
                                    </button>
                                    {!! Form::close() !!}
                                    {!! Form::open(['url' => 'manage_booking/'.$booking->id, 'method' => 'delete']) !!}
                                    <button type="submit">
                                        <img src="{{ asset('/images/cancel.png') }}">
                                    </button>
                                    {!! Form::close() !!}
                                    @endif
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
