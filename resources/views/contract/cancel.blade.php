@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">การยกเลิกสัญญา เลขที่ {{ $contract->contract }}</div>

                <div class="card-body">
                    @if($errors->count() > 0)
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    {!! Form::open(['url' => 'manage_contract/confirmcancel', 'method' => 'post']) !!}

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('หน่วยน้ำปะปา') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('water',null,['class' => 'form-control']) !!}
                        </div>

                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('หน่วยไฟฟ้า') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('power',null,['class' => 'form-control']) !!}
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ค่าทำความสะอาด') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('clear',null,['class' => 'form-control']) !!}
                        </div>

                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ค่าล้างแอร์') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('air',null,['class' => 'form-control']) !!}
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('อื่นๅโปรดระบุ') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('textother',null,['class' => 'form-control']) !!}
                        </div>

                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ราคา') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('priceother',null,['class' => 'form-control']) !!}
                        </div>

                    </div>
                    
                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('อื่นๅโปรดระบุ') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('textother1',null,['class' => 'form-control']) !!}
                        </div>

                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ราคา') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('priceother1',null,['class' => 'form-control']) !!}
                        </div>

                    </div>
                    
                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('อื่นๅโปรดระบุ') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('textother2',null,['class' => 'form-control']) !!}
                        </div>

                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ราคา') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('priceother2',null,['class' => 'form-control']) !!}
                        </div>

                    </div>
                    <br/>
                    <center>
                        <font color='red'>
                        การยกเลิกสัญญาจะมีผลทันทีเมื่อกดยืนยันการยกเลิกแล้ว ดังนั้นควรทำรายการ ณ วันที่ดำเนินการยกเลิก<br/>
                        
                        @if($age == FALSE)
                        ระบบตรวจสอบพบว่า สัญญาฉบับนี้ยังไม่ครบอายุการเช่าอยู่ตามข้อตกลงไว้ วันที่ครบสัญญา <b>{{ $contract->end }}</b><br/>
                        {!! Form::checkbox('checkage', '1') !!} ละเว้นค่าธรรมเนียมการยกเลิก
                       
                        @endif
                        </font>
                    </center>
                    <br/>
                    <input type="hidden" name="num" value="{{ $contract->num }}">
                    <div class="form-group row mb-0">
                        <div class="col-md-12 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('คำนวณการยกเลิก') }}
                            </button>
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
