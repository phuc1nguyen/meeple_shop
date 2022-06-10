<?php
  require_once '../../database/dbconnection.php';
  require_once '../../inc/functions.inc.php';

  $tutId = $_POST['id'];
  $status = $_POST['status'];

  $data = array(
    ':status' => $status,
    ':tutId' => $tutId,
  );
  $query = "UPDATE tutorials SET active = :status WHERE id = :tutId LIMIT 1";
  $sth = $dbh->prepare($query);

  if ($sth->execute($data)) {
    echo true;
  } else {
    echo false;
  }

?>