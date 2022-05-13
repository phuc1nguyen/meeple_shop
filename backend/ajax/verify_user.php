<?php
  // finish updating user status without changing non-verify user (use toastr to warn)
  // then continue writing this file
  require_once('../../database/dbconnection.php');
  require_once('../../inc/functions.inc.php');

  $userId = $_POST['id'];

  $query = "UPDATE users SET active = 1 WHERE id = :userId LIMIT 1";
  $sth->prepare($query);
  $sth->bindParam('userId', $userId);

  if ($sth->execute()) {
    echo true;
  } else {
    echo false;
  }

?>