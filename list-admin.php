<?php include_once 'config.php'; get_header('List submissions'); ?>
      
      <p>
       The list below shows all submissions (newest first). Click the name to view the place on a map.
      </p>
      
      <div style="width:100%;height:500px;overflow:auto;">
      <table style="width:100%;">
      <thead>
        <td width="20%"><b>NAME AND LINK</b></td>
        <td><b>DESCRIPTION</b></td>
      </th>

<?php
      
if ($db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS)) {

  mysqli_select_db($db, DB_NAME);

  $result = mysqli_query($db, 'SELECT * FROM submissions ORDER BY id DESC');

  while ($row = mysqli_fetch_object($result)) {

    if ($row->name == '')
      $row->name = 'Anonymous';
      
?>

      <tr>
        <td><a href="<?php echo APP_URL."map-single.php?p=".$row->id; ?>"><?php echo $row->name; ?></a></td>
        <td><?php echo stripslashes($row->description); ?></td>
      </tr>

<?php

  };

  mysqli_close($db);

};

?>

  </table>
  </div>
  
  <p><br />
   View as a <a href="map-admin.php">map</a> | Download entire data set: <a href="getkml.php" target="_blank">KML</a> or <a href="dbdump.php" target="_blank">SQL</a>
  </p>
      
      <div id="bottompanel">
        <input type="submit" value="&nbsp;&nbsp;Submit a favorite place&nbsp;&nbsp;" onclick="window.location = 'submit.php';" />
        &nbsp;&nbsp;or&nbsp;&nbsp;
        <input type="submit" class="button" value="<?php echo OUT_NAME ?>" onclick="window.location = '<?php echo OUT_URL ?>';" />
      </div>
    
<?php get_footer(); ?>