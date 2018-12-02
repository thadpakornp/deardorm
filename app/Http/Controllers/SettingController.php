<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SettingRequest;
use Auth;

class SettingController extends Controller {

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
            return view('setting.index', [
                'setting' => \App\Setting::orderBy('id', 'desc')->first(),
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
    public function store(SettingRequest $request) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            if ($request->hasFile('logo')) {
                $filename = time() . '.' . str_random(10) . '.' . $request->file('logo')->getClientOriginalExtension();
                $request->file('logo')->move(public_path() . '/images/', $filename);
                $logo = $filename;
            } else {
                $img = \App\Setting::orderBy('id', 'desc')->first();
                if (isset($img)) {
                    $logo = $img->logo;
                } else {
                    $logo = 'No_Image.jpg';
                }
            }

            \App\Setting::create([
                'iddorm' => $request->iddorm,
                'name_th' => $request->name_th,
                'name_en' => $request->name_en,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'rate_water' => $request->rate_water,
                'rate_elec' => $request->rate_elec,
                'vat' => $request->vat,
                'due' => $request->due,
                'die' => $request->die,
                'pay' => $request->pay,
                'pay_limit' => $request->pay_limit,
                'bank' => $request->bank,
                'contract' => $request->contract,
                'logo' => $logo,
            ]);
            $request->session()->flash('alert', 'success');
            $request->session()->flash('status', 'บันทึกข้อมูลเรียบร้อยแล้ว');
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
