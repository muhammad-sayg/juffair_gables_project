<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="{{ route('dashboard') }}"> <img alt="image" style="height: 60px;background:#fff" src="{{ asset('/public/admin/assets')}}/img/juffair_gables_logo.png" class="header-logo" /> <span
            class="logo-name"></span>
        </a>
      </div>
      <div class="sidebar-user">
        <div class="text-white">{{ Auth::user()->name}}</div>
      </div>
      <ul class="sidebar-menu">
        <li class="menu-header">Main</li>
     
        @if(request()->user()->can('view-dashboard'))
        <li class="dropdown  {!! (Request::is('dashboard') ? "active" : "") !!}">
            <a href="{{ route('dashboard')}}" class="nav-link"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
        </li>
        @endif
        
        

        @if(request()->user()->can('rented-apartment-list'))
        <li class="dropdown {!! (Request::is('units/rented_apartment*') ? "active" : "") !!}">
          <a href="{{ route('units.rented_apartment.list') }}" class="nav-link"><i class="fas fa-home"></i><span>Rented Apartments</span></a>
        </li>
        @endif
       
        @if(request()->user()->can('full-apartment-list'))
        <li class="dropdown {!! (Request::is('units/full_apartment*') ? "active" : "") !!} {!! (Request::is('units/unit/search_filter') ? "active" : "") !!} ">
          <a href="{{ route('units.full_apartment.list') }}" class="nav-link"><i class="fas fa-home"></i><span>Full Apartment List</span></a>
        </li>
        @endif

        @if(request()->user()->can('active-task'))
        <li class="dropdown {!! (Request::is('tasks/task/*') ? "active" : "") !!}"><a href="{{ route('tasks.list') }}" class="nav-link">@if(\Auth::user()->userType != 'employee' AND \Auth::user()->userType != 'receptionist')<i class="fas fa-book"></i><span>Tasks </span>@else <i class="fas fa-book"></i><span>Active Tasks</span> @endif</a></li>
        @endif
        
        @if(request()->user()->can('apply-leave'))
        <li class="dropdown {!! (Request::is('leave/*') ? "active" : "") !!}">
          <a href="{{ route('leave.list') }}" class="nav-link"><i class="
            fas fa-pen-alt"></i><span>Apply Leave</span></a>
        </li>
        @endif
        
        @if(request()->user()->can('report-maintenance-request'))
        <li class="dropdown {!! (Request::is('request/request/*') ? "active" : "") !!}">
          <a href="{{ route('request.list') }}" class="nav-link"><i class="fas fa-user-edit"></i><span>Report Maintenance Request</span></a>
        </li>
        @endif
        
        @if(request()->user()->can('send-message'))
        <li class="dropdown {!! (Request::is('send/message*') ? "active" : "") !!}">
          <a href="{{ route('send_message') }}" class="nav-link"><i class="fas fa-envelope"></i><span>Send Message</span></a>
        </li>
        @endif
        

        @if(request()->user()->can('view-tenant'))
        <li class="dropdown {!! (Request::is('tenants/*') ? "active" : "") !!}">
          <a href="{{ route('tenants.list') }}" class="nav-link"><i class="fas fa-users"></i><span>Tenants </span></a>
        </li>
        @endif

        @if(request()->user()->can('view-staff'))
        <li class="dropdown {!! (Request::is('staff/*') ? "active" : "") !!} ">
          <a href="{{ route('staff.list') }}" class="nav-link"><i class="fas fa-user"></i><span>Staff </span></a>
        </li>
        @endif
        
        @if(request()->user()->can('all-tasks'))
        <li class="dropdown {!! (Request::is('tasks/*') ? "active" : "") !!}">
          <a href="{{ route('tasks.list') }}" class="nav-link">@if(\Auth::user()->userType != 'employee')<i class="fas fa-book"></i><span>Tasks</span> @endif</a>
        </li>
        @endif
        
        @if(request()->user()->can('view-leave-requests'))
        <li class="dropdown {!! (Request::is('approveleave/*') ? "active" : "") !!} {!! (Request::is('leave/*') ? "active" : "") !!}">
          <a href="{{ route('approveleave.list') }}" class="nav-link"><i class="
            fas fa-calendar-check"></i><span>Leave Request</span></a>
        </li>
        @endif  
        @if(request()->user()->can('view-messages'))
        <li class="dropdown {!! (Request::is('messages/*') ? "active" : "") !!} {!! (Request::is('leave/*') ? "active" : "") !!}">
          <a href="{{ route('messages.list') }}" class="nav-link"><i class="fas fa-envelope"></i><span>Messages</span></a>
        </li>
        @endif  
        @if(request()->user()->can('view-reviews'))
        <li class="dropdown {!! (Request::is('testimonials/*') ? "active" : "") !!}">
          <a href="{{ route('testimonials.list') }}" class="nav-link"><i class="
            fas fa-comment"></i><span>Reviews</span></a>
        </li>
        @endif 

        @if(request()->user()->can('view-facilities'))
        <li class="dropdown {!! (Request::is('facilities/*') ? "active" : "") !!}">
          <a href="{{ route('facilities.list') }}" class="nav-link"><i class="
            fas fa-spa"></i><span>Facilities</span></a>
        </li>
        @endif

        @if(request()->user()->can('view-reservation'))
        <li class="dropdown {!! (Request::is('reservation/*') ? "active" : "") !!}">
          <a href="{{ route('reservation.list') }}" class="nav-link"><i class="
            far fa-registered"></i><span>Reserved  Facilities</span></a>
        </li>
        @endif
        
        @if(request()->user()->can('view-cv-s'))
        <li class="dropdown {!! (Request::is('job/*') ? "active" : "") !!}">
          <a href="{{ route('job.list') }}" class="nav-link"><i class="
          fas fa-window-restore"></i><span>Received Cv's</span></a>
        </li>
        @endif
        
        @if(request()->user()->can('view-contacts'))
        <li class="dropdown {!! (Request::is('contacts/*') ? "active" : "") !!}">
          <a href="{{ route('contacts.list') }}" class="nav-link"><i class="
          fas fa-address-book"></i><span>Contacts</span></a>
        </li>
        @endif
        
        @if(request()->user()->can('view-service-contract'))
        <li class="dropdown {!! (Request::is('service_contract*') ? "active" : "") !!}">
          <a href="{{ route('service_contract.list') }}" class="nav-link"><i class="
            fas fa-file-contract"></i><span>Service Contracts</span></a>
        </li>
        @endif

        @if(request()->user()->can('view-invoices'))
        <li class="dropdown {!! (Request::is('invoice*') ? "active" : "") !!}">
          <a href="{{ route('invoices.list') }}" class="nav-link"><i class="fas fa-file-invoice"></i><span>Billing Invoices</span></a>
        </li>
        @endif

        @if(request()->user()->can('view-rents'))
        <li class="dropdown {!! (Request::is('rent/*') ? "active" : "") !!}">
          <a href="{{ route('rent.list') }}" class="nav-link"><i class="fas fa-money-check"></i><span>Update Rent Collection</span></a>
        </li>
        @endif
        
        @if(request()->user()->can('view-maintenance-cost'))
        <li class="dropdown {!! (Request::is('maintenancecost/*') ? "active" : "") !!}">
          <a href="{{ route('maintenancecosts.list') }}" class="nav-link"><i class="fas fa-wrench"></i><span>Maintenance Costs</span></a>
        </li>
        @endif
        
        @if(request()->user()->can('view-building-setup'))
        <li  class="dropdown {!! (Request::is('floors/*') ? "active" : "") !!} {!! (Request::is('units*') ? "active" : "") !!} {!! (Request::is('role/edit/*') ? "active" : "") !!} {!! (Request::is('module/list') ? "active" : "") !!} {!! (Request::is('module/create') ? "active" : "") !!} {!! (Request::is('module/edit/*') ? "active" : "") !!} {!! (Request::is('permission/list') ? "active" : "") !!} {!! (Request::is('permission/create') ? "active" : "") !!} {!! (Request::is('permission/edit/*') ? "active" : "") !!} {!! (Request::is('role/assign-permission/*') ? "active" : "") !!}" >
          <a href="#" class="menu-toggle nav-link has-dropdown role-permission-dropdown"><i class="
              fas fa-cogs"></i><span>Building Setup</span></a>
          <ul class="dropdown-menu">
              @if(request()->user()->can('view-floors'))
              <li><a href="{{ route('floors.list') }}" class="nav-link">Floors</a></li>
              @endif
              @if(request()->user()->can('view-apartments'))
              <li><a href="{{ route('units.list') }}" class="nav-link">Apartments</a></li>
              @endif
          </ul>
        </li>
        @endif
        
        
        
        @if(request()->user()->can('view-role-and-permission'))
          <li style="display:none;" class="dropdown {!! (Request::is('role/list') ? "active" : "") !!} {!! (Request::is('role/create') ? "active" : "") !!} {!! (Request::is('role/edit/*') ? "active" : "") !!} {!! (Request::is('module/list') ? "active" : "") !!} {!! (Request::is('module/create') ? "active" : "") !!} {!! (Request::is('module/edit/*') ? "active" : "") !!} {!! (Request::is('permission/list') ? "active" : "") !!} {!! (Request::is('permission/create') ? "active" : "") !!} {!! (Request::is('permission/edit/*') ? "active" : "") !!} {!! (Request::is('role/assign-permission/*') ? "active" : "") !!}" >
            <a href="#"  class="menu-toggle nav-link has-dropdown role-permission-dropdown"><i class="fas fa-user-shield"></i><span>Roles & Permission</span></a>
            <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('role.list') }}">Roles</a></li>
                
                {{-- <li><a class="nav-link" href="{{ route('module.list')}} ">Modules</a></li>
                <li><a class="nav-link" href="{{ route('permission.list') }}">Permissions</a></li> --}}
            </ul>
          </li>
        @endif
    </aside>
  </div>