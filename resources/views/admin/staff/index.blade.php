@extends('layouts.admin.app')
{{-- Page title --}}
@section('title')
Juffair Gables
@stop
{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="{{asset('public/admin/assets/bundles/datatables/datatables.min.css')}}">
<link rel="stylesheet" href="{{asset('public/admin/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
<style>
     table.dataTable td img
    {
        box-shadow: 0 5px 15px 0 rgba(105,103,103,0.5);
        border: 2px solid #ffffff;
        border-radius: 10px;
    }

    table.dataTable td, table.dataTable th {
        vertical-align: middle;
    }
    tr:hover {
    background: #a3a3a3 !important;
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
    <li class="breadcrumb-item">Staffs</li>
    
    </ul> --}}
    <div class="row">
        <div class="col-lg-12">
            @if(request()->user()->can('create-staff'))
                <a href="{{ route('staff.create') }}" class="btn btn-icon icon-left float-right btn-primary mb-4" style="padding:7px 35px;"><i class="fas fa-plus"></i> Add Staff</a>
            @endif
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Active Staff List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport1" style="width:100%;">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Conctact No</th>
                                <th>Image</th>
                                <th>Designation</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                $key = 1;
                            @endphp
                            @foreach (collect($staffs)->where('is_passed', '!=', 1) as $staff)
                            <tr style="cursor:pointer">
                            <td data-href='{{ route('staff.show',$staff['id']) }}'> {{ $key }}</td>
                            <td data-href='{{ route('staff.show',$staff['id']) }}'> {{ $staff['name'] }}</td>
                            <td data-href='{{ route('staff.show',$staff['id']) }}'>{{ $staff['email']}}</td>
                            <td data-href='{{ route('staff.show',$staff['id']) }}'>{{ $staff['number'] }}</td>
                            <td data-href='{{ route('staff.show',$staff['id']) }}'>
                                @if(!empty($staff['image']))
                                <img src="{{ asset('public/admin/assets/img/staff')}}/{{ $staff['image'] }}" alt="" width="100" height="100">
                                @else
                                <img src="{{asset('public/admin/assets/img/staff/no-image.png')}}" alt="" width="100" height="100">
                                @endif
                            </td>
                            <td data-href='{{ route('staff.show',$staff['id']) }}'>
                                @if($staff['userType'] == 'officer')
                                  Accountant
                                  @else
                                  {{ ucwords(str_replace("-", " ",$staff['userType'])) }}
                                  @endif
                                
                                </td>
                            
                                {{-- <td>
                                    @if($staff['status'] ==1)
                                    <a  class="updateStaffStatus" id="staff-{{$staff['id']}}" staff_id="{{$staff['id']}}" href="javascript:void(0)"><i style="font-size:20px" class="fas fa-toggle-on text-success" status="Active" aria-hidden="true"></i></a>
                                    @else
                                    <a class="updateStaffStatus" id="staff-{{$staff['id']}}" staff_id="{{$staff['id']}}" href="javascript:void(0)"><i style="font-size:20px" class="fas fa-toggle-off text-danger" status="Inactive" aria-hidden="true"></i></a>
                                    @endif
                                </td> --}}
                                <td>
                                    <div class="dropdown">
                                        <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Action</a>
                                        <div class="dropdown-menu">
                                        <a href="{{ route('staff.show',$staff['id']) }}" class="dropdown-item has-icon"><i class="fas fa-eye"></i> View</a>
                                        @if(request()->user()->can('edit-staff'))
                                        <a href="{{ route('staff.edit', $staff['id']) }}" class="dropdown-item has-icon"><i class="far fa-edit"></i> Edit</a>
                                        @endif
                                        <div class="dropdown-divider"></div>
                                        <a href="{{ route('staff.passed', $staff['id']) }}"  class="dropdown-item has-icon"><i class="far fa-user"></i>
                                            Passed</a>
                                    </div>
                                    @if(request()->user()->can('delete-staff'))
                                    <form action="{{ route('staff.delete', $staff['id']) }}"
                                            method="post" id="staff-{{ $staff['id'] }}">
                                            @csrf @method('delete')
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @php
                                $key++;
                            @endphp  
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Passed Staff List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport2" style="width:100%;">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Conctact No</th>
                                <th>Image</th>
                                <th>Designation</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $key = 1;
                            @endphp
                            @foreach (collect($staffs)->where('is_passed', 1) as $staff)
                            <tr style="cursor:pointer">
                            <td data-href='{{ route('staff.show',$staff['id']) }}'> {{ $key }}</td>
                            <td data-href='{{ route('staff.show',$staff['id']) }}'> {{ $staff['name'] }}</td>
                            <td data-href='{{ route('staff.show',$staff['id']) }}'>{{ $staff['email']}}</td>
                            <td data-href='{{ route('staff.show',$staff['id']) }}'>{{ $staff['number'] }}</td>
                            <td data-href='{{ route('staff.show',$staff['id']) }}'>
                                @if(!empty($staff['image']))
                                <img src="{{ asset('public/admin/assets/img/staff')}}/{{ $staff['image'] }}" alt="" width="100" height="100">
                                @else
                                <img src="{{asset('public/admin/assets/img/staff/no-image.png')}}" alt="" width="100" height="100">
                                @endif
                            </td>
                            <td data-href='{{ route('staff.show',$staff['id']) }}'>
                                @if($staff['userType'] == 'officer')
                                  Accountant
                                  @else
                                  {{ ucwords(str_replace("-", " ",$staff['userType'])) }}
                                  @endif
                                </td>
                            
                                {{-- <td>
                                    @if($staff['status'] ==1)
                                    <a  class="updateStaffStatus" id="staff-{{$staff['id']}}" staff_id="{{$staff['id']}}" href="javascript:void(0)"><i style="font-size:20px" class="fas fa-toggle-on text-success" status="Active" aria-hidden="true"></i></a>
                                    @else
                                    <a class="updateStaffStatus" id="staff-{{$staff['id']}}" staff_id="{{$staff['id']}}" href="javascript:void(0)"><i style="font-size:20px" class="fas fa-toggle-off text-danger" status="Inactive" aria-hidden="true"></i></a>
                                    @endif
                                </td> --}}
                                <td>
                                    <div class="dropdown">
                                        <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Action</a>
                                        <div class="dropdown-menu">
                                        <a href="{{ route('staff.show',$staff['id']) }}" class="dropdown-item has-icon"><i class="fas fa-eye"></i> View</a>
                                        {{-- @if(request()->user()->can('edit-staff'))
                                        <a href="{{ route('staff.edit', $staff['id']) }}" class="dropdown-item has-icon"><i class="far fa-edit"></i> Edit</a>
                                        @endif
                                        <div class="dropdown-divider"></div>
                                        <a href="{{ route('staff.passed', $staff['id']) }}"  class="dropdown-item has-icon"><i class="far fa-user"></i>
                                            Passed</a> --}}
                                    </div>
                                    {{-- @if(request()->user()->can('delete-staff'))
                                    <form action="{{ route('staff.delete', $staff['id']) }}"
                                            method="post" id="staff-{{ $staff['id'] }}">
                                            @csrf @method('delete')
                                    </form>
                                    @endif --}}
                                </td>
                            </tr>
                            @php
                                $key++;
                            @endphp  
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
<script>
    $("tr td:not(:last-child)").click(function() {
        window.location = $(this).data("href");
    });

    $('#tableExport1').DataTable({
    dom: 'lBfrtip',
    "ordering": true,
    buttons: [
        {
            extend: 'excel',
            text: 'Excel',
            className: 'btn btn-default',
            exportOptions: {
                columns: [0,1,2,3,5]
            },
            filename: function(){
                return 'active_staff_list';
            },
        },
        {
            extend: 'csv',
            text: 'Csv',
            className: 'btn btn-secondary',
            exportOptions: {
                columns: [0,1,2,3,5]
            },
            filename: function(){
                return 'active_staff_list';
            },
        },
        {
            extend: 'pdf',
            text: 'Pdf',
            title : function() {
                    return "Active Staff List";
            },
            className: 'btn btn-default',
            exportOptions: {
                columns: [0,1,2,3,5]
            },
            filename: function(){
                return 'active_staff_list';
            },
        },
        {
            extend: 'print',
            text: 'Print',
            title : function() {
                    return "Active Staff List";
            },
            className: 'btn btn-default',
            exportOptions: {
                columns: [0,1,2,3,5]
            },
            filename: function(){
                return 'active_staff_list';
            },
        },
    ],
    "lengthMenu": [10,25,50,100],
    
    });

    $('#tableExport2').DataTable({
    dom: 'lBfrtip',
    "ordering": true,
    buttons: [
        {
            extend: 'excel',
            text: 'Excel',
            className: 'btn btn-default',
            exportOptions: {
                columns: [0,1,2,3,5]
            },
            filename: function(){
                return 'passed_staff_list';
            },
        },
        {
            extend: 'csv',
            text: 'Csv',
            className: 'btn btn-secondary',
            exportOptions: {
                columns: [0,1,2,3,5]
            },
            filename: function(){
                return 'passed_staff_list';
            },
        },
        {
            extend: 'pdf',
            text: 'Pdf',
            title : function() {
                    return "Passed Staff List";
            },
            className: 'btn btn-default',
            exportOptions: {
                columns: [0,1,2,3,5]
            },
            filename: function(){
                return 'passed_staff_list';
            },
        },
        {
            extend: 'print',
            text: 'Print',
            title : function() {
                    return "Passed Staff List";
            },
            className: 'btn btn-default',
            exportOptions: {
                columns: [0,1,2,3,5]
            },
            filename: function(){
                return 'passed_staff_list';
            },
        },
    ],
    "lengthMenu": [10,25,50,100],
    
    });
</script>
@stop