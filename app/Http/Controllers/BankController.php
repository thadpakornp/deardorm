<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\BankRequest;

class BankController extends Controller {

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
            return view('setting.bank', [
                'count' => \App\Bank::count(),
                'banks' => \App\Bank::orderBy('id', 'desc')->simplePaginate(10),
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
    public function store(BankRequest $request) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            \App\Bank::create([
                'name' => $request->name,
                'number' => $request->number,
            ]);

            $request->session()->flash('alert', 'success');
            $request->session()->flash('status', 'เพิ่มข้อมูลธนาคารเรียบร้อยแล้ว');

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
    public function destroy(Request $request, $id) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            \App\Bank::destroy($id);

            $request->session()->flash('alert_bank', 'success');
            $request->session()->flash('status_bank', 'ลบข้อมูลธนาคารเรียบร้อยแล้ว');

            return redirect()->back();
        }
    }

}
