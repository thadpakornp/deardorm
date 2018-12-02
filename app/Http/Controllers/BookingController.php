<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\BookingRequest;

class BookingController extends Controller {

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
            return view('booking.index', [
                'room' => \App\Rooms::where('status', '=', '0')->orderBy('name', 'asc')->get(),
                'count' => \App\Booking::count(),
                'bookings' => \App\Booking::orderBy('updated_at', 'desc')->simplePaginate(5),
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
    public function store(BookingRequest $request) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            $booking = \App\Autonum::count();
            if ($booking == 0) {
                $booking1 = date('YmdHis') . '0';
            } else {
                $num = \App\Autonum::orderBy('id', 'desc')->first();
                $auto = substr($num->autonum, 14, 10);
                $autonum = $auto + 1;
                $booking1 = date('YmdHis') . $autonum;
            }
            \App\Autonum::create([
                'autonum' => $booking1,
            ]);
            
            \App\Booking::create([
                'name' => $request->name,
                'mobile' => $request->mobile,
                'booking' => $booking1,
                'room' => $request->room,
                'checkin' => $request->checkin,
                'status' => 0
            ]);
            $room = \App\Rooms::where('name', '=', $request->room)->first();
            $room->status = 1;
            $room->save();

            $request->session()->flash('alert', 'success');
            $request->session()->flash('status', 'บันทึกข้อมูลการจองเรียบร้อยแล้ว');
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
        return $id;
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
