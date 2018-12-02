@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">การยกเลิกสัญญา เลขที่ {{ $contract->contract }}</div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="text-center"><strong>รายละเอียดที่แสดงในใบแจ้งการยกเลิก</strong></h4>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-condensed">
                                            <thead>
                                                <tr>
                                                    <td><strong>รายการ</strong></td>
                                                    <td class="text-center"><strong>จำนวน</strong></td>
                                                    <td class="text-center"><strong>ราคา</strong></td>
                                                    <td class="text-right"><strong>รวม</strong></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>ยกเลิกสัญญา เลขที่ <b>{{ $contract->contract }}</b> ห้องพัก เลขที่ <b>{{ $contract->room }}</b> ประเภท <b>{{ $room->type }}</b> ชั้น <b>{{ $room->floor }}</b></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-right"></td>
                                                </tr>
                                                <tr>
                                                    <td>ค่าปะปา มิเตอร์ <b>{{ $invoices->water }}</b> ถึง <b>{{ $water }}</b></td>
                                                    <td class="text-center">{{ $water-$invoices->water }}</td>
                                                    <td class="text-center">{{ $setting->rate_water }}</td>
                                                    <td class="text-right">{{ ($water-$invoices->water)*$setting->rate_water }}</td>
                                                </tr>
                                                <tr>
                                                    <td>ค่าไฟฟ้า มิเตอร์ <b>{{ $invoices->power }}</b> ถึง <b>{{ $power }}</b></td>
                                                    <td class="text-center">{{ $power-$invoices->power }}</td>
                                                    <td class="text-center">{{ $setting->rate_elec }}</td>
                                                    <td class="text-right">{{ ($power-$invoices->power)*$setting->rate_elec }}</td>
                                                </tr>
                                                @if(isset($air))
                                                <tr>
                                                    <td>ค่าทำความสะอาดเครื่องปรับอากาศ</td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center">{{ $air }}</td>
                                                    <td class="text-right">{{ $air }}</td>
                                                </tr>
                                                @endif
                                                @if(isset($clear))
                                                <tr>
                                                    <td>ค่าทำความสะอาดห้องพัก</td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center">{{ $clear }}</td>
                                                    <td class="text-right">{{ $clear }}</td>
                                                </tr>
                                                @endif
                                                @if(isset($textother))
                                                <tr>
                                                    <td>{{ $textother }}</td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center">{{ $priceother }}</td>
                                                    <td class="text-right">{{ $priceother }}</td>
                                                </tr>
                                                @endif
                                                @if(isset($textother1))
                                                <tr>
                                                    <td>{{ $textother1 }}</td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center">{{ $priceother1 }}</td>
                                                    <td class="text-right">{{ $priceother1 }}</td>
                                                </tr>
                                                @endif
                                                @if(isset($textother2))
                                                <tr>
                                                    <td>{{ $textother2 }}</td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center">{{ $priceother2 }}</td>
                                                    <td class="text-right">{{ $priceother2 }}</td>
                                                </tr>
                                                @endif
                                                @if($agecontract == FALSE)
                                                @if($age == 0)
                                                <tr>
                                                    <td>ยกเลิกสัญญาก่อนกำหนดตามที่ระบุไว้ในเงื่อนไข</td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center">{{ $room->price }}</td>
                                                    <td class="text-right">{{ $room->price }}</td>
                                                </tr>
                                                @endif
                                                @if($age == 1)
                                                <tr>
                                                    <td>ยกเลิกสัญญาก่อนกำหนดตามที่ระบุไว้ในเงื่อนไข (ได้รับการละเว้น)</td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-right">0</td>
                                                </tr>
                                                @endif
                                                @endif
                                                <tr>
                                                    <td>ค่าประกันห้องพัก</td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center">-{{ $room->price }}</td>
                                                    <td class="text-right">-{{ $room->price }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="highrow text-center"></td>
                                                    <td class="highrow text-center"></td>
                                                    <td class="highrow text-center"><strong>รวมทั้งหมด</strong></td>
                                                    <td class="highrow text-right"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    {!! Form::open(['url' => 'manage_contract/canceled', 'method' => 'post']) !!}
                    <div class="form-group row mb-0">
                        <div class="col-md-12 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('ยืนยันการยกเลิก') }}
                            </button>
                            <a href="{{ url('manage_contract/cancel/'.$contract->num) }}" class="btn btn-danger">ย้อนกลับหน้าเดิม</a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
