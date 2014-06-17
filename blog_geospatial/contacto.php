<?php
if ($_POST){
		
		$to = "gdc-contact@mit.edu";
		$subject = "Message from Geospatial website";
	
		if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest'){
			
			$output = json_encode(array('type'=>'error','text' => 'Invalid request'));
			die($output);
			
		}
	
	if (!isset($_POST['name']) || !isset($_POST['email']) ||  !isset($_POST['message'])) {
		
		$output = json_encode(array('type'=>'error','text'=>'Input fields emtpy'));
		die($output);
		
	}
	
	$headers = 'From: '.$_POST['email'].''."\r\n".'Reply-To: '.$_POST['email']."\r\n".'X-Mailer: PHP/'.phpversion();
	$mail = mail($to,$subject,$_POST['message'] . ' -'. $_POST['name'],$headers,$_POST['email']);
	
	if(!$mail){
		$output = json_encode(array('type'=>'error','text'=>'Error sending mail'));
		die($output);
	} 
	else {
		$output = json_encode(array('type'=>'message','text'=>'Thank you for your email. We will contact you soon.'));
		die($output);
	}
}
?>