
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

    <title>{{ $nombreevento }} </title>
    <meta content="www.cooprofesionales.com.pa" name="description" />
    <meta content="cooprofesionales" name="author" />

  
    <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">
    


		
    <link rel="shortcut icon" href="../../images/favicon.ico">

    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../../assets/css/metismenu.min.css" rel="stylesheet" type="text/css">
    <link href="../../assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="../../assets/css/style.css" rel="stylesheet" type="text/css">

    <!--link href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script-->
  

  
	  <link rel="stylesheet" href="../../plugins/codemirror/codemirror.css">
    <link rel="stylesheet" href="../../plugins/codemirror/theme/monokai.css">

     <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script> 
    <script>

        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
  
    </script>
	
  
     <link rel="stylesheet" href="{{ asset('css/lolibox.css') }}">
    <script src="{{ asset('js/lobibox.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
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
                                    <i class="mdi mdi-folder-open-outline"></i>{{ $nombreevento }}
								
                            </span> <br/> 
							
                        </a>
                    </div>


                    <div class="menu-extras topbar-custom navbar p-0">


                        <ul class="navbar-right ml-auto list-inline float-right mb-0">

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

    <div class="wrapper" style="padding-top: 84px;">
        <div class="container-fluid">

          @yield('content')
          
        </div>
    </div>

    <footer class="footer">
        ©  {{ date("Y")  }}  </title> <span class="d-none d-sm-inline-block"> - Cooperativa Profesionales, R.L.</span>.
    </footer>

  	  

    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <script src="{{ asset('js/herramientas.js') }}"></script>

    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/jquery.slimscroll.js"></script>
    <script src="../../assets/js/waves.min.js"></script>


    <script src="../../plugins/codemirror/codemirror.js"></script>
    <script src="../../plugins/codemirror/mode/css/css.js"></script>
    <script src="../../plugins/codemirror/mode/xml/xml.js"></script>
    <script src="../../plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>  
    <script src="../../plugins/codemirror/addon/runmode/runmode.js"></script>    

    <!-- App js -->
    <script src="../../assets/js/app.js"></script>

    <script>


  
		 function nobackbutton()
     {
		   window.location.hash="no-back-button";
		   window.location.hash="Again-No-back-button" //chrome
		   window.onhashchange=function(){window.location.hash="no-back-button";}
		 }

    </script>

    @yield('page-script')
  
 </body> 
</html>