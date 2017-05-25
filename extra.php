<?php
	$eventDate = get_post_meta( get_the_ID(), 'Event Date', true );
	if( empty( $eventDate) ) : echo "Empty Record"; endif; 
	$eventLocation = get_post_meta( get_the_ID(), 'Event Location' , true);
	if( empty( $eventLocation) ) : echo "Empty Record"; endif;
$html = '<div class = "event-meta">
	<strong>Event date: </strong> '.$eventDate.'<br>
	<strong>Event Location: </strong> '.$eventLocation.'<br>
	</div>';
