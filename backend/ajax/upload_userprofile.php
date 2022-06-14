<?php
  if (isset($_FILES['thumb'])) {
    $allowed = ['image/jpg', 'image/png', 'image/jpeg'];

    if (in_array($_FILES['thumb']['type'], $allowed)) {
      $tmp = explode('.', $_FILES['thumb']['name']);
      $ext = end($tmp);
      $renamed = time() . '_' . uniqid(rand(), false) . '.' . $ext;
      move_uploaded_file($_FILES['thumb']['tmp_name'], '../public/img/' . $renamed);

      echo json_encode([
        'status' => 'ok',
        'image' => 'backend/public/img/' . $renamed,
      ]);
    } else {
      echo json_encode([
        'message' => 'Invalid file type. Please upload an image',
      ]);
    }
  }
?>