@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">เพิ่มข้อมูลห้องพัก</div>

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

                    {!! Form::open(['url' => 'room', 'method' => 'post']) !!}

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ชื่อห้อง') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('name', null,['class' => 'form-control']) !!}
                        </div>

                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ราคา') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('price', null,['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ชั้น') }}</label>

                        <div class="col-md-4">
                            {!! Form::select('floor', ['' => 'โปรดเลือกชั้น', '0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5'], 'โปรดเลือกชั้น', ['class'=>'form-control']) !!}
                        </div>

                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ประเภทห้อง') }}</label>

                        <div class="col-md-4">
                            {!! Form::select('type', ['' => 'โปรดเลือกประเภทห้อง', 'Standard Room' => 'Standard Room', 'Superior Room' => 'Superior Room', 'Deluxe Room' => 'Deluxe Room', 'Suite Room' => 'Suite Room'], 'โปรดเลือกประเภทห้อง', ['class'=>'form-control']) !!}
                        </div>
                    </div>


                    <div class="form-group row mb-0">
                        <div class="col-md-12 offset-md-5">
                            <button type="submit" class="btn btn-primary">
                                {{ __('เพิ่มข้อมูลห้องพัก') }}
                            </button>
                        </div>
                    </div>


                    {!! Form::close() !!}
                </div>
            </div>

            <br/>


            <div class="card ">
                <div class="card-header">รายชื่อห้องพัก ทั้งหมด {{ $count }} ห้อง</div>


                @if($count != 0)
                <div class="card-body">
                    @if (session('status_room'))
                    <div class="alert alert-{{ session('alert_room') }}" role="alert">
                        {{ session('status_room') }}
                    </div>
                    @endif
                    <table class="table">
                        <thead>
                        <th>ชื่อห้อง</th>
                        <th>ราคา</th>
                        <th>ประเภทห้อง</th>
                        <th>ชั้น</th>
                        <th>สถานะห้อง</th>
                        <th>การกระทำ</th>
                        </thead>
                        <tbody>
                            @foreach ($rooms as $room)
                            <tr>
                                <td>{{ $room->name }}</td>
                                <td>{{ $room->price }}</td>
                                <td>{{ $room->type }}</td>
                                <td>{{ $room->floor }}</td>
                                <td>
                                    @if($room->status == 0)<font color="green">ห้องว่าง</font>@endif
                                    @if($room->status == 1)<font color="orange">ห้องถูกจอง</font>@endif
                                    @if($room->status == 2)<font color="red">มีผู้เข้าพัก</font>@endif
                                </td>
                                <td>
                                    {!! Form::open(['url' => 'room/'.$room->id, 'method' => 'delete']) !!}
                                    <button type="submit">
                                        <img src="{{ asset('/images/bin.png') }}" width="24" height="24">
                                    </button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    {!! $rooms->render() !!}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
