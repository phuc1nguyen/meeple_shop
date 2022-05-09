<?php
  require_once('../database/dbconnection.php');
  require_once('../inc/functions.inc.php');
  include_once('../templates/script.php');
?>

<?php
  if (isset($_GET['text'], $_GET['key']) && strlen($_GET['key']) === 32){
    $text = filteredInput($_GET['text']);
    $key = filteredInput($_GET['key']); 

    $query = "UPDATE users SET active = 1";
    $query .= "WHERE (email = ? AND active = ?) LIMIT 1";
    $sth = $dbh->prepare($query);

    if ($sth->execute([$text, $key])) {
      redirect('auth/login.php');
    } else {
      echo "<script type='text/javascript'> toastr.error('User does not exist'); </script>";
    }
  } else {
    redirect();
  }
?>