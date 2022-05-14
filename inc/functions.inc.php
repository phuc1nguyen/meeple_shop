<?php 
  // requires __DIR__ otherwise cause error when calling ajax to other php files
  require_once(__DIR__ . '/../database/dbconnection.php');

  define('BASE_URL', 'http://meeple_shop.test/');

  if (!function_exists('redirect')) {
    function redirect($page = "index.php"){
      // redirect to certain url
      $url = BASE_URL . $page;
      header("Location: " . $url);
      exit();
    }
  }

  if (!function_exists('filteredInput')) {
    function filteredInput($userInput) {
      // filter user inputs
      $userInput = trim($userInput);
      $userInput = stripslashes($userInput);
      $userInput = strip_tags($userInput);
      $userInput = htmlspecialchars($userInput);
      return $userInput;
    }
  }

  if (!function_exists('isRoute')) {
    // highlight admin side navigation items when certain route is currently active
    // strtok() ignores the query string, then in_array check if the REQUEST_URI is in array of routes
    // https://stackoverflow.com/questions/1283327/how-to-get-url-of-current-page-in-php#1283330
    function isRoute($arrRoutes, $className) {
      if (in_array(strtok($_SERVER['REQUEST_URI'], '?'), $arrRoutes)) {
        echo $className;
      }

      echo "";
    }
  }

  if (!function_exists('pagination')) {
    function pagination() {

    }
  }
?>