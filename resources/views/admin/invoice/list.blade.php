@extends('layouts.admin.app')
{{-- Page title --}}
@section('title')
Juffair Gables
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
    <div class="row">
        <div class="col-12">
            <a href="{{ route('invoices.create') }}" style="padding:7px 35px;" class="btn btn-primary mb-4 float-right" role="button">Create Invoice</a>
        </div>
       <div class="col-12">
         <div class="card">
           <div class="card-header">
            <h4>Pending Invoices</h4>
           </div>
             
             <div class="card-body">
               <div class="table-responsive">
                 <table id="tableExport1" class="table  table-striped display nowrap"  width="100%">
                   <thead>
                     <tr>
                       <th>#</th>
                       <th>Invoice Number</th>
                       <th>Invoice Date</th>
                       <th>Invoice Amount</th>
                       <th>Tenant Name</th>
                       <th>Invoice</th>
                       <th>Action</th>
                     </tr>
                   </thead>
                   <tbody>
                    @foreach($invoices->where('invoice_status_code', 1) as $key => $item)
                     <tr style="cursor:pointer;">
                        <td onclick="getInvoiceDetails({{ $item->id }})">{{ $key+1 }}</td>
                        <td onclick="getInvoiceDetails({{ $item->id }})">{{ $item->invoice_number }}</td>
                        <td onclick="getInvoiceDetails({{ $item->id }})">{{ \Carbon\Carbon::parse($item->invoice_issue_date)->format('Y-m-d') }}</td>
                        <td onclick="getInvoiceDetails({{ $item->id }})">{{ $item->invoice_amount  }}</td>
                        <td onclick="getInvoiceDetails({{ $item->id }})">{{ $item->tenant->tenant_first_name }} {{ $item->tenant->tenant_last_name }}</td>
                        <td><a href="{{ route('invoices.view_invoice',$item->id) }}">View invoice</a></td>
                        <td>
                          <div class="dropdown">
                            <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Action</a>
                            <div class="dropdown-menu">
                              <a href="{{ route('invoices.show',$item->id) }}" class="dropdown-item has-icon"><i class="fas fa-eye"></i> View</a>
                              <a href="{{ route('invoices.edit',$item->id) }}" class="dropdown-item has-icon"><i class="far fa-edit"></i> Edit</a> 
                              <div class="dropdown-divider"></div>
                              <a href="{{ route('invoices.send_invoice',$item->id) }}" class="dropdown-item has-icon"><i class="far fa-envelope"></i>Email Tenant</a> 

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
             <h4>Closed Invoices</h4>
            </div>
              
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tableExport2" class="table  table-striped display nowrap"  width="100%">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Invoice Number</th>
                        <th>Invoice Date</th>
                        <th>Invoice Amount</th>
                        <th>Tenant Name</th>
                        <th>Invoice</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($invoices->where('invoice_status_code', 2) as $key => $item)
                      <tr style="cursor:pointer;">
                        <td>{{ $key+1 }}</td>
                        <td onclick="getInvoiceDetails({{ $item->id }})">{{ $item->invoice_number }}</td>
                        <td onclick="getInvoiceDetails({{ $item->id }})">{{ \Carbon\Carbon::parse($item->invoice_issue_date)->format('Y-m-d') }}</td>
                        <td onclick="getInvoiceDetails({{ $item->id }})">{{ $item->invoice_amount  }}</td>
                        <td onclick="getInvoiceDetails({{ $item->id }})">{{ $item->tenant->tenant_first_name }} {{ $item->tenant->tenant_last_name }}</td>
                        <td><a href="{{ route('invoices.view_invoice',$item->id) }}">View invoice</a></td>
                        <td>
                            <div class="dropdown">
                              <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Action</a>
                              <div class="dropdown-menu">
                              <a href="{{ route('invoices.show',$item->id) }}" class="dropdown-item has-icon"><i class="fas fa-eye"></i> View</a>
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
{{-- Invoice modal --}}
<div class="modal" id="invoiceDetailModal" tabindex="-1" role="dialog" aria-labelledby="formModal"  aria-modal="true">
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
  function getInvoiceDetails(id) {
   
    $.get({
        url: '{{route('invoices.show', '')}}' + "/"+ id,
        dataType: 'json',
        success: function (data) {
            $("#invoiceDetailModal tbody").html(data.html_response)
            $("#invoiceDetailModal").modal("show")
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
                    return "Active Tenant List";
            },
            className: 'btn btn-default',
            exportOptions: {
                columns: [0,1,2,3]
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
                columns: [0,1,2,3]
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
                columns: [0,1,2,3]
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
                columns: [0,1,2,3]
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
                columns: [0,1,2,3]
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
                columns: [0,1,2,3]
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
                columns: [0,1,2,3]
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