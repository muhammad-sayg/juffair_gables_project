<?php

namespace App\Http\Controllers\admin;
use App\Models\Testimonials;
use App\Models\Review;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allreviews = Review::orderBy('id','desc')->get();
        
        return view('admin.testimonial.index',compact('allreviews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $testimonial = Testimonials::all();
        return view('admin.testimonial.create' ,compact('testimonial'));
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
            'name' => 'required',
            'email' =>  'required|email|max:255' ,
            'review' =>  'required' ,
            
            
        ], [
            'name.required' => 'Name is required!',
            'email.required'  => 'Email is required!',
            'review.required'  => 'Review is required!',
            
        ]);

        // $filename ='';
        // if($request->file('image'))
        // {
        //     $file_name = time().'_'.trim($request->file('image')->getClientOriginalName());
            
        //     $image = Image::make($request->file('image')->getRealPath());
        //     $image->resize(300,200);
        //     $image->save(public_path('admin/assets/img/testimonial/'). $file_name);
        //     $filename= $file_name;  
        // }
        
        $testimonial = Review::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'review' => $request['review'],
            'review_status_code' => 2,
            
            
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Your review has been saved',
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $testimonial = Testimonials::find($id);
        $html_response = view('admin.testimonial.partials.testimonial_view_modal', compact('testimonial'))->render();

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
        $testimonial = Testimonials::find($id);
        return view('admin.testimonial.edit',compact('testimonial'));
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
            'name' => 'required',
            'review' =>  'required' ,
        ], [
            'name.required' => 'Name is required!',
            'review.required'  => 'Review is required!',
           
        ]);

        $testimonial = Testimonials::find($id);
        $testimonial->name = $request['name'];
        $testimonial->review = $request['review'];
       
        if($request->file('image'))
        {
            unlink(public_path('admin/assets/img/testimonial/'). $testimonial->image);
            $file_name = time().'_'.trim($request->file('image')->getClientOriginalName());
            
             $image = Image::make($request->file('image')->getRealPath());
            $image->resize(300,200);
            $image->save(public_path('admin/assets/img/testimonial/'). $file_name);
            $filename= $file_name;  
            $testimonial->image = $filename;
        }
      
        $testimonial->save();

        Toastr::success('Testimonial updated successfully!');
        return redirect()->route('testimonials.list');
    }

    
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $review = Review::find($id);

        $review->delete();

        Toastr::success('Review has been deleted successfully!');
        return back();
    }
    public function update_review_status(Request $request,$id,$current_status)
    {
        
    
        $review = Review::find($id);
        //dd($review,$current_status);
        if($current_status == '1')
        {
            
            $review->review_status_code = 1; 
        }
        else
        {
            $review->review_status_code = 2; 

        }

        if($review->save()){
            
            Toastr::success('Your review status has been changed.');
            return back();
        }
        else
        {
            Toastr::success('Something went wrong.');
            return back();
        }
    }
    public function display_review(){
        $reviews = Review::where('review_status_code', 1)->get();
        return view('testimonials', compact('reviews'));
    }
}
