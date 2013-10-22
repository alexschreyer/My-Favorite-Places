<?php include_once 'config.php'; get_header('Submit your favorite place'); ?>

      <script type="text/javascript">

      // Set a default location
      var start_lat = <?php echo START_LAT; ?>;
      var start_lng = <?php echo START_LON; ?>;

      //<![CDATA[

      // Limit input characters in textbox
      function limitChars(textid, limit, infodiv) {
        var text = $('#'+textid).val();
        var textlength = text.length;
        if(textlength > limit) {
      		$('#' + infodiv).html('(You cannot write more then '+limit+' characters)');
      		$('#'+textid).val(text.substr(0,limit));
      		return false;
  	    } else {
          $('#' + infodiv).html('(You have '+ (limit - textlength) +' characters left)');
          return true;
        }
      };
      $(function(){
        $('#description').keyup(function(){
          limitChars('description', 255, 'charlimitinfo');
        })
      });

      var geocoder = new google.maps.Geocoder();

      function geocodePosition(pos) {
        geocoder.geocode({
        latLng: pos
        }, function(responses) {
        if (responses && responses.length > 0) {
          updateMarkerAddress(responses[0].formatted_address);
        } else {
          updateMarkerAddress('Cannot determine address at this location.');
        }
        });
      }

      function updateMarkerStatus(str) {
        document.getElementById('markerStatus').innerHTML = str;
      }

      function updateMarkerPosition(latLng) {
        document.getElementById('info').innerHTML = [
        latLng.lat(),
        latLng.lng()
        ].join(', ');
        document.getElementById('lng').value = latLng.lng();
        document.getElementById('lat').value = latLng.lat();
      }

      function updateMarkerAddress(str) {
        document.getElementById('address').innerHTML = str;
      }

      // Use the browser's location to get a starting value
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(foundLocation, noLocation);
      };

      function foundLocation(position)
      {
        var browser_lat = position.coords.latitude;
        var browser_lon = position.coords.longitude;
        if (browser_lat >= start_lat-0.01 && browser_lat <= start_lat+0.01 && browser_lon >= start_lng-0.01 && browser_lon <= start_lng+0.01) {
          start_lat = browser_lat;
          start_lng = browser_lon;
          // alert('Found location: ' + start_lat + ', ' + start_lng);
        };
      };
      function noLocation()
      {
       // alert('Could not find location');
      }

      function initialize() {
        var latLng = new google.maps.LatLng(start_lat,start_lng);
        var map = new google.maps.Map(document.getElementById('mapCanvas'), {
        zoom: 17,
        maxZoom: 20,
        minZoom: 15,
        center: latLng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        var marker = new google.maps.Marker({
        position: latLng,
        title: 'My favorite place',
        map: map,
        draggable: true
      });

      // Update current position info.
      updateMarkerPosition(latLng);
      geocodePosition(latLng);

      // Add dragging event listeners.
      google.maps.event.addListener(marker, 'dragstart', function() {
      updateMarkerAddress('Dragging...');
      });

      google.maps.event.addListener(marker, 'drag', function() {
      updateMarkerStatus('Dragging...');
      updateMarkerPosition(marker.getPosition());
      });

      google.maps.event.addListener(marker, 'dragend', function() {
      updateMarkerStatus('Drag ended');
      geocodePosition(marker.getPosition());
      });
      }

      // Onload handler to fire off the app.
      google.maps.event.addDomListener(window, 'load', initialize);

      // Verify form values

      function verify() {
        if ($('#type').val() == '' || $('#gender').val() == '' || $('#location').val() == '' || $('#description').val() == '') {
          alert('Please fill in all required fields before submitting.');
          return false;
        } else {
          if (confirm('Did you place the pink marker at the correct location on the map? Click \'OK\' to submit this place or \'Cancel\' to return to the form.')) {
            return true;
          } else {
            return false;
          };
        };
      };

      //]]>
      </script>

      <form action="process.php" onsubmit="return verify();" id="places_form" method="post"
      name="places_form">
      
        <div id="leftpanel">
          <p>
            My favorite place is here:<br />
            (click and drag tip of pink marker to location on map)
          </p>
          <div id="mapCanvas" style="height:400px;">Loading map... be patient...</div>
        </div>   
           
        <div id="rightpanel">
          <p>
            My first name is:<br />
            (this is optional)
          </p><input type="text" id="name" maxlength="32" name="name" />

          <p>
            I am a:
          </p><select id="type" name="type">
            <option value="" disabled="disabled" selected="selected">
              Please select...
            </option>
            <?php while (list($val,$txt) = each($demographic)) { ?>
              <option value="<?php echo $val ?>">
                <?php echo $txt ?>
              </option>
            <?php }; ?>
          </select>
          <p>
            And I am:
          </p><select id="gender" name="gender">
            <option value="" disabled="disabled" selected="selected">
              Please select...
            </option>
            <option value="mal">
              Male
            </option>
            <option value="fem">
              Female
            </option>
            <option value="oth">
              I'd rather not say
            </option>
          </select>
          <p>
            My favorite place is:
          <select id="location" name="location">
            <option value="" disabled="disabled" selected="selected">
              Please select...
            </option>
            <option value="out">
              Outdoors
            </option>
            <option value="ind">
              Indoors
            </option>
          </select>
          </p>
          <p>
            This is why it is special to me:
          </p>
          <textarea id="description" name="description" style="margin-bottom:0px;"></textarea>
          <span id="charlimitinfo" style="font-size:0.8em;" >(Max. 255 characters)</span>
        </div>
        
        <div id="bottompanel">
          <p style="font-size:0.8em;text-align:left;">
           PLEASE NOTE: All submitted information will be publicly viewable.
           We also record your computer's IP address for spam protection. Inappropriate submissions will be removed.
          </p>
          <input type="hidden" id="lng" name="lng" />
          <input type="hidden" id="lat" name="lat" />
          <input type="submit" name="submit" class="button highlight" value="Submit this place" />
          &nbsp;&nbsp;or&nbsp;&nbsp;
          <input type="button" class="button"  value="See what others have submitted" onclick="window.location = 'map.php';" />
        </div>   
        
      </form>

    <div id="infopanel">
      <strong>Marker status:</strong>
      <div id="markerStatus">
        <em>Click and drag the marker.</em>
      </div><strong>Current position:</strong>
      <div id="info"></div><strong>Closest matching address:</strong>
      <div id="address"></div>
    </div>

<?php get_footer(); ?>