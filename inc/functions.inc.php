<?php 
  require_once('../database/dbconnection.php');

  define('BASE_URL', 'http://meeple_shop.test/');

  function redirect($page = "index.php"){
    // redirect to certain url
    $url = BASE_URL . $page;
    header("Location: " . $url);
    exit();
  }

  function filteredInput($userInput) {
    // filter user inputs
    $userInput = trim($userInput);
    $userInput = stripslashes($userInput);
    $userInput = htmlspecialchars($userInput);
    return $userInput;
  }

  function isRoute($arrRoutes, $className) {
    if (in_array(strtok($_SERVER['REQUEST_URI'], '?'), $arrRoutes)) {
      echo $className;
    }

    echo "";
  }

  function pagination() {

  }
?>