<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\BookingRequest;
use App\Http\Requests\BookingPaymentRequest;
use App\Http\Requests\BookingContractRequest;
use Carbon\Carbon;

class ManageBookingController extends Controller {

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
            return view('booking.manage', [
                'count' => \App\Booking::count(),
                'bookings' => \App\Booking::orderBy('updated_at', 'desc')->simplePaginate(10),
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
    public function store(BookingContractRequest $request) {
        if ($request->term != 0) {
            $d = $request->start;
            $dd = explode("-", $d);
            $dt = Carbon::create($dd[0], $dd[1], $dd[2]);
            $contractend = $dt->addMonths($request->term - 1)->toDateString();
        } else {
            $contractend = "0000-00-00";
        }

        if (\App\Contract::count() == 0) {
            $con = '1';
            $year = date('Y');
            $contractid = $con . '/' . $year;
        } else {
            $con = \App\Contract::orderBy('created_at', 'desc')->first();
            $conn = explode("/", $con->contract);
            if ($conn[1] == date('Y')) {
                $idcon = $conn[0] + 1;
                $contractid = $idcon . '/' . date('Y');
            } else {
                $idcon = '1';
                $contractid = $idcon . '/' . date('Y');
            }
        }

        \App\Contract::create([
            'id' => $request->id,
            'room' => $request->room,
            'contract' => $contractid,
            'term' => $request->term,
            'start' => $request->start,
            'end' => $contractend,
            'status' => 0,
        ]);

        $booking = \App\Booking::find($request->booking);
        $booking->status = 2;
        $booking->save();

        $room = \App\Rooms::where('name', '=', $request->room)->first();
        $room->status = 2;
        $room->save();

        $book = \App\Autonum::count();
        if ($book == 0) {
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

        $contract = \App\Contract::where('contract', '=', $contractid)->first();

        \App\Invoice::create([
            'invoice' => $booking1,
            'contract' => $contract->num,
            'ref' => $request->price,
            'water' => $request->water,
            'power' => $request->power,
            'type' => 1,
            'status' => 0
        ]);

        $request->session()->flash('alert', 'success');
        $request->session()->flash('status', 'ดำเนินการสร้างสัญญา ' . $contractid . ' เรียบร้อยแล้ว กรุณาตรวจสอบที่เมนูจัดการสัญญา');

        return redirect()->back();
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
            return view('booking.contract', [
                'bookings' => \App\Booking::find($id),
                'users' => \App\User::where('profile', '=', 'user')->where('status', '=', '1')->orderBy('id', 'asc')->get(),
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
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            return view('booking.edit', [
                'bookings' => \App\Booking::find($id),
                'room' => \App\Rooms::where('status', '=', '0')->orderBy('name', 'asc')->get(),
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
    public function update(BookingRequest $request, $id) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            $booking = \App\Booking::find($id);
            if ($request->rom != $request->room) {
                $room1 = \App\Rooms::where('name', '=', $request->rom)->first();
                $status_room1 = $room1->status;
                $room1->status = 0;

                $room2 = \App\Rooms::where('name', '=', $request->room)->first();
                $room2->status = $status_room1;

                $room2->save();
                $room1->save();
            }

            $booking->name = $request->name;
            $booking->mobile = $request->mobile;
            $booking->room = $request->room;
            $booking->checkin = $request->checkin;

            $booking->save();
            $request->session()->flash('alert', 'success');
            $request->session()->flash('status', 'บันทึกการแก้ไขการจองเรียบร้อยแล้ว');

            return redirect()->back();
        }
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
            $booking = \App\Booking::find($id);
            $booking->status = 3;

            $room = \App\Rooms::where('name', '=', $booking->room)->first();
            $room->status = 0;

            $room->save();
            $booking->save();

            $request->session()->flash('alert_room', 'success');
            $request->session()->flash('status_room', 'ระบบได้ดำเนินการยกเลิกการจองเรียบร้อยแล้ว');
            return redirect()->back();
        }
    }

    public function booking($id) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            $booking = \App\Booking::find($id);
            return view('booking.booking', [
                'bookings' => $booking,
                'room' => \App\Rooms::where('name', '=', $booking->room)->first(),
                'setting' => \App\Setting::orderBy('id', 'desc')->first(),
                'banks' => \App\Bank::all(),
            ]);
        }
    }

    public function payment($id) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            return view('booking.payment', [
                'bookings' => \App\Booking::find($id),
            ]);
        }
    }

    public function pay(BookingPaymentRequest $request, $id) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            $booking = \App\Booking::find($id);

            $booking->status = 1;
            $booking->paid = $request->paid;
            $booking->price = $request->price;

            $booking->save();

            $request->session()->flash('alert', 'success');
            $request->session()->flash('status', 'ระบบบันทึกการชำระเรียบร้อยแล้ว');
            return $this->index();
        }
    }

}
