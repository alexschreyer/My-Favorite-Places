<?php include_once 'config.php'; get_header('Admin map'); ?>

      <?php

        // Pass on GET parameters to KML

        $whereclause = array();
        if(isset($_GET['type']) && ($_GET['type'] != "")){
          array_push($whereclause, "type=".$_GET['type']);
        };
        if(isset($_GET['gender']) && ($_GET['gender'] != "")){
          array_push($whereclause, "gender=".$_GET['gender']);
        };
        if(isset($_GET['location']) && ($_GET['location'] != "")){
          array_push($whereclause, "location=".$_GET['location']);
        };
        if(isset($_GET['limit']) && ($_GET['limit'] != "")){
          array_push($whereclause, "limit=".$_GET['limit']);
        };

        $parameters = "&".implode("&", $whereclause);

      ?>

      <script type="text/javascript">

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

        <?php if(isset($_GET['heatmap'])) { ?>

          var imageBounds = new google.maps.LatLngBounds(
          new google.maps.LatLng(start_lat-0.01,start_lng-0.01),
          new google.maps.LatLng(start_lat+0.01,start_lng+0.01));

          var heatmap = new google.maps.GroundOverlay(
          "<?php echo APP_URL; ?>getheatmap.php",
          imageBounds);
          heatmap.setMap(map);

        <?php }; ?>

        // Add KML data
        var url = '<?php echo APP_URL; ?>getkml.php?v='+ Math.round(Math.random() * 10000000000)+'<?php echo $parameters ?>';
        var ctaLayer = new google.maps.KmlLayer(url);
        ctaLayer.setMap(map);

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
          <input type="checkbox" id="heatmap" name="heatmap" <?php if (isset($_GET['heatmap']) and $_GET['heatmap']=='hea') echo "checked='checked'"; ?> value="hea" />&nbsp;<span style="font-size:0.8em;">Show heatmap (full data)</span>
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
        <input type="submit" class="button" value="View home page" onclick="window.location = 'index.php';" />
      </div>

<?php get_footer(); ?>