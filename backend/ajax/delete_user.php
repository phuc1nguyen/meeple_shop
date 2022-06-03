<?php
  require_once('../../database/dbconnection.php');
  require_once('../../inc/functions.inc.php');

  if (isset($_POST['id']) && filter_var($_POST['id'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
    $userId = $_POST['id'];
  } else {
    redirect('backend/user_index.php');
  }

  // get user to delete profile picture in hard disk
  $query1 = "SELECT avatar FROM users WHERE id = :id LIMIT 1;";
  $sth1 = $dbh->prepare($query1);
  $sth1->bindParam('id', $userId);
  if ($sth1->execute()) {
    $user = $sth1->fetch(PDO::FETCH_ASSOC);
    // get user profile picture path from this php file
    if (!empty($user['avatar'])) {
      $userAva = '../' . $user['avatar'];
      unlink($userAva);
    } else {
      $userAva = "";
    }
  }

  // delete user
  $query2 = "DELETE FROM users WHERE id = :userId LIMIT 1;";
  $sth2 = $dbh->prepare($query2);
  $sth2->bindParam(':userId', $userId);

  if ($sth2->execute()) {
    echo json_encode([
      'status' => 'ok',
      'message' => 'User deleted successfully'
    ]);
  } else {
    echo json_encode([
      'message' => 'Something went wrong'
    ]);
  }
?>