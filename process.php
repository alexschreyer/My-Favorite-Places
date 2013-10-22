<?php
// This file processes incoming data and inserts it into the database

include_once 'config.php';

if (isset($_POST['submit'])) {
//This code runs if the form has been submitted

    //  Filter out some addresses if needed
    //  if (strpos($_SERVER['REMOTE_ADDR'],'128.119') !== false) or (strpos($_SERVER['REMOTE_ADDR'],'72.19') !== false) {

    if ($db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS)) {

      mysqli_select_db($db, DB_NAME);
      
      // Replace any occurrence of bad language... little bit of spam protection
      $_POST['name'] = str_ireplace ($badwords , "****" , $_POST['name']);
      $_POST['description'] = str_ireplace ($badwords , "****" , $_POST['description']);
      
      $query = "INSERT INTO submissions (
      name, type, gender, location, description, lng, lat, ip) VALUES ('"
      .mysqli_real_escape_string($db, ucfirst($_POST['name']))."', '"
      .mysqli_real_escape_string($db, $_POST['type'])."', '"
      .mysqli_real_escape_string($db, $_POST['gender'])."', '"
      .mysqli_real_escape_string($db, $_POST['location'])."', '"
      .mysqli_real_escape_string($db, $_POST['description'])."', '"
      .$_POST['lng']."', '"
      .$_POST['lat']."', '"
      .mysqli_real_escape_string($db, $_SERVER['REMOTE_ADDR'])."')";
      
      // echo $query;

      $result = mysqli_query($db, $query);
      
      $last_id = mysqli_insert_id($db);

      mysqli_close($db);

    };

    //  };
  
};

header('Location: map-single.php?p='.$last_id);

?>