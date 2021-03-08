

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <title>PAPELETA :: Sistema de Votaci&oacute;n :: Cooperativa Profesionales</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="../../../css/bootstrap3.min.css" rel="stylesheet">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>  
      <style type="text/css">
      
         .chat-room {
         border-collapse: collapse;
         border-spacing: 0;
         display: table;
         table-layout: fixed;
         width: 100%;
         position: relative;
         }
         .chat-room aside {
         display: table-cell;
         float: none;
         height: 100%;
         padding: 0;
         vertical-align: top;
         }
         .chat-room .kiri-side {
         width: 25%;
         background: #e5e8ef;
         border-radius: 4px 0 0 4px;
         -webkit-border-radius: 4px 0 0 4px;
         }
         .chat-room .tengah-side {
         width: 75%;
         background: #fff;
         border-right: 1px solid #e5e8ef;
         }
         .chat-room .kanan-side {
         width: 25%;
         background: #fff;
         }
         .chat-room .kiri-side .user-head {
         background: #008d5e;
         color: #FFFFFF;
         min-height: 70px;
         padding: 15px;
         }
         .chat-room .kanan-side .user-head {
         background: #008d5e;
         color: #FFFFFF;
         min-height: 70px;
         padding: 10px;
         border-left: 1px solid #008d5e;
         margin-left: -1px;
         position: relative;
         }
         .chat-room .user-head i {
         float: left;
         font-size: 40px;
         margin-right: 10px;
         }
         .chat-room .user-head h3 {
         margin: 6px 0 0 0;
         font-weight: 100;
         letter-spacing: 1px;
         }
         .chat-room-head {
         background: #008d5e;
         color: #FFFFFF;
         min-height: 70px;
         padding: 15px;
         }
         .chat-room-head h3 {
         margin: 5px 0 0;
         font-weight: 100;
         letter-spacing: 1px;
         display: inline-block;
         }
         .chat-room-head .search-btn {
         width: 20px;
         -webkit-transition: all .3s ease;
         -moz-transition: all .3s ease;
         -ms-transition: all .3s ease;
         -o-transition: all .3s ease;
         transition: all .3s ease;
         box-shadow: none;
         background: #eee;
         padding:0 5px 0 35px;
         margin-top: 2px;
         border: none;
         color: #fff;
         }
         .chat-room-head .search-btn:focus {
         width: 180px;
         box-shadow: none;
         -webkit-transition: all .3s ease;
         -moz-transition: all .3s ease;
         -ms-transition: all .3s ease;
         -o-transition: all .3s ease;
         transition: all .3s ease;
         /*background: #01a6b2;*/
         font-weight: 300;
         color: #fff;
         }
         .chat-room-head .search-btn:focus::-moz-placeholder {
         color: #fff;
         }
         ul.chat-list li a {
         color: #6a6a6a;
         display: block;
         padding: 15px;
         font-weight: 300;
         text-decoration: none;
         }
         ul.chat-list li a:hover, ul.chat-list li.active a {
         color: #00a9b4;
         background: #f2f4f7;
         }
         ul.chat-list li h4 {
         padding: 17px 15px;
         margin: 0;
         font-size: 14px;
         font-weight: 600;
         border-bottom: 1px solid #D5D7DE;
         }
         ul.chat-list li h4 i {
         padding-right: 5px;
         }
         ul.chat-list li a span {
         padding-left: 10px;
         }
         ul.chat-list li a i.fa-times {
         color: #9fa3b0;
         }
         ul.chat-list li.active {
         color: #00a9b4;
         background: #f2f4f7;
         }
         ul.chat-list {
         border-bottom: 1px solid #d5d7de;
         padding-left: 0;
         list-style: none;
         }
         ul.chat-user  {
         margin-bottom: 200px;
         }
         ul.chat-user li {
         border-bottom: none;
         }
         ul.chat-user li a:hover{
         background: none;
         color: #6a6a6a;
         }
         .chat-room .kiri-side footer {
         background: #d5d7de;
         padding: 15px;
         height: 70px;
         width: 25%;
         position: absolute;
         bottom: 0;
         }
         .chat-room .tengah-side footer {
         background: #f6f6f6;
         padding: 15px;
         height: 70px;
         bottom: 0;
         border-right: 1px solid #E5E8EF;
         }
         .chat-room .kanan-side footer {
         background: #fff;
         padding: 15px;
         height: 70px;
         width: 25%;
         position: absolute;
         bottom: 0;
         border-top: 1px solid #E5E8EF;
         }
         .chat-room .kiri-side footer .chat-avatar img {
         width: 40px;
         height: 40px;
         border: 2px solid #fff;
         float: left;
         }
         .chat-room .kiri-side footer .user-status {
         float: left;
         margin: 10px;
         }
         .chat-room .kiri-side footer .user-status i {
         padding-right: 5px;
         }
         .chat-room .left-side footer a.chat-dropdown {
         background: #96979a;
         border-radius: 2px;
         color: #fff;
         font-size: 10px;
         margin-top: 10px;
         padding: 3px 5px;
         }
         .room-desk {
         display: inline-block;
         margin-bottom: 30px;
         width: 100%;
         padding: 15px;
         }
         .room-desk h4 {
         text-transform: uppercase;
         font-weight: 300;
         font-size: 16px;
         margin: 5px 0 0 0;
         }
         .room-box {
         border: 1px solid #f7f8fa;
         background: #f7f8fa;
         padding: 10px;
         display: inline-block;
         width: 100%;
         margin-top: 10px;
         }
         .room-box h5 {
         margin: 0 0 5px 0;
         font-weight: 300;
         font-size: 16px;
         }
         .room-box h5 a {
         color: #00a9b4;
         }
         .chat-tools {
         float: right;
         padding: 3px;
         width: 40px;
         height: 35px;
         line-height: 30px;
         border-radius: 3px;
         -webkit-border-radius: 3px;
         text-align: center;
         margin-top: 6px;
         margin-left: 10px;
         }
         .chat-tools i {
         font-size: 16px !important;
         float: none !important;
         margin-right: 0 !important;
         color: #fff;
         }
         .btn-key {
         background: #1abc9c;
         }
         .btn-key:hover {
         background: #16a085;
         }
         .invite-row {
         background: #E5E8EF;
         display: inline-block;
         width: 100%;
         right: 0;
         height: 100%;
         }
         .invite-row h4 {
         font-size: 16px;
         font-weight: 300;
         }
         ul.chat-available-user {
         padding: 10px;
         list-style: none;
         }
         ul.chat-available-user li {
         margin-bottom: 15px;
         }
         ul.chat-available-user li a {
         color: #6a6a6a;
         text-decoration: none;
         }
         ul.chat-available-user li i {
         padding-right: 5px;
         font-size: 10px;
         }
         .group-rom {
         width: 100%;
         float: left;
         border-bottom: 1px solid #eaebee;
         }
         .group-rom .first-part,
         .group-rom .second-part,
         .group-rom .third-part {
         float: left;
         padding: 15px;
         }
         .group-rom .first-part {
         width: 25%;
         }
         .group-rom .first-part.odd {
         background: #f7f8fa;
         color: #6a6a6a;
         font-weight: 600;
         }
         .group-rom .second-part{
         width: 60%;
         }
         .group-rom .third-part{
         width: 15%;
         color: #d4d3d3;
         }
         a.guest-on {
         color: #6a6a6a;
         margin-top: 8px;
         display: inline-block;
         }
         a.guest-on i {
         background: #40cabe;
         color: #fff;
         padding: 4px;
         border-radius: 3px;
         -webkit-border-radius: 3px;
         margin-right: 5px;
         }
         .chat-txt {
         float: left;
         width: 70%;
         margin-right: 5px;
         }
         .lobby {
         padding: 0 !important;
         }
         .colwrap {
         position: absolute; /* fallback in no js */
         top: 10px; 
         width: 230px; /* 250px -10px 'padding' */
         background: #eee;
         background: transparent;
         }
         .navbar-custom {
         background-color: #008d5e;
         }
         /* change the brand and text color */
         .navbar-custom .navbar-brand,
         .navbar-custom .navbar-text {
         color: rgba(255,255,255,.8);
         }
         /* change the link color */
         .navbar-custom .navbar-nav .nav-link {
         color: rgba(255,255,255,.5);
         }
         /* change the color of active or hovered links */
         .navbar-custom .nav-item.active .nav-link,
         .navbar-custom .nav-item:hover .nav-link {
         color: #ffffff;
         } 
         /* Rounded tabs */
         @media (min-width: 576px) {
         .rounded-nav {
         border-radius: 50rem !important;
         }
         }
         @media (min-width: 576px) {
         .rounded-nav .nav-link {
         border-radius: 50rem !important;
         }
         }
         /* With arrow tabs */
         .with-arrow .nav-link.active {
         position: relative;
         }
         .with-arrow .nav-link.active::after {
         content: '';
         border-left: 6px solid transparent;
         border-right: 6px solid transparent;
         border-top: 6px solid #2b90d9;
         position: absolute;
         bottom: -6px;
         left: 50%;
         transform: translateX(-50%);
         display: block;
         }
         /* lined tabs */
         .lined .nav-link {
         border: none;
         border-bottom: 3px solid transparent;
         }
         .lined .nav-link:hover {
         border: none;
         border-bottom: 3px solid transparent;
         }
         .lined .nav-link.active {
         background: none;
         color: #555;
         border-color: #2b90d9;
         }
         body {
         min-height: 100vh;
         }
         .nav-pills .nav-link {
         color: #555;
         }
         .text-uppercase {
         letter-spacing: 0.1em;
         }
         .my-4 tags-bar nav nav-pills
         {
         margin-bottom: 20px; !important;
         }
         .seleccionadocard{
         border-color:#a0d08d;
         background: #8D9D84;
         }
         .noseleccionadocard{
         border: 1px solid #4dceff;
         background: 'none';
         }
         .seleccionadocard .card-body {
         color: white;
         }
         .noseleccionadocard .card-body {
         color: black;
         }
        
        
        
        
        .cuadritovotante{
          /*border: solid 1px #c3c3c3;*/
        }

  
  .chat__messages  ol{
  counter-reset: li;
  list-style: none;
  *list-style: decimal;
  font-size: 19px;
  font-family: 'Raleway', sans-serif;
  margin-bottom: 4em;
  font-weight: bold;
  }
  .chat__messages  ol ol{
  margin: 0 0 0 2em;
  }
  
  .chat__messages  a{
  position: relative;
  display: block;
  padding: .4em .4em .4em 2em;
  *padding: .4em;
  margin: .5em 0;
  background: #93C775;
  color: #000;
  text-decoration: none;
  -moz-border-radius: .3em;
  -webkit-border-radius: .3em;
  /*border-radius: 10em;*/
  transition: all .2s ease-in-out;
  font-size:19px;
  }
  
  .chat__messages  a:hover{
  background: #d6d4d4;
  text-decoration:none;
  transform: scale(1.1);
  }
  
  .chat__messages  a:before{
  content: counter(li);
  counter-increment: li;
  position: absolute;
  left: -1.3em;
  top: 50%;
  margin-top: -1.3em;
  background:#93C775;
  height: 2em;
  width: 2em;
  line-height: 2em;
  border: .3em solid #fff;
  text-align: center;
  font-weight: bold;
  -moz-border-radius: 2em;
  -webkit-border-radius: 2em;
  border-radius: 2em;
  color:#FFF;
  }        
        
        
      </style>
      <script>
         $.ajaxSetup({
             headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
           });
         
      </script>
   </head>
   <body>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-custom navbar-fixed-top">
         <div class="container">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               </button>
               <a class="navbar-brand" href="{{ env('APP_URL', './') }}/cliente/dashboard/?wget={{ $enlace["wget"] }}&id_evento={{ $enlace["id_evento"] }}" style="font-size: 26px;">  {{  isset($nombreevento) ? $nombreevento :  '' }}</a>
       
            </div>
            <div id="navbar" class="navbar-collapse collapse">
               <ul class="nav navbar-nav navbar-right">
                  <!--li><a href="../navbar/">Default</a></li-->
                  <li><label style="color:white;font-weight: bold;font-size: 19px;"> Cantidad de candidatos seleccionados:</label></li>
                  <li><label style="color:white;font-weight: bold;font-size: 19px;" id="contadorSeleccionados"> (0) </label></li>
               </ul>
            </div>
         </div>
         <div class="col-lg-12" aria-labelledby="navbarDropdownMenuLink3">
            <div class="row">
               <div class="col-lg-8 pull-lef position">
                  <input id="elfiltro" type="text" placeholder="Buscar por nombre o número de cliente..." class="form-control">
               </div>
              
               <div class="col-lg-4 pull-lef position">
                  <a href="#" type="button" class="btn btn-danger pull-right btn-lg"  data-original-title="" title="" onclick="siguientepaso()">Siguiente</a>
               </div>
              
               <!--div class="col-lg-12">
                  <label style="color:white;font-weight: bold;font-size: 19px;">Seleccione el candidato por el cual desea votar.</label>
                  <label style="color:white;font-weight: bold;font-size: 19px;"> Puede escoger hasta 10 candidatos </label>
               </div-->

            </div>
         </div>
      </nav>
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-12">
               <!-- start:lobby -->
               <div class="box">
                 <br/><br/><br/><br/><br/><br/>
                  @yield('content')
               </div>
               <!-- end:lobby -->
            </div>
         </div>
      </div>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
      crossorigin="anonymous"
    ></script>     

      <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
     
       <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
         <script src=".../../../js/maugallery.js"></script>
       <script src="../../js/herramientas.js"></script>
       <script src="../../js/app2.js"></script>
      <script src="../../js/movildetect.js"></script>    
      @yield('page-script')
   </body>
</html>

