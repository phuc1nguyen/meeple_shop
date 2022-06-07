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

  if ($_FILES['image']['error'] > 0) {
    $errors[] = "<p class='red-alert'>The file could not be uploaded because: <b>";

    switch ($_FILES['upload']['error']) {
      case 1:
        $errors[] .= "The file exceeds the upload_max_filesize setting in php.ini";
        break;

      case 2:
        $errors[] .= "The file exceeds the MAX_FILE_SIZE in HTML form";
        break;

      case 3:
        $errors[] .= "The file was partially uploaded";
        break;
      
      case 4:
        $errors[] .= "NO file was uploaded";
        break;

      case 6:
        $errors[] .= "No temporary folder was available";        
        break;

      case 7:
        $errors[] .= "Unable to write to the disk";
        break;

      case 8:
        $errors[] .= "File upload stopped";
        break;

      default:
        $errors[] .= "A system error has occured";
        break;
    }

    $errors .= "</b></p>";
  }
?>