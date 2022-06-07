<?php 
  session_start();
  require_once('../inc/functions.inc.php');
?>

<?php 
  if (!isset($_SESSION['user_type'])) {
    // can not access this if user haven't been authenticated
    redirect();
    exit();
  } else {
    // empty session 
    $_SESSION = array();
    // destroy created session
    session_destroy();
    // delete browser's cookies
    setcookie(session_name(), '', time() - 3600);
    redirect('auth/login.php');
    exit();
  }
?>