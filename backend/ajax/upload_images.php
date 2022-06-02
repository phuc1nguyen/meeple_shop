<?php
  if (isset($_FILES['thumb'])) {
    $allowed = array('image/jpg', 'image/jpeg', 'image/png');

    if (in_array($_FILES['thumb']['type'], $allowed)) {
      // uploaded file is valid
      $tmp = explode('.', $_FILES['thumb']['name']);
      $ext = end($tmp);
      // separate into 2 lines because:
      // https://stackoverflow.com/questions/4636166/only-variables-should-be-passed-by-reference#4636183
      $renamed = time() . '_' . uniqid(rand(), false) . '.' . $ext;
      move_uploaded_file($_FILES['thumb']['tmp_name'], '../public/img/' . $renamed);

      echo json_encode(array(
        'status' => 'ok',
        'image' => 'public/img/' . $renamed
      ));
    } else {
      // uploaded file is invalid
      echo json_encode(array(
        'message' => 'Invalid file type, please choose another file'
      ));
    }
  }
?>