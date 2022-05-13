<?php 
  require_once('../../database/dbconnection.php');
  require_once('../../inc/functions.inc.php');

  if (isset($_GET['query'])) {
    $search = $_GET['query'];
    $data = array(
      ':name' => '%' . $search . '%'
    );

    $query = "SELECT * FROM products WHERE name LIKE :name LIMIT 10";
    $sth = $dbh->prepare($query);
    // $sth->bindParam(':name', '%' . $search . '%');
    $sth->execute($data);
    $products = $sth->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($products);
  }
?>