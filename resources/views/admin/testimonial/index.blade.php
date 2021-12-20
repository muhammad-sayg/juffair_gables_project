@extends('layouts.admin.app')
{{-- Page title --}}

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="{{ asset('public/admin/assets/') }}/bundles/datatables/datatables.min.css">
<link rel="stylesheet" href="{{ asset('public/admin/assets/') }}/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
<style>
   tr:hover {
    background: #a3a3a3 !important;
   }
</style>
@stop
@section('content')
<section class="section">
  
     <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
           <h4>All reviews</h4>
            <!-- <div class="card-header-form">
              <a href="{{ route('testimonials.create') }}" type="button"  class="btn btn-primary">Add Testimonial</a>
             </a>
            </div> -->
          </div>
            
            <div class="card-body">
              <div class="table-responsive">
                <table id="tableExport1" class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Review</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($allreviews as $key => $reviews)
                    <tr>
                        <td onclick="getTestimonialDetails({{ $reviews->id }})">{{ $key+1 }}</td>
                        <td onclick="getTestimonialDetails({{ $reviews->id }})">{{ $reviews->name}}</td>
                        <td onclick="getTestimonialDetails({{ $reviews->id }})">{{ $reviews->email}}</td>
                        <td onclick="getTestimonialDetails({{ $reviews->id }})">{{ $reviews->review}}</td>
                        <td>
                          @php
                          $class = '';
                          switch ($reviews->review_status_code) {
                            case 1:
                              $class = 'badge-success';
                              break;
                            default:
                              $class = 'badge-primary';
                              break;
                          }
                        @endphp
                          <span class="badge {{ $class }}">{{ isset($reviews->review_status) ?  $reviews->review_status->review_status_name : ''}}</span></td>
                        <td>
                          <div class="dropdown">
                            <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Action</a>
                            <div class="dropdown-menu">
                            <a href="#" onclick="getTestimonialDetails({{ $reviews->id }})" class="dropdown-item has-icon"><i class="fas fa-eye"></i> View</a>

                            @if($reviews->review_status_code == 2)
                            <a style="color:green" href="{{ route('testimonials.update_review_status',['id'=>$reviews->id , 'current_status' => '1']) }}"  class="dropdown-item has-icon"><i class="fas fa-globe"></i>Public</a>
                            @endif
                            @if($reviews->review_status_code == 1)
                            <a style="color: #5c5cbf" href="{{ route('testimonials.update_review_status',['id'=>$reviews->id , 'current_status' => '2']) }}" class="dropdown-item has-icon"><i class="fas fa-lock"></i> Private</a>
                            @endif

                            <div class="dropdown-divider"></div>
                            <a href="#" onclick="form_alert('testimonial-{{ $reviews->id }}','Want to delete this review')" class="dropdown-item has-icon text-danger"><i class="far fa-trash-alt"></i>
                                Delete</a>
                            </div>
                          </div>
                          <form action="{{ route('testimonials.delete', $reviews->id) }}"
                            method="post" id="testimonial-{{ $reviews->id }}">
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
{{-- review view modal --}}
<div class="modal" id="testimonialModal" tabindex="-1" role="dialog" aria-labelledby="formModal"  aria-modal="true">
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
              @include('admin.testimonial.partials.testimonial_view_modal')
            </tbody>
          </table>
      </div>
    </div>
  </div>
</div>
@stop
@section('footer_scripts')
<script src="{{ asset('public/admin/assets/') }}/bundles/datatables/datatables.min.js"></script>
<script src="{{ asset('public/admin/assets/') }}/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('public/admin/assets/') }}/bundles/jquery-ui/jquery-ui.min.js"></script>
<!-- Page Specific JS File -->
<script src="{{ asset('public/admin/assets/') }}/js/page/datatables.js"></script>
<script>
  function getTestimonialDetails(id) {
    $.get({
        url: '{{route('testimonials.show', '')}}' + "/"+ id,
        dataType: 'json',
        success: function (data) {
            console.log(data)
            $("#testimonialModal tbody").html(data.html_response)
            $("#testimonialModal").modal("show")
        }
    });
  }
</script>
<script>
  $('#tableExport1').DataTable({
    dom: 'lBfrtip',
    "ordering": true,
    buttons: [
        {
            extend: 'excel',
            text: 'Excel',
            className: 'btn btn-default',
            exportOptions: {
                columns: [0,1,2,3,4]
            },
            filename: function(){
                return 'reviews';
            },
        },
        {
            extend: 'csv',
            text: 'Csv',
            className: 'btn btn-secondary',
            exportOptions: {
                columns: [0,1,2,3,4]
            },
            filename: function(){
                return 'reviews';
            },
        },
        {
            extend: 'pdf',
            text: 'Pdf',
            title : function() {
                    return "All Reviews";
            },
            className: 'btn btn-default',
            exportOptions: {
                columns: [0,1,2,3,4]
            },
            filename: function(){
                return 'reviews';
            },
        },
        {
            extend: 'print',
            text: 'Print',
            title : function() {
                    return "All Reviews";
            },
            className: 'btn btn-default',
            exportOptions: {
                columns: [0,1,2,3,4]
            },
            filename: function(){
                return 'reviews';
            },
        },
    ],
    "lengthMenu": [10,25,50,100],
    
    });
</script>
@stop