<?php

  include_once 'config.php';
  
  // Pass on parameters to KML

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
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo APP_NAME; ?> - Admin map</title>
    <?php include 'headerdata.php'; ?>
    <meta name="robots" content="noindex,nofollow">
    <script type="text/javascript">

    function initialize() {

      var latLng = new google.maps.LatLng(42.390185,-72.528412);
      var myOptions = {
        zoom: 16,
        center: latLng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      }

      var map = new google.maps.Map(document.getElementById("mapCanvas"), myOptions);

      // map.addMapType(G_SATELLITE_3D_MAP);
      
<?php if(isset($_GET['heatmap'])) { ?>

      var imageBounds = new google.maps.LatLngBounds(
      new google.maps.LatLng(42.38,-72.54),
      new google.maps.LatLng(42.40,-72.51));
      
      var heatmap = new google.maps.GroundOverlay(
      "<?php echo APP_URL; ?>getheatmap.php",
      imageBounds);
      heatmap.setMap(map);
      
<?php }; ?>

      var ctaLayer = new google.maps.KmlLayer('http://umass.edu/myfavoriteplaces/getkml2.php?v='+ Math.round(Math.random() * 10000000000)+'<?php echo $parameters ?>');
      ctaLayer.setMap(map);
      
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
      
      <style type="text/css">
      <!--
       #wrap p,option,select,input {font-size:0.9em;};
      //-->
      </style>

      <p>
       This is what has been submitted so far. Filter by:<br />
       
       <form action="" id="filter_form" method="get" name="filter_form">
         <select id="type" name="type">
            <option value="" <?php if (!isset($_GET['type']) or $_GET['type']=='') echo "selected='selected'"; ?>>
              Anybody
            </option>
            <option value="und" <?php if (isset($_GET['type']) and $_GET['type']=='und') echo "selected='selected'"; ?>>
              Undergraduate Student
            </option>
            <option value="gra" <?php if (isset($_GET['type']) and $_GET['type']=='gra') echo "selected='selected'"; ?>>
              Graduate Student
            </option>
            <option value="alu" <?php if (isset($_GET['type']) and $_GET['type']=='alu') echo "selected='selected'"; ?>>
              Alumnus
            </option>
            <option value="fac" <?php if (isset($_GET['type']) and $_GET['type']=='fac') echo "selected='selected'"; ?>>
              Faculty
            </option>
            <option value="emp" <?php if (isset($_GET['type']) and $_GET['type']=='emp') echo "selected='selected'"; ?>>
              Employee
            </option>
            <option value="oth" <?php if (isset($_GET['type']) and $_GET['type']=='oth') echo "selected='selected'"; ?>>
              I am not with UMass
            </option>
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
       View as a <a href="list-admin.php">table</a> | Download entire data set: <a href="getkml2.php" target="_blank">KML</a> |
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