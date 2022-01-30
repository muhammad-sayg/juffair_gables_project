@extends('layouts.admin.app')
{{-- Page title --}}

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="{{asset('public/admin/assets/bundles/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('public/admin/assets/') }}/bundles/bootstrap-timepicker/css/bootstrap-timepicker.min.css">

<style>
   
</style>
@stop
@section('content')


<section class="section">
    {{-- <ul class="breadcrumb breadcrumb-style ">
       <li class="breadcrumb-item">
          <h4 class="page-title m-b-0">Create Utility Bill</h4>
       </li>
       <li class="breadcrumb-item">
          <a href="file:///F:/AMS/tenantlist.html">
          <i class="fas fa-home"></i></a>
       </li>
    </ul> --}}
    <div class="section-body">
    <div class="row">
    <div class="col-12" >
        <div class="card">
            <div class="card-header">
              <h4>Update Task</h4>
            </div>
            <div class="card-body">
            <form method="POSt" action="{{ route('tasks.update', $task->id) }}" enctype="multipart/form-data" autocomplete="off">
              @csrf
                <div class="row">
                    <div class="form-group col-md-4" id="locationDropdown">
                        <label>Select Location <sup class="text-danger">*</sup></label>
                        <select class="form-control" onchange="get_locations(this)" name="location_id" id="">
                            <option value="" disabled selected>--- Select ---</option>
                            @foreach (\App\Models\Location::all() as $location)
                                <option value="{{ $location->id }}" @if(isset($task) && $task->location_id == $location->id) selected @endif>{{ $location->location_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if(isset($task) && $task->location_id == 1)
                        
                            <div class="form-group residential-selects col-md-4">
                                <label>Select Floor <sup class="text-danger">*</sup></label>
                                <select class="form-control" onchange="getUnits(this)" name="floor_id" id="floorSelect">
                                    <option value="" disabled selected>--- Select ---</option>
                                    @foreach (\App\Models\FloorDetail::where('floor_type_code', 2)->get() as $floor)
                                        <option value="{{ $floor->id }}" @if(isset($task) && $task->floor_id == $floor->id) selected @endif>{{ $floor->number }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group residential-selects col-md-4">
                            <label>Select Apartment <sup class="text-danger">*</sup></label>
                            <select class="form-control" name="unit_id" id="unitSelect">
                                <option value="" disabled selected>--- Select ---</option>
                                @foreach (\App\Models\Unit::all() as $unit)
                                    <option value="{{ $unit->id }}" @if(isset($task) && $task->unit_id == $unit->id) selected @endif>{{ $unit->unit_number }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        @endif
                        @if(isset($task) && $task->location_id == 2)
                        
                            <div class="form-group area-select col-md-4">
                                <label>Select Common Area <sup class="text-danger">*</sup></label>
                                <select class="form-control"  name="common_area_id">
                                    <option value="" disabled selected>--- Select ---</option>
                                    @foreach (\App\Models\CommonArea::all() as $common_area)
                                        <option value="{{ $common_area->id }}" @if(isset($task) && $task->common_area_id == $common_area->id) selected @endif>{{ $common_area->area_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        @if(isset($task) && $task->location_id == 3)
                            <div class="form-group parking-select col-md-4">
                                <label>Select Floor <sup class="text-danger">*</sup></label>
                                <select class="form-control"  name="floor_id">
                                    <option value="" disabled selected>--- Select ---</option>
                                    @foreach (\App\Models\FloorDetail::where('floor_type_code', 1)->get() as $floor)
                                        <option value="{{ $floor->id }}" @if(isset($task) && $task->floor_id == $floor->id) selected @endif>{{ $floor->number }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        @if(isset($task) && $task->location_id == 4)
                            <div class="form-group services-select col-md-4">
                                <label>Select Service Area <sup class="text-danger">*</sup></label>
                                <select class="form-control"  name="service_area_id">
                                    <option value="" disabled selected>--- Select ---</option>
                                    @foreach (\App\Models\ServiceArea::all() as $service_area)
                                        <option value="{{ $service_area->id }}" @if(isset($task) && $task->service_area_id == $service_area->id) selected @endif>{{ $service_area->service_area_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                    <div class="form-group col-md-4">
                        <label>Task Title <sup class="text-danger">*</sup></label>
                        <input type="text" value="{{ isset($task)? $task->title : '' }}" name="title" class="form-control">
                    </div>
                    {{-- <div class="form-group col-md-4">
                        <label>Assign Date</label>
                        <input type="text" name="assign_date" class="form-control datepicker">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Assign Time</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-clock"></i>
                                </div>
                            </div>
                            <input type="text"  name="assign_time" class="form-control timepicker">
                        </div>
                    </div>

                    @if(Auth::user()->userType != 'employee')
                    <div class="form-group col-md-4">
                        <label>Deadline Date</label>
                        <input type="text" name="deadline_date" class="form-control datepicker">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Deadline Time</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-clock"></i>
                                </div>
                            </div>
                            <input type="text"  name="deadline_time" class="form-control timepicker">
                        </div>
                    </div>
                    @endif --}}
                </div>
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Description <sup class="text-danger">*</sup></label>
                            <textarea name="description" class="form-control">{{ isset($task)? $task->description : '' }}</textarea>
                        </div>
                    </div>
                </div>
               
                
                <button class="btn btn-primary mr-1" type="submit">Update</button>
                <a href="{{ url()->previous() }}" class="btn btn-primary mr-1">Cancel</a>
                
            </div>
            </from>
          </div>
</section>    
@stop
@section('footer_scripts')
<script src="{{ asset('public/admin/assets/') }}/bundles/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="{{asset('public/admin/assets/bundles/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script>
     $(".monthPicker").datepicker({
        dateFormat: 'MM yy',
        changeMonth: true,
        changeYear: true,
        onClose: function (dateText, inst) {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).val($.datepicker.formatDate('MM yy', new Date(year, month, 1)));
        }
    });
</script>
<script>
    function get_locations(location)
    {
        let id = location.value
        
        if(id == 2 || id == 3 || id == 4)
        {
            $(".residential-selects").remove()
            $(".floor-dropdown").remove()
            $(".unit-dropdown").remove()
        }
 
        if(id == 1 || id == 3 || id == 4)
        {
            $(".area-select").remove()
            $(".common_area_select").remove()
        }
 
        if(id == 1 || id == 2 || id == 4)
        {
            $(".parking-select").remove()
            $(".parking_floor_select").remove()
        }
 
        if(id == 1 || id == 2 || id == 3)
        {
            $(".services-select").remove()
            $(".service_area_select").remove()
        }
 
        $.get({
            url: '{{route('tasks.get_task_location', '')}}' + "/"+ id,
            dataType: 'json',
            success: function (data) {
                console.log(data.options)
 
                if(id == 1)
                {
                    $('#locationDropdown').after(data.floor_select)
                    $('.floor-dropdown').after(data.unit_select)
                }
 
                if(id == 2)
                {
                    
                    $('#locationDropdown').after(data.common_area_select)
                } 
 
                if(id == 3)
                {
                    
                    $('#locationDropdown').after(data.parking_floors)
                } 
 
                if(id == 4)
                {
                    
                    $('#locationDropdown').after(data.service_areas_select)
                } 
 
            }
        });
    }
</script>
<script>
    // function getFloors(id) {
    //     $.get({
    //         url: '{{route('tenants.fetch_floors', '')}}' + "/"+ id,
    //         dataType: 'json',
    //         success: function (data) {
    //             console.log(data.options)
    //             $('#floorSelect').empty().append(data.options)
    //             $('#unitSelect').empty().append(data.options1)
    //            }
    //     });
    // }
    function getUnits(id) {
       
        $.get({
            url: '{{route('floor_type.fetch_all_units','')}}' + "/"+ id,
            dataType: 'json',
            success: function (data) {
                console.log(data.options)
                $('#unitSelect').empty().append(data.options)
               }
        });
    }
</script>
@stop
