<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvitacionVotacion extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
       $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      
	      return $this->view('sistema::estructuraemail')
                    ->with([
                        'contenido' => $this->details,
                        'orderPrice' => 'ed2'
                    ]);
      
      
        $this->withSwiftMessage(function ($message) {
            $message->getHeaders()->addTextHeader(
                'Custom-Header', 'Header Value'
            );
        });   
      
      
       /*return $this->from('digital@cooprofesionales.com.pa')
                ->view('sistema::estructuraemail');*/
      
      /* return $this->view('sistema::estructuraemail')
                ->text('sistema::estructuraemail');    
      
      */
 
      
	     /*	*/	
			
			//dd($this->details);
			/*
			$contenido = '<!DOCTYPE html>
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
					  font-family: Nunito, sans-serif;
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

				<h1>'. $this->details['title'] .'</h1>

				<p>'. $this->details['body'] .'</p>

				<p>'.$this->details['nombre'] .'</p>

   <p>encriptado : '. $oyetu->lara_encriptar( $details['num_cliente'] )  .'</p>

   <p>desencriptado :  '.  $oyetu->lara_desencriptar( $oyetu->lara_encriptar( $details['num_cliente'] )  )  .'</p>
   
   
			  </div>
			 </body>
			</html>';


		Mail::send([], [], function($message) use ($details) {
			$message->from("ozkeyspty@gmail.com");
			$message->to($this->details['correo']);
			$message->subject($this->details['title']);
			$message->setBody($this->body, 'text/html');
		});
  */

        //return $this->markdown('sistema.invitacionvotacion');
    }
}
