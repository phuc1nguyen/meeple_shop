<?php 
  require_once('../database/dbconnection.php');

  define('BASE_URL', 'http://meeple_shop.test/');

  function redirect($page = "index.php"){
    $url = BASE_URL . $page;
    header("Location: " . $url);
    exit();
  }

  function filteredInput($userInput) {
    $userInput = trim($userInput);
    $userInput = stripslashes($userInput);
    $userInput = htmlspecialchars($userInput);
    return $userInput;
  }

  function pagination() {

  }
?>