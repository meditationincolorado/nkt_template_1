<?php 

 	require_once 'google-api-php-client/src/Google/autoload.php';

 	$client = new Google_Client(); 
 	$client->setApplicationName("KMC Colorado Calendar"); 
 	$client->setDeveloperKey("AIzaSyAnL4zStsZJPP02QcauWi52QUHUReLg9UE");

 	$service = new Google_Service_Calendar($client); 

 	$calendarId = 'media@meditationincolorado.org';
 	$curTimestamp = date('c');
 	$tomorrow = date('Y-m-d', strtotime("+1 days")) . 'T00:00:00+00:00';
 	$timeMinString = substr($curTimestamp, 0, strpos($curTimestamp, 'T') + 1). '00:00:00+00:00';
 	//echo '<script>console.log("' . $timeMinString . '");</script>';
 	//echo '<script>console.log("' . $tomorrow . '");</script>';
	
	$optParams = array(
	  //'maxResults' => 5,
	  'orderBy' => 'startTime',
	  'singleEvents' => TRUE,
	  'timeMin' => $timeMinString,
	  'timeMax' => $tomorrow
	);

	$results = $service->events->listEvents($calendarId, $optParams);

	echo '<ul id="todays-classes">';
	 	if (count($results->getItems()) == 0) {
		  print "No upcoming events found.<br/>";
		} else {
		  //print "Upcoming events:<br/>";
		echo "<li id='heading'><h6>today</h6> <span>or</span> <a href='./classes#calendar' class=''>see full calendar</a></li>";

		  foreach ($results->getItems() as $event) {
		    $id = $event->id;
		    if (empty($start)) {
		      $start = $event->start->date;
		    }
		    //echo $id . '<br/>';

		    $event = $service->events->get('media@meditationincolorado.org', $id);
		    $cleanClassName = substr($event->summary, 0);//, strpos($event->summary, "-"));
			$date = new DateTime($event->start["dateTime"]);
			$dateString = $date->format('l, F jS');
			$time = ($date->format('i') != '00') ? $date->format('g:i') : $date->format('g');
			$endDate = new DateTime($event->end["dateTime"]);
			$endTime = ($endDate->format('i') != '00') ? $endDate->format('g:ia') : $endDate->format('ga');
			
			//echo $result;

			echo '<li class="cta_wrapper"><a href="./classes" class="cta">' . $cleanClassName . '</a> <span class="info"><b>' . $time . ' to ' . $endTime . '</b> | <span class="address">' /*. $event->description . ' - '*/ . $event->location . '</span></span></li>';
		  }
		}
	echo '</ul>';
 ?>