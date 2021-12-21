@extends('layouts.admin.app')
{{-- Page title --}}

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="{{ asset('public/admin/assets/') }}/bundles/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
<link rel="stylesheet" href="{{asset('public/admin/assets/bundles/bootstrap-daterangepicker/daterangepicker.css') }}">

<style>
   
</style>
@stop
@section('content')
  <section class="section">
    <div class="section-body">
          <form method="POST" action="{{ route('reservation.store') }}" enctype="multipart/form-data" autocomplete="off">
              @csrf
                  <div class="row">
                      <div class="col-12">
                          <div class="card">
                              <div class="card-header">
                                  <h4> Reservation Form</h4>
                              </div>
                              <div class="card-body">
                                <div class="row">
                                  <div class="form-group col-md-4">
                                    <label for="">Select Facility</label>
                                    <select class="form-control" name="room_id" >
                                      <option value="0" selected disabled>---Select---</option>
                                      @foreach ($facilities_list as $facility)
                                          <option value="{{ $facility->id }}">{{ $facility->name }}</option>
                                      @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                  <label>Reservation Date</label>
                                  <input type="text" name="reservation_date" class="form-control datepicker1">
                                </div>
                                  <div class="form-group col-md-4">
                                      <label>Start Time</label>
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                            <i class="fas fa-clock"></i>
                                          </div>
                                        </div>
                                        <input type="text"  name="start_time" class="form-control timepicker">
                                    </div>
                                </div>
                              </div>
                                <div class="row">
                                  <div class="form-group col-md-4">
                                      <label>End Time</label>
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text">
                                            <i class="fas fa-clock"></i>
                                          </div>
                                        </div>
                                        <input type="text"  name="end_time" class="form-control timepicker">
                                      </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                      <label>Reservation Amount</label>
                                      <input type="text" name="amount" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                      <label>Tenant Name</label>
                                      <input type="text" name="tenant_name" class="form-control">
                                    </div>

                              </div>
                           
                      <button  class="btn btn-primary mr-1" type="submit">save</button>
                      <a href="{{ url()->previous() }}"  class="btn btn-primary ml-2">Cancel</a>

                  </div>
                </form>
              </div>
    </div>
  </section>
@stop
@section('footer_scripts')
<script src="{{ asset('public/admin/assets/') }}/bundles/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="{{asset('public/admin/assets/bundles/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

<script>
  $(".datepicker1").daterangepicker({
        locale: { format: "YYYY-MM-DD" },
        singleDatePicker: true,
        minDate: new Date(),   
  });
</script>
@stop