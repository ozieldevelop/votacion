@inject('oyetu', 'App\Services\GeneralHelper')






<!DOCTYPE html>
<html>
 <head>
  <title>How Send an Email in Laravel</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

  <!-- Styles -->
  <style>
      html, body {
          background-color: #fff;
          color: #636b6f;
          font-family: 'Nunito', sans-serif;
          font-weight: 200;
          height: 100vh;
          margin: 0;
      }

      .full-height {
          height: 100vh;
      } 

      .content {
          text-align: center;
      }

      .title {
          font-size: 84px;
      } 
  </style>
 </head>
 <body>
  <br />
  <br />
  <br />
  <div class="container box" style="width: 970px;">

    <h1>{{ $details['title'] }}</h1>

    <p>{{ $details['body'] }}</p>

	<p>{{ $details['nombre'] }}</p>
	
	
   <p>encriptado : {!! $oyetu->lara_encriptar( $details['num_cliente'] )  !!}</p>

   <p>desencriptado :  {!! $oyetu->lara_desencriptar( $oyetu->lara_encriptar( $details['num_cliente'] )  )  !!}</p>
   
   
  </div>
 </body>
</html>