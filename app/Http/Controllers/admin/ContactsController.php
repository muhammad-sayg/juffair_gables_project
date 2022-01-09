<?php

namespace App\Http\Controllers\admin;
use App\Models\Contacts;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    //
    public function index()
    {
        $allcontacts = Contacts::orderBy('id','desc')->get();
        return view('admin.contacts.index', compact('allcontacts'));
    }

    public function create()
    {
        
        $contact_list = Contacts::all(); 
        return view('admin.contacts.create', compact('contact_list'));
    }
    public function store(Request $request)
    {
      
        $request->validate([
            'company_name' => 'required',
            'contact_person'=> 'required',
            'job_title'=> 'required',
            'number'=> 'required',
            'scope_of_work'=> 'required',

        ], [
            'company_name.required' => ' Company Name is required!',
            'contact_person.required' => ' Contact Person is required!',
            'job_title.required' => ' Job Title is required!',
            'number.required' => ' Contact Number is required!',
            'scope_of_work.required' => 'Scope of Work is required!',
        ]);

     
        $contact = new Contacts();
        $contact->company_name = $request['company_name'];
        $contact->contact_person = $request['contact_person'];
        $contact->job_title = $request['job_title'];
        $contact->number = $request['number'];
        $contact->scope_of_work = $request['scope_of_work'];

        if($contact->save()){
            Toastr::success('Contact has been added successfully.');
            return redirect()->route('contacts.list');
        }
        else
        {
            Toastr::success('Something went wrong.');
            return redirect()->route('contacts.create');
        }
    }
    public function show($id)
    {

        $allcontacts = Contacts::find($id);
        
        $html_response = view('admin.contacts.partials.contacts_view_modal', compact('allcontacts'))->render();

        return response()->json([
            'success' => true,
            'html_response' => $html_response
        ]);
    }

    public function edit($id)
    {
        $allcontacts = Contacts::find($id);
        return view('admin.contacts.edit',compact('allcontacts'));
    }

    public function update(Request $request, $id)
    {
        
        $request->validate([
            'company_name' => 'required',
            'contact_person'=> 'required',
            'job_title'=> 'required',
            'number'=> 'required',
            'scope_of_work'=> 'required',

        ], [
            'company_name.required' => ' Company Name is required!',
            'contact_person.required' => ' Contact Person is required!',
            'job_title.required' => ' Job Title is required!',
            'number.required' => ' Contact Number is required!',
            'scope_of_work.required' => 'Scope of Work is required!',
        ]);

     
        $contact =  Contacts::find($id);
        $contact->company_name = $request['company_name'];
        $contact->contact_person = $request['contact_person'];
        $contact->job_title = $request['job_title'];
        $contact->number = $request['number'];
        $contact->scope_of_work = $request['scope_of_work'];
    
        $contact->save();

        Toastr::success('Contact has been updated successfully!');
        return redirect()->route('contacts.list');
    }

    public function destroy($id)
    {
        $contact = Contacts::find($id);

        $contact->delete();

        Toastr::success('Contact has been deleted successfully!');
        return back();
    }

}
