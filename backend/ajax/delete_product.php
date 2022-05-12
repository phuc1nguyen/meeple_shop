<?php
  ob_start();
  require_once('../../database/dbconnection.php');
  require_once('../../inc/functions.inc.php');

  $productId = $_POST['id'];

  $query = "DELETE FROM products WHERE id = :productId LIMIT 1";
  $sth = $dbh->prepare($query);
  $sth->bindParam(':productId', $productId);

  if ($sth->execute()) {
    ob_end_clean();
    echo json_encode(array(
      'status' => 'ok',
      'message' => 'Product deleted successfully'
    ));
  } else {
    ob_end_clean();
    echo json_encode(array(
      'message' => 'Something went wrong'
    ));
  }
?>