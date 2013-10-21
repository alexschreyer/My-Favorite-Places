<?php include_once 'config.php'; ?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo APP_NAME; ?> - Welcome</title>
    <?php include 'headerdata.php'; ?>
    <meta name="robots" content="index,nofollow">
    <script language="JavaScript" src="jquery-1.6.2.min.js"></script>
    <script language="JavaScript" src="jquery.innerfade.js"></script>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
    	  // Homepage slideshow
    		$('ul#cycle').innerfade({
    			speed: 'slow',
    			timeout: 8000,
    			type: 'random_start',
    			containerheight: '80px'
    		});
    	});
    </script>
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
      
      <img src="image_01.jpg" width="100%">
      
      <ul id="cycle">            
<?php
      
if ($db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS)) {

  mysqli_select_db($db, DB_NAME);
	
  // Select the lastten submissions:
  // $result = mysqli_query($db, 'SELECT * FROM submissions ORDER BY id DESC LIMIT 10');
  
  // Select 10 random submissions:
  $result = mysqli_query($db, 'SELECT * FROM submissions ORDER BY RAND() LIMIT 10');

  while ($row = mysqli_fetch_object($result)) {

    if ($row->name == '')
      $row->name = 'Anonymous';
      
?>
        <li><b><span class="name"><a href="<?php echo APP_URL."map-single.php?p=".$row->id; ?>"><?php echo $row->name; ?> says</a>:</span></b><br />
      	<span class="text">"<?php echo stripslashes($row->description); ?>" - <a href="<?php echo APP_URL."map-single.php?p=".$row->id; ?>"><b>Visit this place</b></a></span></li>
<?php

  };

  mysqli_close($db);

};

?>
      </ul>

      <p>      
        What are <i><b>your</b></i> favorite places at the University of Massachusetts Amherst? 
      </p>  
      <p>  
        <br />If you are part of the UMass
        community, a member of our host communities or have just visited the campus, show us and
        tell us about your favorite place(s) on our campus. Submit any kind of place and as many as you like.
        You can even share them with your friends. Click the buttons below to get started:
      </p>
      <noscript>
        <style type="text/css">
        div#bottompanel {display:none;}
        </style>
        <p style="color:#ff0000;">
         <br />IMPORTANT: You must have Javascript enabled to use this website! Check your browser's settings to enable Javascript.<br /><br />
        </p>
      </noscript>
      
      <div id="bottompanel">
        <input type="submit" class="button highlight" value="Submit your favorite place" onclick="window.location = 'submit.php';" />
        &nbsp;&nbsp;or&nbsp;&nbsp;
        <input type="button" class="button" value="See what others have submitted" onclick="window.location = 'map.php';" />
      </div>

    </div><!-- wrap -->

    <?php include 'footer.php'; ?>

  </body>
</html>