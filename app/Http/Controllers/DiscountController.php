<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DiscountRequest;

class DiscountController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('setting.discount', [
            'count' => \App\Discount::count(),
            'discounts' => \App\Discount::simplePaginate(10),
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
    public function store(DiscountRequest $request) {
        \App\Discount::create([
            'name' => $request->name,
            'discount' => $request->discount,
        ]);
        $request->session()->flash('alert', 'success');
        $request->session()->flash('status', 'บันทึกข้อมูลส่วนลดเรียบร้อยแล้ว');
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
    public function destroy(Request $request, $id) {
        \App\Discount::destroy($id);
        $request->session()->flash('alert_event', 'success');
        $request->session()->flash('status_event', 'ลบข้อมูลส่วนลดเรียบร้อยแล้ว');
        return redirect()->back();
    }

}
