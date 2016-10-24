<?php 

	require_once 'google-api-php-client/src/Google/autoload.php';

	echo 'hello';
 	$client = new Google_Client(); 
 	$client->setApplicationName("KMC Colorado Calendar"); 
 	$client->setDeveloperKey("AIzaSyAnL4zStsZJPP02QcauWi52QUHUReLg9UE");

 	$service = new Google_Service_Calendar($client); 

 	$calendarId = 'media@meditationincolorado.org';
 	$effectiveDate = date("Y-m-d", strtotime($date)) . " +1 month";
?>