<?php

/*
Edit configuration parameters for this app below
*/

// App data
define("APP_NAME",      "Our Favorite Places");
define("APP_DESC",      "A description goes here for the meta tag and for the home page.");
define("ADMIN_EMAILS",  "me@here.com");
define("APP_URL",       "http://localhost/My-Favorite-Places/");

// Outbound button link - This appears on map pages
define("OUT_NAME",      "View home page");
define("OUT_URL",       "index.php");

// Location parameters
define("START_LAT",     "42.390185");
define("START_LON",     "-72.528412");
define("HEATMAP_RES",   "1000");

// MySQL database setup
define("DB_SERVER",     "localhost");
define("DB_USER",       "root");
define("DB_PASS",       "");
define("DB_NAME",       "myfavoriteplaces");

// Options for the demographic dropdown
$demographic = array(
    'und' => 'Undergraduate Student',
    'gra' => 'Graduate Student',
    'alu' => 'Alumnus',
    'fac' => 'Faculty',
    'emp' => 'Employee',
    'oth' => 'Other'
);

// ShareThis publisher ID for social buttons
// Details: http://www.sharethis.com/#sthash.SQGYVVqA.dpbs
define("ST_API",        "");

// Google Maps API Key - needed if you get lots of use
// Details: https://developers.google.com/maps/documentation/javascript/tutorial
define("G_API",         "");

// Error that gets shown when spam is triggered
define("ERROR_SPAM" , 'This submission is not allowed. Something triggered our spam protection. Please go back and resubmit.');

// Some spam protection, these will be replaced with **** - case insensitive
$badwords = array(
  "shit",
  "fuck",
  "cunt");

// If any of these words are submitted, the submission is blocked - case insensitive
$blockwords = array(
	"http",
	"href",
	"javascript",
	"insert",
	"delete",
	"update",
	"drop");

// Spam IP list
$badips = array(
	"188.143.232.61",
	"91.236.74.123",
	"188.143.232.120");

/*
Below are some helper functions. Don't edit these.
*/

function get_header($title = '')
{ // BEGIN function get_header
    include 'header.php';
} // END function get_header

function get_footer()
{ // BEGIN function get_header
    include 'footer.php';
} // END function get_header


?>