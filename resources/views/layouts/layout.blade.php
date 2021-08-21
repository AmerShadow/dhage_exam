<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Breeze Admin</title>
    <link rel="stylesheet" href="{{url('assets/vendors/mdi/css/materialdesignicons.min.css')}}" />
    <link rel="stylesheet" href="{{url('assets/vendors/flag-icon-css/css/flag-icon.min.css')}}" />
    <link rel="stylesheet" href="{{url('assets/vendors/css/vendor.bundle.base.css')}}" />
    <link rel="stylesheet" href="{{url('assets/vendors/select2/select2.min.css')}} ">
    <link rel="stylesheet" href="{{url('assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{url('assets/vendors/font-awesome/css/font-awesome.min.css')}}" />
    <link rel="stylesheet" href="{{url('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" />
    <link rel="stylesheet" href="{{url('assets/css/style.css')}}" />
    <link rel="shortcut icon" href="{{url('assets/images/favicon.png')}}" />
  </head>
<body>
  <div class="container-scroller">
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <div class="text-center sidebar-brand-wrapper d-flex align-items-center">
        <a class="sidebar-brand brand-logo mb-4" href=""><img src="{{asset('svg/logo.png')}}"  alt="logo" /></a>
        <a class="sidebar-brand brand-logo-mini pl-4 pt-3" href=""><img src="{{asset('svg/logo.png')}}" alt="logo" /></a>
      </div>
      <ul class="nav">
       
        <li class="nav-item">
          <a class="nav-link" href="index.html">
            <i class="mdi mdi-home menu-icon"></i>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <i class="mdi mdi-crosshairs-gps menu-icon"></i>
            <span class="menu-title">Exams</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="ui-basic">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item">
                <a class="nav-link" href="{{route('exam.index')}}">All Exams</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('exam.create')}}">Creat Exam</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="">Set Paper</a>
              </li>
            </ul>
          </div>
        </li>
        
        
        
        <li class="nav-item sidebar-actions">
          <div class="nav-link">
            <div class="mt-4">
              
              <ul class="mt-4 pl-0">
                <li>Sign Out</li>
              </ul>
            </div>
          </div>
        </li>
      </ul>
    </nav>
    <div class="container-fluid page-body-wrapper">
      <div id="theme-settings" class="settings-panel">
        <i class="settings-close mdi mdi-close"></i>
        <p class="settings-heading">SIDEBAR SKINS</p>
        <div class="sidebar-bg-options selected" id="sidebar-default-theme">
          <div class="img-ss rounded-circle bg-light border mr-3"></div> Default
        </div>
        <div class="sidebar-bg-options" id="sidebar-dark-theme">
          <div class="img-ss rounded-circle bg-dark border mr-3"></div> Dark
        </div>
        <p class="settings-heading mt-2">HEADER SKINS</p>
        <div class="color-tiles mx-0 px-4">
          <div class="tiles light"></div>
          <div class="tiles dark"></div>
        </div>
      </div>
      <nav class="navbar col-lg-12 col-12 p-lg-0 fixed-top d-flex flex-row">
        <div class="navbar-menu-wrapper d-flex align-items-stretch justify-content-between">
          <a class="navbar-brand brand-logo-mini align-self-center d-lg-none" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
          <button class="navbar-toggler navbar-toggler align-self-center mr-2" type="button" data-toggle="minimize">
            <i class="mdi mdi-menu"></i>
          </button>
          <ul class="navbar-nav">
           
            <li class="nav-item dropdown d-none d-sm-flex">
              <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown">
                <i class="mdi mdi-email-outline"></i>
                <span class="count count-varient2">5</span>
              </a>
              <div class="dropdown-menu navbar-dropdown navbar-dropdown-large preview-list" aria-labelledby="messageDropdown">
                <h6 class="p-3 mb-0">Messages</h6>
                <a class="dropdown-item preview-item">
                  <div class="preview-item-content flex-grow">
                    <span class="badge badge-pill badge-success">Request</span>
                    <p class="text-small text-muted ellipsis mb-0"> Suport needed for user123 </p>
                  </div>
                  <p class="text-small text-muted align-self-start"> 4:10 PM </p>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-item-content flex-grow">
                    <span class="badge badge-pill badge-warning">Invoices</span>
                    <p class="text-small text-muted ellipsis mb-0"> Invoice for order is mailed </p>
                  </div>
                  <p class="text-small text-muted align-self-start"> 4:10 PM </p>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-item-content flex-grow">
                    <span class="badge badge-pill badge-danger">Projects</span>
                    <p class="text-small text-muted ellipsis mb-0"> New project will start tomorrow </p>
                  </div>
                  <p class="text-small text-muted align-self-start"> 4:10 PM </p>
                </a>
                <h6 class="p-3 mb-0">See all activity</h6>
              </div>
            </li>
            <li class="nav-item nav-search border-0 ml-1 ml-md-3 ml-lg-5 d-none d-md-flex">
              <form class="nav-link form-inline mt-2 mt-md-0">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search" />
                  <div class="input-group-append">
                    <span class="input-group-text">
                      <i class="mdi mdi-magnify"></i>
                    </span>
                  </div>
                </div>
              </form>
            </li>
          </ul>
          <ul class="navbar-nav navbar-nav-right ml-lg-auto">
            <li class="nav-item dropdown d-none d-xl-flex border-0">
              <a class="nav-link dropdown-toggle" id="languageDropdown" href="#" data-toggle="dropdown">
                <i class="mdi mdi-earth"></i> English </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="languageDropdown">
                <a class="dropdown-item" href="#"> French </a>
                <a class="dropdown-item" href="#"> Spain </a>
                <a class="dropdown-item" href="#"> Latin </a>
                <a class="dropdown-item" href="#"> Japanese </a>
              </div>
            </li>
            <li class="nav-item nav-profile dropdown border-0">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown">
                <img class="nav-profile-img mr-2" alt="" src="assets/images/faces/face1.jpg" />
                <span class="profile-name">Henry Klein</span>
              </a>
              <div class="dropdown-menu navbar-dropdown w-100" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="#">
                  <i class="mdi mdi-cached mr-2 text-success"></i> Activity Log </a>
                <a class="dropdown-item" href="#">
                  <i class="mdi mdi-logout mr-2 text-primary"></i> Signout </a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      {{--  --}}
      <div class="main-panel">
        <div class="content-wrapper pb-0">

        @yield('content')
        </div>
      </div>
    </div>
  </div>


    <!-- plugins:js -->
    <script src="{{asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
    
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{asset('assets/vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('assets/vendors/flot/jquery.flot.js')}}"></script>
    <script src="{{asset('assets/vendors/flot/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('assets/vendors/flot/jquery.flot.categories.js')}}"></script>
    <script src="{{asset('assets/vendors/flot/jquery.flot.fillbetween.js')}}"></script>
    <script src="{{asset('assets/vendors/flot/jquery.flot.stack.js')}}"></script>
    <script src="{{asset('assets/vendors/flot/jquery.flot.pie.js')}}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <!-- endinject -->
    <script src="{{asset('assets/vendors/select2/select2.min.js')}}"></script>
    <script src="{{asset('assets/vendors/typeahead.js/typeahead.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/off-canvas.js')}}s"></script>
    <script src="{{asset('assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('assets/js/misc.js')}}"></script>
    <script src="{{asset('assets/js/file-upload.js')}}"></script>
    <script src="{{asset('assets/js/typeahead.js')}}"></script>
    <script src="{{asset('assets/js/select2.js')}}"></script>
    <!-- Custom js for this page -->
    <script src="{{asset('assets/js/dashboard.js')}}"></script>

    

    <!-- End custom js for this page -->
  </body>
</html>
