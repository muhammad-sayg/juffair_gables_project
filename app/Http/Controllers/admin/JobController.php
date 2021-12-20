<?php

namespace App\Http\Controllers\admin;

use App\Models\JobOpportunities;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class JobController extends Controller
{
    //
    public function index()
    {
        $alljobs = JobOpportunities::orderBy('id','desc')->get();
        
        return view('admin.job.index',compact('alljobs'));
    }

    public function show($id)
    {
        $alljobs = JobOpportunities::find($id);
        $html_response = view('admin.job.partials.job_view_modal', compact('alljobs'))->render();

        return response()->json([
            'success' => true,
            'html_response' => $html_response
        ]);
    }

    public function store(Request $request)
    {
      
       
    }
    public function destroy($id)
    {
        $job = JobOpportunities::find($id);

        $job->delete();

        Toastr::success('Job Opportunity has been deleted successfully!');
        return back();
    }
}
