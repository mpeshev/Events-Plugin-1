<?php
	$eventDate = get_post_meta( get_the_ID(), 'Event Date', true );
	$eventLocation = get_post_meta( get_the_ID(), 'Event Location' , true);
	$url = get_post_meta( get_the_ID(), 'Link to the book:' , true);
$html = '<div class = "event-meta">
	<strong>Event date: </strong> '.$eventDate.'<br>
	<strong>Event Location: </strong> '.$eventLocation.'<br>
	</div>';
