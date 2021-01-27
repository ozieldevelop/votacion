function manage_swal(options){
	if(options.type === 'show'){
	  Swal.fire({
	   title: options.title,
	   text: options.text,
	   showConfirmButton: false,
	   allowOutsideClick: false,
	   onOpen: () => {
		swal.showLoading()
	  }
	 });
	} else {	
		swal.close();
	}

}



function mensajeprint (mensaje,tipo)
{
  var categoria = '';
  
  if(tipo==1)
  {
      categoria ='success';
  }
  else if(tipo==2)
  {
      categoria ='info';
  }
  else if(tipo==2)
  {
      categoria ='danger';
  }
  else
  {
      categoria ='info';
  }  
  

  Swal.fire({
    position: 'center',
    icon: categoria,
    title: mensaje,
    showConfirmButton: false,
    timer: 1500
  })
  
}


/*
function espere(options){
	///var prm_namedata = localStorage.getItem("prm_name"); 

	if(options.type === 'show'){
	  swal({
	   title: options.title,
	   text: options.text,
	   showConfirmButton: false,
	   allowOutsideClick: false,
	   footer: '<a type="button" style="cursor:pointer;" onclick="redireccionar()" >CONFIRME!</a>',
	   onOpen: function() { 
		swal.showLoading()
	  }
	 });
	} else {	
		swal.close();
	}
}
*/


function lobibox_emergente(tipo,posicion,cerrar,mensaje)
{
    var tiempo = 0; 
    var redondeado = false;
    if(cerrar)
    {
         tiempo = 15000 //In milliseconds
    }
    if(tipo == 'success')
    {
        redondeado = true;
    }

        Lobibox.notify(tipo, {
            size: 'mini',
            icon: true,
            sound: false,
            rounded: redondeado,
            delay: tiempo,
            delayIndicator: cerrar,    
            width: 500,
            position: posicion,
            /*position: {
                left: 423, top: 300
            }, */    
            iconSource: "fontAwesome",
            msg: mensaje
        });
}


function manage_swal(options)
{

	if(options.type === 'show'){
		

		    Swal.fire({
		   title: options.title,
		   text: options.text,
		   showConfirmButton: false,
		   allowOutsideClick: false,
		   footer: '<a type="button" style="cursor:pointer"  >cooprofesionales</a>',
		   onOpen: function() { 
			swal.showLoading()
		  }
		 });
  
	} else {	
		swal.close();
	}
}

function espere(texto)
{
 manage_swal({ type: "show", title: "Espere un momento", text: texto});
}

function terminar_espere()
{
  manage_swal({ type: "hide"});
}

function cerrarSwal()
{
	manage_swal({ type: "hide" });
}


