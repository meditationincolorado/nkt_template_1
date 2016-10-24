<article id="calendar-container" class="row">
	<div class="col-xs-12 col-sm-10 col-sm-offset-1">
		<h2 id="month"></h2>
		<section id="filter">
			<label><input id="all" type="checkbox" checked> All</label> 
			<label><input id="beginner" class="type" type="checkbox"> Beginner</label>
			<label><input id="puja" class="type" type="checkbox"> Pujas</label>
			<label><input id="fp-ttp" class="type" type="checkbox"> FP/TTP</label>
			<label><input id="retreats" class="type" type="checkbox"> Retreats</label><br/>

			<label><input id="downtown" class="location" type="checkbox"> Downtown Denver</label>
			<label><input id="cap-hill" class="location" type="checkbox"> Capitol Hill</label>
			<label><input id="aurora" class="location" type="checkbox"> Aurora</label>
			<label><input id="colorado-springs" class="location" type="checkbox"> Colorado Springs</label><br/>
		</section>

		<div id="calendar">
			<div class="day heading">Sunday</div>
			<div class="day heading">Monday</div>
			<div class="day heading">Tuesday</div>
			<div class="day heading">Wednesday</div>
			<div class="day heading">Thursday</div>
			<div class="day heading">Friday</div>
			<div class="day heading">Saturday</div>
		</div>
	</div>
</article>

<section id="google-api-output">
	<!--https://www.googleapis.com/calendar/v3/calendars/media@meditationincolorado.org/events?key=AIzaSyAnL4zStsZJPP02QcauWi52QUHUReLg9UE-->
	<?php 

	 	require_once 'google-api-php-client/src/Google/autoload.php';

	 	$client = new Google_Client(); 
	 	$client->setApplicationName("KMC Colorado Calendar"); 
	 	$client->setDeveloperKey("AIzaSyAnL4zStsZJPP02QcauWi52QUHUReLg9UE");

	 	$service = new Google_Service_Calendar($client); 

	 	$calendarId = 'media@meditationincolorado.org';
	 	$effectiveDate = date("Y-m-d", strtotime($date)) . " +1 month";

		$optParams = array(
		  //'maxResults' => 3,
		  'orderBy' => 'startTime',
		  'singleEvents' => TRUE,
		  //'timeMin' => date('c')
		  'timeMin' => date('c'),
		  'timeMax' => date( 'Y-m-t' ) . 'T23:59:59-07:00'
		);

		echo $effectiveDate;
		$results = $service->events->listEvents($calendarId, $optParams);

	 	if (count($results->getItems()) == 0) {
		  print "No upcoming events found.<br/>";
		} else {
		  //print "Upcoming events:<br/>";
		  foreach ($results->getItems() as $event) {
		    $id = $event->id;
		    if (empty($start)) {
		      $start = $event->start->date;
		    }
		    //echo $id . '<br/>';

		    $event = $service->events->get('media@meditationincolorado.org', $id);
			$date = new DateTime($event->start["dateTime"]);
			$dateString = $date->format('l, F jS');
			$month = $date->format('F');
			$dayNum = $date->format('j');
			$time = ($date->format('i') != '00') ? $date->format('g:i') : $date->format('g');

			$endDate = new DateTime($event->end["dateTime"]);
			$endTime = ($endDate->format('i') != '00') ? $endDate->format('g:ia') : $endDate->format('ga');
			
			echo $date->format('i') == '00';
			echo 
				'<article>'.
					'<h4 class="title">' . $event->getSummary() . '</h4>' . 
						$dateString . '<br/>' . 
						$event->description . '</br>' .
						'<span class="month">' . $month . '</span> ' .
						'<span class="dayNum">' . $dayNum . '</span>, ' .
						'<span class="time">' . $time . '</span>' .
						'<span class="endTime">' . $endTime . '</span>' .
						'<span class="location">' . $event->location . '</span>' .
				'</article>';
		  }
		}
	 ?>
</section>