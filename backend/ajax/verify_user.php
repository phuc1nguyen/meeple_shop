<?php
  require_once('../../database/dbconnection.php');
  require_once('../../inc/functions.inc.php');

  if (isset($_POST['id']) && filter_var($_POST['id'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
    $userId = $_POST['id'];
  } else {
    redirect();
  }

  $query = "UPDATE users SET active = 1 WHERE id = :userId LIMIT 1;";
  $sth = $dbh->prepare($query);
  $sth->bindParam('userId', $userId);

  if ($sth->execute()) {
    echo true;
  } else {
    echo false;
  }

?>