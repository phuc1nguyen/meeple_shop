<?php
  include('../config/mysqli_connect.php');
  include('../inc/functions.php');
  include('../templates/script.php');
?>

<?php
  if (isset($_GET['text'], $_GET['key']) && strlen($_GET['key']) == 32){
    $text = mysqli_real_escape_string($dbc, $_GET['text']);
    $key = mysqli_real_escape_string($dbc, $_GET['key']); 

    $query = "UPDATE users SET active = 1 WHERE (email = '${text}' AND active = '${key}') LIMIT 1";
    $result = mysqli_query($dbc, $query) or die("Query ${query} failed: " . mysqli_error($dbc));
    if (mysqli_affected_rows($dbc) == 1) {
      redirect('auth/login.php');
    } else {
      echo "<script>alert('User does not exist');</script>";
    }
  } else {
    redirect();
  }
?>