<?php 
  define('BASE_URL', 'http://meeple_shop.test/');

  // function check_query(){

  // }

  function redirect($page = "index.php"){
    $url = BASE_URL . $page;
    header("Location: " . $url);
    exit();
  }
?>