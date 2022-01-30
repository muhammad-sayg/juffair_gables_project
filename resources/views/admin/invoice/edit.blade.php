@extends('layouts.admin.app')
{{-- Page title --}}

{{-- page level styles --}}
@section('header_styles')
{{-- <link rel="stylesheet" href="{{asset('public/admin/assets/bundles/bootstrap-daterangepicker/daterangepicker.css') }}"> --}}
<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="{{asset('public/admin/assets/bundles/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{asset('public/admin/assets/bundles/bootstrap-daterangepicker/daterangepicker.css') }}">

<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
  .select2-selection
  {
    height: 36px !important;
  }
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
           <h4>Update Invoice</h4>
          </div>
            
            <div class="card-body">
              <form action="{{ route('invoices.update', $invoice->id) }}" autocomplete="off" method="POST" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                          <label for="">Select Tenant <sup class="text-danger">*</sup></label>
                          <select name="tenant_id" class="form-control select2"  id="" style="height: 37px;">
                            <option value="">--- Select ---</option>
                            @foreach ($tenant_list as $tenant)
                                <option value="{{ $tenant->id }}" {{ ($tenant->id == $invoice->tenant->id) ? 'selected' : '' }}>{{ $tenant->tenant_first_name }} {{ $tenant->tenant_last_name }}</option>
                            @endforeach
                          </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                          <label for="">Rent Amount (BD) <sup class="text-danger">*</sup></label>
                          <input type="text" class="form-control" value="{{ $invoice->invoice_amount }}" name="rent_amount">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                          <label for="">Invoice Date <sup class="text-danger">*</sup></label>
                          <input type="text" name="invoice_date" value="{{ $invoice->invoice_issue_date }}" class="form-control datepicker">
                        </div>
                    </div>
                    
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="custom-control custom-checkbox mb-3">
                        <input type="checkbox" name="auto_option"  class="monthly_checkbox custom-control-input" id="customCheck1" {{ ($invoice->auto_generate == "Yes" ? 'checked' : '') }}>
                        <label class="custom-control-label" for="customCheck1">Auto Generate</label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="m-b-20 mt-2">
                        <button type="submit" class="btn btn-primary btn-border-radius waves-effect">Update</button>
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
<script src="{{asset('public/admin/assets/bundles/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

<script src="https://foodlabriffa.ebahrain.biz/assets/bower_components/datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="{{asset('public/admin/assets/bundles/select2/dist/js/select2.full.min.js') }}"></script>
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
</script>
@stop