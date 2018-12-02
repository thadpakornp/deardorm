@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">เพิ่มข้อมูลสัญญา</div>

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

                    {!! Form::open(['url' => 'contract', 'method' => 'post']) !!}

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ทำสัญญาโดย') }}</label>

                        <div class="col-md-10">
                            <select name= "id" class="form-control">
                                <option value="">โปรดเลือกผู้ทำสัญญา</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ห้องที่เริ่มสัญญา') }}</label>

                        <div class="col-md-10">
                            <select name= "room" class="form-control">
                                <option value="">โปรดเลือกห้องทำสัญญา</option>
                                @foreach($rooms as $room)
                                <option value="{{ $room->name }}">{{ $room->name }} [{{ $room->price }}] {{ $room->type }} ชั้น {{ $room->floor }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('หน่วยน้ำปะปาเริ่มต้น') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('water', null, ['class' => 'form-control']) !!}
                        </div>

                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('หน่วยไฟฟ้าเริ่มต้น') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('power', null, ['class' => 'form-control']) !!}
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('อายุสัญญา') }}</label>

                        <div class="col-md-10">
                            {!! Form::select('term', ['' => 'โปรดเลือกอายุสัญญา', '2' => 'รายเดือน', '6' => '6 เดือน', '12' => '12 เดือน', '18' => '18 เดือน', '24' => '24 เดือน'], 'โปรดเลือกอายุสัญญา',['class' => 'form-control']) !!}
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('วันเริ่มต้นสัญญา') }}</label>

                        <div class="col-md-4">
                            {!! Form::date('start', \Carbon\Carbon::now()->toDateString(), ['class' => 'form-control']) !!}
                        </div>

                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('สิ้นสุดสัญญา') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('end', 'ถูกคำนวณโดยอัตโนมัติ', ['class' => 'form-control', 'readonly']) !!}
                        </div>

                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-12 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('บันทึกข้อมูลสัญญา') }}
                            </button>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>

            <br/>
            <div class="card ">
                <div class="card-header">รายการสัญญาทั้งหมด {{ $count }} ฉบับ</div>

                @if($count != 0)
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <th>เลขที่สัญญา</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th>ห้อง</th>
                        <th>อายุสัญญา</th>
                        <th>เริ่มต้น</th>
                        <th>สิ้นสุด</th>
                        <th>สถานะ</th>
                        </thead>
                        <tbody>
                            @foreach ($contracts as $contract)
                            <tr>
                                <td>{{ $contract->contract }}</td>
                                <td>{{ $contract->user->name }}</td>
                                <td>{{ $contract->room }}</td>
                                <td>
                                    @if($contract->term == 2) <font color="orange">รายเดือน </font>@endif
                                    @if($contract->term != 2) {{ $contract->term }} เดือน @endif
                                </td>
                                <td>{{ $contract->start }}</td>
                                <td>
                                    @if($contract->term == 2) <font color="orange">นับต่อเนื่อง </font>@endif
                                    @if($contract->term != 2) {{ $contract->end }}@endif
                                </td>
                                <td>
                                    @if($contract->status == 0)<font color="green">ปกติ</font>@endif
                                    @if($contract->status == 1)<font color="blue">ย้ายห้อง/ต่อสัญญา({{ $contract->cancel }})</font>@endif
                                    @if($contract->status == 2)<font color="red">ยกเลิก({{ $contract->cancel }})</font>@endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $contracts->render() !!}
                </div>
                @endif

            </div>

        </div>
    </div>
</div>
@endsection
