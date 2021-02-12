@extends('layouts.invitacion')

@section('content')


        <div class="col-sm-12 col-md-6 col-lg-12">
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="@if ($tienefoto ==1) {{ $tipo.$foto}}  @else {{ $foto }}  @endif"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{ $trato }} . {{ $nombre }}</h3>

                <p class="text-muted text-center">ENCUESTA PREVIA A EL EVENTO - DIA DEL EVENTO {{ $f_inicia }}</p>

                <ul class="list-group list-group-unbordered mb-3">

                  <li class="list-group-item">
                    <b style="color:blue">Asistir&aacute;s al evento?</b> <label   class="float-right"><input type="checkbox" id="laasisobjeto" class="asistire_class">  </label>
                  </li>                
                  <li class="list-group-item">
                    <b>Confirmanos si ser&aacute;s parte del grupo de :</b>
                  </li>
                  
                  
                  @if($tipoevent==1)
                  <li class="list-group-item">
                    <b style="color:blue">Candidatos a Delegados</b> <label   class="float-right"><input type="checkbox" id="candidatodele" class="candidatodele_class"></label>
                  </li>  
                  @else
                  <li class="list-group-item">
                    <b style="color:blue">Junta de directores</b> <label   class="float-right"><input type="checkbox"  id="juntadire" class="juntadire_class"> </label>
                  </li>  
                  <li class="list-group-item">
                    <b style="color:blue">Junta de vigilancia</b> <label   class="float-right"><input type="checkbox"  id="juntavigi" class="juntavigi_class">  </label>
                  </li>     
                  <li class="list-group-item">
                    <b style="color:blue">Comitr&eacute; de cr&eacute;dito</b> <label   class="float-right"><input type="checkbox"  id="comite_credi" class="comite_credi_class">  </label>
                  </li>   
                  @endif
                </ul>

                <button type="button" class="btn btn-block btn-success" onclick="guardarasistencia()">REGISTRARSE</button>
        
              </div>
            </div>
       </div> 


      <div class="col-sm-12 col-md-12 col-lg-12">
          <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title">
                DEVELOPER
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <textarea id="codeMirrorDemo" class="p-3">
                
                
              </textarea>
            </div>
            <div class="card-footer">
            
            </div>
          </div>
     </div>



<div class="col-12" style="display:none">            
            <div class="card card-primary">
              <div class="card-header">
                <h4 class="card-title"> {{ $nombreevento }} </h4>
              </div>
              <div class="card-body ">
         
              <div style="width:100%" id="output">
                  &nbsp;
              </div>
  
    
              </div>
              
              </div>
</div>

@endsection

  
@section('page-script')

<script>
      
  var editor = CodeMirror.fromTextArea(codeMirrorDemo, {
    lineNumbers: true,
    mode: "htmlmixed",
    theme: "monokai"    
  });
  
  
  
  /*
  CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
  });    
  */
      
      
  var modelo = {
    'id_evento':'{{ $id_evento }}',
    'tipoevent':'{{ $tipoevent }}',
    'nombre_evento':'{{ $nombreevento }}',
    'f_inicia':'{{ $f_inicia }}',
    'f_termina':'{{ $f_termina }}',
    'num_cliente':'{{ $num_cliente }}',
    'ocupacion':'{{ $ocupacion }}',
    'profesion':'{{ $profesion }}',
    'trato':'{{ $trato }}',
    'nombre':'{{ $nombre }}',
    'agencia':'{{ $agencia }}',
    'asistire': 0,
    'f_asistire_regis':'',
    'soy_aspirante': 0,
    'cantidato_delegado': 0,
    'junta_directores': 0,
    'junta_vigilancia': 0,
    'comite_credito': 0
  };
     

	function guardarasistencia()
	{
     Swal.fire({
             title: 'Esta a un paso; para registrar tu participación',
             text: "Se procederá a guardar este registro.",
             type: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Si, Deseo participar!',
             cancelButtonText: 'Retroceder!',
             confirmButtonClass: 'btn btn-success',
             cancelButtonClass: 'btn btn-warning',
             buttonsStyling: false
           }).then(function (result) 
               {

                if (result.isConfirmed) 
                {
                  //alert($('meta[name="csrf-token"]').attr('content'));
                  
                  // VALIDAR QUE 
                
                    $.ajax({
                      url: '{{ url("cliente/registro/guardaasistencia")}}',
                      data: { datos : JSON.stringify(modelo)  },
                      method: 'post',
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      success: function(result){
                          lobibox_emergente('success','top right',true,'actualizado.');
                          //setTimeout(function(){ location.reload();  }, 2000);
                      },
                      error: function (r) {
                          //lobibox_emergente('success','top right',true,'de seguro error.');
                          console.log("ERROR");
                          console.log(r);
                      }
                    });
                    //*/
                }
        });
	}
  
  
 function visualizarparametros()
 {
    @if($tipoevent==1)

       if(modelo.cantidato_delegado == 0  )
       {
          modelo.soy_aspirante=0;
       }
       else{
          modelo.soy_aspirante=1;
       }
    @else

       if(modelo.junta_directores == 0 && modelo.junta_vigilancia == 0 && modelo.comite_credito == 0 )
       {
          modelo.soy_aspirante=0;
       }
       else{
          modelo.soy_aspirante=1;
       }   
    @endif
   
   
   
   editor.setValue(JSON.stringify(modelo,undefined,2));
    //document.querySelector('.codemirror').CodeMirror.setValue(JSON.stringify(modelo,undefined,2));
    // var aaaa =  JSON.stringify(modelo,undefined,2);
   //$('#output').html(aaaa);
 }  
   

  
function formatDate() {
    var d = new Date(),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}
  
  
  
 function asistire_class_fn()
  {
          var elf = document.getElementById('laasisobjeto').checked;
        
              if(elf)
              {
                          modelo.asistire = 1;
                          modelo.f_asistire_regis=formatDate();
              }
              else {
                          modelo.asistire = 0;
                          modelo.f_asistire_regis='';
              }
  }
  

 function candidatodele_class_fn()
  {
          var elf = document.getElementById('candidatodele').checked;
          console.log(elf);
              if(elf)
              {
                          modelo.cantidato_delegado = 1;
              }
              else {
                          modelo.cantidato_delegado = 0;
              }
  }

 function juntadire_class_fn()
  {
          var elf = document.getElementById('juntadire').checked;
          console.log(elf);
              if(elf)
              {
                          modelo.junta_directores = 1;
              }
              else {
                          modelo.junta_directores = 0;
              }
  }

  
 function juntavigi_class_fn()
  {
          var elf = document.getElementById('juntavigi').checked;
          console.log(elf);
              if(elf)
              {
                          modelo.junta_vigilancia = 1;
              }
              else {
                          modelo.junta_vigilancia = 0;
              }
  }
  
  
 function comite_credi_class_fn()
  {
          var elf = document.getElementById('comite_credi').checked;
          console.log(elf);
              if(elf)
              {
                          modelo.comite_credito = 1;
              }
              else {
                          modelo.comite_credito = 0;
              }
  }
  
  
  
  $( document ).ready(function() {
       visualizarparametros();
    

      $(".asistire_class").change(function(){
            asistire_class_fn();
          visualizarparametros();
   
      });
    
    
      $(".candidatodele_class").change(function(){
            candidatodele_class_fn();
          visualizarparametros();
   
      });

      $(".juntadire_class").change(function(){
            juntadire_class_fn();
          visualizarparametros();
   
      });
    
      $(".juntavigi_class").change(function(){
          juntavigi_class_fn();
          visualizarparametros();
   
      });    
    
       $(".comite_credi_class").change(function(){
           comite_credi_class_fn();
          visualizarparametros();
   
      });      
    
  });     
  
</script>
@stop	   
  



