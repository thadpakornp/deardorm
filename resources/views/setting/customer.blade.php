@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">เพิ่มข้อมูลลูกค้า</div>

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

                    {!! Form::open(['url' => 'customer', 'method' => 'post']) !!}

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('อีเมลล์') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('email', null,['class' => 'form-control']) !!}
                        </div>

                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ชื่อ-นามสกุล') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('name', null,['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('รหัสผ่าน') }}</label>

                        <div class="col-md-10">
                            {!! Form::text('', 'รหัสผ่านยังไม่สามารถกำหนดได้ ระบบจะสร้างรหัสผ่านให้อีกครั้งเมื่อยืนยันข้อมูลเรียบร้อยแล้ว',['class' => 'form-control' ,'readonly']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ระดับสิทธิ์ใช้งาน') }}</label>

                        <div class="col-md-10">
                            {!! Form::select('profile', ['user' => 'User', 'party' => 'Party', 'admin' => 'Admin'], 'User', ['class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-12 offset-md-5">
                            <button type="submit" class="btn btn-primary">
                                {{ __('เพิ่มข้อมูลลูกค้า') }}
                            </button>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>

            <br/>

            <div class="card ">
                <div class="card-header">รายชื่อลูกค้า จำนวน {{ $count }} คน</div>


                @if($count != 0)
                <div class="card-body">
                    @if (session('status_room'))
                    <div class="alert alert-{{ session('alert_room') }}" role="alert">
                        {{ session('status_room') }}
                    </div>
                    @endif
                    <table class="table">
                        <thead>
                        <th>อีเมลล์</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th>เบอร์ติดต่อ</th>
                        <th>ระดับสิทธิ์</th>
                        <th>สถานะบัญชี</th>
                        <th>การกระทำ</th>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                            <tr>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ isset($customer->profiles->mobile) ? $customer->profiles->mobile : null }}</td>
                                <td>{{ $customer->profile }}</td>
                                <td>
                                    @if($customer->status == 0)<font color='orange'>รออัพเดตข้อมูล</font>@endif
                                    @if($customer->status == 1)<font color='green'>ปกติ</font>@endif
                                    @if($customer->status == 2)<font color='red'>ยกเลิกการเป็นสมาชิก</font>@endif
                                </td>
                                <td>
                                    @if($customer->id != Auth::user()->id)
                                    {!! Form::open(['url' => 'customer/'.$customer->id.'/edit', 'method' => 'get']) !!}
                                    <button type="submit">
                                        <img src="{{ asset('/images/writing.png') }}" width="24" height="24">
                                    </button>
                                    {!! Form::close() !!}
                                    @if($customer->status == 1)
                                    <a href="{{ url('customer/reset/'.$customer->id) }}" class="btn">
                                        <img src="{{ asset('/images/recycle.png') }}" width="24" height="24">
                                    </a>
                                    @endif
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $customers->render() !!}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
