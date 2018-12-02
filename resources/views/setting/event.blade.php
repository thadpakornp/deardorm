@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">เพิ่มข้อมูลกิจกรรม</div>

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

                    {!! Form::open(['url' => 'event', 'method' => 'post']) !!}

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ชื่อกิจกรรม') }}</label>

                        <div class="col-md-10">
                            {!! Form::text('name', null,['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('รายละเอียดกิจกรรม') }}</label>

                        <div class="col-md-10">
                            {!! Form::textarea('event', null,['class' => 'form-control' , 'rows' => '3']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('จำนวนพ้อย') }}</label>
                        
                        <div class="col-md-2">
                            {!! Form::text('point', null,['class' => 'form-control']) !!}
                        </div>

                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('เริ่มต้น') }}</label>

                        <div class="col-md-2">
                            {!! Form::date('start', \Carbon\Carbon::now(),['class' => 'form-control']) !!}
                        </div>

                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('สิ้นสุด') }}</label>

                        <div class="col-md-2">
                            {!! Form::date('end', \Carbon\Carbon::now()->addWeeks(2),['class' => 'form-control']) !!}
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="text" class="col-sm-12 col-form-label text-md-center">{{ __('ข้อมูลจำนวนพ้อยจำเป็นต้องระบุเครื่องหมายบวก หรือ ลบ ทุกครั้งที่บันทึก') }}</label>
                       
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-12 offset-md-5">
                            <button type="submit" class="btn btn-primary">
                                {{ __('เพิ่มกิจกรรม') }}
                            </button>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>

            <br/>

            <div class="card ">
                <div class="card-header">รายการกิจกรรม จำนวน {{ $count }} กิจกรรม</div>


                @if($count != 0)
                <div class="card-body">
                    @if (session('status_event'))
                    <div class="alert alert-{{ session('alert_event') }}" role="alert">
                        {{ session('status_event') }}
                    </div>
                    @endif
                    <table class="table">
                        <thead>
                        <th>ชื่อกิจกรรม</th>
                        <th>รายละเอียด</th>
                        <th>จำนวนพ้อย</th>
                        <th>เริ่มต้น</th>
                        <th>สิ้นสุด</th>
                        <th>การกระทำ</th>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                            <tr>
                                <td>{{ $event->name }}</td>
                                <td>{{ $event->event }}</td>
                                <td>{{ $event->point }}</td>
                                <td>{{ $event->start }}</td>
                                <td>{{ $event->end }}</td>
                                <td>
                                    {!! Form::open(['url' => 'event/'.$event->id, 'method' => 'delete']) !!}
                                    <button type="submit">
                                        <img src="{{ asset('/images/bin.png') }}" width="24" height="24">
                                    </button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $events->render() !!}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
