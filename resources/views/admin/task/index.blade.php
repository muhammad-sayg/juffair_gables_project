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
      <li class="breadcrumb-item">Utility Bills</li>
    
    </ul> --}}
     <div class="row">
      <div class="col-12">
        @if(\Auth::user()->userType != 'employee')
        {{-- <div class="card">
          <div class="card-header">
           <h4>Tasks Under Review</h4>
          </div>
            
            <div class="card-body">
              <div class="table-responsive">
                <table id="table-5" class="table table-striped display nowrap"  width="100%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Title</th>
                      <th>Location</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $tasks = \App\Models\Task::where('assign_date', '=', null)->orderBy('id','desc')->get();
                    @endphp
                    @foreach($tasks as $key => $item)
                    <tr class="tasktable" style="cursor: pointer">
                      <td data-href='{{ route('tasks.show', $item->id) }}'>{{ $key+1 }}</td>
                      <td data-href='{{ route('tasks.show', $item->id) }}'>{{ $item->title }}</td>
                      <td data-href='{{ route('tasks.show', $item->id) }}'>
                        @if($item->location_id == 1)
                          @php
                            $floor_number = \App\Models\FloorDetail::where('id', $item->floor_id)->first()->number;
                            $apartment_number = \App\Models\Unit::where('id', $item->unit_id)->first()->unit_number;
                          @endphp
                          Floor {{ $floor_number }}, Apartment {{ $apartment_number }}
                        @endif

                        @if($item->location_id == 2)
                          @php
                            $location_area = \App\Models\CommonArea::where('id', $item->common_area_id)->first()->area_name;
                          @endphp
                          {{ $location_area }}
                        @endif

                        @if($item->location_id == 3)
                        @php
                          $floor_number = \App\Models\FloorDetail::where('id', $item->floor_id)->first()->number;
                        @endphp
                        Floor {{ $floor_number }}
                        @endif

                        @if($item->location_id == 4)
                          @php
                            $location_area = \App\Models\ServiceArea::where('id', $item->service_area_id)->first()->service_area_name;
                          @endphp
                          {{ $location_area }} Area
                        @endif
                      </td>
                      <td>
                        <div class="dropdown">
                          <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Action</a>
                          <div class="dropdown-menu">
                            <a href="{{ route('tasks.show', $item->id) }}" class="dropdown-item has-icon"><i class="fas fa-eye"></i> View</a>
                            <a href="{{ route('tasks.edit', $item->id) }}" class="dropdown-item has-icon"><i class="far fa-edit"></i> Edit</a>
                            <a href="#" data-task_id="{{  $item->id }}" class="dropdown-item has-icon assign_task"><i class="fas fa-user-shield"></i> Assign Task</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" onclick="form_alert('task-{{ $item->id }}','Want to delete this task')" class="dropdown-item has-icon text-danger"><i class="far fa-trash-alt"></i>
                              Delete</a>
                            <form action="{{ route('tasks.delete', $item->id) }}"
                                method="post" id="task-{{ $item->id }}">
                                @csrf @method('delete')
                            </form>
                          </div>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
        </div> --}}
        <div class="row">
          <div class="col-12">
            <a  href="{{ route('tasks.create') }}" class="btn btn-primary float-right mb-4" style="padding:7px 35px" role="button">Add Task</a>
          </div>
          <div class="col-lg-12">
            <div class="card" style="padding:15px 15px">
              <div class="card-header">
                <h4>Search Tasks By Status</h4>
              </div>
              <div class="card-body">
                <form action="{{ route('tasks.search_tasks_by_status') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="">Select Status</label>
                            <select class="form-control" name="task_status_code" >
                                <option value="0">All</option>
                                @foreach ($task_status_list as $task_status)
                                    <option value="{{ $task_status->task_status_code }}" @if(isset($task_status_code) && ($task_status_code == $task_status->task_status_code)) selected @endif>{{ $task_status->task_status_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group col-md-2" style="margin-top: 1.90rem !important;">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>
              </div>
          </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
           <h4>All Tasks</h4>
          </div>
            
            <div class="card-body">
              <div class="table-responsive">
                <table id="tableExport1" class="table table-responsive table-striped display nowrap"  width="100%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Title</th>
                      <th>Location</th>
                      <th>Assigned Date</th>
                      <th>Deadline Date</th>
                      <th>Completed Date</th>
                      <th>Assign To</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($tasks as $key => $item)
                    <tr class="tasktable @if($item->task_status_code == '6') bg-row @endif" style="cursor: pointer">
                      <td data-href='{{ route('tasks.show', $item->id) }}'>{{ $key+1 }}</td>
                      <td data-href='{{ route('tasks.show', $item->id) }}'>{{ $item->title }}</td>
                      <td data-href='{{ route('tasks.show', $item->id) }}'>
                        @if($item->location_id == 1)
                          @php
                            $floor_number = \App\Models\FloorDetail::where('id', $item->floor_id)->first()->number;
                            $apartment_number = \App\Models\Unit::where('id', $item->unit_id)->first()->unit_number;
                          @endphp
                          Apartment {{ $apartment_number }}
                        @endif

                        @if($item->location_id == 2)
                          @php
                            $location_area = \App\Models\CommonArea::where('id', $item->common_area_id)->first()->area_name;
                          @endphp
                          {{ $location_area }}
                        @endif

                        @if($item->location_id == 3)
                        @php
                          $floor_number = \App\Models\FloorDetail::where('id', $item->floor_id)->first()->number;
                        @endphp
                        Floor {{ $floor_number }}
                        @endif

                        @if($item->location_id == 4)
                          @php
                            $location_area = \App\Models\ServiceArea::where('id', $item->service_area_id)->first()->service_area_name;
                          @endphp
                          {{ $location_area }} Area
                        @endif
                      </td>
                      <td data-href='{{ route('tasks.show', $item->id) }}'>{{ isset($item->assign_date)? \Carbon\Carbon::parse($item->assign_date)->toFormattedDateString(). ' '. \Carbon\Carbon::parse($item->assign_time)->format('g:i A') : '' }} </td>
                      <td data-href='{{ route('tasks.show', $item->id) }}'>{{ isset($item->deadline_date)? \Carbon\Carbon::parse($item->deadline_date)->toFormattedDateString(). ' '. \Carbon\Carbon::parse($item->deadline_time)->format('g:i A') : '' }} </td>
                      {{-- <td>{{ isset($item->complete_date)? \Carbon\Carbon::parse($item->complete_date)->toFormattedDateString(). ' '. \Carbon\Carbon::parse($item->complete_time)->format('g:i A') : '' }}</td> --}}
                      <td data-href='{{ route('tasks.show', $item->id) }}'>{{ isset($item->complete_date)? \Carbon\Carbon::parse($item->complete_date)->toFormattedDateString(). ' '. \Carbon\Carbon::parse($item->complete_time)->format('g:i A') : '' }} </td>
                      <td>
                        @php
                          if($item->assignee_id)
                          {
                            $assign_to = \App\Models\User::where('id', $item->assignee_id)->first()->name;
                          }
                        @endphp
                        {{ isset($assign_to) ? $assign_to : '' }}
                      </td>
                      <td data-href='{{ route('tasks.show', $item->id) }}'>
                        @php
                          $class = '';
                          switch ($item->task_status_code) {
                            case 1:
                              $class = 'badge-warning';
                              break;
                            case 4:
                              $class = 'badge-warning';
                              break;
                            case 6:
                              $class = 'badge-danger';
                              break;
                            default:
                              $class = 'badge-success';
                              break;
                          }
                        @endphp
                        <span class="badge {{ $class }}">{{ isset($item->task_status) ? $item->task_status->task_status_name : ''}}</span>
                      </td>
                      <td>
                        <div class="dropdown">
                          <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Action</a>
                          <div class="dropdown-menu">
                            <a href="{{ route('tasks.show', $item->id) }}" class="dropdown-item has-icon"><i class="fas fa-eye"></i> View</a>
                            @if($item->task_status_code != 5 && $item->task_status_code !=6)
                            <a href="{{ route('tasks.edit', $item->id) }}" class="dropdown-item has-icon"><i class="far fa-edit"></i> Edit</a>
                            @endif
                            @if($item->task_status_code == null)
                            <a href="#" data-task_id="{{  $item->id }}" class="dropdown-item has-icon assign_task"><i class="fas fa-user-shield"></i> Assign Task</a>
                            @endif
                            @if($item->task_status_code == 3)
                            <a href="{{ route('tasks.closed',$item->id) }}" data-task_id="{{  $item->id }}" class="dropdown-item has-icon" style="color:green"><i class="
                              fas fa-check-circle"></i> Close</a>
                            <a href="#" data-task_id="{{  $item->id }}" class="dropdown-item has-icon resubmit-task" style="color:#ffc107"><i class="
                              fas fa-sync-alt"></i> Resubmit</a>
                            @endif
                            @if($item->task_status_code != 6)
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('tasks.cancelled',$item->id) }}"  class="dropdown-item has-icon text-danger"><i class="material-icons">cancel</i>
                              Cancel</a>
                            @endif
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
        @else
        <div class="card">
          <div class="card-header">
            <h4>Active Tasks</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="tableExport3" class="table table-striped display nowrap"  width="100%">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Location</th>
                    <th>Date Assigned</th>
                    <th>Deadline Date</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $tasks = \App\Models\Task::where('assignee_id', Auth::user()->id)->whereIn('task_status_code', [1,2,3,4])->orderBy('id','desc')->get();
                  @endphp
                  @foreach($tasks as $key => $item)
                  <tr class="activeTask" style="cursor: pointer">
                    <td  data-href='{{ route('tasks.show', $item->id) }}'>{{ $key+1 }}</td>
                    <td  data-href='{{ route('tasks.show', $item->id) }}'>{{ $item->title }}</td>
                    <td data-href='{{ route('tasks.show', $item->id) }}'>
                      @if($item->location_id == 1)
                        @php
                          $floor_number = \App\Models\FloorDetail::where('id', $item->floor_id)->first()->number;
                          $apartment_number = \App\Models\Unit::where('id', $item->unit_id)->first()->unit_number;
                        @endphp
                        Apartment {{ $apartment_number }}
                      @endif

                      @if($item->location_id == 2)
                        @php
                          $location_area = \App\Models\CommonArea::where('id', $item->common_area_id)->first()->area_name;
                        @endphp
                        {{ $location_area }}
                      @endif

                      @if($item->location_id == 3)
                      @php
                        $floor_number = \App\Models\FloorDetail::where('id', $item->floor_id)->first()->number;
                      @endphp
                      Floor {{ $floor_number }}
                      @endif

                      @if($item->location_id == 4)
                        @php
                          $location_area = \App\Models\ServiceArea::where('id', $item->service_area_id)->first()->service_area_name;
                        @endphp
                        {{ $location_area }} Area
                      @endif
                    </td>
                    <td  data-href='{{ route('tasks.show', $item->id) }}'>{{ \Carbon\Carbon::parse($item->assign_date)->toFormattedDateString() }} {{ \Carbon\Carbon::parse($item->assign_time)->format('g:i A') }}</td>
                    <td  data-href='{{ route('tasks.show', $item->id) }}'>{{ \Carbon\Carbon::parse($item->deadling_date)->toFormattedDateString() }} {{ \Carbon\Carbon::parse($item->deadline_time)->format('g:i A') }}</td>
                    <td>
                      @php
                        $class = '';
                        switch ( $item->task_status_code) {
                        case 1:
                            $class = 'badge-warning';
                            break;
                        default:
                            $class = 'badge-success';
                            break;
                        }
                      @endphp
                      @if(isset($item->task_status))
                      <span class="badge {{ $class }}">{{$item->task_status->task_status_name}}</span>
                      @endif
                    </td>
                    <td>
                      <div class="dropdown">
                        <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Action</a>
                        <div class="dropdown-menu">
                          <a href="{{ route('tasks.show', $item->id) }}" class="dropdown-item has-icon"><i class="fas fa-eye"></i> View</a>
                          @if(in_array($item->task_status_code,[1,2,4]))
                          <div class="dropdown-divider"></div>
                          <a href="#" data-task_id="{{ $item->id }}" data-task_status_code="{{ $item->task_status_code }}" class="dropdown-item has-icon task-status-button">
                            @if($item->task_status_code == 1)
                            <i class="
                            fas fa-check-circle" style="color:green"></i><span style="color: green"> In Progress
                            @endif
                            @if($item->task_status_code == 2 || $item->task_status_code == 4)
                            <i class="
                            fas fa-check-circle" style="color:green"></i><span style="color: green"> Completed
                            @endif
                            </span>
                          </a>
                          @endif
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
           <h4>Completed Tasks</h4>
          </div>
            
            <div class="card-body">
              <div class="table-responsive">
                <table id="tableExport4" class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Title</th>
                      <th>Location</th>
                      <th>Assigned Date</th>
                      <th>Deadline Date</th>
                      <th>Completed Date</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                    if(Auth::user()->userType == 'employee')
                    {
                      $tasks = \App\Models\Task::where('assignee_id', Auth::user()->id)->where('task_status_code', 5)->orderBy('id','desc')->get();

                    }
                    else {
                      $tasks = \App\Models\Task::where('task_status_code', 3)->orderBy('id','desc')->get();
                      
                    }
                    @endphp
                    @foreach($tasks as $key => $item)
                    
                    <tr class="tasktable" style="cursor: pointer">
                      <td data-href='{{ route('tasks.show', $item->id) }}'>{{ $key+1 }}</td>
                      <td data-href='{{ route('tasks.show', $item->id) }}'>{{ $item->title }}</td>
                      <td data-href='{{ route('tasks.show', $item->id) }}'>
                        @if($item->location_id == 1)
                          @php
                            $floor_number = \App\Models\FloorDetail::where('id', $item->floor_id)->first()->number;
                            $apartment_number = \App\Models\Unit::where('id', $item->unit_id)->first()->unit_number;
                          @endphp
                          Apartment {{ $apartment_number }}
                        @endif

                        @if($item->location_id == 2)
                          @php
                            $location_area = \App\Models\CommonArea::where('id', $item->common_area_id)->first()->area_name;
                          @endphp
                          {{ $location_area }}
                        @endif

                        @if($item->location_id == 3)
                        @php
                          $floor_number = \App\Models\FloorDetail::where('id', $item->floor_id)->first()->number;
                        @endphp
                        Floor {{ $floor_number }}
                        @endif

                        @if($item->location_id == 4)
                          @php
                            $location_area = \App\Models\ServiceArea::where('id', $item->service_area_id)->first()->service_area_name;
                          @endphp
                          {{ $location_area }} Area
                        @endif
                      </td>
                      <td data-href='{{ route('tasks.show', $item->id) }}'>{{ isset($item->assign_date)? \Carbon\Carbon::parse($item->assign_date)->toFormattedDateString(). ' '. \Carbon\Carbon::parse($item->assign_time)->format('g:i A') : '' }} </td>
                      <td data-href='{{ route('tasks.show', $item->id) }}'>{{ isset($item->deadline_date)? \Carbon\Carbon::parse($item->deadline_date)->toFormattedDateString(). ' '. \Carbon\Carbon::parse($item->deadline_time)->format('g:i A') : '' }} </td>
                      <td data-href='{{ route('tasks.show', $item->id) }}'>{{ isset($item->complete_date)? \Carbon\Carbon::parse($item->complete_date)->toFormattedDateString(). ' '. \Carbon\Carbon::parse($item->complete_time)->format('g:i A') : '' }} </td>
                      {{-- <td>{{ isset($item->complete_date)? \Carbon\Carbon::parse($item->complete_date)->toFormattedDateString(). ' '. \Carbon\Carbon::parse($item->complete_time)->format('g:i A') : '' }}</td> --}}
                      <td data-href='{{ route('tasks.show', $item->id) }}'>
                        @php
                          $class = '';
                          switch ($item->task_status_code) {
                            case 1:
                              $class = 'badge-warning';
                              break;
                            default:
                              $class = 'badge-success';
                              break;
                          }
                        @endphp
                        <span class="badge {{ $class }}">{{ isset($item->task_status) ? $item->task_status->task_status_name : ''}}</span>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
        </div>
        @endif
      </div>
     </div>
  </section>
{{-- Confirm modal --}}
<div class="modal" id="taskConfirmModal" tabindex="-1" role="dialog" aria-labelledby="formModal"  aria-modal="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModal">Confirm Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="card-body">
        <form action="{{ route('tasks.change_task_status') }}" method="POST" id="completeTaskForm">
          @csrf
          <input type="hidden" name="task_id" id="confirmTaskId">
          <input type="hidden" name="task_status_code" id="confirmTaskStatusCode">
          <div>
            <p class="task-confirm-message">Do you confirm the task has been completed?</p>
          </div>
          <button type="submit" class="btn btn-primary m-t-15 waves-effect">Confirm</button>
        </form>
      </div>
  </div>
</div>
</div>
  <div class="modal" id="requestDetailModal" >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="formModal">View</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="card-body">
            <table id="mainTable" class="table table-striped">
              <tbody>
                @include('admin.task.partials.request_detail_modal')
              </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="assignTaskModal" >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="formModal">Assign Task</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="card-body">
          <form action="{{ route('tasks.assign_task') }}" method="POST" id="assignTaskForm">
            @csrf
            <div class="row">
              <div class="col-6">
                <input type="hidden" name="task_id" id="assignTaskModalHiddenInput">
                <div class="form-group">
                  <label for="">Select Employee</label>
                  <select name="employee_id" class="form-control" id="">
                    <option value="">--- Select ---</option>
                    @foreach ($employee_list as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <div class="form-check">
                    <input class="form-check-input" name="now_cb" checked type="checkbox">
                    <label class="form-check-label" style="margin-top:1px !important">
                      Now
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="row assign_schedule" style="display: none">
              <div class="col-6">
                <div class="form-group">
                  <label>Assign Date</label>
                  <input type="text" name="assign_date" class="form-control datepicker">
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label>Assign Time</label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                          <div class="input-group-text">
                              <i class="fas fa-clock"></i>
                          </div>
                      </div>
                      <input type="text"  name="assign_time" class="form-control timepicker">
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label>Deadline Date</label>
                  <input type="text" name="deadline_date" class="form-control datepicker1">
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label>Deadline Time</label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                          <div class="input-group-text">
                              <i class="fas fa-clock"></i>
                          </div>
                      </div>
                      <input type="text" name="deadline_time" class="form-control timepicker">
                  </div>
                </div>
              </div>
              {{-- <div class="col-12">
                <div class="form-group">
                  <label>Comment</label>
                  <textarea name="comment" id="" class="form-control" cols="30" rows="10"></textarea>
                </div>
              </div> --}}
            </div>
            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Assign</button>
          </form>
        </div>
    </div>
  </div>
  </div>

  <div class="modal" id="resubmitModal" >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="formModal">Reason</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="card-body">
          <form action="{{ route('tasks.resubmit') }}" method="POST" id="assignTaskForm">
            @csrf
            <input type="hidden" name="task_id" id="resubmitTaskHiddenInput">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label>Reason</label>
                  <textarea name="reason" id="" class="form-control" cols="30" rows="10"></textarea>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-warning m-t-15 waves-effect">Resubmit</button>
          </form>
        </div>
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
  $('#tableExport1').DataTable({
    dom: 'lBfrtip',
    "ordering": true,
    buttons: [
        {
            extend: 'excel',
            text: 'Excel',
            className: 'btn btn-default',
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7]
            },
            filename: function(){
                return 'tasks_list';
            },
        },
        {
            extend: 'csv',
            text: 'Csv',
            className: 'btn btn-secondary',
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7]
            },
            filename: function(){
                return 'tasks_list';
            },
        },
        {
            extend: 'pdf',
            text: 'Pdf',
            title : function() {
                    return "All Tasks";
            },
            className: 'btn btn-default',
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7]
            },
            filename: function(){
                return 'tasks_list';
            },
        },
        {
            extend: 'print',
            text: 'Print',
            title : function() {
                    return "All Tasks";
            },
            className: 'btn btn-default',
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7]
            },
            filename: function(){
                return 'tasks_list';
            },
        },
    ],
    "lengthMenu": [10,25,50,100],
    
    });

  $('#tableExport3').DataTable({
    dom: 'lBfrtip',
    "ordering": true,
    buttons: [
        {
            extend: 'excel',
            text: 'Excel',
            className: 'btn btn-default',
            exportOptions: {
                columns: [0,1,2,3,4,5]
            },
            filename: function(){
                return 'active_task_list';
            },
        },
        {
            extend: 'csv',
            text: 'Csv',
            className: 'btn btn-secondary',
            exportOptions: {
                columns: [0,1,2,3,4,5]
            },
            filename: function(){
                return 'active_task_list';
            },
        },
        {
            extend: 'pdf',
            text: 'Pdf',
            title : function() {
                    return "Active Task List";
            },
            className: 'btn btn-default',
            exportOptions: {
                columns: [0,1,2,3,4,5]
            },
            filename: function(){
                return 'active_task_list';
            },
        },
        {
            extend: 'print',
            text: 'Print',
            title : function() {
                    return "Active Task List";
            },
            className: 'btn btn-default',
            exportOptions: {
                columns: [0,1,2,3,4,5]
            },
            filename: function(){
                return 'active_task_list';
            },
        },
    ],
    "lengthMenu": [10,25,50,100],
    
    });

    $('#tableExport4').DataTable({
    dom: 'lBfrtip',
    "ordering": true,
    buttons: [
        {
            extend: 'excel',
            text: 'Excel',
            className: 'btn btn-default',
            exportOptions: {
                columns: [0,1,2,3,4,5,6]
            },
            filename: function(){
                return 'completed_task_list';
            },
        },
        {
            extend: 'csv',
            text: 'Csv',
            className: 'btn btn-secondary',
            exportOptions: {
                columns: [0,1,2,3,4,5,6]
            },
            filename: function(){
                return 'completed_task_list';
            },
        },
        {
            extend: 'pdf',
            text: 'Pdf',
            title : function() {
                    return "Completed Task List";
            },
            className: 'btn btn-default',
            exportOptions: {
                columns: [0,1,2,3,4,5,6]
            },
            filename: function(){
                return 'completed_task_list';
            },
        },
        {
            extend: 'print',
            text: 'Print',
            title : function() {
                    return "Completed Task List";
            },
            className: 'btn btn-default',
            exportOptions: {
                columns: [0,1,2,3,4,5,6]
            },
            filename: function(){
                return 'completed_task_list';
            },
        },
    ],
    "lengthMenu": [10,25,50,100],
    
    });
</script>
@stop