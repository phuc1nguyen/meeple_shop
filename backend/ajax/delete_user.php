<?php
  require_once('../../database/dbconnection.php');
  require_once('../../inc/functions.inc.php');

  // $userId = $_POST['id'];
  echo json_encode(array('status' => 'ok', 'data' => $_POST));

  // $query = "DELETE FROM users WHERE id = :userId LIMIT 1";
  // $sth = $dbh->prepare($query);
  // $sth->bindParam(':userId', $userId);

  // if ($sth->execute()) {
  //   echo json_encode(array('status' => 'ok'));
  // } else {
  //   echo json_encode(array('status' => 'error'));
  // }
?>