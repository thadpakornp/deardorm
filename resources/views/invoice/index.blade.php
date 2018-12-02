@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">เพิ่มข้อมูลการใช้น้ำปะปา - ไฟฟ้า</div>

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

                    {!! Form::open(['url' => 'invoice', 'method' => 'post']) !!}

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('ข้อมูลผู้เช่า') }}</label>

                        <div class="col-md-10">
                            <select name= "id" class="form-control">
                                <option value="">โปรดเลือกผู้เช่า</option>
                                @foreach($contracts as $contract)
                                <?php
                                $name = \App\User::select('name')->where('id', '=', $contract->id)->get();
                                ?>
                                <option value="{{ $contract->num }}">เลขที่สัญญา {{ $contract->contract }} เลขห้อง {{ $contract->room }} เช่าโดย {{ $name[0]['name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('หน่วยน้ำปะปา') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('water', null, ['class' => 'form-control']) !!}
                        </div>

                        <label for="text" class="col-sm-2 col-form-label text-md-right">{{ __('หน่วยไฟฟ้า') }}</label>

                        <div class="col-md-4">
                            {!! Form::text('power', null, ['class' => 'form-control']) !!}
                        </div>

                    </div>

                    <center><font color="red">หากต้องการแก้ไขข้อมูลน้ำ ไฟ ของผู้เช่าใด ให้บันทึกข้อมูลซ้ำ ภายในวันนั้น</font></center>

                    <div class="form-group row mb-0">
                        <div class="col-md-12 offset-md-5">
                            <button type="submit" class="btn btn-primary">
                                {{ __('บันทึกข้อมูลน้ำปะปา - ไฟฟ้า') }}
                            </button>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>

            <br/>

            <div class="card ">
                <div class="card-header">รายการบันทึกข้อมูลน้ำปะปา - ไฟฟ้า วัน/เดือน/ปี ปัจจุบัน จำนวน {{ $count }} รายการ</div>

                @if($count != 0)
                <div class="card-body">
                    @if (session('statuss'))
                    <div class="alert alert-{{ session('alertt') }}" role="alert">
                        {{ session('statuss') }}
                    </div>
                    @endif
                    <table class="table text-center">
                        <thead>
                        <th>เลขที่ใบแจ้ง</th>
                        <th>ประจำเดือน</th>
                        <th>เลขที่สัญญา</th>
                        <th>ห้อง</th>
                        <th class="table-secondary">ปะปาเก่า</th>
                        <th class="table-success">ปะปาใหม่</th>
                        <th class="table-secondary">ไฟฟ้าเก่า</th>
                        <th class="table-success">ไฟฟ้าใหม่</th>
                        <th>การกระทำ</th>
                        </thead>
                        <tbody>
                            @foreach($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->invoice }}</td>
                                <td>{{ $invoice->due }}/{{ $invoice->year }}</td>
                                <?php
                                $infocontract = \App\Contract::where('num', '=', $invoice->contract)->first();
                                ?>
                                <td>{{ $infocontract->contract }}</td>
                                <td>{{ $infocontract->room }}</td>
                                <?php
                                $using = \App\Invoice::select('water', 'power')->orderBy('id', 'desc')->where('contract', '=', $invoice->contract)->take(2)->get();
                                ?>
                                <td class="table-secondary">{{ $using[1]['water'] }}</td>
                                <td class="table-success">{{ $using[0]['water'] }}</td>
                                <td class="table-secondary">{{ $using[1]['power'] }}</td>
                                <td class="table-success">{{ $using[0]['power'] }}</td>
                                <td>
                                    <a href="{{ url('invoice/sms/'.$invoice->invoice) }}"><img src="{{ asset('images/chat.png') }}"></a>&nbsp;
                                    <a href="{{ url('invoice/email/'.$invoice->invoice) }}"><img src="{{ asset('images/email.png') }}"></a>&nbsp;
                                    <a href="{{ url('invoice/print/'.$invoice->invoice) }}" target="_blank"><img src="{{ asset('images/printer.png') }}"></a>&nbsp;
                                    <a href="{{ url('invoice/view/'.$invoice->invoice) }}" target="_blank"><img src="{{ asset('images/eye.png') }}"></a>
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
