<?php
  require_once '../../database/dbconnection.php';
  require_once '../../inc/functions.inc.php';

  if (isset($_POST['id']) && filter_var($_POST['id'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
    $tutId = $_POST['id'];
  } else {
    redirect('backend/tutorial_index.php');
  }

  // get tutorial to delete 
  $query1 = "SELECT thumb FROM tutorials WHERE id = :id LIMIT 1;";
  $sth1 = $dbh->prepare($query1);
  $sth1->bindParam('id', $tutId);

  if ($sth1->execute()) {
    $tut = $sth1->fetch(PDO::FETCH_ASSOC);
    // get tutorial thumb path from this php file
    if (!empty($tut['thumb'])) {
      $tutThumb = '../' . $tut['thumb'];
    } else {
      $tutThumb = "";
    }
  }

  // delete tutorial
  $query2 = "DELETE FROM tutorials WHERE id = :tutId LIMIT 1;";
  $sth2 = $dbh->prepare($query2);
  $sth2->bindParam(':tutId', $tutId);

  if ($sth2->execute() && unlink($tutThumb)) {
    echo json_encode(array(
      'status' => 'ok',
      'message' => 'Tutorial deleted successfully',
    ));
  } else {
    echo json_encode(array(
      'message' => 'Something went wrong',
    ));
  }
?>