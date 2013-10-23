<!DOCTYPE html>
<html>
  <head>
    <title><?php echo APP_NAME; ?> - <?php echo $title; ?></title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="cache-control" content="no-cache, must-revalidate">
    <meta http-equiv="expires" content="0">
    <meta http-equiv="last-modified" content="">
    <meta name="robots" content="index,follow">
    <link rel="apple-touch-icon" href="img/app.png"/>
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; user-scalable=no" />
    <link rel="image_src" href="img/icon.png" />
    <meta property="og:image" content="img/icon.png"/>
    <meta name="description" content="<?php echo APP_DESC; ?>">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=OFL+Sorts+Mill+Goudy+TT&subset=latin' rel='stylesheet' type='text/css'>
    <script src="http://www.google.com/jsapi" type="text/javascript"></script>
    <script type="text/javascript">
      google.load("jquery", "1.6.2");
    </script>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=<?php echo G_API; ?>&v=3.exp&sensor=true&libraries=visualization"></script>
    <script type="text/javascript">var switchTo5x=true;</script>
    <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
    <script type="text/javascript">stLight.options({publisher: "<?php echo ST_API; ?>", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
  </head>
  <body>
    <div id="wrap">

    <h1>
      <a href="index.php"><?php echo APP_NAME; ?></a>
    </h1>