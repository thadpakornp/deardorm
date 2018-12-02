<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>DearDorm</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        
        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Bai+Jamjuree:400,700" rel="stylesheet"> 
        
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            html,body{
                font-family: 'Bai Jamjuree', sans-serif;
            }
        </style>
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        แดโดม 
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest

                            @else
                            @if(Auth::user()->profile != 'admin')
                            <!-- user Zone -->

                            @else
                            <!-- admin zone -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    BOOKING<span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('booking') }}">
                                        {{ __('จองห้องพัก') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ url('manage_booking') }}">
                                        {{ __('จัดการจองห้องพัก') }}
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    CONTRACT<span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('contract') }}">
                                        {{ __('ระบบสัญญา') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ url('manage_contract') }}">
                                        {{ __('จัดการสัญญา') }}
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    INVOICE<span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('invoice') }}">
                                        {{ __('ใบแจ้งค่าบริการ') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ url('manage_invoice') }}">
                                        {{ __('จัดการใบแจ้งค่าบริการ') }}
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    POS<span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('payment') }}">
                                        {{ __('ชำระเงิน') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ url('manage_payment') }}">
                                        {{ __('จัดการใบเสร็จรับเงิน') }}
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    REPORT<span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('months') }}">
                                        {{ __('รายงานประจำเดือน') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ url('years') }}">
                                        {{ __('รายงานประจำปี') }}
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    SETUP<span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('setting') }}">
                                        {{ __('ตั้งค่าพื้นฐาน') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ url('sms') }}">
                                        {{ __('ตั้งค่า SMS/Email') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ url('room') }}">
                                        {{ __('ตั้งค่าห้องพัก') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ url('bank') }}">
                                        {{ __('ข้อมูลการเงิน') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ url('customer') }}">
                                        {{ __('จัดการผู้ใช้งาน') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ url('event') }}">
                                        {{ __('จัดการกิจกรรม') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ url('point') }}">
                                        {{ __('จัดการพ้อย') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ url('discount') }}">
                                        {{ __('จัดการส่วนลด') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ url('sent_sms') }}">
                                        {{ __('ส่ง SMS') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ url('sent_email') }}">
                                        {{ __('ส่ง EMAIL') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ url('history_sms') }}">
                                        {{ __('ประวัติการส่ง SMS') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ url('history_email') }}">
                                        {{ __('ประวัติการส่ง EMAIL') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ url('inbox') }}">
                                        {{ __('กล่องข้อความ') }}
                                    </a>
                                </div>
                            </li>
                            @endif

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} ({{ Auth::user()->profile }})<span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('password') }}">
                                        {{ __('เปลี่ยนรหัสผ่าน') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ url('profile') }}">
                                        {{ __('แก้ไขข้อมูลส่วนตัว') }}
                                    </a>
                                    @if(Auth::user()->profile != 'admin')
                                    <a class="dropdown-item" href="{{ url('contact') }}">
                                        {{ __('ติดต่อผู้ดูแล') }}
                                    </a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('ออกจากระบบ') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="py-4">
                @yield('content')
            </main>

        </div>
    </body>
</html>
