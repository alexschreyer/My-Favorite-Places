<?php include_once 'config.php'; ?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo APP_NAME; ?> - View submissions</title>
    <?php include 'headerdata.php'; ?>
    <meta name="robots" content="noindex,nofollow">
    <script type="text/javascript">
    
    function initialize() {

      var latLng = new google.maps.LatLng(42.390185,-72.528412);
      var myOptions = {
        zoom: 15,
        center: latLng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      }

      var map = new google.maps.Map(document.getElementById("mapCanvas"), myOptions);

      var ctaLayer = new google.maps.KmlLayer('<?php echo APP_URL; ?>getkml2.php?limit=10&v='+ Math.round(Math.random() * 10000000000));
      ctaLayer.setMap(map);
    };


    $(document).ready(function(){

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
       The pins below show the most recent 500 submissions. Click the pins to view comments.
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
    
    </div><!-- wrap -->

    <?php include 'footer.php'; ?>
    
  </body>
</html>