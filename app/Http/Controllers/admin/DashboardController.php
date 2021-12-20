<?php

namespace App\Http\Controllers\admin;

use Session;
use Carbon\Carbon;
use App\Models\Rent;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\MaintenanceCost;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $employee_list = User::where('userType', 'employee')->get();
        $total_minutes = 0;
        $average_time = 0;
        if(Auth::user()->userType == 'employee'){

            $login_user_id = Auth::user()->id;
            $tasks = Task::where('assignee_id', $login_user_id)->where('task_status_code', 5)->get();
            
            $number = $tasks->count();
            
            if($number > 0)
            {
                foreach($tasks as $task)
                {
                    $assigned_date_time = Carbon::parse($task->assign_date)->format('Y-m-d') .' '. Carbon::parse($task->assign_time)->format("H:i:s");
                    $complete_date_time = Carbon::parse($task->complete_date)->format('Y-m-d') .' '.  Carbon::parse($task->complete_time)->format("H:i:s");
                   
                    $minutes = Carbon::parse($assigned_date_time)->diffInMinutes(Carbon::parse($complete_date_time));
                    $total_minutes = $total_minutes + $minutes;
                    // dump($total_minutes);
                }
        
                $avg_in_minutes = $total_minutes/$number;
                // dd($avg_in_minutes);
                $average_time = floor($avg_in_minutes / 60).':'.($avg_in_minutes -   floor($avg_in_minutes / 60) * 60);
            }
        }

        // culculate monthly base rent

        $current_year = Carbon::now()->format('Y');
 
        $montly_base_total_rent = [];

        $month_array = ["01","02","03","04","05","06","07","08","09","10","11","12"];

        $month_year_array = [];

        foreach($month_array as $month)
        {
            $month_year_string = '';
            $month_year_string = $current_year . '-' . $month;
            array_push($month_year_array,$month_year_string);
        }

        foreach($month_year_array as $key => $value)
        {
            $rent_sum = Rent::where('received_date', 'like' , $value.'-%')->sum('received_amount');
            
            array_push($montly_base_total_rent,(int)$rent_sum);
        }

        $total_rent_per_year = 0;
        $total_rent_per_year = Rent::where('received_date', 'like' , $current_year.'-%')->sum('received_amount');
        
        $total_maintenance_cost_per_year = 0;
        $total_maintenance_cost_per_year = MaintenanceCost::where('maintenance_date', 'like' , $current_year.'-%')->sum('maintenance_cost_total_amount');


        return view('admin.index', compact('average_time','employee_list','montly_base_total_rent','total_rent_per_year','total_maintenance_cost_per_year'));
    }
}
