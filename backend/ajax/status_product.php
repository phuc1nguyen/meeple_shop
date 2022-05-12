<?php
  require_once('../../database/dbconnection.php');
  require_once('../../inc/functions.inc.php');

  $productId = $_POST['id'];
  $status = $_POST['status'];

  $data = array(
    ':status' => $status,
    ':prodId' => $productId
  );
  $query = "UPDATE products SET active = :status WHERE id = :prodId LIMIT 1";
  $sth = $dbh->prepare($query);
  if ($sth->execute($data)) {
    echo '1';
  } else {
    echo '0';
  }

?>