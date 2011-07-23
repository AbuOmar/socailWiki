<?php

include_once("../../lib/Core.php");

// only allow logged in people
$POD = new PeoplePod(array(
	'authSecret'=>$_COOKIE['pp_auth'],
  'lockdown'=>'login'
));

$POD->header();

		include('/wikimate/globals.php');
		$wikis = $POD->getContents(array(
			'type'=>'wiki'
		));	
		
		$ch = curl_init();
		foreach($wikis as $wiki){
		
		$curlPost = 'pNUMBER='  . urlencode($phoneNumber) . '&MESSAGE=' . urlencode($message) . '&SUBMIT=Send';
		curl_setopt($ch, CURLOPT_URL, 'http://www.example.com/sendSMS.php');
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_GETFIELDS, $curlPost);
		$data = curl_exec();
		curl_close($ch); 
		
		
		}
		curl_close($ch);		
		
$POD->footer();

?>