<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Crypt;
use App\Http\Api\thsms;
use Mail;

require_once(__DIR__ . '\smsgateway\autoload.php');

use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Api\DeviceApi;

class ContactController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('auth.profile.contact');
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
    public function store(ContactRequest $request) {
        $data = array('name' => $request->contact);
        Mail::send('setting.mail', $data, function($message){
            $message->to('thadpakorn.p@gmail.com', 'Thadpakorn Phetwisut')->subject
                    ('ระบบได้รับแจ้งปัญหาการใช้งาน');
            $message->from(env('MAIL_USERNAME', ''), env('MAIL_USERNAME', ''));
        });

        \App\Contact::create([
            'email' => $request->email,
            'contact' => Crypt::encryptString($request->contact),
            'status' => 0,
        ]);

        $request->session()->flash('alert', 'success');
        $request->session()->flash('status', 'รับแจ้งปัญหาเรียบร้อยแล้ว จะได้รับการติดต่อกลับภายใน 48 ชม.');
        return redirect()->back();
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
