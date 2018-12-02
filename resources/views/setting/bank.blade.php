@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">เพิ่มข้อมูลธนาคาร</div>

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

                    {!! Form::open(['url' => 'bank', 'method' => 'post']) !!}

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ชื่อธนาคาร') }}</label>

                        <div class="col-md-10">
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('เลขที่ธนาคาร') }}</label>

                        <div class="col-md-10">
                            {!! Form::text('number', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-12 offset-md-5">
                            <button type="submit" class="btn btn-primary">
                                {{ __('เพิ่มข้อมูลธนาคาร') }}
                            </button>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>

            <br/>

            <div class="card ">
                <div class="card-header">รายชื่อธนาคารในระบบ</div>


                @if($count != 0)
                <div class="card-body">
                    @if (session('status_bank'))
                    <div class="alert alert-{{ session('alert_bank') }}" role="alert">
                        {{ session('status_bank') }}
                    </div>
                    @endif
                    <table class="table">
                        <thead>
                        <th>ชื่อธนาคาร</th>
                        <th>เลขที่บัญชี</th>
                        <th>การกระทำ</th>
                        </thead>
                        <tbody>
                            @foreach ($banks as $bank)
                            <tr>
                                <td>{{ $bank->name }}</td>
                                <td>{{ $bank->number }}</td>
                                <td>
                                    {!! Form::open(['url' => 'bank/'.$bank->id, 'method' => 'delete']) !!}
                                    <button type="submit">
                                        <img src="{{ asset('/images/bin.png') }}" width="24" height="24">
                                    </button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $banks->render() !!}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
