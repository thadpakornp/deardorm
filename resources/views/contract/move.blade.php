@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">ย้ายห้องสำหรับเลขสัญญาที่ {{ $contracts->contract }}</div>

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

                    {!! Form::model($contracts, ['url' => 'manage_contract/moved/'.$contracts->num, 'method' => 'post']) !!}

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ห้องเดิม') }}</label>

                        <div class="col-md-10">
                            {!! Form::text('roomold', $contracts->room, ['class' => 'form-control', 'readonly']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('หน่วยปะปา') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('oldwater', null, ['class' => 'form-control']) !!}
                        </div>

                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('หน่วยไฟฟ้า') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('oldpower', null, ['class' => 'form-control']) !!}
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ค่าทำความสะอาด') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('clear', null, ['class' => 'form-control']) !!}
                        </div>

                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('อื่นๆ') }}</label>

                        <div class="col-md-3">
                            {!! Form::text('other', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="col-md-1">
                            {!! Form::text('priceother', '0', ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <hr/>
                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ห้องใหม่') }}</label>

                        <div class="col-md-10">
                            <select name='roomnew' class="form-control">
                                <option value="">โปรดเลือกห้องพักใหม่</option> 
                                @foreach($rooms as $room)
                                <option value="{{ $room->name }}">{{ $room->name }} [{{ $room->price }}] {{ $room->type }} ชั้น {{ $room->floor }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ปะปาเริ่มต้น') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('water', null, ['class' => 'form-control']) !!}
                        </div>

                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ไฟฟ้าเริ่มต้น') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('power', null, ['class' => 'form-control']) !!}
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('วันเริ่มต้นสัญญา') }}</label>

                        <div class="col-md-4">
                            {!! Form::date('start', null, ['class' => 'form-control']) !!}
                        </div>

                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('อายุสัญญา') }}</label>

                        <div class="col-md-4">
                            {!! Form::select('term', ['' => 'โปรดเลือกอายุสัญญา', '0' => 'รายวัน', '0' => 'รายเดือน', '6' => '6 เดือน', '12' => '12 เดือน', '18' => '18 เดือน', '24' => '24 เดือน'], 'โปรดเลือกอายุสัญญา',['class' => 'form-control']) !!}
                        </div>

                    </div>

                    <center>
                        <font color='red'><b>ข้อควรระวัง</b>
                        <p>
                            การเปลี่ยนห้องพัก สัญญาเก่าจะถูกยกเลิกและสร้างสัญญาใหม่ทันที โดยระมัดระวังการทำรายการ
                            <br/>
                            หากราคาห้องใหม่ต่างจากเดิมจะถูกคำนวณใหม่เป็นราคาที่ต้องจ่ายเพิ่มเติม
                            <br/>
                            ขอสงวนสิทธิ์ในการคืนเงินทุกกรณี หากห้องพักใหม่ราคาประกันน้อยกว่าห้องพักเดิม
                        </p>
                        </font>
                    </center>
                    <div class="form-group row mb-0">
                        <div class="col-md-12 offset-md-4">
                            @if (session('invoice'))
                            <a href="{{ url('manage_contract/invoices/'.session('invoice')) }}" class="btn btn-success" target="_blank">พิมพ์ใบแจ้งห้องเดิม</a>
                            @else
                            <button type="submit" class="btn btn-primary">
                                {{ __('ยืนยันการเปลี่ยนห้องพัก') }}
                            </button>
                            @endif
                            <a href="{{ url('manage_contract') }}" class="btn btn-danger">ย้อนกลับหน้าเดิม</a>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
