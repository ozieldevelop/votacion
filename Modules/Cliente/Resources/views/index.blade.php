@extends('layouts.cliente')

@section('content')

<!--iframe allow="microphone; camera" style="border: 0; height: 100%; left: 0; position: absolute; top: 0; width: 100%;" src="https://zoom.us/wc/join/96214394151" frameborder="0"></iframe-->





  <style>
  

    
    .checkbox label:after, 
.radio label:after {
    content: '';
    display: table;
    clear: both;
}

.checkbox .cr,
.radio .cr {
    position: relative;
    display: inline-block;
    border: 1px solid #a9a9a9;
    border-radius: .25em;
    width: 1.3em;
    height: 1.3em;
    float: left;
    margin-right: .5em;
}

.radio .cr {
    border-radius: 50%;
}

.checkbox .cr .cr-icon,
.radio .cr .cr-icon {
    position: absolute;
    font-size: .8em;
    line-height: 0;
    top: 50%;
    left: 20%;
}

.radio .cr .cr-icon {
    margin-left: 0.04em;
}

.checkbox label input[type="checkbox"],
.radio label input[type="radio"] {
    display: none;
}

.checkbox label input[type="checkbox"] + .cr > .cr-icon,
.radio label input[type="radio"] + .cr > .cr-icon {

    opacity: 0;

}

.checkbox label input[type="checkbox"]:checked + .cr > .cr-icon,
.radio label input[type="radio"]:checked + .cr > .cr-icon {
    transform: scale(1) rotateZ(0deg);
    opacity: 1;
}

.checkbox label input[type="checkbox"]:disabled + .cr,
.radio label input[type="radio"]:disabled + .cr {
    opacity: .5;
}
    
    
    
  </style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">




    <!-- Heading Row -->
    <div class="row align-items-center my-5">
      <div class="col-lg-2">
        <img class="img-fluid rounded mb-7 mb-lg-0" src="http://placehold.it/900x400" alt="">
      </div>
      <!-- /.col-lg-8 -->
      <div class="col-lg-10">
        <h1 class="font-weight-light">{{  env('TITULOREGISTROASPIRANTES') }}</h1>
        <!--p>This is a template that is great for small businesses. It doesn't have too much fancy flare to it, but it makes a great use of the standard Bootstrap core components. Feel free to use this template for any project you want!</p-->
        <a class="btn btn-primary" href="#">Subir nueva imagen de perfil!</a>
      </div>
      <!-- /.col-md-4 -->
    </div>
    <!-- /.row -->

    <!-- Call to Action Well -->
    <div class="card text-white bg-secondary my-5 py-4 text-center">
      <div class="card-body">
        <p class="text-white m-0">Seleccione las &aacute;reas a las que desea postularse. (este listado ser&aacute; verificado)</p>
      </div>
    </div>





<form>
  
    <div class="form-group row">
      <label for="staticEmail" class="col-sm-2 col-form-label">N&uacute;mero de cliente</label>
      <div class="col-sm-10">
        <input type="text" readonly class="form-control-plaintext" id="numero_cliente" value="AB123">
      </div>
    </div>
    <div class="form-group row">
      <label for="staticEmail" class="col-sm-2 col-form-label">Nombre de cliente</label>
      <div class="col-sm-10">
        <input type="text" readonly class="form-control-plaintext" id="nombre" value="JORGE RODRIGUEZ">
      </div>
    </div>  

  
      <p style="color: #c2c9d0;font-weight: bold;font-size: 18px;">
        Seleccione las &aacute;reas a las que desea postularse. (este listado ser&aacute; verificado)
    </p>

  

    <div class="col-sm-12 col-md-4 col-lg-4">
        <div class="checkbox">
            <label style="font-size:27px">
                <input type="checkbox" value="" checked>
                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                Junta de Directores
            </label>
        </div>
    </div>
  
    <div class="col-sm-12 col-md-4 col-lg-4">
        <div class="checkbox">
            <label style="font-size: 27px">
                <input type="checkbox" value="" checked>
                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                Junta de Seguridad
            </label>
        </div>
    </div>
   
  
    <div class="col-sm-12 col-md-4 col-lg-4">
        <div class="checkbox">
            <label style="font-size:27px">
                <input type="checkbox" value="" checked>
                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                Comit&eacute; de Cr&eacute;dito
            </label>
        </div>
      <br/><br/>
    </div>
   
  
  
  
    <div class="form-group ">
      <label for="exampleFormControlFile1">Hoja de vida</label>
      <input type="file" class="form-control-file" id="exampleFormControlFile1">
    </div>

    <div class="form-group row">
       <div class="col-sm-10"><br/><br/><br/><br/><br/>
          <button type="submit" class="btn btn-primary">Registrar</button>
        </div>
    </div>
  
  
</form>



@endsection
