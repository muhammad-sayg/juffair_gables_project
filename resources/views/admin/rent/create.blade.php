@extends('layouts.admin.app')
{{-- Page title --}}

{{-- page level styles --}}
@section('header_styles')
{{-- <link rel="stylesheet" href="{{asset('public/admin/assets/bundles/bootstrap-daterangepicker/daterangepicker.css') }}"> --}}
<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<meta name="csrf-token" content="{{ csrf_token() }}">

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
              <form action="{{ route('rent.store') }}" autocomplete="off" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                          <label for="">Select Tenant</label>
                          <select name="tenant_id" class="form-control"  id="" style="height: 37px;">
                            <option value="">--- Select ---</option>
                            @foreach ($tenant_list as $tenant)
                                <option value="{{ $tenant->id }}">{{ $tenant->tenant_first_name }} {{ $tenant->tenant_last_name }}</option>
                            @endforeach
                          </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                          <label for="">Rent Amount (BD)</label>
                          <input type="text" class="form-control" readonly  name="rent_amount">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                          <label for="">Received Amount (BD)</label>
                          <input type="text" class="form-control" name="received_amount">
                          <span class="text-danger" style="display: none">Received amount cannot be less then rent amount.</span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                          <label for="">Upload Document</label>
                          <input type="file" class="form-control" name="receipt">
                        </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label for="" style="display: block;" class="mt-2">Status</label>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" id="customRadioInline1" value="paid" name="rent_status"
                            class="custom-control-input">
                          <label class="custom-control-label" for="customRadioInline1">Paid</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" id="customRadioInline2" checked value="unpaid" name="rent_status"
                            class="custom-control-input">
                          <label class="custom-control-label" for="customRadioInline2">Unpaid</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="custom-control custom-checkbox mb-3">
                        <input type="checkbox" name="monthly_checkbox"  class="monthly_checkbox custom-control-input" id="customCheck1" checked>
                        <label class="custom-control-label" for="customCheck1">Monthly base</label>
                      </div>
                    </div>
                  </div>
                  <div class="monthly-base-rent-input">
                    <div class="row">
                      <div class="col-lg-4">
                          <div class="form-group">
                            <label for="">Rent Month</label>
                            <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                              <input type="text" name="rent_month" class="form-control datetimepicker-input" data-target="#datetimepicker1"/>
                              <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                            </div>
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
                              <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                                <input type="text" name="rent_start_month" class="form-control datetimepicker-input" data-target="#datetimepicker2"/>
                                <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-4">
                            <div class="form-group">
                              <label for="">Rent To</label>
                              <div class="input-group date" id="datetimepicker3" data-target-input="nearest">
                                <input type="text" name="rent_end_month" class="form-control datetimepicker-input" data-target="#datetimepicker3"/>
                                <div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="m-b-20 mt-5">
                        <button type="submit" class="btn btn-primary btn-border-radius waves-effect">Save</button>
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
{{-- <script src="{{asset('public/admin/assets/bundles/bootstrap-daterangepicker/daterangepicker.js') }}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://foodlabriffa.ebahrain.biz/assets/bower_components/datepicker/js/bootstrap-datepicker.min.js"></script>
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

<script type="text/javascript">
  $(function () {
      $('#datetimepicker1').datepicker({
        format:'mm-yyyy',
        viewMode: "months", 
        minViewMode: "months", 
        autoclose:true

      });
      
      $('#datetimepicker2').datepicker({
        format:'mm-yyyy',
        viewMode: "months", 
        minViewMode: "months", 
        autoclose:true

      });

      $('#datetimepicker3').datepicker({
        format:'mm-yyyy',
        viewMode: "months", 
        minViewMode: "months", 
        autoclose:true
      });
  });
</script>
<script>
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });

  $("select[name='tenant_id']").change(function(){
    let id = this.value
    
    jQuery.ajax({
        url: "{{ route('tenant.rent') }}",
        method: 'POST',
        data:{id:id},
        success: function(data){
            if(data.success)
            {
              $("input[name='rent_amount']").val(Math.trunc(data.rent))
            }

        },
            error: function(jqXHR,exception)
        {
            alert(jqXHR.status + "\n" + jqXHR.responseText)
        }

    })
  })

  $("input[name='received_amount']").keyup(function(){
    let received_amount = $(this).val()
    let rent_amount = $("input[name='rent_amount']").val()
    console.log(received_amount,rent_amount)
    if(received_amount == rent_amount)
    {
      $(".text-danger").hide()
      $(':input[type="submit"]').prop('disabled', false)
    }
    else
    {
      $(".text-danger").show()
      $(':input[type="submit"]').prop('disabled', true)
    }
  });
</script>
@stop