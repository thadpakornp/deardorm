<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\UploadsRequest;
use File;
use App\Http\Requests\ServicesRequest;
use App\Http\Requests\FamilyRequest;
use App\Http\Requests\MoveRequest;
use Carbon\Carbon;
use App\Http\Requests\CancelRequest;

class ManageContractController extends Controller {

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
            return view('contract.manage', [
                'count' => \App\Contract::count(),
                'contracts' => \App\Contract::orderBy('created_at', 'desc')->simplePaginate(15),
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
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            $contract = \App\Contract::where('num', '=', $id)->first();
            return view('contract.show', [
                'contracts' => $contract,
                'rooms' => \App\Rooms::where('name', '=', $contract->room)->first(),
                'setting' => \App\Setting::orderBy('id', 'desc')->first(),
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
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $upload = \App\Uploads::find($id);

        if (isset($upload)) {
            File::delete(public_path() . '\\images\\' . $upload->files);
            \App\Uploads::destroy($id);
        }

        $request->session()->flash('alert_upload', 'success');
        $request->session()->flash('status_upload', 'ลบไฟล์อัปโหลดเรียบร้อยแล้ว');
        return redirect()->back();
    }

    public function files($id) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            return view('contract.uploads', [
                'contracts' => \App\Contract::where('num', '=', $id)->first(),
                'count' => \App\Uploads::where('num', '=', $id)->count(),
                'uploads' => \App\Uploads::where('num', '=', $id)->get(),
            ]);
        }
    }

    public function services($id) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            return view('contract.services', [
                'contracts' => \App\Contract::where('num', '=', $id)->first(),
                'discounts' => \App\Discount::all(),
                'count' => \App\Services::count(),
                'services' => \App\Services::where('num', '=', $id)->get(),
            ]);
        }
    }

    public function service(ServicesRequest $request) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            $service = \App\Services::where('num', '=', $request->num)->count();
            if ($service != 0) {
                $request->session()->flash('alert', 'danger');
                $request->session()->flash('status', 'ไม่สามารถเพิ่มส่วนเสริมได้มากกว่า 1 รายการ');
            } else {
                $discount = \App\Discount::find($request->service);

                \App\Services::create([
                    'num' => $request->num,
                    'name' => $discount->name,
                    'price' => $discount->discount,
                ]);

                $invoice = \App\Invoice::where('contract', '=', $request->num)->first();
                $invoice->service = $discount->name;
                $invoice->discount = $discount->discount;
                $invoice->save();

                $request->session()->flash('alert', 'success');
                $request->session()->flash('status', 'เพิ่มข้อมูลส่วนเสริมเรียบร้อยแล้ว');
            }
            return redirect()->back();
        }
    }

    public function deleteservices(Request $request) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            \App\Services::destroy($request->id);
            $request->session()->flash('alert', 'success');
            $request->session()->flash('status', 'เพิ่มข้อมูลส่วนเสริมเรียบร้อยแล้ว');
            return redirect()->back();
        }
    }

    public function uploads(UploadsRequest $request) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            if ($request->hasFile('files')) {
                $filename = time() . '.' . str_random(15) . '.' . $request->file('files')->getClientOriginalExtension();
                $request->file('files')->move(public_path() . '/images/', $filename);
                $file = $filename;
            }
            \App\Uploads::create([
                'num' => $request->num,
                'files' => $file,
            ]);
            $request->session()->flash('alert', 'success');
            $request->session()->flash('status', 'อัปโหลดไฟล์เรียบร้อยแล้ว');
            return redirect()->back();
        }
    }

    public function imanges($id) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            return view('contract.imanges', [
                'imanges' => $id,
            ]);
        }
    }

    public function invoice($id) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            $contract = \App\Contract::where('num', '=', $id)->first();
            return view('contract.invoice1', [
                'invoice' => \App\Invoice::where('contract', '=', $id)->first(),
                'setting' => \App\Setting::orderBy('id', 'desc')->first(),
                'room' => \App\Rooms::where('name', '=', $contract->room)->first(),
                'user' => \App\User::where('id', '=', $contract->id)->first(),
                'banks' => \App\Bank::all(),
            ]);
        }
    }

    public function pay($id) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            $contract = \App\Contract::where('num', '=', $id)->first();
            return view('contract.pay', [
                'invoice' => \App\Invoice::where('contract', '=', $id)->first(),
                'setting' => \App\Setting::orderBy('id', 'desc')->first(),
                'room' => \App\Rooms::where('name', '=', $contract->room)->first(),
                'user' => \App\User::where('id', '=', $contract->id)->first(),
            ]);
        }
    }

    public function recivce($id) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            $contract = \App\Contract::where('num', '=', $id)->first();
            $invoice = \App\Invoice::where('contract', '=', $id)->first();
            return view('contract.payment', [
                'invoice' => $invoice,
                'setting' => \App\Setting::orderBy('id', 'desc')->first(),
                'room' => \App\Rooms::where('name', '=', $contract->room)->first(),
                'user' => \App\User::where('id', '=', $contract->id)->first(),
                'payment' => \App\Payment::where('invoice', '=', $invoice->invoice)->first(),
            ]);
        }
    }

    public function payment(Request $request) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            $payment = \App\Autonum::count();
            if ($payment == 0) {
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

            \App\Payment::create([
                'id' => $request->id,
                'invoice' => $request->invoice,
                'payment' => $booking1,
                'month' => $request->month,
                'year' => $request->year,
                'total' => $request->total,
                'status' => 0,
            ]);

            $invoice = \App\Invoice::where('invoice', '=', $request->invoice)->first();
            $invoice->status = 1;
            $invoice->save();

            $request->session()->flash('alert', 'success');
            $request->session()->flash('status', 'บันทึกการชำระเงินเรียบร้อยแล้ว');
            return redirect()->back();
        }
    }

    public function familys($id) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            return view('contract.familys', [
                'count' => \App\Familys::Where('id', '=', $id)->count(),
                'users' => \App\User::find($id),
                'familys' => \App\Familys::Where('id', '=', $id)->get(),
            ]);
        }
    }

    public function family(FamilyRequest $request) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            \App\Familys::create([
                'id' => $request->id,
                'name' => $request->name,
                'relationship' => $request->relationship,
                'mobile' => $request->mobile
            ]);

            $request->session()->flash('alert', 'success');
            $request->session()->flash('status', 'เพิ่มข้อมูลเรียบร้อยแล้ว');
            return redirect()->back();
        }
    }

    public function deletefamily(Request $request) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            $family = \App\Familys::where('created_at', '=', $request->id);
            $family->delete();

            $request->session()->flash('alert', 'success');
            $request->session()->flash('status', 'ลบข้อมูลเรียบร้อยแล้ว');
            return redirect()->back();
        }
    }

    public function move(Request $request, $id) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            $checkcontract = \App\Contract::where('num', '=', $id)->first();
            if ($checkcontract->status != 0) {
                $request->session()->flash('alert', 'danger');
                $request->session()->flash('status', 'ไม่สามารถย้ายห้องได้ เนื่องจากสัญญานี้ได้มีการย้ายห้องพักไปแล้ว');
                return redirect()->back();
            } else {
                $invoice = \App\Invoice::where('contract', '=', $id)->where('status', '=', '0')->count();
                if ($invoice > 0) {
                    $request->session()->flash('alert', 'danger');
                    $request->session()->flash('status', 'ไม่สามารถย้ายห้องได้ เนื่องจากสัญญานี้มียอดค้างชำระ');
                    return redirect()->back();
                } else {
                    return view('contract.move', [
                        'contracts' => \App\Contract::where('num', '=', $id)->first(),
                        'rooms' => \App\Rooms::where('status', '=', '0')->get(),
                    ]);
                }
            }
        }
    }

    public function moved(MoveRequest $request, $id) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            //ดึงข้อมูลสัญญาเดิม
            $oldcontract = \App\Contract::where('num', '=', $id)->first();
            //ยกเลิกสัญญาเดิม
            $oldcontract->cancel = date('Y-m-d');
            $oldcontract->status = 1;
            $oldcontract->save();
            //อัพเดทห้องเก่า
            $room = \App\Rooms::where('name', '=', $oldcontract->room)->first();
            $room->status = 0;
            $room->save();
            //สร้างเลขสัญญาใหม่
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
            //บันทึกสัญญาใหม่
            \App\Contract::create([
                'id' => $oldcontract->id,
                'room' => $request->roomnew,
                'contract' => $contractid,
                'term' => $request->term,
                'start' => $request->start,
                'end' => $contractend,
                'status' => 0,
            ]);
            //อัพเดทห้องพักห้องใหม่
            $roomnew = \App\Rooms::where('name', '=', $request->roomnew)->first();
            $roomnew->status = 2;
            $roomnew->save();

            //เลขที่ใบแจ้ง
            $invoice = \App\Autonum::count();
            if ($invoice == 0) {
                $invoice1 = date('YmdHis') . '0';
            } else {
                $num = \App\Autonum::orderBy('id', 'desc')->first();
                $auto = substr($num->autonum, 14, 10);
                $autonum = $auto + 1;
                $invoice1 = date('YmdHis') . $autonum;
            }
            \App\Autonum::create([
                'autonum' => $invoice1,
            ]);
            //สร้างใบแจ้ง
            $oldinvoice = \App\Invoice::where('contract', '=', $oldcontract->num)->where('type', '=', '1')->first();
            if ($oldinvoice->status != 1) {
                $oldinvoice->status = 2;
                $oldinvoice->save();
            }

            $oldpayment = \App\Payment::where('invoice', '=', $oldinvoice->invoice)->where('status', '=', '0')->count();
            if ($oldpayment > 0) {
                $paymentt = \App\Payment::where('invoice', '=', $oldinvoice->invoice)->where('status', '=', '0')->first();
                $paymentprice = $paymentt->total;
            } else {
                $paymentprice = 0;
            }
            $contract = \App\Contract::where('contract', '=', $contractid)->first();
            \App\Invoice::create([
                'invoice' => $invoice1,
                'contract' => $contract->num,
                'ref' => $paymentprice,
                'water' => $request->water,
                'power' => $request->power,
                'type' => 1,
                'status' => 0
            ]);

            //ใบแจ้งค่าบริการห้องเก่า
            $invoice2 = \App\Autonum::count();
            if ($invoice2 == 0) {
                $invoices2 = date('YmdHis') . '0';
            } else {
                $num1 = \App\Autonum::orderBy('id', 'desc')->first();
                $auto1 = substr($num1->autonum, 14, 10);
                $autonum1 = $auto1 + 1;
                $invoices2 = date('YmdHis') . $autonum1;
            }
            \App\Autonum::create([
                'autonum' => $invoices2,
            ]);

            \App\Invoice::create([
                'invoice' => $invoices2,
                'contract' => $oldcontract->num,
                'due' => date('m'),
                'year' => date('Y'),
                'water' => $request->oldwater,
                'power' => $request->oldpower,
                'type' => 2,
                'status' => 0
            ]);

            //รายละเอียดบิลใบแจ้งห้องเก่า
            \App\Detail_invoice::create([
                'id' => $invoices2,
                'name' => 'ค่าทำความสะอาดห้องพัก',
                'price' => $request->clear,
            ]);

            if ($request->other != "") {
                \App\Detail_invoice::create([
                    'id' => $invoices2,
                    'name' => $request->other,
                    'price' => $request->priceother,
                ]);
            }

            $request->session()->flash('alert', 'success');
            $request->session()->flash('status', 'ดำเนินการย้ายห้องสำเร็จแล้ว');
            $request->session()->flash('invoice', $invoices2);

            $localhost = url('manage_contract/invoices/' . $invoices2);
            echo "<script>window.open('" . $localhost . "','_blank')</script>";

            return redirect()->back();
        }
    }

    public function invoices($id) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            $invoice = \App\Invoice::where('invoice', '=', $id)->first();
            $contract = \App\Contract::where('num', '=', $invoice->contract)->first();
            return view('contract.invoice2', [
                'invoice' => $invoice,
                'invoices' => \App\Detail_invoice::where('id', '=', $id)->get(),
                'usage' => \App\Invoice::select('water', 'power')->orderBy('id', 'desc')->where('contract', '=', $contract->num)->take(2)->get(),
                'setting' => \App\Setting::orderBy('id', 'desc')->first(),
                'room' => \App\Rooms::where('name', '=', $contract->room)->first(),
                'user' => \App\User::where('id', '=', $contract->id)->first(),
                'banks' => \App\Bank::all(),
            ]);
        }
    }

    public function cancel(Request $request, $id) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            $invoice = \App\Invoice::where('contract', '=', $id)->where('status', '=', '0')->count();
            if ($invoice > 0) {
                $request->session()->flash('alert', 'danger');
                $request->session()->flash('status', 'ไม่สามารถยกเลิกสัญญาได้ เนื่องจากสัญญานี้มียอดค้างชำระ');
                return redirect()->back();
            } else {
                $contract = \App\Contract::where('num', '=', $id)->first();
                $end = explode("-", $contract->end);
                $today = explode("-", Carbon::now()->toDateString());
                $first = Carbon::create($end[0], $end[1], $end[2], 0, 0, 0);
                $second = Carbon::create($today[0], $today[1], $today[2], 0, 0, 0);
                return view('contract.cancel', [
                    'age' => $first->lessThan($second),
                    'contract' => $contract,
                ]);
            }
        }
    }

    public function confirmcancel(CancelRequest $request) {
        if (Auth::user()->profile != 'admin') {
            abort(403);
        } else {
            $contract = \App\Contract::where('num', '=', $request->num)->first();
            $end = explode("-", $contract->end);
            $today = explode("-", Carbon::now()->toDateString());
            $first = Carbon::create($end[0], $end[1], $end[2], 0, 0, 0);
            $second = Carbon::create($today[0], $today[1], $today[2], 0, 0, 0);
            return view('contract.confirm', [
                'invoices' => \App\Invoice::orderBy('id', 'desc')->where('contract', '=', $request->num)->where('status', '!=', '2')->first(),
                'contract' => $contract,
                'room' => \App\Rooms::where('name', '=', $contract->room)->first(),
                'age' => $request->checkage,
                'agecontract' => $first->lessThan($second),
                'power' => $request->power,
                'water' => $request->water,
                'air' => $request->air,
                'clear' => $request->clear,
                'textother' => $request->textother,
                'priceother' => $request->priceother,
                'textother1' => $request->textother1,
                'priceother1' => $request->priceother1,
                'textother2' => $request->textother2,
                'priceother2' => $request->priceother2,
                'setting' => \App\Setting::orderBy('id', 'desc')->first(),
            ]);
        }
    }

}
