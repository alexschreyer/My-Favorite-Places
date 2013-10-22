<?php

/*

Edit configuration for this app below

*/

// App data
define("APP_NAME",      "Our Favorite Places");
define("APP_DESC",      "A description goes here for the meta tag and for the home page.");
define("ADMIN_EMAILS",  "me@here.com");
define("APP_URL",       "");

// Location parameters
define("START_LAT",     "42.390185");
define("START_LON",     "-72.528412");
define("HEATMAP_RES",   "1000");

// MySQL database setup
define("DB_SERVER",     "localhost");
define("DB_USER",       "root");
define("DB_PASS",       "");
define("DB_NAME",       "myfavoriteplaces");

// Some spam protection, these will be replaced - case insensitive
$badwords = array("shit" , "fuck" , "cunt", "insert" , "delete", "update", "drop");

// Options for the demographic dropdown
$demographic = array(
    'und' => 'Undergraduate Student',
    'gra' => 'Graduate Student',
    'alu' => 'Alumnus',
    'fac' => 'Faculty',
    'emp' => 'Employee',
    'oth' => 'I am not with UMass'
);

// ShareThis publisher ID for social buttons
define("ST_API",       "");

/*

Below are some helper functions. Don't edit these.

*/

function get_header($title)
{ // BEGIN function get_header
    include 'header.php';
} // END function get_header

function get_footer()
{ // BEGIN function get_header
    include 'footer.php';
} // END function get_header

?>