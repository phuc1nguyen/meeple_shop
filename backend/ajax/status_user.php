<?php
  require_once('../../database/dbconnection.php');
  require_once('../../inc/functions.inc.php');

  $userId = $_POST['id'];
  $status = $_POST['status'];

  $data = array(
    ':status' => $status,
    ':userId' => $userId
  );

  // check if existing user is verified yet
  $query = "SELECT active FROM users WHERE id = :userId LIMIT 1";
  $sth = $dbh->prepare($query);
  $sth->bindParam(':userId', $userId);
  $sth->execute();
  $user = $sth->fetch(PDO::FETCH_ASSOC);

  if (strlen($user['active']) === 32) {
    // if user is not verified
    echo json_encode(array(
      'status' => 'error',
      'message' => 'Please verify user first'
    ));
  } else {
    // if user is created by admin or is verified
    // toggle user's status
    $query = "UPDATE users SET active = :status WHERE id = :userId LIMIT 1";
    $sth = $dbh->prepare($query);
    if ($sth->execute($data)) {
      echo json_encode(array(
        'status' => 'ok'
      ));
    } else {
      echo json_encode(array(
        'status' => 'error',
        'message' => 'Something went wrong'
      ));
    }
  }

?>