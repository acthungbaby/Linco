<?php

/*
|--------------------------------------------------------------------------
| Settings 
|--------------------------------------------------------------------------
*/

define("EMAIL" , "oscar@linco.com.py, mauricio@garabato.com.py");
define("SUBJECT" , "Te llego un mensaje desde la web");

define("NAME_MSG" , "Favor ingrese un nombre");
define("EMAIL_MSG" , "Favor ingrese un mail");
define("EMAIL_WRONG" , "Favor ingrese un mail valido");
define("PHONE_MSG" , "Favor ingresar un numero de telefono");
define("MESSAGE_MSG" , "Favor ingrese un mensaje");
/*
|--------------------------------------------------------------------------
| Simple Sender Script
|--------------------------------------------------------------------------
*/

if( $_POST ) {
    
	/* check mandatory fields */
	if( empty( $_POST['name'] ) ) {
		exit( NAME_MSG );
	}
	
	if( empty( $_POST['email'] ) ) {
		exit( EMAIL_MSG );
	}
	
	if( empty( $_POST['phone'] ) ) {
		exit( PHONE_MSG );
	}
	
	if( empty( $_POST['message'] ) ) {
		exit( MESSAGE_MSG );
	}
	
	/* validate email */
	if ( !empty( $_POST['email']) && !preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST['email'])) {
		
		exit( EMAIL_WRONG );
		
	}
	
	/* create body message */
    $message = '';
    
	// Name 
	$message.= '<p> Name : ' . $_POST['name'] . '</p>';
	
    // Phone
    $message.= '<p> Phone : ' . $_POST['phone'] . '</p>';
	    
    // Message
    $message.= '<p> Message : ' . $_POST['message'] . '</p>';
	
     
/* send email */
$email = mail( EMAIL , SUBJECT , $message , "From: ".$_POST['name']." <".$_POST['email'].">\r\n" ."Reply-To: ".$_POST['email']."\r\n" );

/* callback for ajax */
if( $email ) {
    echo 'OK';
} else { 
    echo 'ERROR';	}
}
	
?>