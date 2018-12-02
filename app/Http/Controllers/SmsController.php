<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SmsRequest;
use Illuminate\Support\Facades\Crypt;
use App\Http\Api\thsms;
use Auth;

require_once(__DIR__ . '\smsgateway\autoload.php');

use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Api\DeviceApi;

class SmsController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            return view('setting.sms', [
                'sms' => \App\Sms::orderBy('id', 'desc')->first(),
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SmsRequest $request) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            if ($request->password != $request->repassword) {
                $request->session()->flash('alert', 'danger');
                $request->session()->flash('status', 'รหัสผ่านไม่ตรงกัน');
            } else {
                \App\Sms::create([
                    'gateway' => $request->gateway,
                    'username' => $request->username,
                    'password' => Crypt::encryptString($request->password),
                ]);
                $request->session()->flash('alert', 'success');
                $request->session()->flash('status', 'บันทึกการตั้งค่า SMS เรียบร้อยแล้ว');
            }
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function test(Request $request) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            $test = \App\Sms::orderBy('id', 'desc')->first();
            $username = $test->username;
            $password = Crypt::decryptString($test->password);
            if ($test->gateway == 'THSMS.COM') {
                $sms = new thsms();

                $sms->username = $username;
                $sms->password = $password;

                if ($sms->getCredit() == FALSE) {
                    $request->session()->flash('alert', 'danger');
                    $request->session()->flash('status', 'ไม่สามารถเชื่อมต่อ API ได้ กรุณาตรวจสอบ ชื่อผู้ใช้งานหรือรหัสผ่าน');
                } else {
                    $request->session()->flash('alert', 'success');
                    $request->session()->flash('status', 'การเชื่อมต่อ API สำเร็จ เครดิตใช้งานคงเหลือ ' . $sms->getCredit());
                }
            } else {
                // Configure client
                $config = Configuration::getDefaultConfiguration();
                $config->setApiKey('Authorization', $password);

                // Create device client
                $deviceClient = new DeviceApi();

                // Get device information
                if ($deviceClient->getDevice($username) != 200) {
                    $request->session()->flash('alert', 'danger');
                    $request->session()->flash('status', 'ไม่สามารถเชื่อมต่อ API ได้ กรุณาตรวจสอบ ชื่อผู้ใช้งานหรือรหัสผ่าน');
                } else {
                    $request->session()->flash('alert', 'success');
                    $request->session()->flash('status', 'การเชื่อมต่อ API สำเร็จ');
                }
            }
            return redirect()->back();
        }
    }

}
