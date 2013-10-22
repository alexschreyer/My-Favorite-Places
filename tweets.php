<?php include_once 'config.php'; get_header('View tweets'); ?>

      <script type="text/javascript">

      $(document).ready(function(){

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

        var ctaLayer = new google.maps.KmlLayer('<?php echo APP_URL; ?>getkml2.php?limit=10&v='+ Math.round(Math.random() * 10000000000));
        ctaLayer.setMap(map);

          $.ajax({
              url:'http://search.twitter.com/search.json?geocode=42.389046,-72.529181,0.5mi&rpp=10&include_entities=true',
              dataType: "jsonp",
              success:function(data, textStatus, jqXHR) {
                  var json = $.parseJSON(data);
                  var tweets = json.results;
                  for (i = 0; i < tweets.length; i++) {
                      var html = '<div class="market-item"><div class="avatar"><img src="' + tweets[i].userImage + '" width="40"/></div><div class="message">' + tweets[i].text + '</div></div></div>';
                      addMarker(map, tweets[i].latitude, tweets[i].longitude, html);
                  }
              }
          });

      });

      </script>
      
      <p>
       The pins below show the most recent tweets. Click the pins to view comments.
      </p>
  
      <div id="mapCanvas" style="width:100%;height:500px;">Loading map... be patient...</div>
      
      <p>
        <br />Share this page:<br />
        <span class="st_twitter_large" displayText="Tweet"></span><span class="st_facebook_large" displayText="Facebook"></span><span class="st_ybuzz_large" displayText="Yahoo! Buzz"></span><span class="st_gbuzz_large" displayText="Google Buzz"></span><span class="st_email_large" displayText="Email"></span><span class="st_sharethis_large" displayText="ShareThis"></span>
      </p>
      
      <div id="bottompanel">
        <input type="submit" class="button highlight" value="Submit a favorite place" onclick="window.location = 'submit.php';" />
        &nbsp;&nbsp;or&nbsp;&nbsp;
        <input type="submit" class="button" value="Visit UMass.edu" onclick="window.location = 'http://umass.edu';" />
      </div>
    
<?php get_footer(); ?>