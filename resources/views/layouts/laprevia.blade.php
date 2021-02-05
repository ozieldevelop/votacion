
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta content="Responsive admin theme build on top of Bootstrap 4" name="description" />
    <meta content="CooperativaRLdesign" name="author" />
	<meta name="csrf-token" content="{{ csrf_token() }}">	
		
    <link rel="shortcut icon" href="../../images/favicon.ico">

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
	
	
    <script>

        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
  


		function nobackbutton(){


		   window.location.hash="no-back-button";


		   window.location.hash="Again-No-back-button" //chrome


		   window.onhashchange=function(){window.location.hash="no-back-button";}
			

		}


    </script>
	
</head>

<body >

    <div class="header-bg">
        <!-- Navigation Bar-->
        <header id="topnav">
            <div class="topbar-main">
                <div class="container-fluid">

                    <!-- Logo-->
                    <div>
                        <a href="/" class="logo" style="line-height: 28px;">
                            <span class="logo-light">
                                    <i class="mdi mdi-folder-open-outline"></i> {{ $nombre }}
								
                            </span> <br/> 
					@if($id_evento == 1)
					<label style="color:white;font-style: italic;font-size: 12px;line-height: 0p; !important"> Verificaci&oacute;n de su voto para escogencia a delegados</label>
					@else
					<label style="color:white;font-style: italic;font-size: 12px;line-height: 0p; !important"> Verificaci&oacute;n de su voto para escogencia a directivos</label>
					@endif								
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
                            <!--li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                                <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                                    <i class="mdi mdi-arrow-expand-all noti-icon"></i>
                                </a>
                            </li-->

                          

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

                        <ul class="navigation-menu">

       

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

    <div class="wrapper" style="padding-top: 84px;">
        <div class="container-fluid">
 
 
          
          @yield('content')
          
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- end wrapper -->

    <!-- Footer -->
    <footer class="footer">
        ©  {{ date("Y")  }}  </title> <span class="d-none d-sm-inline-block"> - Cooperativa Profesionales, R.L.</span>.
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