
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">	
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta content="www.cooprofesionales.com.pa" name="description" />
    <meta content="cooprofesionales" name="author" />
    <link rel="shortcut icon" href="../../assets/images/favicon.ico">

    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../../assets/css/metismenu.min.css" rel="stylesheet" type="text/css">
    <link href="../../assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="../../assets/css/style.css" rel="stylesheet" type="text/css">

  
      <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>



  
  
      <!--link href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css">
      <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script-->
  
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <script src="{{ asset('js/herramientas.js') }}"></script>
    
    <script src="{{ asset('datatable/1.10.22/') }}/DataTables-1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('datatable/1.10.22/') }}/DataTables-1.10.22/js/dataTables.bootstrap4.min.js"></script>  
    <script src="{{ asset('datatable/1.10.22/') }}/Responsive-2.2.6/js/dataTables.responsive.min.js"></script> 
    <script src="{{ asset('datatable/1.10.22/') }}/Responsive-2.2.6/js/responsive.bootstrap4.min.js"></script> 
    
    
    
    <link href="{{ asset('datatable/1.10.22/') }}/DataTables-1.10.22/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">  
    <link href="{{ asset('datatable/1.10.22/') }}/Responsive-2.2.6/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">

    <script>

	  
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
  
    </script>
</head>

<body>

    <div class="header-bg">
        <!-- Navigation Bar-->
        <header id="topnav">
            <div class="topbar-main">
                <div class="container-fluid">

                    <!-- Logo-->
                    <div>
                        <a href="/home" class="logo">
                            <span class="logo-light">
                                    <i class="mdi mdi-folder-open-outline"></i> {{ config('app.name', 'Laravel') }}
                            </span>
                        </a>
                    </div>
                    <!-- End Logo-->

                    <div class="menu-extras topbar-custom navbar p-0">
                        <!--ul class="list-inline d-none d-lg-block mb-0">
                            <li class="hide-phone app-search float-left">
                                <form role="search" class="app-search">
                                    <div class="form-group mb-0">
                                        <input type="text" class="form-control" placeholder="Search..">
                                        <button type="submit"><i class="fa fa-search"></i></button>
                                    </div>
                                </form>
                            </li>
                        </ul-->

                        <ul class="navbar-right ml-auto list-inline float-right mb-0">
                            <!-- language-->
                            <!--li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                                <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img src="../../assets/images/flags/us_flag.jpg" class="mr-2" height="12" alt="" /> English <span class="mdi mdi-chevron-down"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated language-switch">
                                    <a class="dropdown-item" href="#"><img src="../../assets/images/flags/french_flag.jpg" alt="" height="16" /><span> French </span></a>
                                    <a class="dropdown-item" href="#"><img src="../../assets/images/flags/spain_flag.jpg" alt="" height="16" /><span> Spanish </span></a>
                                    <a class="dropdown-item" href="#"><img src="../../assets/images/flags/russia_flag.jpg" alt="" height="16" /><span> Russian </span></a>
                                    <a class="dropdown-item" href="#"><img src="../../assets/images/flags/germany_flag.jpg" alt="" height="16" /><span> German </span></a>
                                    <a class="dropdown-item" href="#"><img src="../../assets/images/flags/italy_flag.jpg" alt="" height="16" /><span> Italian </span></a>
                                </div>
                            </li-->

                            <!-- full screen -->
                            <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                                <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                                    <i class="mdi mdi-arrow-expand-all noti-icon"></i>
                                </a>
                            </li>

                            <!-- notification -->
                            <li class="dropdown notification-list list-inline-item">
                                <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <i class="mdi mdi-bell-outline noti-icon"></i>
                                    <span class="badge badge-pill badge-danger noti-icon-badge">3</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-lg px-1">
                                    <!-- item-->
                                    <h6 class="dropdown-item-text">
                                            Notifications
                                        </h6>
                                    <div class="slimscroll notification-item-list">
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                            <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                                            <p class="notify-details"><b>Your order is placed</b><span class="text-muted">Dummy text of the printing and typesetting industry.</span></p>
                                        </a>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon bg-danger"><i class="mdi mdi-message-text-outline"></i></div>
                                            <p class="notify-details"><b>New Message received</b><span class="text-muted">You have 87 unread messages</span></p>
                                        </a>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon bg-info"><i class="mdi mdi-filter-outline"></i></div>
                                            <p class="notify-details"><b>Your item is shipped</b><span class="text-muted">It is a long established fact that a reader will</span></p>
                                        </a>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon bg-success"><i class="mdi mdi-message-text-outline"></i></div>
                                            <p class="notify-details"><b>New Message received</b><span class="text-muted">You have 87 unread messages</span></p>
                                        </a>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon bg-warning"><i class="mdi mdi-cart-outline"></i></div>
                                            <p class="notify-details"><b>Your order is placed</b><span class="text-muted">Dummy text of the printing and typesetting industry.</span></p>
                                        </a>

                                    </div>
                                    <!-- All-->
                                    <a href="javascript:void(0);" class="dropdown-item text-center notify-all text-primary">
                                            View all <i class="fi-arrow-right"></i>
                                        </a>
                                </div>
                            </li>

                            <li class="dropdown notification-list list-inline-item">
                                <div class="dropdown notification-list nav-pro-img">
                                    <a class="dropdown-toggle nav-link arrow-none nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                        <img src="../../assets/images/users/user-4.jpg" alt="user" class="rounded-circle">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                        <!-- item-->
                                        <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Profile</a>
                                        <a class="dropdown-item" href="#"><i class="mdi mdi-wallet"></i> My Wallet</a>
                                        <a class="dropdown-item d-block" href="#"><span class="badge badge-success float-right">11</span><i class="mdi mdi-settings"></i> Settings</a>
                                        <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline"></i> Lock screen</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-danger" href="{{ route('logout') }}"><i class="mdi mdi-power text-danger"></i> Logout</a>
                                    </div>
                                </div>
                            </li>

                            <li class="menu-item dropdown notification-list list-inline-item">
                                <!-- Mobile menu toggle-->
                                <a class="navbar-toggle nav-link">
                                    <div class="lines">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </a>
                                <!-- End mobile menu toggle-->
                            </li>

                        </ul>

                    </div>
                    <!-- end menu-extras -->

                    <div class="clearfix"></div>

                </div>
                <!-- end container -->
            </div>
            <!-- end topbar-main -->

            <!-- MENU Start -->
			<div class="navbar-custom">
                <div class="container-fluid">

                    <div id="navigation">

                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">

                            <!--li class="has-submenu">
                                <a href="/home"><i class="icon-accelerator"></i> Dashboards</a>
                            </li-->



                        </ul>

                        <!-- End navigation menu -->
                    </div>
                    <!-- end #navigation -->
                </div>
                <!-- end container -->
            </div>
            <!-- end navbar-custom -->
        </header>
        <!-- End Navigation Bar-->

    </div>
    <!-- header-bg -->

    <div class="wrapper">
        <div class="container-fluid">

            <!--<div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title"></h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">{{ config('app.name', 'Laravel') }}</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);"></a></li>
                         
                        </ol>
                    </div>
                </div>
           

            </div>-->

     
          
          
          
            
          @yield('content')
          
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- end wrapper -->

    <!-- Footer -->
    <footer class="footer">
        © 2020 - {{ date("Y")  }} {{  config('app.name', 'Laravel') }} </title> <span class="d-none d-sm-inline-block"> - Crafted with by eaguilars</span>.
    </footer>

    <!-- End Footer -->

    <!-- jQuery  -->
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/jquery.slimscroll.js"></script>
    <script src="../../assets/js/waves.min.js"></script>

    <!-- App js -->
    <script src="../../assets/js/app.js"></script>

</body>

   @yield('page-script')
  
  
</html>