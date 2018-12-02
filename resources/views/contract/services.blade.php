@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">เพิ่มข้อมูลส่วนเสริม สัญญาเลขที่ {{ $contracts->contract }} <font color="red">สามารถเพิ่มได้เพียง 1 รายการเท่านั้น</font></div>

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

                    {!! Form::open(['url' => 'manage_contract/service', 'method' => 'post']) !!}

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ส่วนเสริม') }}</label>

                        <div class="col-md-10">
                            <select name="service" class="form-control">
                                <option value="">โปรดเลือกส่วนเสริม</option>
                                @foreach ($discounts as $discount)
                                <option value="{{ $discount->id }}">{{ $discount->name }} [{{ $discount->discount }}]</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    
                    <input type="hidden" name="num" value="{{ $contracts->num }}">
                    <div class="form-group row mb-0">
                        <div class="col-md-12 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('เพิ่มข้อมูลส่วนเสริม') }}
                            </button>
                            <a href="{{ url('manage_contract') }}" class="btn btn-danger">ย้อนกลับหน้าเดิม</a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>

            <br/>

            <div class="card ">
                <div class="card-header">รายการส่วนเสริม</div>

                @if($count != 0)
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <th width = "70%">รายการส่วนเสริม</th>
                        <th width = "20%">ส่วนเสริมที่ได้รับ</th>
                        <th width = "10%">การกระทำ</th>
                        </thead>
                        <tbody>
                            @foreach ($services as $service)
                            <tr>
                                <td width = "70%">{{ $service->name }}</td>
                                <td width = "20%">{{ $service->price }}</td>
                                <td width = "10%">
                                    {!! Form::open(['url' => 'manage_contract/service/delete/','method' => 'post']) !!}
                                    <input type="hidden" name="id" value="{{ $service->id }}">
                                    <button type="submit">
                                        <img src="{{ asset('/images/cancel.png') }}">
                                    </button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
