<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\MaillingRequest;
use Mail;

class SentEmailController extends Controller {

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
            return view('setting.mails', [
                'user' => \App\User::where('status', '=', '1')->get(),
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
    public function store(MaillingRequest $request) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            $data = array('name' => $request->texts);
            if ($request->email != '*') {
                $sending = New \App\Mailling;

                Mail::send('setting.mail', $data, function($message) use($request) {
                    $message->to($request->email, $request->email)->subject
                            ($request->topic);
                    $message->from(env('MAIL_USERNAME', ''), env('MAIL_USERNAME', ''));
                });

                $sending->gateways = env('MAIL_USERNAME', '');
                $sending->topic = $request->topic;
                $sending->email = $request->email;
                $sending->texts = $request->texts;
                $sending->save();
            } else {
                $profile = \App\User::where('status', '=', '1')->get();
                foreach ($profile as $p) {
                    $sending = New \App\Mailling;

                    Mail::send('setting.mail', $data, function($message) use($request, $p) {
                        $message->to($p->email, $p->email)->subject
                                ($request->topic);
                        $message->from(env('MAIL_USERNAME', ''), env('MAIL_USERNAME', ''));
                    });

                    $sending->gateways = env('MAIL_USERNAME', '');
                    $sending->topic = $request->topic;
                    $sending->email = $p->email . '(' . $request->email . ')';
                    $sending->texts = $request->texts;
                    $sending->save();
                }
            }
            $request->session()->flash('alert', 'success');
            $request->session()->flash('status', 'ระบบได้ดำเนินการจัดส่งอีเมลล์เรียบร้อยแล้ว');
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
