@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">เพิ่มจำนวนพ้อย</div>

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

                    {!! Form::model($user, ['url' => 'point', 'method' => 'post']) !!}

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ชื่อผู้รับรางวัล') }}</label>

                        <div class="col-md-10">
                            <select name="id" class="form-control">
                                <option value="">โปรดเลือกชื่อผู้ได้รับรางวัล</option>
                                @foreach ($user as $u)
                                <option value="{{ $u->id }}">{{ $u->name }} [{{ $u->email }}]</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('กิจกรรมที่ได้รับ') }}</label>

                        <div class="col-md-10">
                            <select name="event" class="form-control">
                                <option value="">โปรดเลือกกิจกรรมที่ได้รับ</option>
                                @foreach ($events as $event)
                                <option value="{{ $event->id }}">{{ $event->name }} [{{ $event->point }}]</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-12 offset-md-5">
                            <button type="submit" class="btn btn-primary">
                                {{ __('เพิ่มคะแนนพ้อย') }}
                            </button>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>

            <br/>

            <div class="card ">
                <div class="card-header">รายการพ้อยทั้งหมด</div>


                @if($count != 0)
                <div class="card-body">
                    @if (session('status_point'))
                    <div class="alert alert-{{ session('alert_point') }}" role="alert">
                        {{ session('status_point') }}
                    </div>
                    @endif
                    <table class="table">
                        <thead>
                        <th>ชื่อ-นามสกุล</th>
                        <th>กิจกรรม</th>
                        <th>จำนวนพ้อย</th>
                        <th>ได้รับเมื่อ</th>
                        <th>การกระทำ</th>
                        </thead>
                        <tbody>
                            @foreach ($points as $point)
                            <tr>
                                <td>{{ $point->user->name }} <br/>[{{ $point->user->email }}]</td>
                                <td>{{ $point->event }}</td>
                                <td>{{ $point->point }}</td>
                                <td>{{ $point->updated_at }}</td>
                                <td>
                                    {!! Form::open(['url' => 'point/'.$point->created_at, 'method' => 'delete']) !!}
                                    <button type="submit">
                                        <img src="{{ asset('/images/bin.png') }}" width="24" height="24">
                                    </button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $points->render() !!}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
