@extends('layouts.admin.app')
{{-- Page title --}}

{{-- page level styles --}}
@section('header_styles')
<style>
</style>
@stop
@section('content')

   <div class="section-body">
      <form method="POST" action="{{route('maintenancecosts.update',$maintenance_costs->id) }}" enctype="multipart/form-data" autocomplete="off">
         @csrf
         <div class="row">
            <div class="col-12">
               <div class="card">
                  <div class="card-header">
                     <h4>Maintenance Details</h4>
                  </div>
                  <div class="card-body">
                     <div class="row">
                        <div class="form-group col-md-4">
                           <label>Maintenance Title</label>
                           <input type="text" name="maintenance_title" value="@if(isset($maintenance_costs)) {{ $maintenance_costs->maintenance_title }} @endif" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                           <label>Date</label>
                           <input type="text" value="{{ isset($maintenance_costs) ? \Carbon\Carbon::parse($maintenance_costs->maintenance_date)->format('Y-m-d') : ''}}"  name="maintenance_date" class="form-control datepicker">
                        </div>
                        <div class="form-group col-md-4">
                           <label>Maintenance Cost</label>
                           <input type="text" name="maintenance_cost_total_amount" value="@if(isset($maintenance_costs)) {{ $maintenance_costs->maintenance_cost_total_amount }} @endif" class="form-control">
                        </div>
                        <div class="form-group col-md-4" id="locationDropdown">
                           <label>Select Location</label>
                           <select class="form-control" onchange="get_locations(this)" name="location_id" id="">
                               <option value="" disabled selected>--- Select ---</option>
                               @foreach (\App\Models\Location::all() as $location)
                                   <option value="{{ $location->id }}" @if(isset($maintenance_costs) && $maintenance_costs->location_id == $location->id) selected @endif>{{ $location->location_name }}</option>
                               @endforeach
                           </select>
                       </div>
                       @if(isset($maintenance_costs) && $maintenance_costs->location_id == 1)
                        
                            <div class="form-group residential-selects col-md-4">
                                <label>Select Floor</label>
                                <select class="form-control" onchange="getUnits(this)" name="floor_id" id="floorSelect">
                                    <option value="" disabled selected>--- Select ---</option>
                                    @foreach (\App\Models\FloorDetail::where('floor_type_code', 2)->get() as $floor)
                                        <option value="{{ $floor->id }}" @if(isset($maintenance_costs) && $maintenance_costs->floor_id == $floor->id) selected @endif>{{ $floor->number }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group residential-selects col-md-4">
                            <label>Select Apartment</label>
                            <select class="form-control" name="unit_id" id="unitSelect">
                                <option value="" disabled selected>--- Select ---</option>
                                @foreach (\App\Models\Unit::all() as $unit)
                                    <option value="{{ $unit->id }}" @if(isset($maintenance_costs) && $maintenance_costs->unit_id == $unit->id) selected @endif>{{ $unit->unit_number }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                       @endif
                       @if(isset($maintenance_costs) && $maintenance_costs->location_id == 2)
                        
                            <div class="form-group area-select col-md-4">
                                <label>Select Common Area</label>
                                <select class="form-control"  name="common_area_id">
                                    <option value="" disabled selected>--- Select ---</option>
                                    @foreach (\App\Models\CommonArea::all() as $common_area)
                                        <option value="{{ $common_area->id }}" @if(isset($maintenance_costs) && $maintenance_costs->common_area_id == $common_area->id) selected @endif>{{ $common_area->area_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                       @endif
                       @if(isset($maintenance_costs) && $maintenance_costs->location_id == 3)
                            <div class="form-group parking-select col-md-4">
                                <label>Select Floor</label>
                                <select class="form-control"  name="floor_id">
                                    <option value="" disabled selected>--- Select ---</option>
                                    @foreach (\App\Models\FloorDetail::where('floor_type_code', 1)->get() as $floor)
                                        <option value="{{ $floor->id }}" @if(isset($maintenance_costs) && $maintenance_costs->floor_id == $floor->id) selected @endif>{{ $floor->number }}</option>
                                    @endforeach
                                </select>
                            </div>
                       @endif
                       @if(isset($maintenance_costs) && $maintenance_costs->location_id == 4)
                            <div class="form-group services-select col-md-4">
                                <label>Select Service Area</label>
                                <select class="form-control"  name="service_area_id">
                                    <option value="" disabled selected>--- Select ---</option>
                                    @foreach (\App\Models\ServiceArea::all() as $service_area)
                                        <option value="{{ $service_area->id }}" @if(isset($maintenance_costs) && $maintenance_costs->service_area_id == $service_area->id) selected @endif>{{ $service_area->service_area_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                       @endif
                        <div class="form-group col-md-12">
                           <label>Description</label>
                          
                           <textarea name="maintenance_description" value="" class="form-control">{{ isset($maintenance_costs) ? $maintenance_costs->maintenance_description : ''}}</textarea>
                        </div>
                     </div>
                     <button  class="btn btn-primary mr-1" type="submit">update</button>
                     <a href="{{ url()->previous() }}"  class="btn btn-primary ml-2">Cancel</a>
                  </div>
               </div>
            </div>
         </div>
   </div>
   </div>
   </form>
   </div>
   </div>
</section>
@stop
@section('footer_scripts')
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

