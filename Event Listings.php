<?php
/**
 * Plugin Name: Event listings.
 * Description: List and add Events to google calendar and custom wordpress posts.
 * Plugin URI: http://example.org/
 * Author: Bojidar
 * Version : 0.1
 * Author URI:
 * License: GPL2
 */

/**
* Creating new class for Events.
*/
class EventListings
{
	
	function __construct()
	{
		add_action( 'init', array( $this, 'event_listing' ) );
	}
	
	public function event_listing() {
		register_post_type( 'eventing', array(
			'labels' 					=> array(
				'name' 					=> __("Events ", 'eventbase'),
				'singular_name'				=> __("Event", 'eventbase'),
				'add_new' 				=> _x("Add New", 'eventing', 'eventbase' ),
				'add_new_item' 				=> __("Add New Event", 'eventbase' ),
				'edit_item' 				=> __("Edit Event", 'eventbase' ),
				'new_item' 				=> __("New Event", 'eventbase' ),
				'view_item' 				=> __("View Event", 'eventbase' ),
				'search_items' 				=> __("Search Events ", 'eventbase' ),
				'not_found' 				=>  __("No Events  found", 'eventbase' ),
				'not_found_in_trash' 			=> __("No Events  found in Trash", 'eventbase' ),
			),
				'description' 				=> __("Events  for the demo", 'eventbase'),
				'public' 				=> true,
				'publicly_queryable' 			=> true,
				'query_var' 				=> true,
				'rewrite' 				=> true,
				'has_archive'				=> true,
				'exclude_from_search' 			=> true,
				'show_ui' 				=> true,
				'show_in_menu'				=> true,
				'menu_position' 			=> 11, // may cause problems
				'supports' 				=> array(
				'title',
				'editor',
				'thumbnail',
				'custom-fields',
				'page-attributes',
			),
				'menu_icon' 				=> 'dashicons-book-alt',
				'taxonomies' 				=> array( 'post_tag' )
		));	
	}
}
new EventListings();
add_filter( 'the_content', 'prepend_event_data' );
function prepend_event_data( $content ) {

 if( is_singular( 'eventing' ) ) {
 		$eventDate = get_post_meta( get_the_ID(), 'Event Date', true );
 		$eventLocation = get_post_meta( get_the_ID(), 'Event Location' , true);
 		$url = get_post_meta( get_the_ID(), 'Link to the book:' , true);
 	$html = '
<div class = "event-meta">
	<strong>Event date: </strong> '.$eventDate.'<br>
	<strong>Event Location: </strong> '.$eventLocation.'<br>
	</div>
<script type="text/javascript" src="https://addevent.com/libs/atc/1.6.1/atc.min.js" async defer></script>
<div title="Go to Calendar" class="addeventatc">
    Go to Calendar
    <span class="start">05/25/2017 09:00 AM</span>
    <span class="end">05/25/2017 11:00 AM</span>
    <span class="timezone">Europe/Bulgaria</span>
    <span class="title">Summary of the event</span>
    <span class="description">Description of the event<br>Example of a new line</span>
    <span class="location">Location of the event</span>
    <span class="organizer">Organizer</span>
    <span class="organizer_email">Organizer e-mail</span>
    <span class="facebook_event">https://www.facebook.com/events/703782616363133</span>
    <span class="all_day_event">false</span>
    <span class="date_format">MM/DD/YYYY</span>
    <span class="client">awUXRGrIizNzJpoyfmNJ28309</span>
</div>
 	';
 	return $content. $html;
}
return $content;
}
