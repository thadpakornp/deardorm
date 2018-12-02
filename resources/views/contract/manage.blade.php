@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">จัดการสัญญาในระบบ</div>

                @if($count != 0)
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-{{ session('alert') }}" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <table class="table text-center">
                        <thead>
                        <th>เลขที่สัญญา</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th>ห้อง</th>
                        <th>เริ่มสัญญา</th>
                        <th>สิ้นสุดสัญญา</th>
                        <th>บันทึก</th>
                        <th>สถานะ</th>
                        <th>การกระทำ</th>
                        </thead>
                        <tbody>
                            @foreach ($contracts as $contract)
                            <tr>
                                <td>{{ $contract->contract }} </td>
                                <td>{{ $contract->user->name }}</td>
                                <td>{{ $contract->room }}</td>
                                <td>{{ $contract->start }}</td>
                                <td>{{ $contract->end }}</td>
                                <td>{{ $contract->created_at }}</td>
                                <td>
                                    @if($contract->status == 0)<font color="green">ปกติ</font>@endif
                                    @if($contract->status == 1)<font color="blue">ย้ายห้อง/ต่อสัญญา</font>@endif
                                    @if($contract->status == 2)<font color="red">ยกเลิก</font>@endif
                                    <br/> 
                                    <?php
                                    if (\App\Invoice::where('contract', '=', $contract->num)->where('status', '=', '0')->count() > 0) {
                                        echo '<font color="red">พบยอดค้างชำระ</font>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <div class="btn-group dropright">
                                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            เลือกเมนู
                                        </button>
                                        <div class="dropdown-menu">
                                            @if($contract->status == 0)
                                            <a class="dropdown-item" href="{{ url('manage_contract/move/'.$contract->num) }}">ย้ายห้อง</a>
                                            <a class="dropdown-item" href="{{ url('manage_contract/cancel/'.$contract->num) }}">ยกเลิก</a>
                                            <div class="dropdown-divider"></div>
                                            @endif
                                            <a class="dropdown-item" href="{{ url('manage_contract/'.$contract->num) }}" target="_blank">รายละเอียด</a>
                                            <a class="dropdown-item" href="{{ url('manage_contract/invoice/'.$contract->num) }}" target="_blank">ใบแจ้งสัญญา</a>
                                            @if($contract->status == 0)
                                            <a class="dropdown-item" href="{{ url('manage_contract/pay/'.$contract->num) }}" target="_blank">ชำระค่าสัญญา</a>
                                            @endif
                                            <a class="dropdown-item" href="{{ url('manage_contract/recivce/'.$contract->num) }}" target="_blank">ใบเสร็จสัญญา</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="{{ url('manage_contract/files/'.$contract->num) }}">อัปโหลดเอกสาร</a>
                                            <a class="dropdown-item" href="{{ url('manage_contract/services/'.$contract->num) }}">จัดการส่วนเสริม</a>
                                            <a class="dropdown-item" href="{{ url('manage_contract/familys/'.$contract->user->id) }}">ข้อมูลครอบครัว</a>
                                        </div>
                                    </div>
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
