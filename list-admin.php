<?php include_once 'config.php'; ?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo APP_NAME; ?> - List submissions</title>
    <?php include 'headerdata.php'; ?>
    <meta name="robots" content="noindex,nofollow">
  </head>
  <body>
  
    <!-- Begin UMass Amherst top banner -->
    <div id="topbanner" style="text-align: right; padding-top: 8px; padding-right: 15px; padding-bottom: 8px; padding-left: 15px; background-color: rgb(136, 28, 28); ">
      <div style="width:900px;margin:0 Auto;">
       <a href="http://umass.edu/"><img id="banner_wordmark" src="http://umass.edu/umhome/identity/top_banner_06/informal_fff_on_881c1c.gif" width="146" height="22" alt="UMass Amherst" style="float: left; width: 146px; border: 0;"></a>
      <form action="http://googlebox.oit.umass.edu/search" method="get" name="gs" onsubmit="if (this.q.value=='Search UMass Amherst') return false;" style="margin: 0; padding: 0">
      <div><label for="q"><input type="text" style="font-size: 11px; font-family: Verdana, sans-serif; padding-left: 2px" size="22" name="q" id="q" value="Search UMass Amherst" onfocus="if (this.value=='Search UMass Amherst') this.value=''" onblur="if (this.value=='') this.value='Search UMass Amherst'"></label>
      <input name="sa" type="submit" value="Go" style="font-size: 11px; font-family: Verdana, sans-serif;">
      <input type="hidden" name="site" value="default_collection">
      <input type="hidden" name="client" value="default_frontend">
      <input type="hidden" name="proxystylesheet" value="default_frontend">
      <input type="hidden" name="output" value="xml_no_dtd">
      </div></form>
      </div>
    </div>
    <!-- End UMass Amherst top banner -->

    <div id="wrap">
    
      <h1>
        <a href="index.php"><?php echo APP_NAME; ?></a>
      </h1>
      
      <style type="text/css">
      <!--
       #wrap p,option,select,input {font-size:0.9em;};
      //-->
      </style>
      
      <p>
       The list below shows all submissions (newest first). Click the name to view the place on a map.
      </p>
      
      <div style="width:100%;height:500px;overflow:auto;">
      <table>
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
   View as a <a href="map-admin.php">map</a> | Download entire data set: <a href="getkml2.php" target="_blank">KML</a> |
       View <a href="http://statcounter.com/project/standard/stats.php?project_id=6368502&guest=1" target="_blank">Website Stats</a>
  </p>
      
      <div id="bottompanel">
        <input type="submit" value="&nbsp;&nbsp;Submit a favorite place&nbsp;&nbsp;" onclick="window.location = 'submit.php';" />
        &nbsp;&nbsp;or&nbsp;&nbsp;
        <input type="submit" value="&nbsp;&nbsp;Visit UMass.edu&nbsp;&nbsp;" onclick="window.location = 'http://umass.edu';" />
      </div>
    
    </div><!-- wrap -->

    <?php include 'footer.php'; ?>
    
  </body>
</html>