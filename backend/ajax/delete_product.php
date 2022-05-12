<?php
  require_once('../../database/dbconnection.php');
  require_once('../../inc/functions.inc.php');

  $productId = $_POST['id'];

  $query = "DELETE FROM products WHERE id = :productId LIMIT 1";
  $sth = $dbh->prepare($query);
  $sth->bindParam(':productId', $productId);

  if ($sth->execute()) {
    echo json_encode([
      'status' => 'ok',
      'message' => 'Product deleted successfully'
    ]);
  } else {
    echo json_encode([
      'message' => 'Something went wrong'
    ]);
  }
?>