<?php
/**
 * @package Meetup Winner!
 * @version 0.1
 */
/*
Plugin Name: Meetup Winner!
Plugin URI: http://wordpress.org/extend/plugins/meetup-winner/
Description: Hold a drawing to give away prizes and swag at your Meetup!  Once you add your Meetup API key and your event ID you can randomly pick a winner from those who have RSVPed to your meetup.
Author: Dustin Filippini
Version: 0.1
Author URI: http://dustyf.com/
*/

/**********
 * Creating the Settings Page
 **********/

// Adding a menu under Settings
add_action( 'admin_menu', 'meet_win_admin_menu' );
function meet_win_admin_menu() {
	add_submenu_page( 'options-general.php', 'Meetup Winner!', 'Meetup Winner!', 'edit_posts', 'meetup-winner', 'meet_win_admin_page' );
}

//Registering settings sections and fields
add_action( 'admin_init', 'meet_win_admin_init' );
function meet_win_admin_init() {
    register_setting( 'meet-win-settings', 'meetup-api-key' );
    add_settings_section( 'api-info', 'Meetup API', 'meet_win_api_section', 'meetup-winner' );
    add_settings_field( 'enter-api-key', 'Enter API Key', 'meet_win_enter_api', 'meetup-winner', 'api-info' );
}

// Callback for the start of the section to enter your API info
function meet_win_api_section() {
	echo '<p>Please enter your Meetup.com API Key.  Your API Key can be found by visiting <a href="http://www.meetup.com/meetup_api/key/">http://www.meetup.com/meetup_api/key/</a> while logged in to your Meetup.com account.';
}

// Callback for the field to enter the API Key
function meet_win_enter_api() {
	$apikey = esc_attr( get_option( 'meetup-api-key' ) );
    echo '<input type="text" name="meetup-api-key" value="' . $apikey . '" />';
}

// Displaying the Admin Page
function meet_win_admin_page() {
	?>
    <div class="wrap">
        <h2>Meetup Winner! Options</h2>
        <form action="options.php" method="POST">
            <?php settings_fields( 'meet-win-settings' ); ?>
            <?php do_settings_sections( 'meetup-winner' ); ?>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}


/**********
 * Creating a function that displays the winner info
 **********/

function meet_win_display($eventid) {

	$apikey = get_option( 'meetup-api-key' );
	$url = 'https://api.meetup.com/2/rsvps?&event_id=' . $eventid . '&key=' . $apikey;
	$meetup = wp_remote_get( $url );
	$rsvps = json_decode($meetup['body'])->results;

	$i = -1;
	$userArray = array();
	foreach ($rsvps as $rsvp) {
		if($rsvp->response == 'yes') {
			$i++;
			$rsvpNames[] = $rsvp->member->name;
			$rsvpPhotos[] = $rsvp->member_photo->thumb_link;
		}
	}

	$random = wp_rand( 0, $i );

	echo '<div class="meetup-winner">';
	echo '<div class="winner-photo"><img src="' . $rsvpPhotos[$random] . '" /></div>';
	echo '<div class="winner-text"><span class="winner-name">' . $rsvpNames[$random] . '</span> is the winner!</div>';
	echo '</div>';
}

/**********
 * Creating a shortcode to display the winner
 **********/

function meet_win_shortcode($atts) {
	extract( shortcode_atts( array(
    	'eventid' => null
     ), $atts ) );
	meet_win_display($eventid);
}
add_shortcode('meetup_winner', 'meet_win_shortcode');

/**********
 * Adding some basic styles for the Winner Display
 **********/

add_action( 'wp_enqueue_scripts', 'meet_win_add_styles' );
function meet_win_add_styles() {
	wp_enqueue_style( 'meet-win-styles', plugins_url('css/meetup-winner.css', __FILE__) );
}
