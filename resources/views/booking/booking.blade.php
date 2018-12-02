<?php

function num2string($num) {
    $ans = '';
    $digit = Array("หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
    $unit = Array("สิบ", "ร้อย", "พัน", "หมื่น", "แสน");

    if ($num == 0)
        return "บาทถ้วน";

    if (strpos($num, ".") == 0)
        $num .= ".00";

    $tmp = substr($num, 0, strpos($num, "."));
    while (strlen($tmp) > 6) {
        $cut = strlen($tmp) % 6;
        if ($cut == 0)
            $cut = 6;
        $data = substr($tmp, 0, $cut);
        for ($i = 0; $i < strlen($data) - 2; $i++) {
            if ($data[$i] == 0)
                continue;

            $ans .= $digit[$data[$i] - 1] . $unit[strlen($data) - $i - 2];
        }
        $ans .= num2string_2digit(substr($data, strlen($data) - 2)) . "ล้าน";
        $tmp = substr($tmp, $cut);
    }

    for ($i = 0; $i < strlen($tmp) - 2; $i++) {
        if ($tmp[$i] == 0)
            continue;

        $ans .= $digit[$tmp[$i] - 1] . $unit[strlen($tmp) - $i - 2];
    }

    $ans .= num2string_2digit(substr($tmp, strlen($tmp) - 2)) . "บาท";

    $tmp = substr($num, strpos($num, ".") + 1);
    if (substr($tmp, 0, 2) == "00")
        return $ans . "ถ้วน";

    return $ans . num2string_2digit($tmp) . "สตางค์";
}

function num2string_2digit($num) {
    $digit = Array("", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");

    $ans = "";
    $num = sprintf("%d", $num);

    if (strlen($num) == 1)
        return $digit[$num];

    if ($num[0] == 2)
        $ans .= "ยี่";
    else if ($num[0] > 2)
        $ans .= $digit[$num[0]];

    if ($num[0] > 0)
        $ans .= "สิบ";

    if ($num[1] > 1)
        $ans .= $digit[$num[1]];
    else if ($num[1] == 1)
        $ans .= "เอ็ด";

    return $ans;
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>ใบสำคัญการจองห้องพัก #{{ $bookings->booking }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('font-awesome/css/font-awesome.min.css') }}" />

        <script type="text/javascript" src="{{ asset('js/jquery-1.10.2.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
        <link href="https://fonts.googleapis.com/css?family=Bai+Jamjuree:400,700" rel="stylesheet"> 
        <style>
            html,body{
                font-family: 'Bai Jamjuree', sans-serif;
            }
        </style>
    </head>
    <body>
        <div class="page-header">
            <img src="{{ asset('images/'.$setting->logo) }}" width="120" height="120"><h1>{{ $setting->name_en }}({{ $setting->name_th }}) {{ $setting->iddorm }} <br/><small>{{ $setting->address }} โทร {{ $setting->phone }} อีเมลล์ {{ $setting->email }}</small></h1>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="text-center">
                    <h2>ใบสำคัญการจองห้องพัก #{{ $bookings->booking }}</h2>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">สถานะการจอง : 
                                @if($bookings->status == 0)<font color="orange">รอชำระเงิน</font>@endif
                                @if($bookings->status == 1)<font color="green">ปกติ</font>@endif
                                @if($bookings->status == 2)<font color="blue">ทำสัญญาแล้ว</font>@endif
                                @if($bookings->status == 3)<font color="red">ยกเลิก</font>@endif
                            </div>
                            @if(($bookings->paid != NULL) and ($bookings->price != NULL))
                            <div class="panel-body">
                                ประเภทการชำระ : 
                                <strong>
                                    @if($bookings->paid == 0)มัดจำค่าจองห้องพักส่วนหนึ่ง@endif
                                    @if($bookings->paid == 1)ชำระค่าจองห้องพักเต็มจำนวน@endif
                                </strong>  
                                จำนวน <strong>{{ $bookings->price }}</strong> บาท<br>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">ข้อมูลผู้จอง</div>
                            <div class="panel-body">
                                ชื่อ - นามสกุล : <strong>{{ $bookings->name }}</strong>
                                เบอร์ติดต่อ : <strong>{{ $bookings->mobile }}</strong><br>
                                วันที่ทำรายการ : <strong>{{ $bookings->created_at }}</strong> ปรับปรุงข้อมูลล่าสุด : <strong>{{ $bookings->updated_at }}</strong><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="text-center"><strong>รายละเอียดการจอง</strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <td><strong>รายการ</strong></td>
                                        <td class="text-center"><strong>ราคา</strong></td>
                                        <td class="text-right"><strong>รวม</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>จองห้องพัก ห้องเลขที่ {{ $bookings->room }}</td>
                                        <td class="text-center"></td>
                                        <td class="text-right"></td>
                                    </tr>
                                    <tr>
                                        <td>ประเภทห้อง {{ $room->type }} ชั้น {{ $room->floor }}</td>
                                        <td class="text-center">{{ $room->price }}</td>
                                        <td class="text-right">{{ $room->price }}</td>
                                    </tr>
                                    <tr>
                                        <td>วันที่เข้าพัก {{ $bookings->checkin }}</td>
                                        <td class="text-center"></td>
                                        <td class="text-right"></td>
                                    </tr>
                                    <tr>
                                        <td class="highrow text-center"><b>({{ num2string($room->price) }})</b></td>
                                        <td class="highrow text-center"><strong>รวมทั้งหมด</strong></td>
                                        <td class="highrow text-right">{{ $room->price }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <center>
                                <b>
                                    ชื่อบัญชี : {{ $setting->bank }} <br/>
                                    @foreach ($banks as $bank)
                                    <u>{{ $bank->name }} {{ $bank->number }}</u> &emsp;
                                    @endforeach
                                </b>
                                <br/>
                                <?php echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($bookings->booking, "C128", 3, 33) . '"/>'; ?>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .height {
                min-height: 200px;
            }

            .icon {
                font-size: 47px;
                color: #5CB85C;
            }

            .iconbig {
                font-size: 77px;
                color: #5CB85C;
            }

            .table > tbody > tr > .emptyrow {
                border-top: none;
            }

            .table > thead > tr > .emptyrow {
                border-bottom: none;
            }

            .table > tbody > tr > .highrow {
                border-top: 3px solid;
            }
        </style> 
    </body>
</html>
