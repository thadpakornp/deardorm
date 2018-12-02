<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\ProfileRequest;
use File;

class ProfileController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('auth.profile.profile', [
            'user' => \App\User::find(Auth::user()->id)
        ]);
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
    public function store(Request $request) {
        //
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
    public function update(ProfileRequest $request, $id) {
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
        
        $user->save();
        
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
        $profile->save();

        $request->session()->flash('alert', 'success');
        $request->session()->flash('status', 'แก้ไขข้อมูลส่วนตัวเรียบร้อยแล้ว');
        return redirect()->back();
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
