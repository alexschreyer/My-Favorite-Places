<?php include_once 'config.php';
// This file shows a single data point

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

get_header('A favorite place');

?>

      <script type="text/javascript">

      jQuery(document).ready(function($) {

          // Initialize map

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

      });

      </script>

      <p>
        Here's your favorite place:
      </p>

      <div id="mapCanvas" style="width:100%;height:500px;">Loading map... be patient...</div>
      
      <p>
        <br />Share this place:<br />
        <?php $sharemessage = htmlspecialchars("\"".$row->description."\"", ENT_QUOTES).' says '.(($row->name!='') ? $row->name : 'Anonymous'); ?>
        <span class='st_sharethis_large' displayText='ShareThis' st_title='<?php echo $sharemessage; ?>'></span>
        <span class='st_facebook_large' displayText='Facebook' st_title='<?php echo $sharemessage; ?>'></span>
        <span class='st_twitter_large' displayText='Tweet' st_title='<?php echo $sharemessage; ?>'></span>
        <span class='st_linkedin_large' displayText='LinkedIn' st_title='<?php echo $sharemessage; ?>'></span>
        <span class='st_pinterest_large' displayText='Pinterest' st_title='<?php echo $sharemessage; ?>'></span>
        <span class='st_email_large' displayText='Email' st_title='<?php echo $sharemessage; ?>'></span>
      </p>

      <div id="bottompanel">
        <input type="submit" class="button highlight" value="Submit another favorite place" onclick="window.location = 'submit.php';" />
        &nbsp;&nbsp;or&nbsp;&nbsp;
        <input type="submit" class="button" value="See what others have submitted" onclick="window.location = 'map.php';" />
      </div>

<?php get_footer(); ?>