<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Tenant;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Mail\SendInvoiceToTenant;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Mail;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::orderBy('id','desc')->get();
        
        return view('admin.invoice.list', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
         // print_r($_GET); exit;
        $tenant_list = Tenant::where('is_passed', null)->get();
        return view('admin.invoice.create' ,compact('tenant_list'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save_invoice_info(Request $request)
    {
        $request->validate([
            'renter_name' => 'required',
            'apartment_no' => 'required',
            'invoice_no' => 'required',
            'rent' => 'required',
            'ewa_bill' => 'required',
            'utility_bill' => 'required',
            'date_of_issue' => 'required',
            'paid_date' => 'required',
            'payment_method' => 'required|string',
            'note' => 'required',
            'rent_paid_status_code' => 'required',
            'grand_total' => 'required',
        ]);
        $invoice = new Invoice();
        
        $invoice->renter_name = $request['renter_name'];
        $invoice->apartment_no = $request['apartment_no'];
        $invoice->invoice_no = $request['invoice_no'];
        $invoice->rent = $request['rent'];
        $invoice->ewa_bill = $request['ewa_bill'];
        $invoice->utility_bill = $request['utility_bill'];
        $invoice->date_of_issue = $request['date_of_issue'];
        $invoice->paid_date = $request['paid_date'];
        $invoice->payment_method = $request['payment_method'];
        $invoice->note = $request['note'];
        $invoice->rent_paid_status_code = $request['rent_paid_status_code'];
        $invoice->grand_total = $request['grand_total'];
        if($invoice->save()){
        Toastr::success('Invoice created successfully!');
        return redirect()->route('rent.list');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'tenant_id' => 'required',
            'rent_amount' => 'required',
            'invoice_date' => 'required',
        ],[
            'tenant_id.required' => 'Please select the tenant.'
        ]);

        $count = Invoice::whereDate('invoice_issue_date', $request->input('invoice_date'))->count();
        
        if($count > 0)
        {
            Toastr::error('You already created invoice on this selected invoice date.');
            return redirect()->route('invoices.create');
        }

        $invoice = new Invoice();
        $invoice->tenant_id = $request->input('tenant_id');
        $invoice->invoice_issue_date = Carbon::parse($request->input('invoice_date'));
        $invoice->invoice_due_date = Carbon::parse($request->input('invoice_date'))->addDays(5);
        $invoice->invoice_amount = $request->input('rent_amount');
        $invoice->invoice_status_code = 1; //pending

        $auto_option = $request->input('auto_option');

        if(isset($auto_option) && $auto_option == "on")
        {
           
            $invoice->auto_generate = "Yes";
        }

        if($invoice->save())
        {
            $invoice->invoice_number = 'INV-' . str_pad($invoice->id,3,0, STR_PAD_LEFT);
            $invoice->save();
            Toastr::success('Invoice created successfully.');
            return redirect()->route('invoices.list');
        }
        else
        {
            Toastr::error('Something went wrong.');
            return redirect()->route('invoices.create');
        }
    }

    public function view_invoice($id)
    {
        $invoice = Invoice::find($id);

        return view('admin.invoice.invoice', compact('invoice'));
    }
   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::find($id);
        $html_response = view('admin.invoice.partial.invoice_view_modal', compact('invoice'))->render();

        return response()->json([
            'success' => true,
            'html_response' => $html_response
        ]);
    }

    public function send_invoice($id)
    {
        $invoice = Invoice::find($id);

        $tenant_email = $invoice->tenant->tenant_email_address;
       
        Mail::to('engrzulqarnainkhan@gmail.com')->send(new SendInvoiceToTenant($invoice));
 
        if (Mail::failures()) {
            Toastr::error('Something went wrong.');
            return redirect()->route('invoices.list');
        }
        else
        {
            Toastr::success('Email sent successfully.');
            return redirect()->route('invoices.list');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice = Invoice::find($id);
        $tenant_list = Tenant::where('is_passed', null)->get();
        return view('admin.invoice.edit', compact('invoice','tenant_list'));
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
            'invoice_date' => 'required',
        ],[
            'tenant_id.required' => 'Please select the tenant.'
        ]);

        
        $invoice = Invoice::find($id);
        $invoice->tenant_id = $request->input('tenant_id');
        $invoice->invoice_issue_date = Carbon::parse($request->input('invoice_date'));
        $invoice->invoice_due_date = Carbon::parse($request->input('invoice_date'))->addDays(5);
        $invoice->invoice_amount = $request->input('rent_amount');
        $invoice->invoice_status_code = 1; //pending

        $auto_option = $request->input('auto_option');

        if(isset($auto_option) && $auto_option == "on")
        {
           
            $invoice->auto_generate = "Yes";
        }
        else
        {
            $invoice->auto_generate = "No";
        }

        if($invoice->save())
        {
            $invoice->invoice_number = 'INV-' . str_pad($invoice->id,3,0, STR_PAD_LEFT);
            $invoice->save();
            Toastr::success('Invoice updated successfully.');
            return redirect()->route('invoices.list');
        }
        else
        {
            Toastr::error('Something went wrong.');
            return redirect()->route('invoices.create');
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
        //
    }
}
