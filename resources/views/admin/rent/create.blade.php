@extends('layouts.admin.app')
{{-- Page title --}}

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="{{asset('public/admin/assets/bundles/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<style>
</style>
@stop
@section('content')
<section class="section">
    {{-- <ul class="breadcrumb breadcrumb-style ">
      <li class="breadcrumb-item">
      </li>
      <li class="breadcrumb-item">
        <a href="file:///F:/AMS/dashboard.html">
          <i class="fas fa-home"></i></a>
      </li>
      <li class="breadcrumb-item">Utility Bills</li>
    
    </ul> --}}
     <div class="row">
       
      <div class="col-12">
        <div class="card">
          <div class="card-header">
           <h4>Rent Collection Form</h4>
          </div>
            
            <div class="card-body">
              <form action="">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                          <label for="">Select Tenant</label>
                          <select name="tenant_id" class="form-control" id="" style="height: 37px;">
                            <option value="0">--- Select ---</option>
                            @foreach ($tenant_list as $tenant)
                                <option value="{{ $tenant->id }}">{{ $tenant->tenant_first_name }} {{ $tenant->tenant_last_name }}</option>
                            @endforeach
                          </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                          <label for="">Rent Amount</label>
                          <input type="text" class="form-control" name="rent_amount">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                          <label for="">Received Amount</label>
                          <input type="text" class="form-control" name="received_amount">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                          <label for="">Upload</label>
                          <input type="file" class="form-control" name="rent_file">
                        </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label for="" style="display: block;" class="mt-2">Status</label>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" id="customRadioInline1" name="customRadioInline1"
                            class="custom-control-input">
                          <label class="custom-control-label" for="customRadioInline1">Paid</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" id="customRadioInline2" name="customRadioInline1"
                            class="custom-control-input">
                          <label class="custom-control-label" for="customRadioInline2">Unpaid</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="custom-control custom-checkbox mb-3">
                        <input type="checkbox" name="monthly_checkbox" class="monthly_checkbox custom-control-input" id="customCheck1" checked>
                        <label class="custom-control-label" for="customCheck1">Monthly base</label>
                      </div>
                    </div>
                  </div>
                  <div class="monthly-base-rent-input">
                    <div class="row">
                      <div class="col-lg-4">
                          <div class="form-group">
                            <label for="">Rent Month</label>
                            <input type="text" name="rent_month" id="datepick" class="form-control datepicker1">
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="period-base-rent-inputs" style="display: none;">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="form-group">
                              <label for="">Rent From</label>
                              <input type="text" name="rent_from" class="form-control datepicker">
                            </div>
                          </div>
                          <div class="col-lg-4">
                            <div class="form-group">
                              <label for="">Rent To</label>
                              <input type="month" name="rent_to" class="form-control">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="m-b-20 mt-5">
                        <button type="submit" class="btn btn-primary btn-border-radius waves-effect">Send</button>
                        <a href="{{ url()->previous() }}" type="button" class="btn btn-primary btn-border-radius waves-effect ml-3">Cancel</a>
                      </div>
                    </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@stop
@section('footer_scripts')
<script src="{{asset('public/admin/assets/bundles/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script>
  function getRentDetails(id) {
    $.get({
        url: '{{route('rent.show', '')}}' + "/"+ id,
        dataType: 'json',
        success: function (data) {
            console.log(data)
            $("#rentModal tbody").html(data.html_response)
            $("#rentModal").modal("show")
        }
    });
  }
</script>
<script>
  function getFloors(id) {
          $.get({
              url: '{{route('floor_type.fetch_floors', '')}}' + "/"+ id,
              dataType: 'json',
              success: function (data) {
                  console.log(data.options)
                  $('#floorSelect').empty().append(data.options)
              }
          });
      }
</script>

<script>
  $('.monthly_checkbox').click(function() {
    if(!$(this).is(':checked')) {
        $(".period-base-rent-inputs").show()
        $(".monthly-base-rent-input").hide()
    }
    else
    {
        $(".period-base-rent-inputs").hide()
        $(".monthly-base-rent-input").show()
    }
  });
</script>

<script>
  $(document).ready(function() {
	$('#datepick').datepicker()
});
</script>
@stop