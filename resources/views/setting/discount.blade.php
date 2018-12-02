@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">เพิ่มข้อมูลส่วนลด</div>

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

                    {!! Form::open(['url' => 'discount', 'method' => 'post']) !!}

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ชื่อส่วนลด') }}</label>
                        
                        <div class="col-md-4">
                            {!! Form::text('name', null,['class' => 'form-control']) !!}
                        </div>

                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('จำนวนส่วนลด') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('discount', null,['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="text" class="col-sm-12 col-form-label text-md-center">{{ __('ข้อมูลส่วนลดจำเป็นต้องระบุเครื่องหมายบวก หรือ ลบ ทุกครั้งที่บันทึก') }}</label>
                       
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-12 offset-md-5">
                            <button type="submit" class="btn btn-primary">
                                {{ __('เพิ่มข้อมูลส่วนลด') }}
                            </button>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>

            <br/>

            <div class="card ">
                <div class="card-header">รายการส่วนลด จำนวน {{ $count }} รายการ</div>


                @if($count != 0)
                <div class="card-body">
                    @if (session('status_event'))
                    <div class="alert alert-{{ session('alert_event') }}" role="alert">
                        {{ session('status_event') }}
                    </div>
                    @endif
                    <table class="table">
                        <thead>
                        <th>ชื่อส่วนลด</th>
                        <th>ส่วนลดที่ได้รับ</th>
                        <th>บันทึกข้อมูลเมื่อ</th>
                        <th>การกระทำ</th>
                        </thead>
                        <tbody>
                            @foreach ($discounts as $discount)
                            <tr>
                                <td>{{ $discount->name }}</td>
                                <td>{{ $discount->discount }}</td>
                                <td>{{ $discount->updated_at }}</td>
                                <td>
                                    {!! Form::open(['url' => 'discount/'.$discount->id, 'method' => 'delete']) !!}
                                    <button type="submit">
                                        <img src="{{ asset('/images/bin.png') }}" width="24" height="24">
                                    </button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $discounts->render() !!}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
