<?php include_once 'config.php'; get_header('Admin map'); ?>

<script type="text/javascript">

var myData = [

<?php

  // Assemble GET parameters for KML and DB request
  $whereclause = array();
  if(isset($_GET['type']) && ($_GET['type'] != "")){
    array_push($whereclause, "type='".$_GET['type']."'");
  };
  if(isset($_GET['gender']) && ($_GET['gender'] != "")){
    array_push($whereclause, "gender='".$_GET['gender']."'");
  };
  if(isset($_GET['location']) && ($_GET['location'] != "")){
    array_push($whereclause, "location='".$_GET['location']."'");
  };
  if(isset($_GET['limit']) && ($_GET['limit'] != "")){
    array_push($whereclause, "limit='".$_GET['limit']."'");
  };
  $parameters = "&".implode("&", $whereclause);


  // Get data from DB directly for heatmap
  if ($db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS)) {

    mysqli_select_db($db, DB_NAME);

    // Assemble query from form fields via GET
    $query = "SELECT * FROM submissions";
    if ($_GET) {
      $query .= (count($whereclause) > 0 ? (count($whereclause) > 1 ? " WHERE ".implode(" AND ", $whereclause) : " WHERE ".implode(" ", $whereclause)) : "");
    };
    $query .= " ORDER BY id DESC";
    if(isset($_GET['limit']) && ($_GET['limit'] != "")){
      $query .= " LIMIT " . $_GET['limit'];
    };

    // echo $query;

    $points = array();

    if ($result = mysqli_query($db, $query)) {

      while ($row = mysqli_fetch_object($result)) {

        if ($row->name == '') $row->name = 'Anonymous';
        $points[] = array(
             'id' => $row->id,
             'name' => $row->name,
             'description' => $row->description,
             'lat' => $row->lat,
             'lng' => $row->lng
        );
        // Echo points: ?>
        new google.maps.LatLng(<?php echo $row->lat ?>, <?php echo $row->lng ?>),
        <?php
      };

    };

    mysqli_close($db);

  };


?>

];

jQuery(document).ready(function($) {

  // Initialize map

  // Set a default location
  var start_lat = <?php echo START_LAT; ?>;
  var start_lng = <?php echo START_LON; ?>;

  var latLng = new google.maps.LatLng(start_lat,start_lng);
  var myOptions = {
    zoom: 16,
    center: latLng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }

  var map = new google.maps.Map(document.getElementById("mapCanvas"), myOptions);

  // Show heatmap only if no KML is shown

  <?php if(isset($_GET['heatmap'])) { ?>

  // Add heatmap data
    var pointArray = new google.maps.MVCArray(myData);
    heatmap = new google.maps.visualization.HeatmapLayer({
      data: pointArray,
      radius: 50
    });

    heatmap.setMap(map);

  <?php } else  { ?>

    // Add KML data
    var url = "<?php echo APP_URL; ?>getkml.php?v="+ Math.round(Math.random() * 10000000000)+"<?php echo $parameters ?>";
    var ctaLayer = new google.maps.KmlLayer(url);

    ctaLayer.setMap(map);

  <?php }; ?>

});

</script>

      <p>This is what has been submitted so far. Filter by:<br />
       
       <form action="" id="filter_form" method="get" name="filter_form">
         <select id="type" name="type">
            <option value="" <?php if (!isset($_GET['type']) or $_GET['type']=='') echo "selected='selected'"; ?>>
              Anybody
            </option>
            <?php while (list($val,$txt) = each($demographic)) { ?>
              <option value="<?php echo $val ?>" <?php if (isset($_GET['type']) and $_GET['type']==$val) echo "selected='selected'"; ?>>
                <?php echo $txt ?>
              </option>
            <?php }; ?>
          </select>
          <select id="gender" name="gender">
            <option value="" <?php if (!isset($_GET['gender']) or $_GET['gender']=='') echo "selected='selected'"; ?>>
              Any gender
            </option>
            <option value="mal" <?php if (isset($_GET['gender']) and $_GET['gender']=='mal') echo "selected='selected'"; ?>>
              Male
            </option>
            <option value="fem" <?php if (isset($_GET['gender']) and $_GET['gender']=='fem') echo "selected='selected'"; ?>>
              Female
            </option>
            <option value="oth" <?php if (isset($_GET['gender']) and $_GET['gender']=='oth') echo "selected='selected'"; ?>>
              I'd rather not say
            </option>
          </select>
          <select id="location" name="location">
            <option value="" <?php if (!isset($_GET['location']) or $_GET['location']=='') echo "selected='selected'"; ?>>
              Anywhere
            </option>
            <option value="out" <?php if (isset($_GET['location']) and $_GET['location']=='out') echo "selected='selected'"; ?>>
              Outdoors
            </option>
            <option value="ind" <?php if (isset($_GET['location']) and $_GET['location']=='ind') echo "selected='selected'"; ?>>
              Indoors
            </option>
          </select>
          <input type="checkbox" id="heatmap" name="heatmap" <?php if (isset($_GET['heatmap']) and $_GET['heatmap']=='hea') echo "checked='checked'"; ?> value="hea" />&nbsp;Heatmap
          <input type="submit" value=" Update Map " />
       </form>
      </p>

      <div id="mapCanvas" style="width:100%;height:500px;">Loading map... be patient...</div>
      
      <p><br />
       View as a <a href="list-admin.php">table</a> | Download entire data set: <a href="getkml.php" target="_blank">KML</a> or <a href="dbdump.php" target="_blank">SQL</a>
      </p>

      <div id="bottompanel">
        <input type="submit" value="&nbsp;&nbsp;Submit a favorite place&nbsp;&nbsp;" onclick="window.location = 'submit.php';" />
        &nbsp;&nbsp;or&nbsp;&nbsp;
        <input type="submit" class="button" value="<?php echo OUT_NAME ?>" onclick="window.location = '<?php echo OUT_URL ?>';" />
      </div>

<?php get_footer(); ?>