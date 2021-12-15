@extends('layouts.admin.app')
{{-- Page title --}}

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="{{ asset('public/admin/assets/') }}/bundles/datatables/datatables.min.css">
<link rel="stylesheet" href="{{ asset('public/admin/assets/') }}/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('public/admin/assets/bundles/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('public/admin/assets/') }}/bundles/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
  tr:hover {
    background: #a3a3a3 !important;
    cursor: pointer;
  }
</style>
@stop
@section('content')
<section class="section">
   <div class="row">
        <div class="col-12">
          <a href="{{ route('rent.create') }}" type="button"  class="btn btn-primary float-right mb-4" style="padding: 7px 35px;">Add Rent</a>
        </div>
        <div class="col-12">
            <div class="card" style="padding:15px 15px">
                <form action="{{ route('rent.search') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="">Select Tenant</label>
                            <select name="tenant_id" class="form-control"  id="" style="height: 37px;">
                              <option value="0">--- Select ---</option>
                              @foreach ($tenant_list as $tenant)
                                  <option value="{{ $tenant->id }}" @if(isset($tenant_id) && $tenant_id == $tenant->id) selected @endif>{{ $tenant->tenant_first_name }} {{ $tenant->tenant_last_name }}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Rent Month</label>
                            <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                              <input type="text" value="{{ isset($rent_month) ? $rent_month : '' }}" name="rent_month" class="form-control datetimepicker-input" data-target="#datetimepicker1"/>
                              <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                          <label for="">Rent Status</label>
                          <select name="rent_paid_status_code" class="form-control"  id="" style="height: 37px;">
                            <option value="0">--- Select ---</option>
                            @foreach ($rent_paid_status as $item)
                                  <option value="{{ $item->rent_paid_status_code }}" @if(isset($rent_paid_status_code) && $rent_paid_status_code == $item->rent_paid_status_code) selected @endif>{{ $item->rent_paid_status_name }}</option>
                            @endforeach
                          </select>
                      </div>
                        <div class="form-group col-md-1" style="margin-top: 1.90rem !important;">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
        </div>
   </div>
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Rents Detail</h4>
              <div class="card-header-form">
              
              </a>
            </div>
            </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tableExport1" class="table table-responsive table-striped display nowrap"  width="100%">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Tenant Name</th>
                        <th>Apartment No</th>
                        <th>Amount</th>
                        <th>Received Amount</th>
                        <th>Received Date</th>
                        <th>Rent Month</th>
                        <th>Rent Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($rent_details as $key => $item)
                      <tr>
                          <td onclick="getRentDetails({{ $item->id }})">{{ $key+1 }}</td>
                          <td onclick="getRentDetails({{ $item->id }})">{{ isset($item->tenant) ? $item->tenant->tenant_first_name.' '.$item->tenant->tenant_last_name : ''}}</td>
                          <td onclick="getRentDetails({{ $item->id }})">{{ isset($item->tenant->unit) ? $item->tenant->unit->unit_number : '' }}</td>
                          <td onclick="getRentDetails({{ $item->id }})">{{ round($item->rent_amount,0) }} BD</td>
                          <td onclick="getRentDetails({{ $item->id }})">{{ isset($item->received_amount) ? round($item->received_amount,0). ' BD' : '' }}</td>
                          <td onclick="getRentDetails({{ $item->id }})">{{ isset($item->received_date) ? \Carbon\Carbon::parse($item->received_date)->toFormattedDateString() : '' }}</td>
                          <td onclick="getRentDetails({{ $item->id }})">
                            @php
                              if($item->rent_month != null)
                              {
                                $dateMonthArray = explode('-', $item->rent_month);
                                $month = $dateMonthArray[0];
                                $year = $dateMonthArray[1];
                                $date = \Carbon\Carbon::createFromDate($year, $month, 1);
                              }
                              else 
                              {
                                $dateMonthArray = explode('-', $item->rent_start_month);
                                $month = $dateMonthArray[0];
                                $year = $dateMonthArray[1];
                                $date1 = \Carbon\Carbon::createFromDate($year, $month, 1);

                                $dateMonthArray = explode('-', $item->rent_end_month);
                                $month = $dateMonthArray[0];
                                $year = $dateMonthArray[1];
                                $date2 = \Carbon\Carbon::createFromDate($year, $month, 1);
                              }
                            @endphp
                            @if($item->rent_month != null)
                            {{ $date->format('M Y') }}
                            @else
                            {{ $date1->format('M Y') }} -  {{ $date2->format('M Y') }}
                            @endif
                          </td>
                          <td onclick="getRentDetails({{ $item->id }})">
                            @php
                                $class = '';
                                switch ($item->rent_paid_status_code) {
                                case 1:
                                    $class = 'badge-success';
                                    break;
                                default:
                                    $class = 'badge-warning';
                                    break;
                                }
                            @endphp
                            <span class="badge {{ $class }}">{{ $item->rent_status ? $item->rent_status->rent_paid_status_name : ''}}</span>
                          </td>
                          <td>
                            <div class="dropdown">
                              <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Action</a>
                              <div class="dropdown-menu">
                                <a href="#" onclick="getRentDetails({{ $item->id }})" class="dropdown-item has-icon"><i class="fas fa-eye"></i> View</a>
                                @if($item->rent_paid_status_code == 2)
                                <a href="{{ route('rent.edit', $item->id) }}" class="dropdown-item has-icon"><i class="far fa-edit"></i> Edit</a>
                                @endif
                                <!-- <a href="#" onclick="form_alert('service_contract-{{ $item->id }}','Want to delete this Service Contract')" class="dropdown-item has-icon text-danger"><i class="far fa-trash-alt"></i>
                                  Delete</a> -->
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
    
</section>
{{-- Service Contract modal --}}
<div class="modal" id="rentDetailModal" tabindex="-1" role="dialog" aria-labelledby="formModal"  aria-modal="true">
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
             
            </tbody>
          </table>
      </div>
    </div>
  </div>
</div>
@stop
@section('footer_scripts')
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
<script src="https://foodlabriffa.ebahrain.biz/assets/bower_components/datepicker/js/bootstrap-datepicker.min.js"></script>

<script>
  function getRentDetails(id) {
    $.get({
        url: '{{route('rent.show', '')}}' + "/"+ id,
        dataType: 'json',
        success: function (data) {
            $("#rentDetailModal tbody").html(data.html_response)
            $("#rentDetailModal").modal("show")
        }
    });
  }

  $('#datetimepicker1').datepicker({
        format:'mm-yyyy',
        viewMode: "months", 
        minViewMode: "months", 
        autoclose:true

  });

  $('#tableExport1').DataTable({
    dom: 'lBfrtip',
    "ordering": true,
    buttons: [
        {
            extend: 'excel',
            text: 'Excel',
            title : function() {
                    return "Rents Detail";
            },
            className: 'btn btn-default',
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7]
            },
            filename: function(){
                return 'rents_detail';
            },
        },
        {
            extend: 'csv',
            text: 'Csv',
            title : function() {
                    return "Rents Detail";
            },
            className: 'btn btn-secondary',
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7]
            },
            filename: function(){
                return 'rents_detail';
            },
        },
        {
            extend: 'pdf',
            text: 'Pdf',
            title : function() {
                    return "Rents Detail";
            },
            className: 'btn btn-default',
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7]
            },
            filename: function(){
                return 'rents_detail';
            },
        },
        {
            extend: 'print',
            text: 'Print',
            title : function() {
                    return "Rents Detail";
            },
            className: 'btn btn-default',
            customize: function (win) {
                $(win.document.body)
                    .css('font-size', '12pt');
        
                $(win.document.body).find('table')
                    .addClass('compact')
                    .css('font-size', 'inherit');
            },
            exportOptions: {
              columns: [0,1,2,3,4,5,6,7]
            },
            filename: function(){
                return 'rents_detail';
            },
        },
    ],
    "lengthMenu": [10,25,50,100],
    
    });
</script>

@stop