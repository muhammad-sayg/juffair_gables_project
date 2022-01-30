<?php

namespace App\Http\Controllers\admin;

use Session;
use App\Models\Rent;
use App\Models\Unit;
use App\Models\Floor;
use App\Models\Tenant;
use App\Models\Building;
use App\Models\RentType;
use App\Models\FloorType;
use App\Models\UnitStatus;
use Illuminate\Http\Request;
use App\Models\RentPaidStatus;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {  
        $rent_paid_status = RentPaidStatus::where('rent_paid_status_code','<>', 2)->get();
        $rent_details = Rent::orderBy('id','desc')->get();
        
        $tenant_list = Tenant::where('is_passed', null)->get();
        return view('admin.rent.index', compact('rent_details','rent_paid_status','tenant_list'));
    }

    public function generate_receipt($id)
    {
        $rent = Rent::find($id);
        return view('admin.rent.receipt',compact('rent'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $tenant_list = Tenant::where('is_passed', null)->get();
        
        return view('admin.rent.create', compact('tenant_list'));
    }
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'tenant_id' => 'required',
            'invoice_id' => 'required',
            'rent_amount' => 'required',
            'received_amount' => 'required',
            // 'rent_status' => 'required'
        ],[
            'tenant_id.required' => 'Please select the tenant first.',
            'invoice_id.required' => 'Please select the invoice first.'
        ]);
        
        $invoice = Invoice::find($request['invoice_id']);

        $rent = new Rent();

        
        $rent->received_date = Carbon::now();
        $rent->tenant_id = $request['tenant_id'];
        $rent->rent_amount = $invoice->invoice_amount;

        $rent->received_amount = $request['received_amount'];

        $old_invoice_rent = Rent::where('invoice_no', $invoice->invoice_number)->get();
        // dd($old_invoice_rent);
        if($old_invoice_rent->isNotEmpty())
        {
            $total_rent_collected = 0;
            foreach($old_invoice_rent as $item)
            {
                $total_rent_collected  += $item->received_amount;
            }
            
            $total_rent_collected = $total_rent_collected + $request['received_amount'];
            $rent->due_amount =  $invoice->invoice_amount - $total_rent_collected;
        }
        else
        {
            
            $rent->due_amount = $invoice->invoice_amount - $request['received_amount'];
        }

        $rent->received_date = Carbon::now();

        if($rent->due_amount == 0)
        {
            $rent->rent_paid_status_code = 1; // paid

            $invoice->invoice_status_code = '2'; // closed

            Rent::where('invoice_no', $invoice->invoice_number)->update(['rent_paid_status_code' => 1]);

            $invoice->save();
        }
        else
        {
            $rent->rent_paid_status_code = 3; // Due

        }
        
        $rent->rent_month = $invoice->invoice_issue_date;
        $rent->invoice_no = $invoice->invoice_number;
        $current_year = Carbon::parse($invoice->invoice_issue_date)->format('Y');
        $current_month = Carbon::parse($invoice->invoice_issue_date)->format('m');
        
        if($rent->save()){

            $rent->receipt_no = $current_year. '/JG/' . $current_month . '/' . str_pad($rent->id,3,0, STR_PAD_LEFT);
            $rent->save();
            
            Toastr::success('Rent detail added successfully.');
            return redirect()->route('rent.list');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rent = Rent::where('id', $id)->first();
        $html_response = view('admin.rent.partials.rent_detail_view_modal', compact('rent'))->render();

        return response()->json([
            'success' => true,
            'html_response' => $html_response
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {    
        $rent = Rent::find($id);
        
        $tenant_list = Tenant::where('is_passed', null)->get();
        
        return view('admin.rent.edit', compact('rent','tenant_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tenant_id' => 'required',
            'rent_amount' => 'required',
            // 'rent_status' => 'required'
        ],[
            'tenant_id.required' => 'Please select the tenant first.'
        ]);
        
        if($request->input('monthly_checkbox') == "on")
        {
            $request->validate([
                'rent_month' => 'required',
            ]);
        }
        else
        {
            $request->validate([
                'rent_start_month' => 'required',
                'rent_end_month' => 'required',
            ],[
                'rent_start_month.required' => 'Rent form field is required.',
                'rent_end_month.required' => 'Rent to field is required.'
            ]);
        }

        $rent = Rent::find($id);

        // if($request['rent_status'] == 'paid')
        // {
        //     $request->validate([
        //         'received_amount' => 'required',
        //     ]);
        //     $rent_paid_status_code = 1; // paid
        //     $rent->received_date = Carbon::now();
        // }
        // else
        // {
        //     $rent_paid_status_code = 2; // unpaid

        // }

        $rent->tenant_id = $request['tenant_id'];
        $rent->rent_amount = $request['rent_amount'];

        if($request['received_amount'])
        {
            
            $rent->received_amount = $request['received_amount'];
            $rent->received_date = Carbon::now();
            $rent_paid_status_code = 1; //paid
        }
        

        $rent->rent_paid_status_code = $rent_paid_status_code;
        
        if($request->input('monthly_checkbox') == "on")
        {
            $rent->rent_month = $request->input('rent_month');
        }
        else
        {
            $rent->rent_start_month = $request->input('rent_start_month');
            $rent->rent_end_month = $request->input('rent_end_month');
        }
        
        if($rent->save()){
            Toastr::success('Rent detail updated successfully.');
            return redirect()->route('rent.list');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rent = Rent::find($id);
        $rent->delete();
        Toastr::success('This Rent details deleted successfully!');
        return back();
    }
   
    public function search_rent(Request $request)
    {
        $query = Rent::query();

        if($request['tenant_id'])
        {
            $query->where('tenant_id', $request['tenant_id']);
        }

        if($request['rent_month'])
        {
            $query->whereDate('rent_month', $request['rent_month']);
        }

        if($request['rent_paid_status_code'])
        {
            $query->where('rent_paid_status_code', $request['rent_paid_status_code']);
        }

        $rent_details = $query->get();

        $tenant_id = $request['tenant_id'];
        $rent_month = $request['rent_month'];
        $rent_paid_status_code = $request['rent_paid_status_code'];

        $rent_paid_status = RentPaidStatus::where('rent_paid_status_code','<>', 2)->get();
        $tenant_list = Tenant::where('is_passed', null)->get();

        return view('admin.rent.index', compact('rent_details','rent_paid_status','tenant_list','tenant_id','rent_month','rent_paid_status_code'));
    }

    public function invoice(Request $request)
    {
        return view('admin.rent.invoice');
    }
    public function reciept(Request $request)
    {
        return view('admin.rent.reciept');
    }
}
