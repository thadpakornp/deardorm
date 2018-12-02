<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\InvoiceRequest;
use Illuminate\Support\Facades\Crypt;
use App\Http\Api\thsms;
use Mail;
use PDF1;

require_once(__DIR__ . '\smsgateway\autoload.php');

use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Api\DeviceApi;

class InvoiceController extends Controller {

    public function __construct() {
        return $this->middleware('auth');
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
            return view('invoice.index', [
                'contracts' => \App\Contract::orderBy('room', 'ASC')->where('status', '=', '0')->get(),
                'count' => \App\Invoice::where('created_at', 'LIKE', date('Y-m-d') . ' %')->where('type', '=', '2')->count(),
                'invoices' => \App\Invoice::orderBy('id', 'ASC')->where('created_at', 'LIKE', date('Y-m-d') . ' %')->where('type', '=', '2')->get(),
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
    public function store(InvoiceRequest $request) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            if (\App\Invoice::where('contract', '=', $request->id)->where('created_at', 'LIKE', date('Y-m-d') . ' %')->where('type', '=', '2')->count() > 0) {
                //update
                $id = \App\Invoice::where('contract', '=', $request->id)->where('created_at', 'LIKE', date('Y-m-d') . ' %')->where('type', '=', '2')->first();
                $id->water = $request->water;
                $id->power = $request->power;
                $id->save();

                $request->session()->flash('alert', 'success');
                $request->session()->flash('status', 'แก้ไขข้อมูลการบันทึกน้ำไฟเรียบร้อยแล้ว');
            } else {
                //create
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

                \App\Invoice::create([
                    'invoice' => $booking1,
                    'contract' => $request->id,
                    'due' => date('m'),
                    'year' => date('Y'),
                    'water' => $request->water,
                    'power' => $request->power,
                    'type' => 2,
                    'status' => 0,
                ]);

                $service = \App\Services::where('num', '=', $request->id)->first();
                if (isset($service)) {
                    \App\Detail_invoice::create([
                        'id' => $booking1,
                        'name' => $service->name,
                        'price' => $service->price,
                    ]);
                }

                $request->session()->flash('alert', 'success');
                $request->session()->flash('status', 'เพิ่มข้อมูลการบันทึกน้ำไฟเรียบร้อยแล้ว');
            }
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

    public function email(Request $request, $id) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            $invoice = \App\Invoice::where('invoice', '=', $id)->first();
            $contract = \App\Contract::where('num', '=', $invoice->contract)->first();
            $user = \App\User::find($contract->id);
            $pdf = PDF1::loadView('invoice.invoice', [
                        'invoice' => $invoice,
                        'invoices' => \App\Detail_invoice::where('id', '=', $id)->get(),
                        'usage' => \App\Invoice::select('water', 'power')->orderBy('id', 'desc')->where('contract', '=', $contract->num)->take(2)->get(),
                        'setting' => \App\Setting::orderBy('id', 'desc')->first(),
                        'contract' => $contract,
                        'user' => $user,
                        'room' => \App\Rooms::where('name', '=', $contract->room)->first(),
                        'banks' => \App\Bank::all(),
            ]);
            $pdf->save($id . '.pdf');
            $data = [
                'name' => 'รายละเอียดตามไฟล์แนบ',
            ];
            $subject = 'รายละเอียดใบแจ้งค่าบริการประจำเดือน ' . $invoice->due . '/' . $invoice->year;
            $file = public_path() . '\\' . $invoice->invoice . '.pdf';
            $sending = New \App\Mailling;

            Mail::send('invoice.mail', $data, function($message) use($user, $subject, $file) {
                $message->to($user->email, $user->email)->subject($subject);
                $message->from(env('MAIL_USERNAME', ''), env('MAIL_USERNAME', ''));
                $message->attach($file);
            });

            $sending->gateways = env('MAIL_USERNAME', '');
            $sending->topic = 'ส่งใบแจ้งค่าบริการ';
            $sending->email = $user->email;
            $sending->texts = 'รายละเอียดใบแจ้งค่าบริการประจำเดือน ' . $invoice->due . '/' . $invoice->year;
            $sending->save();

            $request->session()->flash('alertt', 'success');
            $request->session()->flash('statuss', 'ส่งอีเมลล์ใบแจ้งเลขที่ ' . $id . ' เรียบร้อยแล้ว');

            return redirect()->back();
        }
    }

    public function view($id) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            $invoice = \App\Invoice::where('invoice', '=', $id)->first();
            $contract = \App\Contract::where('num', '=', $invoice->contract)->first();
            return view('invoice.invoice1', [
                'invoice' => $invoice,
                'invoices' => \App\Detail_invoice::where('id', '=', $id)->get(),
                'usage' => \App\Invoice::select('water', 'power')->orderBy('id', 'desc')->where('contract', '=', $contract->num)->take(2)->get(),
                'setting' => \App\Setting::orderBy('id', 'desc')->first(),
                'contract' => $contract,
                'user' => \App\User::find($contract->id),
                'room' => \App\Rooms::where('name', '=', $contract->room)->first(),
            ]);
        }
    }

    public function printer($id) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            $invoice = \App\Invoice::where('invoice', '=', $id)->first();
            $contract = \App\Contract::where('num', '=', $invoice->contract)->first();
            return view('invoice.invoice2', [
                'invoice' => $invoice,
                'invoices' => \App\Detail_invoice::where('id', '=', $id)->get(),
                'usage' => \App\Invoice::select('water', 'power')->orderBy('id', 'desc')->where('contract', '=', $contract->num)->take(2)->get(),
                'setting' => \App\Setting::orderBy('id', 'desc')->first(),
                'contract' => $contract,
                'user' => \App\User::find($contract->id),
                'room' => \App\Rooms::where('name', '=', $contract->room)->first(),
                'banks' => \App\Bank::all(),
            ]);
        }
    }

    public function sms(Request $request, $id) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            $invoice = \App\Invoice::where('invoice', '=', $id)->first();
            $contract = \App\Contract::where('num', '=', $invoice->contract)->first();
            $settings = \App\Setting::orderBy('id', 'desc')->first();
            $usage = \App\Invoice::select('water', 'power')->orderBy('id', 'desc')->where('contract', '=', $contract->num)->take(2)->get();
            $room = \App\Rooms::where('name', '=', $contract->room)->first();
            $invoices = \App\Detail_invoice::where('id', '=', $id)->get();
            $user = \App\User::find($contract->id);

            $ins = 0;
            if (isset($invoices)) {
                foreach ($invoices as $in) {
                    $ins += $in->price;
                }
            }

            $total = (($usage[0]['water'] - $usage[1]['water']) * $settings->rate_water) + (($usage[0]['power'] - $usage[1]['power']) * $settings->rate_elec) + $ins + $room->price;

            $sending = New \App\Sending;
            $setting = \App\Sms::orderBy('id', 'desc')->first();
            $username = $setting->username;
            $password = Crypt::decryptString($setting->password);
            if ($setting->gateway == 'THSMS.COM') {
                $sms = new thsms();

                $sms->username = $username;
                $sms->password = $password;
                $sms->send('0000', $user->profiles->mobile, 'ค่าใช้จ่ายประจำเดือน ' . $invoice->due . '/' . $invoice->year . ' จำนวน ' . $total . ' บาท ก่อนวันที่ ' . $settings->due . ' เดือนถัดไป');
                $sending->gateways = 'THSMS.COM';
            } else {
                $clients = new SMSGatewayMe\Client\ClientProvider($password);

                $sendMessageRequest = new SMSGatewayMe\Client\Model\SendMessageRequest([
                    'phoneNumber' => $user->profiles->mobile, 'message' => 'ค่าใช้จ่ายประจำเดือน ' . $invoice->due . '/' . $invoice->year . ' จำนวน ' . $total . ' บาท ก่อนวันที่ ' . $settings->due . ' เดือนถัดไป', 'deviceId' => $username
                ]);

                $clients->getMessageClient()->sendMessages([$sendMessageRequest]);
                $sending->gateways = 'SMSGATEWAY.ME';
            }
            $sending->mobile = $user->profiles->mobile;
            $sending->texts = 'ค่าใช้จ่ายประจำเดือน ' . $invoice->due . '/' . $invoice->year . ' จำนวน ' . $total . ' บาท ก่อนวันที่ ' . $settings->due . ' เดือนถัดไป';
            $sending->save();

            $request->session()->flash('alertt', 'success');
            $request->session()->flash('statuss', 'ส่งข้อความใบแจ้งเลขที่ ' . $id . ' เรียบร้อยแล้ว');

            return redirect()->back();
        }
    }

}
