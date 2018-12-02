@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if($count == 0 )
            <div class="card">
                <div class="card-header">ยินดีต้อนรับ</div>

                <div class="card-body">
                    คุณได้เข้าสู่ระบบแล้ว
                </div>
            </div>
            @endif
            @if($count != 0 )
            @foreach ($events as $event)
            <br/>
            <div class="card">
                <div class="card-header">
                    {{ $event->name }} 
                </div>

                <div class="card-body">
                    {{ $event->event }}
                    <br/>
                    <hr/>
                    <b>จำนวนพ้อยรางวัล</b>  {{ $event->point }} <b>พ้อย</b><br/>
                    <b>ระยะเวลากิจกรรม</b>  {{ $event->start }}  <b>ถึง</b>  {{ $event->end }} <br/>
                    <b>วันที่บันทึกข้อมูล</b>  {{ $event->created_at }}  <b>แก้ไขล่าสุด</b>  {{ $event->updated_at }}
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
