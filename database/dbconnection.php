<?php 
  // requires __DIR__ otherwise causes error calling ajax to other php files
  require __DIR__ . '/../inc/config.inc.php';

  try {
    // connect to database with the PDO object, $dbh stands for database handle
    // close connection by setting $dbh = null;
    $dbh = new PDO("mysql:host=" . DATABASE_HOSTNAME . ";dbname=" . DATABASE_NAME . ";charset=utf8", DATABASE_USERNAME, DATABASE_PASSWORD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $err) {
    // if connection is failed, show PDO error
    throw new PDOException($err->getMessage(), (int) $err->getCode());
    // echo "Connected failed: " . $err->getMessage() . "<br/>";
    die();
  }
?>