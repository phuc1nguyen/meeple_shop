<?php 
  require_once('../inc/config.inc.php');

  try {
    // connect to database with the PDO object, $dbh stands for database handle
    // close connection by setting $dbh = null;
    $dbh = new PDO("mysql:host=" . DATABASE_HOSTNAME . ";dbname=" . DATABASE_NAME . ";charset=utf8", DATABASE_USERNAME, DATABASE_PASSWORD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $err) {
    // if connection failed, show PDO error
    echo "Connected failed: " . $err->getMessage() . "<br/>";
    die();
  }
?>