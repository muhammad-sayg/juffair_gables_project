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
          <h4 class="page-title m-b-0">Update Facility Form</h4>
       </li>
       <li class="breadcrumb-item">
          <a href="file:///F:/AMS/tenantlist.html">
          <i class="fas fa-home"></i></a>
       </li>
    </ul> --}}
    <div class="section-body">
    <div class="row">
        <div class="col-12" >
            <form method="POST" action="{{ route('facilities.update', $allfacilities->id) }}" enctype="multipart/form-data" autocomplete="off">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Facility Information</h4>
                    </div>
                    <div class="card-body">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Facility  Name</label>
                                <input type="text" name="name" value="{{ isset($allfacilities->name)? $allfacilities->name : '' }}" class="form-control">
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