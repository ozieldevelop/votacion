<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="www.cooprofesionales.com.pa" name="description" />
    <meta content="cooprofesionales" name="author" />
  <meta name="csrf-token" content="{{ csrf_token() }}">	

  <link rel="shortcut icon" href="../../favicon.ico">
  <title>PAPELETA :: Sistema de Votaci&oacute;n :: Cooperativa Profesionales</title>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>


  <link href="../../font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="../../css/simple-line-icons.css" rel="stylesheet">
  <link href="../../css/style_custom.css" rel="stylesheet">

  <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">

  <script src="../../js/herramientas.js"></script>

  <link rel="stylesheet" href="../../css/lolibox.min.css"/>
  <script src="../../js/lobibox.js"></script>


  <link href="../../css/bootstrap.min.css" rel="stylesheet">
  
  
    <script>

        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
  
    </script>

	
	<style>
      @font-face {
        font-family: "Ordinary";
        src: url('../../fonts/big_noodle_titling.ttf');
      }
	</style>
	
	<script>
	
		function Verificar()
		{
			//con esto se identifica si se presiono la tecla F5
			var tecla=window.event.keyCode;
			//console.log(tecla);
			if (tecla==116) {
				  event.keyCode=0;
				  event.returnValue=false;      
				  return false;
			}
		}


		function nobackbutton(){


		   window.location.hash="no-back-button";


		   window.location.hash="Again-No-back-button" //chrome


		   window.onhashchange=function(){window.location.hash="no-back-button";}
			

		}
	</script>
  
  
    <style>
      /* unvisited link */
      a:link {
        color: #fff;
      }
      /* visited link */
      a:visited {
        color:  #fff;
      }
      /* mouse over link */
      a:hover {
        color:  #fff;
      }
      /* selected link */
      a:active {
        color:  #fff;
      }
    </style>
  
  
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden sidebar-hidden"   onKeyDown="javascript:Verificar()">
  <header class="app-header navbar" style="font-weight: bold;">

		 <div style="width:100%;background:#008d5e;text-align: center;color:white;font-size: 28px;font-weight: bold; ">
      <a href="{{ env('APP_URL', './') }}/cliente/dashboard/?wget={{ $enlace["wget"] }}&id_evento={{ $enlace["id_evento"] }}">  {{  isset($nombreevento) ? $nombreevento :  '' }}   </a>
    </div>
	     &nbsp; &nbsp; &nbsp; BUSCAR  &nbsp; <input type="text" class="form-control col-md-6 col-lg-4 " id="elfiltro" placeholder="INGRESE EL N&Uacute;MERO DE CLIENTE O NOMBRE "  style="font-family: arial;width: 36%;background: #111a07;"/> <br/>
	 

    <ul class="nav navbar-nav ml-auto">

      <li class="nav-item dropdown">

        <div class="dropdown-menu dropdown-menu-right">
          <div class="dropdown-header text-center">
            <strong>Account</strong>
          </div>
          <a class="dropdown-item" href="#"><i class="fa fa-bell-o"></i> Updates<span class="badge badge-info">42</span></a>
          <a class="dropdown-item" href="#"><i class="fa fa-envelope-o"></i> Messages<span class="badge badge-success">42</span></a>
          <a class="dropdown-item" href="#"><i class="fa fa-tasks"></i> Tasks<span class="badge badge-danger">42</span></a>
          <a class="dropdown-item" href="#"><i class="fa fa-comments"></i> Comments<span class="badge badge-warning">42</span></a>
          <div class="dropdown-header text-center">
            <strong>Settings</strong>
          </div>
          <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Profile</a>
          <a class="dropdown-item" href="#"><i class="fa fa-wrench"></i> Settings</a>
          <a class="dropdown-item" href="#"><i class="fa fa-usd"></i> Payments<span class="badge badge-secondary">42</span></a>
          <a class="dropdown-item" href="#"><i class="fa fa-file"></i> Projects<span class="badge badge-primary">42</span></a>
          <div class="divider"></div>
          <a class="dropdown-item" href="#"><i class="fa fa-shield"></i> Lock Account</a>
          <a class="dropdown-item" href="#"><i class="fa fa-lock"></i> Logout</a>
        </div>
      </li>
    </ul>
    <button class="navbar-toggler aside-menu-toggler" type="button">
	  <label style="margin-left: 51px;color:#000;font-size: 16px;font-weight: bold;">Cantidad de candidatos seleccionados:</label><label id="contadorSeleccionados" style="font-weight: bold;color:#000;font-family: Impact;font-size: 28px;">(0)</label>
      <span class="navbar-toggler-icon"></span>
    </button>
     
	<script>
							var tiempoCena = localStorage.getItem('xccok');
	</script>
		
  </header>

  <div class="app-body">

		@yield('content')
    

  </div>

  <footer class="app-footer">

  </footer>

<script src="../../js/app2.js"></script>
<script src="../../js/movildetect.js"></script>

@yield('page-script')

</body>
</html>