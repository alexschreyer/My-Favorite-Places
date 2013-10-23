<?php

include_once 'config.php';

header("Content-type: application/xml");

printf("<?xml version='1.0' encoding='UTF-8'?>\n\r");
printf("<kml xmlns='http://earth.google.com/kml/2.0'>
<Document>
<Style id='tweetIcon'>
<IconStyle>
<Icon>
<href>".APP_URL."img/tweet.png</href>
</Icon>
</IconStyle>
</Style>
<LookAt><latitude>".START_LAT."</latitude><longitude>".START_LON."</longitude><range>1200</range><tilt>0</tilt><heading>0</heading></LookAt>
");

// Take out to make generic:
// 


// Attempt with RSS, doesn't contain location data
// Need these so that Twitter doesn't block catching of RSS feed - from PHP docs
// ini_set("user_agent","Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)");
// ini_set("max_execution_time", 0);
// ini_set("memory_limit", "10000M");
//$xml = simplexml_load_file('http://search.twitter.com/search.rss?geocode=42.389046,-72.529181,0.5mi&rpp=100&include_entities=true&result_type=recent');

// Get json file from Twitter
$url = 'http://search.twitter.com/search.json?geocode=42.390185,-72.528412,1mi&rpp=100&include_entities=true&result_type=recent';
$page = file_get_contents($url); 
$json = json_decode($page);

// print_r($json->results);
// die();

foreach ($json->results as $result) {

// Check if we have coordinates that are close to here
if (strpos($result->location,'42') !== false) {

		// extract coordinates from location info
		$source = $result->location;
		preg_match_all('([+-]?[0-9]+.[0-9]+)' , $source , $coords);
		$lon = (float)$coords[0][0];
		$lat = (float)$coords[0][1];
		// print_r($coords);

    printf('
<Placemark><name>@%s via Twitter</name><description><![CDATA[<img src="%s" style="float:left;margin:10px;"><a href="http://www.twitter.com/%s">@%s</a> says:<br />%s]]></description><styleUrl>#tweetIcon</styleUrl><Point><coordinates>%f,%f</coordinates></Point></Placemark>',
    htmlspecialchars($result->from_user),
    htmlspecialchars($result->profile_image_url),    
    htmlspecialchars($result->from_user),
    htmlspecialchars($result->from_user),
    htmlspecialchars($result->text),
    htmlspecialchars($lat),
    htmlspecialchars($lon)
    );
    
};    

};

printf("
</Document>
</kml>");

?>