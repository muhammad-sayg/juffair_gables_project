<?php

namespace App\Http\Controllers\admin;

use App\Models\Facilities;
use App\Models\Reservations;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FacilitiesController extends Controller
{
    //
    public function index()
    {
        $allfacilities = Facilities::orderBy('id','desc')->get();
        return view('admin.facilities.index', compact('allfacilities'));
    }
    public function create()
    {
        
        $facility_list = Facilities::all(); 
        return view('admin.facilities.create', compact('facility_list'));
    }
    public function store(Request $request)
    {
      
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Name is required!',
        ]);

     
        $facility = new Facilities();
        $facility->name = $request['name'];
        
        // $facility = Facilities::create([
        //     'name' => $request['name'],
            
        // ]);

        if($facility->save()){
            Toastr::success('Facility has been added successfully.');
            return redirect()->route('facilities.list');
        }
        else
        {
            Toastr::success('Something went wrong.');
            return redirect()->route('facilities.create');
        }
    }
 
    public function show($id)
    {

        $allfacilities = Facilities::find($id);
        
        $html_response = view('admin.facilities.partials.facilities_view_modal', compact('allfacilities'))->render();

        return response()->json([
            'success' => true,
            'html_response' => $html_response
        ]);


        // $allfacilities = Facilities::find($id);
        // return view('admin.facilities.show', compact('allfacilities'));
    }

    public function edit($id)
    {
        $allfacilities = Facilities::find($id);
        return view('admin.facilities.edit',compact('allfacilities'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Name is required!',
        ]);

     
        $facility =  Facilities::find($id);
        $facility->name = $request['name'];
    
       
      
        $facility->save();

        Toastr::success('Facility has been updated successfully!');
        return redirect()->route('facilities.list');
    }

    public function destroy($id)
    {
        $facility = Facilities::find($id);
        
        $count = Reservations::where('room_id', $id)->count();
    
        if($count > 0)
        {
            Toastr::error('You cannot delete this facility because it is booked someone.');
            return back();
        }

        $facility->delete();

        Toastr::success('Facility has been deleted successfully!');
        return back();
    }
}
