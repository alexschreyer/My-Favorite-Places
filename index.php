<?php include_once 'config.php'; get_header('Welcome'); ?>

<!-- BEGIN page content -->

<img src="img/home.jpg" width="100%">

<!-- BEGIN slideshow -->

<script language="JavaScript" src="inc/jquery.innerfade.js"></script>
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
      
<ul id="cycle">

<?php
      
if ($db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS)) {

  mysqli_select_db($db, DB_NAME);
  
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

<!-- END slideshow -->

<p><?php echo APP_DESC; ?></p>

<p><br />Tell us about your favorite place(s) and show us where they are. Submit any kind of place and as many as you like.
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

<!-- END page content -->

<?php get_footer(); ?>