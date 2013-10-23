<?php

include_once 'config.php';

header("Content-type: application/xml");

printf("<?xml version='1.0' encoding='UTF-8'?>\n\r");
printf("<kml xmlns='http://earth.google.com/kml/2.0'>
<Document>
<Style id='commentsIcon'>
<IconStyle>
<Icon>
<href>".APP_URL."img/marker.png</href>
</Icon>
</IconStyle>
</Style>
<LookAt><latitude>".START_LAT."</latitude><longitude>".START_LON."</longitude><range>1200</range><tilt>0</tilt><heading>0</heading></LookAt>
");

if ($db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS)) {

  mysqli_select_db($db, DB_NAME);
  
  $query = "SELECT * FROM submissions";
  
  $whereclause = array();
  if(isset($_GET['type']) && ($_GET['type'] != "")){
    array_push($whereclause, "type = '".$_GET['type']."'");
  };
  if(isset($_GET['gender']) && ($_GET['gender'] != "")){
    array_push($whereclause, "gender = '".$_GET['gender']."'");
  };
  if(isset($_GET['location']) && ($_GET['location'] != "")){
    array_push($whereclause, "location = '".$_GET['location']."'");
  };
  
  if ($_GET) {
    $query .= (count($whereclause) > 0 ? (count($whereclause) > 1 ? " WHERE ".implode(" AND ", $whereclause) : " WHERE ".implode(" ", $whereclause)) : "");
  };
  
  $query .= " ORDER BY id DESC";
  
  if(isset($_GET['limit']) && ($_GET['limit'] != "")){
    $query .= " LIMIT " . $_GET['limit'];
  };

  // die($query);

  $result = mysqli_query($db, $query);

  while ($row = mysqli_fetch_object($result)) {

    if ($row->name == '')
      $row->name = 'Anonymous';
    printf('
<Placemark id="%d"><name>%s says:</name><description>%s</description><styleUrl>#commentsIcon</styleUrl><Point><coordinates>%f,%f</coordinates></Point></Placemark>',
    htmlspecialchars($row->id),
    htmlspecialchars(stripslashes($row->name)),
    htmlspecialchars(stripslashes($row->description)."<div style='margin-top:10px;'><a href='".APP_URL."map-single.php?p=".$row->id."' title='Share this point'>Link</a> | <a href='".APP_URL."report.php?p=".$row->id."' title='Report this point as inappropriate'>Report</a></div>"),
    htmlspecialchars($row->lng),
    htmlspecialchars($row->lat)
    );

  };

  mysqli_close($db);

};

printf("
</Document>
</kml>");

?>