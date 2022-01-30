@extends('layouts.admin.app')
{{-- Page title --}}
@section('title')
    Juffair Gables
@stop
{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="{{asset('public/admin/assets/bundles/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{asset('public/admin/assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
<link rel="stylesheet" href="{{  asset('public/assets/css/intlTelInput.css') }}">

<style>
   textarea.form-control {
        height: 80px !important;
    }

    .bootstrap-tagsinput
   {
       min-height: 100px;
       width: 100% !important;
   }
   
   .iti--allow-dropdown
   {
       width:100%;
   }
   
   .fa-info-circle
   {
       position: relative;
        top: 1px;
        margin-left: 8px;
   }
   
</style>
@stop
@section('content')


<section class="section">
    {{-- <ul class="breadcrumb breadcrumb-style ">
       <li class="breadcrumb-item">
          <h4 class="page-title m-b-0">Update Tenant Form</h4>
       </li>
       <li class="breadcrumb-item">
          <a href="file:///F:/AMS/tenantlist.html">
          <i class="fas fa-home"></i></a>
       </li>
    </ul> --}}
    <div class="section-body">
    <div class="row">
        <div class="col-12" >
            <form method="POST" action="{{ route('tenants.update',$tenant->id) }}" enctype="multipart/form-data" autocomplete="off">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Tenant Information</h4>
                    </div>
                    <div class="card-body">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Tenant First Name <sup class="text-danger">*</sup></label>
                                <input type="text" name="tenant_first_name" value="{{ isset($tenant->tenant_first_name)? $tenant->tenant_first_name : '' }}" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Tenant Last Name <sup class="text-danger">*</sup></label>
                                <input type="text" name="tenant_last_name" value="{{ isset($tenant->tenant_last_name)? $tenant->tenant_last_name : '' }}" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label style="display:block;">Contact Number <sup class="text-danger">*</sup></label>
                                <input type="tel" maxLength="11" id="contactNo" name="tenant_mobile_phone" value="{{ isset($tenant->tenant_mobile_phone)? $tenant->tenant_mobile_phone : '' }}" class="form-control">
                                <input type="hidden" name="country_code" value="" >
                            </div>
                            <div class="form-group col-md-4">
                                <label>Tenant Email <sup class="text-danger">*</sup></label>
                                <input type="email" name="tenant_email_address" value="{{ isset($tenant->tenant_email_address)? $tenant->tenant_email_address : '' }}" required class="form-control">
                            </div>

                            <div class="form-group col-md-4">
                                <label>Date of birth <sup class="text-danger">*</sup></label>
                                <input type="text" name="tenant_date_of_birth" value="{{ isset($tenant->tenant_date_of_birth)? $tenant->tenant_date_of_birth : '' }}" class="form-control datepicker">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Image <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="right"
                      title="Image size should be 2 MB and Image should be in jpg and png format."></i> <sup class="text-danger">*</sup></label>
                                <input type="file" name="tenant_image"  class="form-control">
                                @if(isset($tenant->tenant_image) && !empty($tenant->tenant_image))
                                    <img src="{{asset('public/admin/assets/img/staff/'.$tenant->tenant_image)}}" height="150" width="150">
                                @endif 
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label>Present Address <sup class="text-danger">*</sup></label>
                                <textarea name="tenant_present_address" class="form-control">{{ isset($tenant->tenant_present_address)? $tenant->tenant_present_address : '' }}</textarea>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Permanent Address <sup class="text-danger">*</sup></label>
                                <textarea name="tenant_permanent_address"  class="form-control">{{ isset($tenant->tenant_permanent_address)? $tenant->tenant_permanent_address : '' }}</textarea>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Home Country Address <sup class="text-danger">*</sup></label>
                                <textarea name="home_country_address"  class="form-control">{{ isset($tenant->home_country_address)? $tenant->home_country_address : '' }}</textarea>
                            </div>
                            <div class="form-group col-md-4">
                                <label>CPR Number</label>
                                <input type="text" name="tenant_cpr_no" value="{{ isset($tenant->tenant_cpr_no)? $tenant->tenant_cpr_no : '' }}" id="cprNumber" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Passport Number <sup class="text-danger">*</sup></label>
                                <input type="text" maxlength="9" value="{{ isset($tenant->tenant_passport_no)? $tenant->tenant_passport_no : '' }}" name="tenant_passport_number" class="form-control" id="cprNumber">
                             </div>
                            <div class="form-group col-md-4">
                                <label>Contract Period Start Date <sup class="text-danger">*</sup></label>
                                <input type="text" name="lease_period_start_datetime" value="{{ isset($tenant->lease_period_start_datetime)? $tenant->lease_period_start_datetime : '' }}" class="form-control datepicker">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Contract Period End Date <sup class="text-danger">*</sup></label>
                                <input type="text" name="lease_period_end_datetime" value="{{ isset($tenant->lease_period_end_datetime)? $tenant->lease_period_end_datetime : '' }}" class="form-control datepicker">
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label>Emergency Email <sup class="text-danger">*</sup></label>
                                <input type="text" name="emergancy_email" value="{{ isset($tenant->emergancy_email)? $tenant->emergancy_email : '' }}" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Tenant Type <sup class="text-danger">*</sup></label>
                                <select class="form-control" name="tenant_type_code">
                                    @foreach ($tenant_types as $tenant_type)
                                        <option value="{{ $tenant_type->tenant_type_code }}" {{ isset($tenant->tenant_type_code) && ($tenant_type->tenant_type_code == $tenant->tenant_type_code)? 'selected':'' }}>{{ $tenant_type->tenant_type_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label>Tenant Passport Copy <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="right"
                      title="Image size should be 2 MB and Image should be in jpg and png format."></i> <sup class="text-danger">*</sup></label>
                                <input type="file" name="tenant_passport_copy" class="form-control">
                                @if(isset($tenant->tenant_passport_copy) && !empty($tenant->tenant_passport_copy))
                                    <a class="mt-3"  href="{{asset('public/admin/assets/img/documents/'.$tenant->tenant_passport_copy)}}" target="_blank">View Passport Copy</a>
                                @endif 
                            </div>
                            <div class="form-group col-md-4">
                                <label>Tenant CPR Copy <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="right"
                      title="Image size should be 2 MB and Image should be in jpg and png format."></i></label>
                                <input type="file" name="tenant_cpr_copy" class="form-control">
                                @if(isset($tenant->tenant_cpr_copy) && !empty($tenant->tenant_cpr_copy))
                                    <a class="mt-3"  href="{{asset('public/admin/assets/img/documents/'.$tenant->tenant_cpr_copy)}}" target="_blank">View Cpr Copy</a>
                                @endif 
                            </div>
                            <div class="form-group col-md-4">
                                <label>Tenant Contract Copy <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="right"
                      title="Image size should be 2 MB and Image should be in jpg and png format."></i> <sup class="text-danger">*</sup></label>
                                <input type="file" name="tenant_contract_copy" class="form-control">
                                @if(isset($tenant->tenant_contract_copy) && !empty($tenant->tenant_contract_copy))
                                    <a class="mt-3"  href="{{asset('public/admin/assets/img/documents/'.$tenant->tenant_contract_copy)}}" target="_blank">View Contract Copy</a>
                                @endif 
                            </div>
                        </div>
                    </div>
                    <div class="card-header">
                        <h4>Edit Apartment Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            {{-- <div class="form-group col-md-4">
                                <label for="">Floor Type <sup class="text-danger">*</sup></label>
                                <select class="form-control" name="floor_type_code" onchange="getFloors(this.value)" id="floor_type_code">
                                @foreach ($floor_types as $floor_type)
                                    <option value="{{ $floor_type->floor_type_code }}" {{(isset($tenant) && ($tenant->unit->floor->floor_type_code == $floor_type->floor_type_code)) ? 'selected': '' }}>{{ $floor_type->floor_type_name }}</option>
                                @endforeach
                                </select>
                            </div> --}}
                
                            <div class="form-group col-md-3">
                                <label for="">Select Floor <sup class="text-danger">*</sup></label>
                                <select class="form-control" style="height: 32px;" name="floor_id" onchange="getUnits(this.value)" id="floorSelect">
                                    @foreach ($floors as $floor)
                                        <option value="{{ $floor->id }}" {{ (isset($tenant) && ($tenant->floor_id == $floor->id)) ? 'selected' :'' }}>{{ $floor->number}}</option>
                                    @endforeach
                                </select>
            
                            </div>
                            <div class="form-group col-md-3" >
                                <label>Select Apartment <sup class="text-danger">*</sup></label>
                                <select class="form-control" style="height: 32px;" name="unit_id"  id="unitSelect">
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}" {{ (isset($tenant) && ($tenant->unit_id == $unit->id)) ? 'selected' :'' }}>{{ $unit->unit_number}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label style="display: block;">Add Facilities</label>
                                <input type="text" name="all_facilities" value="{{ implode(',', $tenant->tenant_facilities_list) }}" class="form-control inputtags">
                              </div>
                            <div class="form-group col-md-4" >
                                <label>Total Rent <sup class="text-danger">*</sup></label>
                                <input type="text" style="height: 32px;" name="total_rent" value="{{ isset($tenant->tenant_rent)? $tenant->tenant_rent : '' }}" class="form-control" style="height: 38px;">
                            </div>
                            {{-- <div class="form-group col-md-4" >
                                <label>Security Deposit (BD)</label>
                                <input type="text" name="security_deposit" value="{{ isset($tenant->security_deposit)? $tenant->security_deposit : '' }}" class="form-control">
                            </div> --}}
                        </div>
                        <button class="btn btn-primary mr-1" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>    
@stop
@section('footer_scripts')
<script src="{{asset('public/admin/assets/bundles/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{asset('public/admin/assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{  asset('public/assets/js/intlTelInput.js') }}"></script>
      <script src="{{ asset('public/assets/js/intlTelInput.js')}}"></script>
<script>
    $(".inputtags").tagsinput('items');
</script>
<script>
    $('.bootstrap-tagsinput input').keydown(function( event ) {
    if ( event.which == 13 ) {
        $(this).blur();
        $(this).focus();
        return false;
    }
})
</script>
<script>
    (function($) {
            $.fn.inputFilter = function(inputFilter) {
                return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
                if (inputFilter(this.value)) {
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                } else {
                    this.value = "";
                }
                });
            };
        }(jQuery));
    
        
        $("#contactNo").inputFilter(function(value) {
        return /^[+-]?\d*$/.test(value); });

        $("#cprNumber").inputFilter(function(value) {
        return /^-?\d*$/.test(value); });

        $("#emergencyNumber").inputFilter(function(value) {
        return /^[+-]?\d*$/.test(value); });
    </script>
    <script>
        function getFloors(id) {
            $.get({
                url: '{{route('floor_type.fetch_all_units_and_floors_list', '')}}' + "/"+ id,
                dataType: 'json',
                success: function (data) {
                    console.log(data.options)
                    $('#floorSelect').empty().append(data.options)
                    $('#unitSelect').empty().append(data.options1)
                   }
            });
        }
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
    <script>
         var input = document.querySelector("#contactNo");
         window.intlTelInput(input, {
         //   allowDropdown: false,
         //   autoHideDialCode: true,
         autoPlaceholder: "On",
         //   dropdownContainer: document.body,
         //   excludeCountries: ["us"],
         //   formatOnDisplay: true,
         geoIpLookup: function(callback) {
           $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
             var countryCode = (resp && resp.country) ? resp.country : "";
             callback(countryCode);
           });
         },
         //   hiddenInput: "full_number",
         //   initialCountry: "auto",
         //   localizedCountries: { 'de': 'Deutschland' },
         //   nationalMode: false,
         //   onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
         placeholderNumberType: "MOBILE",
         //   preferredCountries: ['cn', 'jp'],
         separateDialCode: true,
         
         utilsScript: "build/js/utils.js",
         });
         
      </script>
      <script>
         $(document).ready(function(){
            let country_code = $(".iti__selected-dial-code").html()

            $("input[name=country_code]").val(country_code)
         })

         $(".iti__selected-dial-code").on('DOMSubtreeModified',function(){
            let country_code = $(".iti__selected-dial-code").html()

            $("input[name=country_code]").val(country_code)
         })
      </script>
@stop