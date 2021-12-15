@extends('layouts.admin.app')
{{-- Page title --}}
@section('title')
Juffair Gable
@stop
{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="{{ asset('public/admin/assets/') }}/bundles/datatables/datatables.min.css">
<link rel="stylesheet" href="{{ asset('public/admin/assets/') }}/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
<style>
   tr:hover {
    background: #a3a3a3 !important;
   }

  
   @media print {
    body
    {
    border-top: hidden;
    width: 100%;
    height: auto;
    }
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
      <li class="breadcrumb-item">Tenants</li>
    </ul> --}}
     <div class="row">
       <div class="col-12">
         @if(request()->user()->can('add-tenant') OR \Auth::user()->userType == 'officer')
           <a href="{{ route('tenants.create') }}" style="padding:7px 35px;" class="btn btn-primary mb-4 float-right" role="button">Add Tenant</a>
         @endif
       </div>
      <div class="col-12">
        <div class="card">
          <div class="card-header">
           <h4>Active Tenant list</h4>
          </div>
            
            <div class="card-body">
              <div class="table-responsive">
                <table id="tableExport1" class="table table-responsive table-striped display nowrap"  width="100%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Tenant Name</th>
                      <th>Tenant Email</th>
                      <th>Contact Number</th>
                      <th>Date of Birth</th>
                      <th>Tenant Present Address</th>
                      <th>Tenant Permanent Address</th>
                      <th>Contract Start Date</th>
                      <th>Contract End Date</th>
                      <th>Emergancy Email</th>
                      <th>Emergancy Contact Number</th>
                      <th>Apartment No</th>
                      <th>Apartment Rent</th>
                      @if(request()->user()->userType != 'employee')
                      <th>Action</th>
                      @endif
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($tenants->where('is_passed','!=', 1) as $key => $tenant)
                    <tr style="cursor:pointer;">
                        <td data-href='{{ route('tenants.show',$tenant->id) }}'>{{ $key+1 }}</td>
                        <td data-href='{{ route('tenants.show',$tenant->id) }}'>{{ $tenant->tenant_first_name }} {{ $tenant->tenant_last_name }}</td>
                        <td data-href='{{ route('tenants.show',$tenant->id) }}'>{{ $tenant->tenant_email_address  }}</td>
                        <td data-href='{{ route('tenants.show',$tenant->id) }}'>{{ $tenant->tenant_mobile_phone }}</td>
                        <td data-href='{{ route('tenants.show',$tenant->id) }}'>{{ isset($tenant->tenant_date_of_birth) ? \Carbon\Carbon::parse($tenant->tenant_date_of_birth)->format('d-m-Y') : '' }}</td>
                        <td data-href='{{ route('tenants.show',$tenant->id) }}'>{{ $tenant->tenant_present_address  }}</td>
                        <td data-href='{{ route('tenants.show',$tenant->id) }}'>{{ $tenant->tenant_permanent_address  }}</td>
                        <td data-href='{{ route('tenants.show',$tenant->id) }}'>{{ isset($tenant->lease_period_start_datetime) ? \Carbon\Carbon::parse($tenant->lease_period_start_datetime)->toFormattedDateString() : '' }}</td>
                        <td data-href='{{ route('tenants.show',$tenant->id) }}'>{{ isset($tenant->lease_period_end_datetime) ? \Carbon\Carbon::parse($tenant->lease_period_end_datetime)->toFormattedDateString() : '' }}</td>
                        <td data-href='{{ route('tenants.show',$tenant->id) }}'>{{ $tenant->emergancy_email }}</td>
                        <td data-href='{{ route('tenants.show',$tenant->id) }}'>{{ $tenant->emergancy_contact_number }}</td>
                        <td data-href='{{ route('tenants.show',$tenant->id) }}'>{{ isset($tenant->unit) ? $tenant->unit->unit_number : '' }}</td>
                        <td data-href='{{ route('tenants.show',$tenant->id) }}'>{{ (int)$tenant->tenant_rent  }} BD</td>
                        <td>
                          <div class="dropdown">
                            <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Action</a>
                            <div class="dropdown-menu">
                              <a href="{{ route('tenants.show',$tenant->id) }}" class="dropdown-item has-icon"><i class="fas fa-eye"></i> View</a>
                              @if(request()->user()->can('edit-tenant'))
                              <a href="{{ route('tenants.edit',$tenant->id) }}" class="dropdown-item has-icon"><i class="far fa-edit"></i> Edit</a>
                              @endif

                              <div class="dropdown-divider"></div>
                              <a href="{{ route('tenants.passed', $tenant->id) }}"  class="dropdown-item has-icon"><i class="far fa-user"></i>
                                Passed</a>
                             
                            </div>
                          </div>
                          
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
        </div>
        <div class="card">
          <div class="card-header">
           <h4>Passed Tenant list</h4>
          </div>
            
            <div class="card-body">
              <div class="table-responsive">
                <table id="tableExport2" class="table table-responsive display nowrap"  width="100%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Tenant Name</th>
                      <th>Tenant Email</th>
                      <th>Contact Number</th>
                      <th>Date of Birth</th>
                      <th>Tenant Present Address</th>
                      <th>Tenant Permanent Address</th>
                      <th>Contract Start Date</th>
                      <th>Contract End Date</th>
                      <th>Emergancy Email</th>
                      <th>Emergancy Contact Number</th>
                      <th>Apartment No</th>
                      <th>Apartment Rent</th>
                      @if(request()->user()->userType != 'employee')
                      <th>Action</th>
                      @endif
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($tenants->where('is_passed', 1) as $key => $tenant)
                    <tr style="cursor:pointer;">
                      <td data-href='{{ route('tenants.show',$tenant->id) }}'>{{ $key+1 }}</td>
                      <td data-href='{{ route('tenants.show',$tenant->id) }}'>{{ $tenant->tenant_first_name }} {{ $tenant->tenant_last_name }}</td>
                      <td data-href='{{ route('tenants.show',$tenant->id) }}'>{{ $tenant->tenant_email_address  }}</td>
                      <td data-href='{{ route('tenants.show',$tenant->id) }}'>{{ $tenant->tenant_mobile_phone }}</td>
                      <td data-href='{{ route('tenants.show',$tenant->id) }}'>{{ isset($tenant->tenant_date_of_birth) ? \Carbon\Carbon::parse($tenant->tenant_date_of_birth)->format('d-m-Y') : '' }}</td>
                      <td data-href='{{ route('tenants.show',$tenant->id) }}'>{{ $tenant->tenant_present_address  }}</td>
                      <td data-href='{{ route('tenants.show',$tenant->id) }}'>{{ $tenant->tenant_permanent_address  }}</td>
                      <td data-href='{{ route('tenants.show',$tenant->id) }}'>{{ isset($tenant->lease_period_start_datetime) ? \Carbon\Carbon::parse($tenant->lease_period_start_datetime)->toFormattedDateString() : '' }}</td>
                      <td data-href='{{ route('tenants.show',$tenant->id) }}'>{{ isset($tenant->lease_period_end_datetime) ? \Carbon\Carbon::parse($tenant->lease_period_end_datetime)->toFormattedDateString() : '' }}</td>
                      <td data-href='{{ route('tenants.show',$tenant->id) }}'>{{ $tenant->emergancy_email }}</td>
                      <td data-href='{{ route('tenants.show',$tenant->id) }}'>{{ $tenant->emergancy_contact_number }}</td>
                      <td data-href='{{ route('tenants.show',$tenant->id) }}'>{{ isset($tenant->unit) ? $tenant->unit->unit_number : '' }}</td>
                      <td data-href='{{ route('tenants.show',$tenant->id) }}'>{{ (int)$tenant->tenant_rent  }} BD</td>
                        <td>
                          <div class="dropdown">
                            <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Action</a>
                            <div class="dropdown-menu">
                              <a href="{{ route('tenants.show',$tenant->id) }}" class="dropdown-item has-icon"><i class="fas fa-eye"></i> View</a>
                              <!-- @if(request()->user()->can('edit-tenant'))
                              <a href="{{ route('tenants.edit',$tenant->id) }}" class="dropdown-item has-icon"><i class="far fa-edit"></i> Edit</a>
                              @endif -->
                              <a href="{{ route('tenants.reactivate',$tenant->id) }}" class="dropdown-item has-icon"><i class="fas fa-sync-alt"></i> Reactivate</a>

                            </div>
                          </div>
                          
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
    </div>
  </section>
@stop
@section('footer_scripts')
<!-- JS Libraies -->
<script src="{{ asset('public/admin/assets/') }}/bundles/datatables/datatables.min.js"></script>
<script src="{{ asset('public/admin/assets/') }}/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('public/admin/assets/') }}/bundles/jquery-ui/jquery-ui.min.js"></script>
<!-- Page Specific JS File -->
<script src="{{ asset('public/admin/assets/') }}/js/page/datatables.js"></script>
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
            title : function() {
                    return "Active Tenant List";
            },
            className: 'btn btn-default',
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8,9,10,11,12]
            },
            filename: function(){
                return 'active_tenant_list';
            },
        },
        {
            extend: 'csv',
            text: 'Csv',
            title : function() {
                    return "Active Tenant List";
            },
            className: 'btn btn-secondary',
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8,9,10,11,12]
            },
            filename: function(){
                return 'active_tenant_list';
            },
        },
        {
            extend: 'pdf',
            text: 'Pdf',
            title : function() {
                    return "Active Tenant List";
            },
            className: 'btn btn-default',
            orientation : 'landscape',
            pageSize : 'LEGAL',
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8,9,10,11,12]
            },
            filename: function(){
                return 'active_tenant_list';
            },
        },
        {
            extend: 'print',
            text: 'Print',
            title : function() {
                    return "Active Tenant List";
            },
            className: 'btn btn-default',
            customize: function (win) {
                $(win.document.body)
                    .css('font-size', '10pt');
        
                $(win.document.body).find('table')
                    .addClass('compact')
                    .css('font-size', 'inherit');
            },
            exportOptions: {
              columns: ":visible"
            },
            filename: function(){
                return 'active_tenant_list';
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
                columns: [0,1,2,3,4,5,6,7,8,9,10,11,12]
            },
            filename: function(){
                return 'passed_tenant_list';
            },
        },
        {
            extend: 'csv',
            text: 'Csv',
            className: 'btn btn-secondary',
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8,9,10,11,12]
            },
            filename: function(){
                return 'passed_tenant_list';
            },
        },
        {
            extend: 'pdf',
            text: 'Pdf',
            title : function() {
                    return "Active Tenant List";
            },
            className: 'btn btn-default',
            orientation : 'landscape',
            pageSize : 'LEGAL',
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8,9,10,11,12]
            },
            filename: function(){
                return 'passed_tenant_list';
            },
        },
        {
            extend: 'print',
            text: 'Print',
            title : function() {
                    return "Active Tenant List";
            },
            className: 'btn btn-default',
            customize: function (win) {
                $(win.document.body)
                    .css('font-size', '10pt');
        
                $(win.document.body).find('table')
                    .addClass('compact')
                    .css('font-size', 'inherit');
            },
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8,9,10,11,12]
            },
            filename: function(){
                return 'passed_tenant_list';
            },
        },
    ],
    "lengthMenu": [10,25,50,100],
    
    });
</script>
@stop