<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use File;
use Illuminate\Support\Facades\Crypt;
use App\Http\Api\thsms;
use Auth;
use Hash;

require_once(__DIR__ . '\smsgateway\autoload.php');

use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Api\DeviceApi;

class CustomerController extends Controller {

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
            return view('setting.customer', [
                'count' => \App\User::count(),
                'customers' => \App\User::with('profiles')->simplePaginate(5),
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
    public function store(CustomerRequest $request) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            if (\App\User::where('email', '=', $request->email)->count() > 0) {
                $request->session()->flash('alert', 'danger');
                $request->session()->flash('status', 'อีเมลล์นี้มีในระบบแล้ว กรุณาใช้งานอีเมลล์อื่น หรือ เปิดใช้งานอีเมลล์นี้อีกครั้ง');
            } else {
                \App\User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'profile' => $request->profile,
                    'status' => 0
                ]);
                $request->session()->flash('alert', 'success');
                $request->session()->flash('status', 'บันทึกข้อมูลลูกค้าเรียบร้อยแล้ว');
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
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            return view('setting.profile', [
                'user' => \App\User::find($id),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, $id) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            $user = \App\User::find($id);
            if ($user->email != $request->email) {

                if (\App\User::where('email', '=', $request->email)->count() == 0) {
                    $user->email = $request->email;
                } else {

                    $request->session()->flash('alertt', 'danger');
                    $request->session()->flash('statuss', 'ไม่สามารถแก้ไขอีเมลล์ได้');
                }
            }

            $user->name = $request->name;
            $user->profile = $request->profile;

            $profile = \App\Profiles::find($id);

            if (isset($profile)) {
                if ($profile->img != 'No_Image.jpg' AND $request->hasFile('img')) {
                    File::delete(public_path() . '\\images\\' . $profile->img);
                }
            } else {
                $profile = New \App\Profiles;
                $profile->id = $id;
            }

            $profile->idcard = $request->idcard;
            $profile->nickname = $request->nickname;
            $profile->hbd = $request->hbd;
            $profile->mobile = $request->mobile;
            $profile->address = $request->address;

            if ($request->hasFile('img')) {
                $filename = time() . '.' . str_random(10) . '.' . $request->file('img')->getClientOriginalExtension();
                $request->file('img')->move(public_path() . '/images/', $filename);
                $profile->img = $filename;
            } else {
                if ($profile->img == '') {
                    $profile->img = 'No_Image.jpg';
                }
            }


            $request->session()->flash('alert', 'success');
            $request->session()->flash('status', 'แก้ไขข้อมูลส่วนตัวเรียบร้อยแล้ว');

            if ($user->status == 0) {
                $sending = New \App\Sending;

                $user->status = 1;

                $newpassword = str_random(6);
                $user->password = Hash::make($newpassword);

                $setting = \App\Sms::orderBy('id', 'desc')->first();
                $username = $setting->username;
                $password = Crypt::decryptString($setting->password);
                if ($setting->gateway == 'THSMS.COM') {
                    $sms = new thsms();

                    $sms->username = $username;
                    $sms->password = $password;
                    $sms->send('0000', $request->mobile, 'รหัสผ่านของท่านคือ ' . $newpassword);
                    $sending->gateways = 'THSMS.COM';
                } else {
                    $clients = new SMSGatewayMe\Client\ClientProvider($password);

                    $sendMessageRequest = new SMSGatewayMe\Client\Model\SendMessageRequest([
                        'phoneNumber' => $request->mobile, 'message' => 'รหัสผ่านของท่านคือ ' . $newpassword, 'deviceId' => $username
                    ]);

                    $clients->getMessageClient()->sendMessages([$sendMessageRequest]);
                    $sending->gateways = 'SMSGATEWAY.ME';
                }
                $sending->mobile = $request->mobile;
                $sending->texts = 'รหัสผ่านของท่านคือ ' . $newpassword;
                $sending->save();
            }
            $profile->career = $request->career;
            $user->save();
            $profile->save();
            return redirect()->back();
        }
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

    public function reset(Request $request, $id) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            $sending = New \App\Sending;
            $user = \App\User::find($id);

            if ($user->status == 1) {
                $newpassword = str_random(6);
                $user->password = Hash::make($newpassword);

                $setting = \App\Sms::orderBy('id', 'desc')->first();
                $username = $setting->username;
                $password = Crypt::decryptString($setting->password);

                $profile = \App\Profiles::find($user->id);

                if ($setting->gateway == 'THSMS.COM') {
                    $sms = new thsms();

                    $sms->username = $username;
                    $sms->password = $password;
                    $sms->send('0000', $profile->mobile, 'รหัสผ่านใหม่ของท่านคือ ' . $newpassword);
                    $sending->gateways = 'THSMS.COM';
                } else {
                    $clients = new SMSGatewayMe\Client\ClientProvider($password);

                    $sendMessageRequest = new SMSGatewayMe\Client\Model\SendMessageRequest([
                        'phoneNumber' => $profile->mobile, 'message' => 'รหัสผ่านใหม่ของท่านคือ ' . $newpassword, 'deviceId' => $username
                    ]);

                    $clients->getMessageClient()->sendMessages([$sendMessageRequest]);
                    $sending->gateways = 'SMSGATEWAY.ME';
                }
                $user->save();
                $sending->mobile = $profile->mobile;
                $sending->texts = 'รหัสผ่านใหม่ของท่านคือ ' . $newpassword;
                $sending->save();
                $request->session()->flash('alert_room', 'success');
                $request->session()->flash('status_room', 'ตั้งค่ารหัสผ่านใหม่เรียบร้อยแล้ว');
            } else {
                $request->session()->flash('alert_room', 'danger');
                $request->session()->flash('status_room', 'สถานะบัญชีไม่พร้อมใช้งานฟังก์ชั่นนี้');
            }
            return redirect()->back();
        }
    }

}
