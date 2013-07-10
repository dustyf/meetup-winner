=== Plugin Name ===
Contributors: dustyf
Donate link: http://dustyf.com/donate
Tags: meetup, meetup.com, winner, contest, giveaway, drawing, prize, api
Requires at least: 3.0.1
Tested up to: 3.5.2
Stable tag: 0.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Give away prizes and swag to a random attendee who RSVPed to your meetup!

== Description ==

Do you want to add something extra to your next Meetup?  Everyone likes getting free prizes and swag, right?  But, you have more people attending than things to give away.  Now you can use this plugin to hold a drawing for the free prize!

This plugin will connect to the Meetup.com API and select a random member of your Meetup who RSVPed to your event so you can give a prize at the event.

To use, install the plugin, activate, and add your Meetup.com API key in the settings.  Next, add the shortcode [meetup_winner eventid="110963702"] to any page on your site and replace the number with the Event ID of your Meetup Event.  Whenever you visit that page or refresh the page a new winner will be selected.


== Installation ==

1. Download through the WordPress plugin installer
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Add your Meetup.com API key under Settings > Meetup Winner!

= Installing Manually =

1. Download the zip file
1. Unzip meetup-winner.zip
1. Upload `/meetup-winner/` and it's contents to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Add your Meetup.com API key under Settings > Meetup Winner!

== Frequently Asked Questions ==

= Where can I find my Meetup.com API Key? =

Visit http://www.meetup.com/meetup_api/key/ while signed in to Meetup.com to find your API Key.

= Where can I find my Meetup Event ID? =

Visit your event on Meetup.com and copy the number at the end of your URL.

For instance the event id for the following Meetup is: 110963702
http://www.meetup.com/Milwaukee-WordPress-MeetUp/events/110963702/

= How do I pick a winner? =

Add the shortcode `[meetup_winner eventid="110963702"]` replacing the number with your event ID to any page on your website.  You can also use the template tag `<?php meet_win_display('110963702'); ?>` replacing the number with your event ID to use in a page template.  Visit the page to view a winner and refresh the page for a new winner.

== Screenshots ==

1. The winner displayed on a page
2. Add a Shortcode to your page
3. Add your API key in Settings


== Changelog ==

= 0.2 =
* Moved the screenshots out of the actual plugin folder
* Fixed some formatting in the Readme
* Changed the shortcode to return the value instead of echo it

= 0.1 =
* First Version.
* You can add the Meetup Winner picker via shortcode or template tag.
