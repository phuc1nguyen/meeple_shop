<?php
  require_once '../../database/dbconnection.php';
  require_once '../../inc/functions.inc.php';

  $sliderId = $_POST['id'];
  $status = $_POST['status'];

  $data = array(
    ':status' => $status,
    ':sliderId' => $sliderId,
  );
  $query = "UPDATE sliders SET active = :status WHERE id = :sliderId LIMIT 1";
  $sth = $dbh->prepare($query);

  if ($sth->execute($data)) {
    echo true;
  } else {
    echo false;
  }

?>