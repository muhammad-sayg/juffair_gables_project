@extends('layouts.admin.app')
{{-- Page title --}}
{{-- @section('title')
    AMS
@stop --}}
{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="{{ asset('public/admin/assets/') }}/bundles/datatables/datatables.min.css">
<link rel="stylesheet" href="{{ asset('public/admin/assets/') }}/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('public/admin/assets/bundles/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('public/admin/assets/') }}/bundles/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
<style>
   tr:hover {
    background: #a3a3a3 !important;
   }
   .bg-row
   {
      background-color: #ee8c8c;
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
      <li class="breadcrumb-item">Facilities</li>
    </ul> --}}
     <div class="row">
     <div class="col-12">
            <a  href="{{ route('facilities.create') }}" class="btn btn-primary float-right mb-4" style="padding:7px 35px" role="button">Add Facility</a>
          </div>
      <div class="col-12">
        <div class="card">
          <div class="card-header">
           <h4>Facilities list</h4>
            
            
            <div class="card-header-form">
         
                <!-- <a href="{{ route('facilities.create') }}" class="btn btn-primary" role="button">Add Facility</a> -->
       
            </div>
          </div>
            
            <div class="card-body">
              <div class="table-responsive">
                <table id="tableExport1" class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Facility Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach( $allfacilities as $key => $facility)
                    <tr style="cursor:pointer;">
                        <td onclick="getFacilityDetails({{ $facility->id }})">{{ $key+1 }}</td>
                        <td onclick="getFacilityDetails({{ $facility->id }})">{{ $facility->name }} </td>
                        <td>
                          <div class="dropdown">
                            <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Action</a>
                            <div class="dropdown-menu">
                              <a href="#" onclick="getFacilityDetails({{ $facility->id }})" class="dropdown-item has-icon"><i class="fas fa-eye"></i> View</a>
                           
                              <a href="{{ route('facilities.edit',$facility->id) }}" class="dropdown-item has-icon"><i class="far fa-edit"></i> Edit</a>
                              
                              <div class="dropdown-divider"></div>
                              <a href="#" onclick="form_alert('facilities-{{ $facility->id }}','Want to delete this facility')" class="dropdown-item has-icon text-danger"><i class="far fa-trash-alt"></i>
                                Delete</a>
                            
                            </div>
                          </div>
                          <form action="{{route('facilities.delete',[$facility->id])}}"
                              method="post" id="facilities-{{ $facility->id }}">
                                @csrf @method('delete')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  {{-- facilities view modal --}}
<div class="modal" id="facilitiesModal" tabindex="-1" role="dialog" aria-labelledby="formModal"  aria-modal="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModal">View</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="card-body">
        <form class="table-responsive">
          <table id="mainTable" class="table table-striped">
            <tbody>
              @include('admin.facilities.partials.facilities_view_modal')
            </tbody>
          </table>
      </div>
    </div>
  </div>
</div>
@stop
@section('footer_scripts')
<!-- JS Libraies -->
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
<script src="{{ asset('public/admin/assets/') }}/bundles/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="{{asset('public/admin/assets/bundles/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script>
  function getFacilityDetails(id) {
    $.get({
        url: '{{route('facilities.show', '')}}' + "/"+ id,
        dataType: 'json',
        success: function (data) {
            console.log(data.options)
            $("#facilitiesModal tbody").html(data.html_response)
            $("#facilitiesModal").modal("show")
        }
    });
  }

  $('#tableExport1').DataTable({
    dom: 'lBfrtip',
    "ordering": true,
    buttons: [
        {
            extend: 'excel',
            text: 'Excel',
            className: 'btn btn-default',
            exportOptions: {
                columns: [0,1]
            },
            filename: function(){
                return 'facilities_list';
            },
        },
        {
            extend: 'csv',
            text: 'Csv',
            className: 'btn btn-secondary',
            exportOptions: {
                columns: [0,1]
            },
            filename: function(){
                return 'facilities_list';
            },
        },
        {
            extend: 'pdf',
            text: 'Pdf',
            title : function() {
                    return "All Facilities";
            },
            className: 'btn btn-default',
            exportOptions: {
                columns: [0,1]
            },
            filename: function(){
                return 'facilities_list';
            },
        },
        {
            extend: 'print',
            text: 'Print',
            title : function() {
                    return "All Facilities";
            },
            className: 'btn btn-default',
            exportOptions: {
                columns: [0,1]
            },
            filename: function(){
                return 'facilities_list';
            },
        },
    ],
    "lengthMenu": [10,25,50,100],
    
    });
</script>
@stop