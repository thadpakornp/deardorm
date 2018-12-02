@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">อัปโหลดไฟล์</div>

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

                    {!! Form::model($contracts, ['url' => 'manage_contract/uploads', 'files' => true, 'method' => 'post']) !!}

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('โปรดเลือกไฟล์') }}</label>

                        <div class="col-md-4">
                            {!! Form::file('files',null,['class' => 'form-control']) !!}
                        </div>

                    </div>
                    
                    <input type="hidden" name="num" value="{{ $contracts->num }}">
                    <div class="form-group row mb-0">
                        <div class="col-md-12 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('อัปโหลดไฟล์') }}
                            </button>
                            <a href="{{ url('manage_contract') }}" class="btn btn-danger">ย้อนกลับหน้าเดิม</a>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>

            <br/>

            <div class="card ">
                <div class="card-header">รายการไฟล์ จำนวน {{ $count }} รายการ</div>

                @if($count != 0)
                <div class="card-body">
                    @if (session('status_upload'))
                    <div class="alert alert-{{ session('alert_upload') }}" role="alert">
                        {{ session('status_upload') }}
                    </div>
                    @endif
                    <table class="table">
                        <thead>
                        <th width = "90%">ชื่อไฟล์</th>
                        <th width = "10%">การกระทำ</th>
                        </thead>
                        <tbody>
                            @foreach ($uploads as $upload)
                            <tr>
                                <td width = "90%"><a href="{{ url('manage_contract/imanges/'.$upload->files) }}" target="_blank">{{ $upload->files }}</a></td>
                                <td width = "10%">
                                    {!! Form::open(['url' => 'manage_contract/'.$upload->id, 'method' => 'delete']) !!}
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
