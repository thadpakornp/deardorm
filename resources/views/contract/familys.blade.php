@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">เพิ่มข้อมูลผู้ติดต่อของ {{ $users->name }}</div>

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

                    {!! Form::open(['url' => 'manage_contract/family', 'method' => 'post']) !!}

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ชื่อ-นามสกุล') }}</label>

                        <div class="col-md-10">
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ความสัมพันธ์') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('relationship', null, ['class' => 'form-control']) !!}
                        </div>

                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('เบอร์ติดต่อ') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('mobile', null, ['class' => 'form-control']) !!}
                        </div>

                    </div>

                    <input type="hidden" name="id" value="{{ $users->id }}">
                    <div class="form-group row mb-0">
                        <div class="col-md-12 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('เพิ่มข้อมูลผู้ติดต่อ') }}
                            </button>
                            <a href="{{ url('manage_contract') }}" class="btn btn-danger">ย้อนกลับหน้าเดิม</a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>

            <br/>

            <div class="card ">
                <div class="card-header">รายชื่อผู้ติดต่อ</div>

                @if($count != 0)
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <th>ชื่อ-นามสกุล</th>
                        <th>เบอร์ติดต่อ</th>
                        <th>ความสัมพันธ์</th>
                        <th>การกระทำ</th>
                        </thead>
                        <tbody>
                            @foreach ($familys as $family)
                            <tr>
                                <td>{{ $family->name }}</td>
                                <td>{{ $family->mobile }}</td>
                                <td>{{ $family->relationship }}</td>
                                <td>
                                    {!! Form::open(['url' => 'manage_contract/family/delete/','method' => 'post']) !!}
                                    <input type="hidden" name="id" value="{{ $family->created_at }}">
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
