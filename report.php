<?php
// This file allows for reporting an inappropriate point

include_once 'config.php';

if (isset($_GET['p']) and !isset($_POST['submit']) and is_numeric(trim($_GET['p']))) {
  //This code runs if one point's ID has been submitted
  if ($db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS)) {
    mysqli_select_db($db, DB_NAME);
    $query = "SELECT * FROM submissions WHERE id=".$_GET['p']." LIMIT 1";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_object($result);
    mysqli_close($db);
  };
  if ($row==NULL) { header('Location: map.php'); };
}
else if (isset($_POST['submit'])) {
    // Email form submission
    $message = "
Point submitted as inappropriate:

ID: {$_POST['id']}
Name: {$_POST['name']}
Description: {$_POST['description']}

Comment: {$_POST['comment']}";
    $headers = 'From: noreply@myfavoriteplaces.umass.edu' . "\r\n" .
      'Reply-To: noreply@myfavoriteplaces.umass.edu' . "\r\n" .
      'X-Mailer: PHP/' . phpversion();
    if (mail(ADMIN_EMAILS,'['.APP_NAME.'] Submission report',$message, $headers)) {
      $response = "<p>Your submission has been sent.</p>";
    } else {
      $response = "<p>Your submission could not be sent.</p>";
    };
    // die($response);
    header('Location: map.php');
}

else {
  // Load the overview map otherwise
  header('Location: map.php');
};
?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo APP_NAME; ?> - Report submission</title>
    <?php include 'headerdata.php'; ?>
    <meta name="robots" content="noindex,nofollow">
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

      <p>
        Report this place as inappropriate:
      </p>
      
      <?php
       if (!isset($_POST['submit'])) {
      ?>
      
      <form action='<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>' method='post'>

        <table>
          <tr>
            <td><b>ID:</b></td>
            <td><?php echo $row->id; ?></td>
          </tr>
          <tr>
            <td><b>Name:</b></td>
            <td><?php echo $row->name; ?></td>
          </tr>
          <tr>
            <td><b>Description:</b></td>
            <td><?php echo $row->description; ?></td>
          </tr>
        </table>

        <p>
          Please comment why this place is inappropriate (optional):
        </p>
        
        <textarea style="width:100%;height:100px;" name="comment" id="comment"></textarea>
        
        <input type="hidden" name="id" value="<?php echo $row->id; ?>">
        <input type="hidden" name="name" value="<?php echo $row->name; ?>">
        <input type="hidden" name="description" value="<?php echo $row->description; ?>">
        
        <div id="bottompanel">
          <input type="submit" name="submit" value="&nbsp;&nbsp;Submit as inappropriate&nbsp;&nbsp;" />
          &nbsp;&nbsp;or&nbsp;&nbsp;
          <input type="submit" value="&nbsp;&nbsp;Go back&nbsp;&nbsp;" onclick="window.location = 'map.php';" />
        </div>
      
      </form>
      
      <?php
       };
      ?>

    </div><!-- wrap -->

    <?php include 'footer.php'; ?>

  </body>
</html>