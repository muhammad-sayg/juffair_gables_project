@extends('layouts.admin.app')
{{-- Page title --}}
{{-- @section('title')
    AMS
@stop --}}
{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="{{ asset('public/admin/assets/') }}/bundles/datatables/datatables.min.css">
<link rel="stylesheet" href="{{ asset('public/admin/assets/') }}/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
<style>

  #tableExport1
  {
    color:#fff !important;
  }
   tr:hover {
    background: #a3a3a3 !important;
   }
   .finished-contract
   {
     background:#c17676 !important;
   }
   .contract-running
   {
      background-color: #63e863  !important;
   }

   .dataTables_empty
   {
     color:black !important;
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
      <li class="breadcrumb-item">Utility Bills</li>
    
    </ul> --}}
     <div class="row">
       <div class="col-12">
        <a href="{{ route('service_contract.create') }}" class="btn btn-primary float-right mb-4" style="padding: 7px 35px;" role="button">Add New Contract</a>
       </div>
       <div class="col-12">
            <div class="card" style="padding:15px 15px">
                <form action="{{ route('service_contract.search') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="">Frequency Pay</label>
                            <select name="frequency_of_pay" class="form-control"  id="" style="height: 37px;">
                            <option value="0" disabled>--- Select ---</option>
                            <option value="all" @if(isset($frequency_of_pay) && $frequency_of_pay == "all") selected @endif>All</option>
                            <option value="monthly" @if(isset($frequency_of_pay) && $frequency_of_pay == "monthly") selected @endif>Monthly</option>
                            <option value="quarterly" @if(isset($frequency_of_pay) && $frequency_of_pay == "quarterly") selected @endif>Quarterly</option>
                            <option value="yearly" @if(isset($frequency_of_pay) && $frequency_of_pay == "yearly") selected @endif>Yearly</option>
                            <option value="bi-yearly" @if(isset($frequency_of_pay) && $frequency_of_pay == "bi-yearly") selected @endif>Bi-yearly</option>
                            <option value="one-time-payment" @if(isset($frequency_of_pay) && $frequency_of_pay == "one-time-payment") selected @endif>One time Payment</option>
                        </select>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                          <label for="">Service Contract Status</label>
                          <select name="service_contract_status_code" class="form-control"  id="" style="height: 37px;">
                            <option value="0" disabled>--- Select ---</option>
                            <option value="all">All</option>
                            @foreach ($service_contract_status as $item)
                                  <option value="{{ $item->service_contract_status_code }}" @if(isset($service_contract_status_code) && $service_contract_status_code == $item->service_contract_status_code) selected @endif>{{ $item->service_contract_status_name }}</option>
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
           <h4>Service Contract list</h4>
          </div>
            
            <div class="card-body">
              <div class="table-responsive">
                <table id="tableExport1" class="table table-responsive table-striped display nowrap"  width="100%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Title</th>
                      <th>Cost Per Period</th>
                      <th>Frequency of Pay</th>
                      <th>Contract Start Date</th>
                      <th>Contract End Date</th>
                      <th>Auto Renewal</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($services_contract_list as $key => $item)
                    @php
                      $current_date = \Carbon\Carbon::now()->format('Y-m-d');
                      $contract_end_date = \Carbon\Carbon::parse($item->contract_end_date)->format('Y-m-d');
                      
                      $class = 'contract-running';
                      if(\Carbon\Carbon::parse($current_date)->gt(\Carbon\Carbon::parse($contract_end_date)))
                      {
                        $class = 'finished-contract';
                      }
                    @endphp
                    <tr style="cursor:pointer" class="@if($class) {{$class}} @endif">
                      <td onclick="getServiceContractDetails({{ $item->id }})">{{ $key+1 }}</td>
                      <td onclick="getServiceContractDetails({{ $item->id }})">{{ $item->Title }}</td>
                      <td onclick="getServiceContractDetails({{ $item->id }})">{{ (int)$item->amount }} BD</td>
                      <td onclick="getServiceContractDetails({{ $item->id }})">{{ $item->frequency_of_pay }}</td>
                      <td onclick="getServiceContractDetails({{ $item->id }})">{{ \Carbon\Carbon::parse($item->contract_start_date)->toFormattedDateString() }}</td>
                      <td onclick="getServiceContractDetails({{ $item->id }})">{{ \Carbon\Carbon::parse($item->contract_end_date)->toFormattedDateString() }}</td>
                      <td>
                        <span class="badge btn-warning">
                          @if($item->auto_renewal == '1')
                          Yes
                          @else
                          No
                          @endif
                        </span>
                      </td>
                      <td>
                        @php
                          $class = '';
                          switch ($item->service_contract_status_code) {
                            case 1:
                              $class = 'badge-success';
                              break;
                            default:
                              $class = 'badge-danger';
                              break;
                          }
                        @endphp
                        <span class="badge {{ $class }}">{{ isset($item->service_contract_status_code) ? $item->service_contract_status->service_contract_status_name : ''}}</span>
                      </td>
                      <td>
                        <div class="dropdown">
                          <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Action</a>
                          <div class="dropdown-menu">
                            <a href="#" onclick="getServiceContractDetails({{ $item->id }})" class="dropdown-item has-icon"><i class="fas fa-eye"></i> View</a>
                            <a href="{{ route('service_contract.edit', $item->id) }}" class="dropdown-item has-icon"><i class="far fa-edit"></i> Edit</a>
                            <div class="dropdown-divider"></div>
                            <!-- <a href="#" onclick="form_alert('service_contract-{{ $item->id }}','Want to delete this Service Contract')" class="dropdown-item has-icon text-danger"><i class="far fa-trash-alt"></i>
                              Delete</a> -->
                          </div>
                        </div>
                        <!-- <form action="{{ route('service_contract.delete', $item->id) }}"
                            method="post" id="service_contract-{{ $item->id }}">
                            @csrf @method('delete')
                        </form> -->
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
{{-- Service Contract modal --}}
<div class="modal" id="serviceContractModal" tabindex="-1" role="dialog" aria-labelledby="formModal"  aria-modal="true">
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
<!-- JS Libraies -->
<script src="{{ asset('public/admin/assets/') }}/bundles/datatables/datatables.min.js"></script>
<script src="{{ asset('public/admin/assets/') }}/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('public/admin/assets/') }}/bundles/jquery-ui/jquery-ui.min.js"></script>
<!-- Page Specific JS File -->
<script src="{{ asset('public/admin/assets/') }}/js/page/datatables.js"></script>
<script>
  function getServiceContractDetails(id) {
    $.get({
        url: '{{route('service_contract.show', '')}}' + "/"+ id,
        dataType: 'json',
        success: function (data) {
            console.log(data.options)
            $("#serviceContractModal tbody").html(data.html_response)
            $("#serviceContractModal").modal("show")
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
            title : function() {
                    return "Service Contract List";
            },
            className: 'btn btn-default',
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7]
            },
            filename: function(){
                return 'service_contract_list';
            },
        },
        {
            extend: 'csv',
            text: 'Csv',
            title : function() {
                    return "Service Contract List";
            },
            className: 'btn btn-secondary',
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7]
            },
            filename: function(){
                return 'service_contract_list';
            },
        },
        {
            extend: 'pdf',
            text: 'Pdf',
            title : function() {
                    return "Service Contract List";
            },
            className: 'btn btn-default',
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7]
            },
            filename: function(){
                return 'service_contract_list';
            },
        },
        {
            extend: 'print',
            text: 'Print',
            title : function() {
                    return "Service Contract List";
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
              columns: ":visible"
            },
            filename: function(){
                return 'service_contract_list';
            },
        },
    ],
    "lengthMenu": [10,25,50,100],
    
    });
</script>
@stop