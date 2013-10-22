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
<?php get_header('Report submission'); ?>

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

<?php get_footer(); ?>