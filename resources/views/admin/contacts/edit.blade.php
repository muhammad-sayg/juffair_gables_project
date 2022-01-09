@extends('layouts.admin.app')
{{-- Page title --}}
@section('title')
    Juffair Gables
@stop
{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="{{asset('public/admin/assets/bundles/bootstrap-daterangepicker/daterangepicker.css') }}">
<style>
   textarea.form-control {
        height: 80px !important;
    }
</style>
@stop
@section('content')

<section class="section">
    {{-- <ul class="breadcrumb breadcrumb-style ">
       <li class="breadcrumb-item">
          <h4 class="page-title m-b-0">Update Contacts Form</h4>
       </li>
       <li class="breadcrumb-item">
          <a href="file:///F:/AMS/tenantlist.html">
          <i class="fas fa-home"></i></a>
       </li>
    </ul> --}}
    <div class="section-body">
    <div class="row">
        <div class="col-12" >
            <form method="POST" action="{{ route('contacts.update', $allcontacts->id) }}" enctype="multipart/form-data" autocomplete="off">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Contact Information</h4>
                    </div>
                    <div class="card-body">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Company  Name</label>
                                <input type="text" name="company_name" value="{{ isset($allcontacts->company_name)? $allcontacts->company_name : '' }}" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Contact  Person</label>
                                <input type="text" name="contact_person" value="{{ isset($allcontacts->contact_person)? $allcontacts->contact_person : '' }}" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Job  Title</label>
                                <input type="text" name="job_title" value="{{ isset($allcontacts->job_title)? $allcontacts->job_title : '' }}" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Contact  Number</label>
                                <input type="text" name="number"  id="contactNo" value="{{ isset($allcontacts->number)? $allcontacts->number : '' }}" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Scope of Work</label>
                                <textarea name="scope_of_work" class="form-control">{{ isset($allcontacts->scope_of_work)? $allcontacts->scope_of_work : '' }}</textarea>
                            </div>
                        </div>
                        <button class="btn btn-primary mr-1" type="submit">Update</button>
                        <a class="btn btn-primary mr-1" href="{{ URL::previous() }}">Cancel</a>
                        
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>    
@stop
@section('footer_scripts')
<script src="{{asset('public/admin/assets/bundles/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
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

    </script>
@stop