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
   textarea
   {
       height: 75px !important;
   }

   .bootstrap-tagsinput
   {
       min-height: 100px;
       width: 100% !important;
   }
   .bootstrap-tagsinput input
   {
       margin-top: 5px !important;
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
          <h4 class="page-title m-b-0">Create Tenant</h4>
       </li>
       <li class="breadcrumb-item">
          <a href="file:///F:/AMS/tenantlist.html">
          <i class="fas fa-home"></i></a>
       </li>
    </ul> --}}
    <div class="section-body">
    <div class="row">
    <div class="col-12" >
    <form method="POST" action="{{ route('tenants.store') }}" enctype="multipart/form-data" autocomplete="off">
    <div class="card">
       <div class="card-header">
          <h4>Tenant Information</h4>
       </div>
       <div class="card-body">
                @csrf
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Tenant First Name <sup class="text-danger">*</sup></label>
                        <input type="text" value="{{old('tenant_first_name')}}" maxLength="20" name="tenant_first_name" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Tenant Last Name <sup class="text-danger">*</sup></label>
                        <input type="text" value="{{old('tenant_last_name')}}" maxLength="20" name="tenant_last_name" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label style="display:block;">Contact Number <sup class="text-danger">*</sup></label>
                        <input type="tel" maxLength="11" value="{{old('tenant_mobile_phone')}}" name="tenant_mobile_phone" id="contactNo" class="form-control">
                        <input type="hidden" name="country_code" value="" >
                    </div>
                    <div class="form-group col-md-4">
                        <label>Tenant Email <sup class="text-danger">*</sup></label>
                        <input type="email" value="{{old('tenant_email_address')}}" name="tenant_email_address" required class="form-control">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Date of birth <sup class="text-danger">*</sup></label>
                        <input type="text" value="{{old('tenant_date_of_birth')}}" name="tenant_date_of_birth" class="form-control datepicker">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Image <sup class="text-danger">*</sup> <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="right"
                      title="Image size should be 2 MB and Image should be in jpg and png format."></i></label>
                        <input type="file" name="tenant_image" accept="image/png,image/jpeg,image/jpg" class="form-control">
                    </div>
                    
                    <!--<div class="form-group col-md-4">-->
                    <!--    <label>Password</label>-->
                    <!--    <input type="text" value="{{old('password')}}" name="password"  class="form-control">-->
                    <!--</div>-->
                    <div class="form-group col-md-4">
                        <label>Present Address <sup class="text-danger">*</sup></label>
                        <textarea name="tenant_present_address"  class="form-control">{{old('tenant_present_address')}}</textarea>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Permanent Address <sup class="text-danger">*</sup></label>
                        <textarea name="tenant_permanent_address"  class="form-control">{{old('tenant_permanent_address')}}</textarea>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Home Country Address <sup class="text-danger">*</sup></label>
                        <textarea name="home_country_address"  class="form-control">{{old('home_country_address')}}</textarea>
                    </div>
                    <div class="form-group col-md-4">
                        <label>CPR Number</label>
                        <input type="text" maxlength="9" value="{{old('tenant_cpr_no')}}" name="tenant_cpr_no" class="form-control" id="cprNumber">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Passport Number <sup class="text-danger">*</sup></label>
                        <input type="text" maxlength="9" value="{{old('tenant_passport_number')}}" name="tenant_passport_number" class="form-control" id="cprNumber">
                     </div>
                    <div class="form-group col-md-4">
                        <label>Contract Period Start Date <sup class="text-danger">*</sup></label>
                        <input type="date" name="lease_period_start_datetime" value="{{old('lease_period_start_datetime')}}" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Contract Period End Date <sup class="text-danger">*</sup></label>
                        <input type="date" name="lease_period_end_datetime" value="{{old('lease_period_end_datetime')}}" class="form-control">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Emergency Email <sup class="text-danger">*</sup></label>
                        <input type="email" name="emergancy_email" value="{{old('emergancy_email')}}" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Tenant Type <sup class="text-danger">*</sup></label>
                        <select class="form-control" name="tenant_type_code">
                            @foreach ($tenant_types as $tenant_type)
                                <option value="{{ $tenant_type->tenant_type_code }}">{{ $tenant_type->tenant_type_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label>Tenant Passport Copy <sup class="text-danger">*</sup> <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="right"
                      title="Image size should be 2 MB and Image should be in jpg and png format."></i></label>
                        <input type="file" accept="image/png, image/jpeg" name="tenant_passport_copy" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Tenant CPR Copy <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="right"
                      title="Image size should be 2 MB and Image should be in jpg and png format."></i></label>
                        <input type="file" accept="image/png, image/jpeg" name="tenant_cpr_copy" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Tenant Contract Copy <sup class="text-danger">*</sup> <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="right"
                      title="Image size should be 2 MB and Image should be in jpg and png format."></i></label>
                        <input type="file" accept="image/png, image/jpeg" name="tenant_contract_copy" class="form-control">
                    </div>
                </div>
            </div>
            <div class="card-header">
                <h4>Apartment Information</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    {{-- <div class="form-group col-md-4">
                        <label for="">Floor Type <sup class="text-danger">*</sup></label>
                        <select class="form-control" name="floor_type_code" onchange="getFloors(this.value)" id="floor_type_code">
                          <option value="0" selected disabled>---Select---</option>
                          @foreach ($floor_types as $floor_type)
                              <option value="{{ $floor_type->floor_type_code }}">{{ $floor_type->floor_type_name }}</option>
                          @endforeach
                        </select>
                    </div> --}}
          
                    <div class="form-group col-md-3">
                        <label for="">Select Floor <sup class="text-danger">*</sup></label>
                        <select class="form-control" name="floor_id" style="height: 38px;" onchange="getUnits(this.value)" id="floorSelect">
                            <option value="0" selected disabled>---Select---</option>
                            @foreach ($floor_list as $floor)
                                <option value="{{ $floor->id }}">{{ $floor->number }}</option>
                            @endforeach
                        </select>
    
                    </div>
                    <div class="form-group col-md-3" >
                        <label>Select Apartment <sup class="text-danger">*</sup></label>
                        <select class="form-control" name="unit_id" id="unitSelect" style="height: 38px;"></select>
                    </div>
                    <div class="form-group col-md-6">
                        <label style="display: block;">Aditional Facilities</label>
                        <input type="text" value="{{old('all_facilities')}}" name="all_facilities" class="form-control inputtags" id="tags-input">
                      </div>
                    <div class="form-group col-md-4" >
                        <label>Total Rent <sup class="text-danger">*</sup></label>
                        <input type="text" value="{{old('total_rent')}}" name="total_rent" class="form-control" style="height: 38px;">
                    </div>
                </div>
                <button class="btn btn-primary mr-1" type="submit">Save</button>
                <a href="{{ url()->previous() }}" class="btn btn-primary mr-1">Cancel</a>
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
    $('.bootstrap-tagsinput input').keydown(function( event ) {
    if ( event.which == 13 ) {
        $(this).blur();
        $(this).focus();
        return false;
    }
})
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
            url: '{{route('floor.fetch_units','')}}' + "/"+ id,
            dataType: 'json',
            success: function (data) {
                console.log(data.options)
                $('#unitSelect').empty().append(data.options)
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
                  $('#unitSelect').empty().append(data.options1)
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