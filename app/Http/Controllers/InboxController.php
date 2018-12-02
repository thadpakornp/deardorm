<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\InboxRequest;
use Mail;

class InboxController extends Controller {

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
            return view('setting.inbox', [
                'count' => \App\Contact::count(),
                'contacts' => \App\Contact::orderBy('id', 'desc')->simplePaginate(10),
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
    public function store(InboxRequest $request) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            $data = array('name' => $request->inbox);
            Mail::send('setting.mail', $data, function($message) use($request) {
                $message->to($request->email, $request->email)->subject
                        ('ตอบกลับ ระบบได้รับแจ้งปัญหาการใช้งาน');
                $message->from(env('MAIL_USERNAME', ''), env('MAIL_USERNAME', ''));
            });

            \App\InboxReply::create([
                'id' => $request->id,
                'email' => $request->email,
                'inbox' => Crypt::encryptString($request->inbox),
            ]);

            $request->session()->flash('alert', 'success');
            $request->session()->flash('status', 'ระบบดำเนินการตอบกลับลูกค้าเรียบร้อยแล้ว');
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
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            $contact = \App\Contact::find($id);

            if ($contact->received == NULL) {
                $contact->received = Auth::user()->name;
            }
            $contact->status = 1;

            $contact->save();

            return view('setting.details', [
                'contacts' => \App\Contact::find($id),
                'inboxs' => \App\InboxReply::where('id', '=', $id)->get(),
            ]);
        }
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
