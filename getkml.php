<?php

include_once 'config.php';

header("Content-type: application/xml");

printf("<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<kml xmlns=\"http://earth.google.com/kml/2.0\">
<Document>
<LookAt><latitude>42.390185</latitude><longitude>-72.528412</longitude><range>1400</range><tilt>0</tilt><heading>0</heading></LookAt>");

if ($db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS)) {

  mysqli_select_db($db, DB_NAME);

  $result = mysqli_query($db, 'SELECT * FROM submissions LIMIT 500');
  
  while ($row = mysqli_fetch_object($result)) {
  
    if ($row->name == '')
      $row->name = 'Anonymous';
    printf('
<Placemark id="%d"><name>%s says:</name><description>%s</description><Point><coordinates>%f,%f</coordinates></Point></Placemark>',
    htmlspecialchars($row->id),
    htmlspecialchars(stripslashes($row->name)),
    htmlspecialchars(stripslashes($row->description)),
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