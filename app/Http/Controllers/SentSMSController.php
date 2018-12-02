<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Api\thsms;
use Auth;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\SentSMSRequest;

require_once(__DIR__ . '\smsgateway\autoload.php');

use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Api\DeviceApi;

class SentSMSController extends Controller {

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
            return view('setting.send', [
                'user' => \App\User::with('profiles')->where('status', '=', '1')->get(),
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
    public function store(SentSMSRequest $request) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            $setting = \App\Sms::orderBy('id', 'desc')->first();
            $username = $setting->username;
            $password = Crypt::decryptString($setting->password);

            $sms = new thsms();

            $sms->username = $username;
            $sms->password = $password;

            if ($request->mobile != '*') {
                $sending = New \App\Sending;
                if ($setting->gateway == 'THSMS.COM') {

                    $sms->send('0000', $request->mobile, $request->texts);
                    $sending->gateways = 'THSMS.COM';
                    $sending->mobile = $request->mobile;
                    $sending->texts = $request->texts;
                    $sending->save();
                } else {
                    $clients = new SMSGatewayMe\Client\ClientProvider($password);

                    $sendMessageRequest = new SMSGatewayMe\Client\Model\SendMessageRequest([
                        'phoneNumber' => $request->mobile, 'message' => $request->texts, 'deviceId' => $username
                    ]);

                    $clients->getMessageClient()->sendMessages([$sendMessageRequest]);
                    $sending->gateways = 'SMSGATEWAY.ME';
                    $sending->mobile = $request->mobile;
                    $sending->texts = $request->texts;
                    $sending->save();
                }
            } else {
                $profile = \App\User::with('profiles')->where('status', '=', '1')->get();

                if ($setting->gateway == 'THSMS.COM') {
                    $sms = new thsms();

                    $sms->username = $username;
                    $sms->password = $password;
                    foreach ($profile as $p) {
                        $sending = New \App\Sending;
                        $sms->send('0000', $p->profiles->mobile, $request->texts);

                        $sending->gateways = 'THSMS.COM';
                        $sending->mobile = $p->profiles->mobile;

                        $sending->texts = $request->texts;
                        $sending->save();
                    }
                } else {
                    $clients = new SMSGatewayMe\Client\ClientProvider($password);
                    foreach ($profile as $p) {
                        $sending = New \App\Sending;
                        $sendMessageRequest = new SMSGatewayMe\Client\Model\SendMessageRequest([
                            'phoneNumber' => $p->profiles->mobile, 'message' => $request->texts, 'deviceId' => $username
                        ]);

                        $clients->getMessageClient()->sendMessages([$sendMessageRequest]);
                        $sending->gateways = 'SMSGATEWAY.ME';

                        $sending->mobile = $p->profiles->mobile;

                        $sending->texts = $request->texts;
                        $sending->save();
                    }
                }
            }
            $request->session()->flash('alert', 'success');
            $request->session()->flash('status', 'ระบบได้ดำเนินการจัดส่งข้อความเรียบร้อยแล้ว');
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

}
