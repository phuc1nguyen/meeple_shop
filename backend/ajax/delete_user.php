<?php
  require_once('../../database/dbconnection.php');
  require_once('../../inc/functions.inc.php');

  $userId = $_POST['id'];

  $query = "DELETE FROM users WHERE id = :userId LIMIT 1";
  $sth = $dbh->prepare($query);
  $sth->bindParam(':userId', $userId);

  if ($sth->execute()) {
    echo json_encode([
      'status' => 'ok',
      'message' => 'User deleted successfully'
    ]);
  } else {
    echo json_encode([
      'message' => 'Something went wrong'
    ]);
  }
?>