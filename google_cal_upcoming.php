<?php 

 	require_once 'google-api-php-client/src/Google/autoload.php';

 	$client = new Google_Client(); 
 	$client->setApplicationName("KMC Colorado Calendar"); 
 	$client->setDeveloperKey("AIzaSyAnL4zStsZJPP02QcauWi52QUHUReLg9UE");

 	$service = new Google_Service_Calendar($client); 

 	$calendarId = 'media@meditationincolorado.org';
	$optParams = array(
	  'maxResults' => 3,
	  'orderBy' => 'startTime',
	  'singleEvents' => TRUE,
	  'timeMin' => date('c')
	);
	$results = $service->events->listEvents($calendarId, $optParams);

	echo '<ul id="todays-classes">';
	 	if (count($results->getItems()) == 0) {
		  print "No upcoming events found.<br/>";
		} else {
		  //print "Upcoming events:<br/>";
		echo "<li class='cta_wrapper'><h6>today</h6> or <a href='./classes#calendar' class=''>see full calendar</a></li>";

		  foreach ($results->getItems() as $event) {
		    $id = $event->id;
		    if (empty($start)) {
		      $start = $event->start->date;
		    }
		    //echo $id . '<br/>';

		    $event = $service->events->get('media@meditationincolorado.org', $id);
		    $cleanClassName = substr($event->summary, 0, strpos($event->summary, "-") - 1);
			$date = new DateTime($event->start["dateTime"]);
			$dateString = $date->format('l, F jS');
			$time = ($date->format('i') != '00') ? $date->format('g:i') : $date->format('g');
			$endDate = new DateTime($event->end["dateTime"]);
			$endTime = ($endDate->format('i') != '00') ? $endDate->format('g:ia') : $endDate->format('ga');
			
			//echo $result;

			echo '<li class="cta_wrapper"><a href="" class="cta">' . $cleanClassName . '</a> <span>' . $time . ' to ' . $endTime . ' | ' . $event->description . ' - ' . $event->location . '</span></li>';
			//echo '<strong>' . $event->getSummary() . '</strong><br/>' . $dateString . ' at '. $event->location . '<br/>' . $event->description . '<br/><br/>';
		    //echo 'After<br/>';
		  }
		}
	echo '</ul>';
 ?>