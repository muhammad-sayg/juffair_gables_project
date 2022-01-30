<style>
    .header-bottom {
        background: #fff !important;
    }
    .categories-area .single-cat::before {
        background: #240cf4 !important;
    }
    .section-tittle span
    {
        color: #240cf4 !important;
    }
    .fa 
    {
        color:black;
    }
    .fas 
    {
        font-size: 14px;
        color:black;
    }
    .nav-item:hover > ul.dropdown-menu {
    display: block !important;
    }

    .dropdown-menu
    {
    left: -33px !important;
    background:black;
    
    }

    .dropdown-menu li a
    {
    color:#fff;
    }

    a.dropdown-toggle
    {
    color:black;
    }

    .dropdown:hover .dropdown-menu
    {
    display: bock;
    }

    .dropdown-menu > li > a:hover:after {
    text-decoration: underline;
    transform: rotate(-90deg);
    }

    .footer-area {
        background: #240cf4 !important;
    }

    #scrollUp, #back-top
    {
        color: #fff !important;
        background: #240cf4 !important;
    }

    #scrollUp, #back-top .fas
    {
        color: #fff !important;
       
    }

    .footer-tittle a
    {
        color:#fff !important;
    }

    .footer-area .footer-bottom {
        border-top: unset !important;
        padding: 0px 0px 23px;
    }

    .footer-bottom p
    {
        color: #fff !important;
    }

</style>
<header>
    <!-- Header Start -->
    <div class="header-area header-transparent">
       <div class="main-header">
          <div class="header-bottom  header-sticky">
             <div class="container-fluid">
                <div class="row align-items-center">
                   <!-- Logo -->
                   <div class="col-md-4">
                      <a href="{{ url('/') }}"><img
                         src="{{ asset('public/admin/assets/img/sayglogo.png') }}"
                         width="160px" height="90px" alt=""></a>
                   </div>
                   <div class="col-md-4">
                   </div>
                   <div class="col-md-4">
                    <li class="nav-item dropdown float-right">
                        <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          My Login
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                          <li><a href="{{ url('/login') }}" class="dropdown-item" href="#">Admin</a></li>
                          <li><a href="{{ url('/login') }}" class="dropdown-item" href="#">General Manager</a></li>
                          <li><a href="{{ url('/login') }}" class="dropdown-item" href="#">Accountant</a></li>
                          <li><a href="{{ url('/login') }}" class="dropdown-item" href="#">Employee</a></li>
                        </ul>
                      </li>
                   </div>
                   <!-- Mobile Menu -->
                   <div class="col-12">
                      <div class="mobile_menu d-block d-lg-none"></div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
    <!-- Header End -->
 </header>