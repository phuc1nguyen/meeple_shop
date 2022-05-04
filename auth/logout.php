<?php 
  session_start();
  include('../database/dbconnection.php');
  include('../inc/functions.inc.php');
?>

<?php 
  if (!isset($_SESSION['user_type'])){
    // neu chua dang nhap thi khong cho dang xuat
    redirect();
  } else {
    // xoa het array cua session
    $_SESSION = array();
    // destroy session da tao
    session_destroy();
    // xoa cookie cua trinh duyet 
    setcookie(session_name(), '', time() - 3600);
    redirect('auth/login.php');
  }
?>