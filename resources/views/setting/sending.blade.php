@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">ประวัติการจัดส่ง SMS จำนวน {{ $count }} รายการ</div>


                @if($count != 0)
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <th>เบอร์ที่ถูกส่ง</th>
                        <th>รายละเอียด</th>
                        <th>ช่องทาง</th>
                        <th>วันและเวลา</th>
                        </thead>
                        <tbody>
                            @foreach ($sendings as $sending)
                            <tr>
                                <td>{{ $sending->mobile }}</td>
                                <td>{{ $sending->texts }}</td>
                                <td>{{ $sending->gateways }}</td>
                                <td>{{ $sending->updated_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $sendings->render() !!}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
