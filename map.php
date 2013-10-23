<?php include_once 'config.php'; get_header('View submissions'); ?>

      <script type="text/javascript">

      // Initialize map when loaded

      jQuery(document).ready(function($) {

        // Set a default location
        var start_lat = <?php echo START_LAT; ?>;
        var start_lng = <?php echo START_LON; ?>;

        var latLng = new google.maps.LatLng(start_lat,start_lng);
        var myOptions = {
          zoom: 15,
          center: latLng,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }

        var map = new google.maps.Map(document.getElementById("mapCanvas"), myOptions);

        // Load KML layer
        var FavoritePlacesLayer = new google.maps.KmlLayer('<?php echo APP_URL; ?>getkml.php?limit=500&v='+ Math.round(Math.random() * 10000000000));
        FavoritePlacesLayer.setMap(map);

        // Load Twitter layer
        var TwitterLayer = new google.maps.KmlLayer('<?php echo APP_URL; ?>gettweetkml.php?v='+ Math.round(Math.random() * 10000000000));
        TwitterLayer.setMap(map);

      });

      </script>
      
      <p>
       The pins below show the most recent 500 submissions. Click the pins to view comments.
      </p>
  
      <div id="mapCanvas" style="width:100%;height:500px;">Loading map... be patient...</div>
      
      <p>
        <br />Share this page:<br />
        <span class='st_sharethis_large' displayText='ShareThis'></span>
        <span class='st_facebook_large' displayText='Facebook'></span>
        <span class='st_twitter_large' displayText='Tweet'></span>
        <span class='st_linkedin_large' displayText='LinkedIn'></span>
        <span class='st_pinterest_large' displayText='Pinterest'></span>
        <span class='st_email_large' displayText='Email'></span>
      </p>
      
      <div id="bottompanel">
        <input type="submit" class="button highlight" value="Submit a favorite place" onclick="window.location = 'submit.php';" />
        &nbsp;&nbsp;or&nbsp;&nbsp;
        <input type="submit" class="button" value="<?php echo OUT_NAME ?>" onclick="window.location = '<?php echo OUT_URL ?>';" />
      </div>
    
<?php get_footer(); ?>