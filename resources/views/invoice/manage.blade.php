@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">ข้อมูลใบแจ้งค่าบริการ จำนวน {{ $count }} รายการ</div>

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
                        <th>ประเภท</th>
                        <th>การกระทำ</th>
                        </thead>
                        <tbody>
                            @foreach($invoices as $invoice)
                            <tr>
                                <td>
                                    @if($invoice->status == 0)<font color="red">{{ $invoice->invoice }}</font>@endif
                                    @if($invoice->status == 1)<font color="blue">{{ $invoice->invoice }}</font>@endif
                                    @if($invoice->status == 2){{ $invoice->invoice }}@endif
                                </td>
                                <td>
                                    @if($invoice->type == 1)-@endif</font>
                                    @if($invoice->type == 2){{ $invoice->due }}/{{ $invoice->year }}@endif
                                </td>
                                <?php
                                $infocontract = \App\Contract::where('num', '=', $invoice->contract)->first();
                                ?>
                                <td>{{ $infocontract->contract }}</td>
                                <td>{{ $infocontract->room }}</td>
                                <?php
                                $using = \App\Invoice::select('water', 'power')->orderBy('id', 'desc')->where('contract', '=', $invoice->contract)->take(2)->get();
                                ?>
                                <td class="table-secondary">
                                    @if($invoice->type == 1)
                                    -
                                    @else
                                    {{ $using[1]['water'] }}
                                    @endif
                                </td>
                                <td class="table-success">
                                    @if($invoice->type == 1)
                                    {{ $using[1]['water'] }}
                                    @else
                                    {{ $using[0]['water'] }}
                                    @endif
                                </td>
                                <td class="table-secondary">
                                    @if($invoice->type == 1)
                                    -
                                    @else
                                    {{ $using[1]['power'] }}
                                    @endif
                                </td>
                                <td class="table-success">
                                    @if($invoice->type == 1)
                                    {{ $using[1]['power'] }}
                                    @else
                                    {{ $using[0]['power'] }}
                                    @endif
                                </td>
                                <td>
                                    @if($invoice->type == 1)<font color="orange">แรกเข้า</font>@endif
                                    @if($invoice->type == 2)<font color="green">รายเดือน</font>@endif
                                </td>
                                <td>
                                    <a href="{{ url('invoice/sms/'.$invoice->invoice) }}"><img src="{{ asset('images/chat.png') }}"></a>&nbsp;
                                    <a href="{{ url('invoice/email/'.$invoice->invoice) }}"><img src="{{ asset('images/email.png') }}"></a>&nbsp;
                                    <a href="{{ url('invoice/print/'.$invoice->invoice) }}" target="_blank"><img src="{{ asset('images/printer.png') }}"></a>&nbsp;
                                    <a href="{{ url('invoice/view/'.$invoice->invoice) }}" target="_blank"><img src="{{ asset('images/eye.png') }}"></a>&nbsp;
                                    @if($invoice->status == 0)<a href="{{ url('manage_invoice/cancel/'.$invoice->invoice) }}"><img src="{{ asset('images/remove.png') }}"></a>@endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $invoices->render() !!}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
