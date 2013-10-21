<?php
// This file shows a single data point

include_once 'config.php';

if (isset($_GET['p']) and is_numeric(trim($_GET['p']))) {
  //This code runs if one point's ID has been submitted
  if ($db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS)) {
    mysqli_select_db($db, DB_NAME);
    $query = "SELECT * FROM submissions WHERE id=".$_GET['p']." LIMIT 1";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_object($result);
    mysqli_close($db);
  };
  if ($row==NULL) { header('Location: map.php'); };
}
else {
  // Load the overview map otherwise
  header('Location: map.php');
};
?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo APP_NAME; ?> - A favorite place</title>
    <?php include 'headerdata.php'; ?>
    <meta name="robots" content="noindex,nofollow">
    <script type="text/javascript">

    function initialize() {

      var latLng = new google.maps.LatLng(<?php echo $row->lat; ?>,<?php echo $row->lng; ?>);
      var viewlatLng = new google.maps.LatLng(<?php echo $row->lat; ?>,<?php echo $row->lng; ?>);
      var myOptions = {
        zoom: 17,
        center: viewlatLng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      };
      var map = new google.maps.Map(document.getElementById("mapCanvas"), myOptions);
      var marker = new google.maps.Marker({
        position: latLng,
        title: 'My favorite place',
        map: map,
        draggable: false
      });
      var infowindow = new google.maps.InfoWindow({
        content: "<div style='margin:0;padding:0;font-size:medium;font-weight:bold;'><?php $name = ($row->name!='') ? $row->name : 'Anonymous'; echo $name; ?> says:</div><div style='margin:0;padding:0;'>\"<?php echo $row->description; ?>\"</div>"
      });
      google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map,marker);
      });
      infowindow.open(map,marker);
    };

    </script>
  </head>
  <body onload="initialize();">

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

      <p>
        Here's your favorite place:
      </p>

      <div id="mapCanvas" style="width:100%;height:500px;">Loading map... be patient...</div>
      
      <p>
        <br />Share this place:<br />
         <?php $sharemessage = htmlspecialchars("\"".$row->description."\"", ENT_QUOTES).' says '.(($row->name!='') ? $row->name : 'Anonymous'); ?>
        <span  class='st_twitter_large' displayText='Tweet' st_title='<?php echo $sharemessage.' #UMassAmherst - '; ?>'></span><span  class='st_facebook_large' displayText='Facebook' st_title='<?php echo $sharemessage; ?>'></span><span  class='st_yahoo_large' displayText='Yahoo!' st_title='<?php echo $sharemessage; ?>'></span><span  class='st_gbuzz_large' displayText='Google Buzz' st_title='<?php echo $sharemessage; ?>'></span><span  class='st_email_large' displayText='Email'></span><span  class='st_sharethis_large' displayText='ShareThis' st_title='<?php echo $sharemessage.' #UMassAmherst '; ?>'></span>
      </p>

      <div id="bottompanel">
        <input type="submit" class="button highlight" value="Submit another favorite place" onclick="window.location = 'submit.php';" />
        &nbsp;&nbsp;or&nbsp;&nbsp;
        <input type="submit" class="button" value="See what others have submitted" onclick="window.location = 'map.php';" />
      </div>

    </div><!-- wrap -->

    <?php include 'footer.php'; ?>

  </body>
</html>