<?php

namespace App\Http\Controllers\admin;
use Carbon\Carbon;
use App\Models\Rooms;
use App\Models\Facilities;
use App\Models\Reservations;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservation = Reservations::orderBy('id','desc')->get();
        return view('admin.reservation.index',compact('reservation'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $facilities_list = Facilities::all();
        // $rooms = Rooms::all();
        return view('admin.reservation.create' ,compact('facilities_list'));
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
            'room_id' => 'required' ,
            'reservation_date' =>  'required' ,
            'start_time' => 'required',
            'end_time' => 'required',
            'tenant_name' => 'required',
            'amount' => 'required',
        ], [
            'room_id.required'  => 'Please select the facility!',
            'reservation_date.required'  => 'reservation date is required!',
            'start_time.required' => 'start time is required!',
            'end_time.required' => 'end time is required!',
            'tenant_name' => 'tenant name is required!',
            
        ]);

        $reservation_id = random_int(10000,50000);

        $count = Reservations::where('room_id', $request['room_id'])->whereDate('reservation_date', $request['reservation_date'])
        ->whereRaw('(? between start_time and end_time or ? between start_time and end_time or start_time between ? and ?)',[date('H:i:s', strtotime($request->start_time)),date('H:i:s', strtotime($request->end_time)),date('H:i:s',strtotime($request->start_time)),date('H:i:s', strtotime($request->end_time))])->get()->count();
        
        if($count > 0)
        {
            Toastr::error('This time slot is not available.');
            return redirect()->back();
        }

        $reservation = Reservations::create([
            'room_id' => $request['room_id'],
            'reservation_date' => $request['reservation_date'],
            'start_time' => Carbon::parse($request['start_time'])->format('H:i:s'),
            'end_time' => Carbon::parse($request['end_time'])->format('H:i:s'),
            'tenant_name' => $request['tenant_name'],
            'reservation_id' =>  12,
            'amount' => $request['amount'],
        ]);

        $reservation->reservation_id = $reservation->id.rand(1000,9999);
        $reservation->save();
        
        Toastr::success('Reservation added successfully!');
        return redirect()->route('reservation.list');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reservation = Reservations::find($id);
        
        $html_response = view('admin.reservation.partials.reservationdetails_view_modal', compact('reservation'))->render();

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
        $reservation = Reservations::find($id);
        $facilities_list = Facilities::all();
       
        return view('admin.reservation.edit',compact('reservation','facilities_list'));
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
            'room_id' => 'required' ,
            'reservation_date' =>  'required' ,
            'start_time' => 'required',
            'end_time' => 'required',
            'tenant_name' => 'required',
            'amount' => 'required',
        ], [
            'room_id.required'  => 'Please select the facility!',
            'reservation_date.required'  => 'reservation date is required!',
            'start_time.required' => 'start time is required!',
            'end_time.required' => 'end time is required!',
            'tenant_name' => 'tenant name is required!',
            
        ]);

        $reservation = Reservations::find($id);

        $count = Reservations::where('room_id', $request['room_id'])->where('reservation_id','!=', $reservation->reservation_id)->whereDate('reservation_date', $request['reservation_date'])
        ->whereRaw('(? between start_time and end_time or ? between start_time and end_time or start_time between ? and ?)',[date('H:i:s', strtotime($request->start_time)),date('H:i:s', strtotime($request->end_time)),date('H:i:s',strtotime($request->start_time)),date('H:i:s', strtotime($request->end_time))])->get()->count();

        if($count > 0)
        {
            Toastr::error('This time slot is not available.');
            return redirect()->back();
        }

        $reservation->room_id = $request['room_id'];
        $reservation->reservation_date = $request['reservation_date'];
        $reservation->start_time = Carbon::parse($request['start_time'])->format('H:i:s');
        $reservation->end_time = Carbon::parse($request['end_time'])->format('H:i:s');
        $reservation->amount = $request['amount'];
        $reservation->tenant_name = $request['tenant_name'];

        $reservation->save();

        Toastr::success('Reservation updated successfully!');
        return redirect()->route('reservation.list');
    }
    


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reservation=Reservations::find($id);
        $reservation->delete();
        Toastr::success('Reservations deleted successfully!');
        return back();
    }
}
