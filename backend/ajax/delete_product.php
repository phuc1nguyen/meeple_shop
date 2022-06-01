<?php
  ob_start();
  require_once('../../database/dbconnection.php');
  require_once('../../inc/functions.inc.php');

  if (isset($_POST['id']) && filter_var($_POST['id'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
    $productId = $_POST['id'];
  } else {
    redirect('backend/prod_index.php');
  }

  // get product thumbnail
  $query1 = "SELECT thumb FROM products WHERE id = :id LIMIT 1;";
  $sth1 = $dbh->prepare($query1);
  $sth1->bindParam('id', $productId);
  if ($sth1->execute()) {
    $product = $sth1->fetch(PDO::FETCH_ASSOC);
    // get thumbnail path from this php file
    $productThumb = '../' . $product['thumb'];
  }

  // delete product
  $query2 = "DELETE FROM products WHERE id = :productId LIMIT 1";
  $sth2 = $dbh->prepare($query2);
  $sth2->bindParam(':productId', $productId);

  if ($sth2->execute() && unlink($productThumb)) {
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