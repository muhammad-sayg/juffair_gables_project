<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html"> <img alt="image" style="height: 55px" src="{{ asset('/public/admin/assets')}}/img/juffair_gables_logo.png" class="header-logo" /> <span
            class="logo-name"></span>
        </a>
      </div>
      <div class="sidebar-user">
        {{-- <div class="sidebar-user-picture">
          <img alt="image" src="{{ asset('public/admin/assets/img/staff/') }}/{{Auth::user()->image}}">
        </div> --}}
        {{-- <div class="text-white">{{ Auth::user()->userType}}</div> --}}
        <div class="text-white">{{ Auth::user()->name}}</div>
      </div>
      <ul class="sidebar-menu">
        <li class="menu-header">Main</li>
        <li class="dropdown  {!! (Request::is('dashboard') ? "active" : "") !!}">
            <a href="{{ route('dashboard')}}" class="nav-link"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
        </li>
        
        {{-- <li class="dropdown">
          <a href="/" class="menu-toggle nav-link has-dropdown"><i class="fas fa-building"
             ></i><span>Building Information</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{ route('buildings.list') }}">Building List</a></li>
           
          </ul>
        </li> --}}
        
        @if(Auth::user()->userType == 'officer')
          
          <li class="dropdown {!! (Request::is('units/full_apartment*') ? "active" : "") !!} {!! (Request::is('units/unit/search_filter') ? "active" : "") !!} ">
            <a href="{{ route('units.full_apartment.list') }}" class="nav-link"><i class="fas fa-home"></i><span>Full Apartment List</span></a>
          </li>
          
          <li class="dropdown {!! (Request::is('tenants*') ? "active" : "") !!}">
            <a href="{{ route('tenants.list') }}" class="nav-link"><i class="fas fa-users"></i><span>Add New Tenant</span></a>
          </li>
          <li class="dropdown {!! (Request::is('service_contract*') ? "active" : "") !!}">
            <a href="{{ route('service_contract.list') }}" class="nav-link"><i class="
              fas fa-plus-circle"></i><span>Add a New Service Contract</span></a>
          </li>

          <li class="dropdown {!! (Request::is('rent/*') ? "active" : "") !!}">
            <a href="{{ route('rent.list') }}" class="nav-link"><i class="fas fa-money-check"></i><span>Update Rent Collection</span></a>
          </li>
          
          <li class="dropdown {!! (Request::is('reports*') ? "active" : "") !!}">
            <a href="{{ route('reports.list') }}" class="nav-link"><i class="
              fas fa-sticky-note"></i><span>Reports</span></a>
          </li>
        @endif

        @if(Auth::user()->userType == 'employee')
        <li class="dropdown {!! (Request::is('units/rented_apartment*') ? "active" : "") !!}">
          <a href="{{ route('units.rented_apartment.list') }}" class="nav-link"><i class="fas fa-home"></i><span>Rented Apartment</span></a>
        </li>
        <li class="dropdown {!! (Request::is('tasks/task/*') ? "active" : "") !!}"><a href="{{ route('tasks.list') }}" class="nav-link">@if(\Auth::user()->userType != 'employee')<i class="fas fa-book"></i><span>Tasks </span>@else <i class="fas fa-book"></i><span>Active Tasks</span> @endif</a></li>
       
        
        <li class="dropdown {!! (Request::is('leave/*') ? "active" : "") !!}">
          <a href="{{ route('leave.list') }}" class="nav-link"><i class="
            fas fa-pen-alt"></i><span>Apply Leave</span></a>
        </li>

        <li class="dropdown {!! (Request::is('request/request/*') ? "active" : "") !!}">
          <a href="{{ route('request.list') }}" class="nav-link"><i class="fas fa-user-edit"></i><span>Report Maintenance Request</span></a>
        </li>
        <li class="dropdown {!! (Request::is('send/message*') ? "active" : "") !!}">
          <a href="{{ route('send_message') }}" class="nav-link"><i class="fas fa-envelope"></i><span>Send Message</span></a>
        </li>
        
        @endif

       

        @if(Auth::user()->userType == 'general-manager' || Auth::user()->userType == 'Admin')
        <li class="dropdown {!! (Request::is('tenants/*') ? "active" : "") !!}">
          <a href="{{ route('tenants.list') }}" class="nav-link"><i class="fas fa-users"></i><span>Tenants </span></a>
        </li>
        @endif

        @if(Auth::user()->userType == 'general-manager' || Auth::user()->userType == 'Admin')
        <li class="dropdown {!! (Request::is('staff/*') ? "active" : "") !!} ">
          <a href="{{ route('staff.list') }}" class="nav-link"><i class="fas fa-user"></i><span>Staff </span></a>
        </li>
        @endif
        {{-- <li class="dropdown">
          <a href="/" class="menu-toggle nav-link has-dropdown"><i class="fas fa-user"></i><span>Owner Information </span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{ route('owners.list') }}">Owner List</a></li>
          </ul>
        </li> --}}
        {{-- <li class="dropdown  {!! (Request::is('tenants/tenant_list') ? "active" : "") !!}">
          <a href="/" class="menu-toggle nav-link has-dropdown"><i class="fas fa-users"></i><span>Tenant Information</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{ route('tenants.list') }}">Tenant List</a></li>
          </ul>
        </li> --}}
        {{-- 
        <li class="dropdown {!! (Request::is('employee/employee_list') ? "active" : "") !!}">
          <a href="/" class="menu-toggle nav-link has-dropdown"><i class="fas fa-address-card"></i><span>Employee Information</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{ route('employee.list') }}">Employee List</a></li>
          </ul>
        </li>
        <li class="dropdown  {!! (Request::is('rent/rent_list') ? "active" : "") !!}">
          <a href="/" class="menu-toggle nav-link has-dropdown"><i class="fas fa-dollar-sign "></i><span>Rent Collection</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{ route('rent.list') }}">Rent List</a></li>
          </ul>
        </li>
        --}}

        @if(request()->user()->can('view-utility-bill'))
        {{-- <li class="dropdown {!! (Request::is('utility_bill/*') ? "active" : "") !!}">
          <a href="{{ route('utility_bill.list') }}" class="nav-link"><i class="
            fas fa-money-bill-wave"></i><span>Utility Bill</span></a>
        </li> --}}
        @endif
        
       
        
        {{-- @if(request()->user()->can('view-security-deposit'))
        <li class="dropdown {!! (Request::is('securitydeposit/*') ? "active" : "") !!}">
          <a href="{{ route('securitydeposit.list') }}" class="nav-link"><i class="fas fa-money-bill-alt"></i><span>Security Deposits</span></a>
        </li>
        @endif --}}
        
        @if(Auth::user()->userType == 'general-manager' || Auth::user()->userType == 'Admin')
        <li class="dropdown {!! (Request::is('tasks/*') ? "active" : "") !!}">
          <a href="{{ route('tasks.list') }}" class="nav-link">@if(\Auth::user()->userType != 'employee')<i class="fas fa-book"></i><span>Tasks</span> @endif</a>
        </li>
        @endif
        
        {{-- @if(request()->user()->can('view-employees-request'))
        <li class="dropdown {!! (Request::is('request/*') ? "active" : "") !!}">
          <a href="{{ route('request.list') }}" class="nav-link"><i class="fas fa-newspaper"></i><span>Employees Request</span></a>
        </li>
        @endif
       
        --}}
        {{-- @if(Auth::user()->userType == 'general-manager' OR Auth::user()->userType == 'Admin')
        <li class="dropdown {!! (Request::is('request/*') ? "active" : "") !!}">
          <a href="{{ route('request.list')}}" class="nav-link">
            <i class="fas fa-comment-dots"></i>
            <span>Incoming Request</span>
          </a>
        </li>
        @endif --}}
        @if(request()->user()->can('view-visitor'))
        {{-- <li class="dropdown {!! (Request::is('visitor/*') ? "active" : "") !!}">
          <a href="{{ route('visitor.list') }}" class="nav-link"><i class="fas fa-user-friends"></i><span>Visitor List</span></a>
        </li> --}}
        @endif

        @if(Auth::user()->userType == 'general-manager' || Auth::user()->userType == 'Admin')
        {{-- <li class="dropdown">
          <a href="/" class="menu-toggle nav-link has-dropdown"><i class="fas fa-check-square"></i><span>Reservations</span></a> 
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{ route('reservation.list') }}">Reservation Details</a></li>
             <li><a class="nav-link" href="{{ route('room.list') }}">Add Rooms</a></li>
          </ul>
        </li> --}}
        
        
        @if(Auth::user()->userType == 'general-manager' || Auth::user()->userType == 'Admin')
        <li class="dropdown {!! (Request::is('approveleave/*') ? "active" : "") !!} {!! (Request::is('leave/*') ? "active" : "") !!}">
          <a href="{{ route('approveleave.list') }}" class="nav-link"><i class="
            fas fa-calendar-check"></i><span>Leave Request</span></a>
        </li>
        @endif  
        @if(Auth::user()->userType == 'general-manager' || Auth::user()->userType == 'Admin')
        <li class="dropdown {!! (Request::is('messages/*') ? "active" : "") !!} {!! (Request::is('leave/*') ? "active" : "") !!}">
          <a href="{{ route('messages.list') }}" class="nav-link"><i class="fas fa-envelope"></i><span>Messages</span></a>
        </li>
        @endif  
        @if(Auth::user()->userType == 'general-manager' || Auth::user()->userType == 'Admin')
        <li class="dropdown {!! (Request::is('testimonials/*') ? "active" : "") !!}">
          <a href="{{ route('testimonials.list') }}" class="nav-link"><i class="
            fas fa-comment"></i><span>Reviews</span></a>
        </li>
        @endif 

        @if(Auth::user()->userType == 'general-manager' || Auth::user()->userType == 'Admin')
        <li class="dropdown {!! (Request::is('facilities/*') ? "active" : "") !!}">
          <a href="{{ route('facilities.list') }}" class="nav-link"><i class="
            fas fa-spa"></i><span>Facilities</span></a>
        </li>

        <li class="dropdown {!! (Request::is('reservation/*') ? "active" : "") !!}">
          <a href="{{ route('reservation.list') }}" class="nav-link"><i class="
            far fa-registered"></i><span>Reserved  Facilities</span></a>
        </li>
        @endif

        @if(Auth::user()->userType == 'general-manager' || Auth::user()->userType == 'Admin')
        <li class="dropdown {!! (Request::is('job/*') ? "active" : "") !!}">
          <a href="{{ route('job.list') }}" class="nav-link"><i class="
          fas fa-window-restore"></i><span>Job Opportunities</span></a>
        </li>
        @endif

        @if(Auth::user()->userType == 'general-manager' || Auth::user()->userType == 'Admin')
        <li class="dropdown {!! (Request::is('maintenancecost/*') ? "active" : "") !!}">
          <a href="{{ route('maintenancecosts.list') }}" class="nav-link"><i class="fas fas fa-toolbox"></i><span>Maintenance Costs</span></a>
        </li>
        @endif

        @if(Auth::user()->userType == 'general-manager' || Auth::user()->userType == 'Admin')
        <li  class="dropdown {!! (Request::is('floors/*') ? "active" : "") !!} {!! (Request::is('units*') ? "active" : "") !!} {!! (Request::is('role/edit/*') ? "active" : "") !!} {!! (Request::is('module/list') ? "active" : "") !!} {!! (Request::is('module/create') ? "active" : "") !!} {!! (Request::is('module/edit/*') ? "active" : "") !!} {!! (Request::is('permission/list') ? "active" : "") !!} {!! (Request::is('permission/create') ? "active" : "") !!} {!! (Request::is('permission/edit/*') ? "active" : "") !!} {!! (Request::is('role/assign-permission/*') ? "active" : "") !!}" >
          <a href="#" class="menu-toggle nav-link has-dropdown role-permission-dropdown"><i class="
              fas fa-cogs"></i><span>Building Setup</span></a>
          <ul class="dropdown-menu">
              <li><a href="{{ route('floors.list') }}" class="nav-link">Floors</a></li>
              <li><a href="{{ route('units.list') }}" class="nav-link">Apartments</a></li>
          </ul>
        </li>
        @endif
        {{-- <li class="dropdown">
          <a href="/" class="menu-toggle nav-link has-dropdown"><i class="fas fa-chalkboard"></i><span>Notice Board</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{ route('notice.list') }}">Notice List</a></li>
          </ul>
        </li> --}}
        @endif
        {{--<li class="dropdown">
          <a href="/" class="menu-toggle nav-link has-dropdown"><i class="far fa-user"></i><span>Complaints & Suggestions</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="">Complaint List</a></li>
          </ul>
        </li>
       
        
         <li class="dropdown">
          <a href="/" class="menu-toggle nav-link has-dropdown"><i class="fas fa-chalkboard"></i><span>Notice Board</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{ route('notice') }}">Notice List</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="/" class="menu-toggle nav-link has-dropdown"><i class="fas fa-hands-helping"></i><span>Help Desk</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{ route('helpdesk') }}">Helpdesk List</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="/" class="menu-toggle nav-link has-dropdown"><i class="fas fa-flag"></i><span>Reports</span></a>
         <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{ route('rentreport') }}">Rental Report</a></li>
             <li><a class="nav-link" href="{{ route('visitorsreport') }}">Visitors Report</a></li>
              <li><a class="nav-link" href="{{ route('complaintreport') }}">Complaint Report</a></li>
             <li><a class="nav-link" href="{{ route('unitstatusreport') }}">Unit Status Report</a></li>
          </ul>
        </li> --}}
        @if(request()->user()->can('view-role-and-permission'))
        <li style="display:none;" class="dropdown {!! (Request::is('role/list') ? "active" : "") !!} {!! (Request::is('role/create') ? "active" : "") !!} {!! (Request::is('role/edit/*') ? "active" : "") !!} {!! (Request::is('module/list') ? "active" : "") !!} {!! (Request::is('module/create') ? "active" : "") !!} {!! (Request::is('module/edit/*') ? "active" : "") !!} {!! (Request::is('permission/list') ? "active" : "") !!} {!! (Request::is('permission/create') ? "active" : "") !!} {!! (Request::is('permission/edit/*') ? "active" : "") !!} {!! (Request::is('role/assign-permission/*') ? "active" : "") !!}" >
          <a href="#"  class="menu-toggle nav-link has-dropdown role-permission-dropdown"><i class="fas fa-user-shield"></i><span>Roles & Permission</span></a>
          <ul class="dropdown-menu">
              <li><a class="nav-link" href="{{ route('role.list') }}">Roles</a></li>
              
              <li><a class="nav-link" href="{{ route('module.list')}} ">Modules</a></li>
              <li><a class="nav-link" href="{{ route('permission.list') }}">Permissions</a></li>
          </ul>
        </li>
        @endif
    </aside>
  </div>