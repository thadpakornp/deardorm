<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PointRequest;
use Auth;

class PointController extends Controller {

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
            return view('setting.point', [
                'user' => \App\User::all(),
                'events' => \App\Event::all(),
                'count' => \App\Point::count(),
                'points' => \App\Point::with('user')->orderBy('created_at', 'desc')->simplePaginate(5),
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
    public function store(PointRequest $request) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            $event = \App\Event::find($request->event);
            $point = $event->point;
            $event_name = $event->name;
            \App\Point::create([
                'id' => $request->id,
                'point' => $point,
                'event' => $event_name,
            ]);

            $request->session()->flash('alert', 'success');
            $request->session()->flash('status', 'เพิ่มคำแนนพ้อยเรียบร้อยแล้ว');
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
            \App\Point::where('created_at', '=', $id)->delete();
            $request->session()->flash('alert_point', 'success');
            $request->session()->flash('status_point', 'ลบข้อมูลเรียบร้อยแล้ว');
            return redirect()->back();
        }
    }

}
