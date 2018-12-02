<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\ContractRequest;
use Carbon\Carbon;

class ContractController extends Controller {

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
            return view('contract.index', [
                'users' => \App\User::where('profile', '=', 'user')->where('status', '=', '1')->orderBy('id', 'asc')->get(),
                'rooms' => \App\Rooms::where('status', '=', '0')->orderBy('name', 'asc')->get(),
                'count' => \App\Contract::count(),
                'contracts' => \App\Contract::orderBy('num', 'desc')->simplePaginate(5),
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
    public function store(ContractRequest $request) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {

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
                'water' => $request->water,
                'power' => $request->power,
                'type' => 1,
                'status' => 0
            ]);

            $request->session()->flash('alert', 'success');
            $request->session()->flash('status', 'ดำเนินการสร้างสัญญา ' . $contractid . ' เรียบร้อยแล้ว');

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
