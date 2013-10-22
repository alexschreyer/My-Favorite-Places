<?php

/*

Edit configuration for this app below
TODO: Move all of the settings here.

*/

// APP DATA
define("APP_NAME",      "Our Favorite Places");
define("APP_DESC",      "A description goes here for the meta tag and for the home page.");
define("ADMIN_EMAILS",  "me@here.com");
define("APP_URL",       "");
define("START_LAT",     "42.390185");
define("START_LON",     "-72.528412");

// MySQL DATABASE SETUP
define("DB_SERVER",     "localhost");
define("DB_USER",       "root");
define("DB_PASS",       "");
define("DB_NAME",       "myfavoriteplaces");

// Some spam protection, these will be replaced - case insensitive
$badwords = array("shit" , "fuck" , "cunt", "insert" , "delete", "update");

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