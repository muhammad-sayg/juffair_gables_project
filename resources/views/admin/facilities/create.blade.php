@extends('layouts.admin.app')
{{-- Page title --}}
@section('title')
    Juffair Gable
@stop
{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="{{asset('public/admin/assets/bundles/bootstrap-daterangepicker/daterangepicker.css') }}">
<style>
   textarea
   {
       height: 75px !important;
   }
</style>
@stop
@section('content')
<section class="section">
    {{-- <ul class="breadcrumb breadcrumb-style ">
       <li class="breadcrumb-item">
          <h4 class="page-title m-b-0">Create Facility</h4>
       </li>
       <li class="breadcrumb-item">
          <a href="file:///F:/AMS/tenantlist.html">
          <i class="fas fa-home"></i></a>
       </li>
    </ul> --}}
    <div class="section-body">
    <div class="row">
    <div class="col-12" >
    <form method="POST" action="{{ route('facilities.store') }}" enctype="multipart/form-data" autocomplete="off">
    <div class="card">
       <div class="card-header">
          <h4>Facility Information</h4>
       </div>
       <div class="card-body">
                @csrf
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Facility Name</label>
                        <input type="text" maxLength="20" name="name" class="form-control">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <button class="btn btn-primary mr-1" type="submit">Save</button>
                <a class="btn btn-primary mr-1" href="{{ URL::previous() }}">Cancel</a>

            </div>
        </form>
        </div>
    </div>
</section> 
@stop
@section('footer_scripts')
<script src="{{asset('public/admin/assets/bundles/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
