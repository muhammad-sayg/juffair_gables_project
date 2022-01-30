@extends('layouts.admin.app')
{{-- Page title --}}
@section('title')
Juffair Gables
@stop
{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="{{asset('public/admin/assets/bundles/datatables/datatables.min.css')}}">
<link rel="stylesheet" href="{{asset('public/admin/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{  asset('public/assets/css/intlTelInput.css') }}">
<style>
   textarea
   {
   height: 64px !important;
   }
    .iti--allow-dropdown
   {
       width:100%;
   }
</style>
@stop
@section('content')
<section class="section">
   {{-- 
   <ul class="breadcrumb breadcrumb-style ">
      <li class="breadcrumb-item">
         <a href="index.html">
         <i class="fas fa-home"></i></a>
      </li>
      <li class="breadcrumb-item">Staff Details</li>
      <li class="breadcrumb-item">Add Staff</li>
   </ul>
   --}}
   <div class="section-body">
   <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
         <div class="card">
            <form 
               action="{{route('staff.store') }}" 
               method="POST"  enctype="multipart/form-data" autocomplete="off">
               @csrf
               <div class="card-header">
                  <h4>Add Staff</h4>
               </div>
               <div class="card-body">
                  <div class="form-group row">
                     <div class="form-group col-md-4">
                        <label for="name">Name <sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control" autocomplete="off" required="" name="name" id="name"
                           value="{{ old('name')}}" 
                           placeholder="Staff name">
                        <div class="invalid-feedback">
                           Staff Name is required?
                        </div>
                     </div>
                     <div class="form-group col-md-4">
                        <label for="number">Contact Number <sup class="text-danger">*</sup></label>
                        <input type="tel" maxLength="11"  class="form-control" autocomplete="off" name="number" id="number" required="" 
                           value="{{ old('number')}}" 
                           placeholder="Staff contact number">
                           <input type="hidden" name="country_code" value="" >
                        <div class="invalid-feedback">
                           Staff number is required?
                        </div>
                     </div>
                     <div class="form-group col-md-4">
                        <label for="email">Email <sup class="text-danger">*</sup></label>
                        <input type="email" class="form-control" autocomplete="off" required="" name="email" id="email" placeholder="Enter Staff email"
                           value="{{ old('email')}}">
                        <div class="invalid-feedback">
                           Please add an email
                        </div>
                     </div>
                     <div class="form-group col-md-4">
                        <label>Date of birth <sup class="text-danger">*</sup></label>
                        <input type="date" value="{{ old('staff_date_of_birth') }}" name="staff_date_of_birth" class="form-control">
                     </div>
                     <div class="form-group col-md-4">
                        <label for="password">Password <sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control" autocomplete="off" required="" name="password" id="password" placeholder="Enter password">
                        <div class="invalid-feedback">
                           Please add password
                        </div>
                     </div>
                     <div class="col-md-4 col-12">
                        <div class="form-group">
                           <label for="staff_image">Staff Image <sup class="text-danger">*</sup><i class="fas fa-info-circle" data-toggle="tooltip" data-placement="right"
                      title="Image size should be 2 MB and Image should be in jpg and png format."></i></label>
                           <div class="input-group">
                              <div class="custom-file">
                                 <input type="file"
                                    id="staff_image" name="staff_image"
                                    accept="image/jpeg,image/png">
                              </div>
                           </div>
                        </div>
                     </div>
                     
                     <div class="form-group col-md-4">
                        <label>Annual Leaves <sup class="text-danger">*</sup></label>
                        <input type="text" value="{{old('annual_leaves')}}" name="annual_leaves" class="form-control" id="annual_leaves"></input>
                     </div>
                     <div class="form-group col-md-4">
                        <label>Total Salary (BD) <sup class="text-danger">*</sup></label>
                        <input type="text" value="{{old('sallery')}}" name="sallery" class="form-control" id="sallery"></input>
                     </div>

                     <div class="form-group col-md-4">
                        <label>Present Address <sup class="text-danger">*</sup></label>
                        <textarea name="staff_present_address" class="form-control">{{ old('staff_present_address') }}</textarea>
                     </div>
                     <div class="form-group col-md-4">
                        <label>Permanent Address <sup class="text-danger">*</sup></label>
                        <textarea name="staff_permanent_address" class="form-control">{{ old('staff_permanent_address') }}</textarea>
                     </div>
                     <div class="form-group col-md-4">
                        <label>CPR Number </label>
                        <input type="text" maxlength="9" name="staff_cpr_no" class="form-control" value="{{ old('staff_cpr_no') }}" id="cprNumber">
                     </div>
                     <div class="form-group col-md-4">
                        <label>Passport Number <sup class="text-danger">*</sup></label>
                        <input type="text" maxlength="9" name="passport_number" class="form-control" value="{{ old('passport_number') }}" id="cprNumber">
                     </div>
                     <div class="form-group col-md-4">
                        <label>Contract Start Date <sup class="text-danger">*</sup></label>
                        <input type="date" value="{{ old('lease_period_start_datetime') }}" name="lease_period_start_datetime" class="form-control">
                     </div>
                     <div class="form-group col-md-4">
                        <label>Contract End Date <sup class="text-danger">*</sup></label>
                        <input type="date" value="{{ old('lease_period_end_datetime') }}" name="lease_period_end_datetime" class="form-control">
                     </div>
                     <div class="form-group col-md-4">
                        <label>Passport Copy <sup class="text-danger">*</sup><i class="fas fa-info-circle" data-toggle="tooltip" data-placement="right"
                      title="Image size should be 2 MB and Image should be in jpg and png format."></i></label>
                        <input type="file" accept="image/png, image/jpeg,image/jpg" name="staff_passport_copy" class="form-control">
                     </div>
                     <div class="form-group col-md-4">
                        <label>CPR Copy <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="right"
                      title="Image size should be 2 MB and Image should be in jpg and png format."></i></label>
                        <input type="file" accept="image/png, image/jpeg,image/jpg" name="staff_cpr_copy" class="form-control">
                     </div>
                     <div class="form-group col-md-4">
                        <label>Contract Copy <sup class="text-danger">*</sup><i class="fas fa-info-circle" data-toggle="tooltip" data-placement="right"
                      title="Image size should be 2 MB and Image should be in jpg and png format."></i></label>
                        <input type="file" accept="image/png, image/jpeg,image/jpg" name="staff_contract_copy" class="form-control">
                     </div>
                     <div class="form-group col-md-12" style="margin-right: 10px">
                        <label>Assign Role to Staff <sup class="text-danger">*</sup></label> <br>
                        @foreach($roles as $key=>$role )
                        <input type="radio" name="staffType" value="{{$role['slug']}}">
                       
                        @if($role['name'] == 'Officer')
                        Accountant <br>
                        @else
                        {{$role['name']}} <br>
                        @endif
                        @endforeach
                        <div class="invalid-feedback">
                           Please select role for the staff
                        </div>
                     </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Save</button>
                  <a href="{{ url()->previous() }}" type="button" class="btn btn-primary">Cancel</a>
            </form>
            </div>
         </div>
      </div>
   </div>
</section>
@stop
@section('footer_scripts')
<!-- JS Libraies -->
<script src="{{asset('public/admin/assets/bundles/datatables/datatables.min.js')}}"></script>
<script src="{{asset('public/admin/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/admin/assets/bundles/datatables/export-tables/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('public/admin/assets/bundles/datatables/export-tables/buttons.flash.min.js')}}"></script>
<script src="{{asset('public/admin/assets/bundles/datatables/export-tables/jszip.min.js')}}"></script>
<script src="{{asset('public/admin/assets/bundles/datatables/export-tables/pdfmake.min.js')}}"></script>
<script src="{{asset('public/admin/assets/bundles/datatables/export-tables/vfs_fonts.js')}}"></script>
<script src="{{asset('public/admin/assets/bundles/datatables/export-tables/buttons.print.min.js')}}"></script>
<script src="{{asset('public/admin/assets/js/page/datatables.js')}}"></script>
<script src="{{  asset('public/assets/js/intlTelInput.js') }}"></script>
<script src="{{ asset('public/assets/js/intlTelInput.js')}}"></script>
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
   
      
       $("#number").inputFilter(function(value) {
       return /^[+-]?\d*$/.test(value); });
   
       $("#cprNumber").inputFilter(function(value) {
       return /^-?\d*$/.test(value); });
   
       $("#sallery").inputFilter(function(value) {
       return /^[+-]?\d*$/.test(value); });
   
</script>
<script>
         var input = document.querySelector("#number");
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

