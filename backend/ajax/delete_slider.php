<?php
  require_once '../../database/dbconnection.php';
  require_once '../../inc/functions.inc.php';

  if (isset($_POST['id']) && filter_var($_POST['id'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
    $sliderId = $_POST['id'];
  } else {
    redirect('backend/slider_index.php');
  }

  // get slider to delete 
  $query1 = "SELECT thumb FROM sliders WHERE id = :id LIMIT 1;";
  $sth1 = $dbh->prepare($query1);
  $sth1->bindParam('id', $sliderId);

  if ($sth1->execute()) {
    $slider = $sth1->fetch(PDO::FETCH_ASSOC);
    // get slider path from this php file
    if (!empty($slider['thumb'])) {
      $sliderThumb = '../' . $slider['thumb'];
    } else {
      $sliderThumb = "";
    }
  }

  // delete slider
  $query2 = "DELETE FROM sliders WHERE id = :sliderId LIMIT 1;";
  $sth2 = $dbh->prepare($query2);
  $sth2->bindParam(':sliderId', $sliderId);

  if ($sth2->execute() && unlink($sliderThumb)) {
    echo json_encode(array(
      'status' => 'ok',
      'message' => 'Slider deleted successfully',
    ));
  } else {
    echo json_encode(array(
      'message' => 'Something went wrong',
    ));
  }
?>