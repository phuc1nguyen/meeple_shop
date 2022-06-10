<?php 
  require_once '../inc/functions.inc.php';

  adminAccess();

  if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
    $sliderId = $_GET['id'];
  } else {
    redirect('backend/slider_index.php');
  }
  
  // get slider by id from database
  $query = "SELECT * FROM sliders WHERE id = ? LIMIT 1"; 
  $sth = $dbh->prepare($query);
  $sth->bindParam(1, $sliderId);

  if ($sth->execute()) {
    $slider = $sth->fetch(PDO::FETCH_ASSOC);
  } else {
    redirect('backend/slider_index.php');
  }

  // update this slider
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // slider description is not required for updating
    $errors = array();
    
    if (!empty($_POST['name'])) {
      $name = filteredInput($_POST['name']);
    } else {
      $errors[] = 'name';
    }

    if (!empty($_POST['description'])) {
      $description = filteredInput($_POST['description']);
    } else {
      $description = "";
    }

    if (!empty($_POST['thumbPath'])) {
      $path = filteredInput($_POST['thumbPath']);
    } else {
      $errors[] = 'thumb';
    }

    if (!empty($_POST['oldThumb'])) {
      $oldPath = filteredInput($_POST['oldThumb']);
      unlink($oldPath);
    }

    if (isset($_POST['active'])) {
      $active = $_POST['active'];
    } else {
      $active = 1;
    }

    if (empty($errors)) {
      // if all inputs are filled in
      $data = array(
        'name' => $name,
        'description' => $description,
        'thumb' => $path,
        'active' => $active,
        'id' => $sliderId,
      );
      $query = "UPDATE sliders";
      $query .= " SET name = :name, description = :description, thumb = :thumb, active = :active";
      $query .= " WHERE id = :id LIMIT 1";
      $sth = $dbh->prepare($query);
      
      if ($sth->execute($data)) {
        redirect('backend/slider_index.php');
      } else {
        // failed to update
        $msg = "<script type='text/javascript'> toastr.error('Failed to update due to server error'); </script>";
      }
    } else {
      // some missing inputs alert
      $msg = "<script type='text/javascript'> toastr.error('Please fill in all fields'); </script>";
    }
  }
?>

<?php
  include_once 'templates/header.php';
  include_once 'templates/navbar.php';
  include_once 'templates/sidebar.php';
?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="ml-2">Update Slider</h1> 
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Slider Information</h3>
              </div>
              <form class="form-horizontal" id="myForm" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name<sup>*</sup></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter slider name" value="<?= $slider['name'] ?? ''; ?>">
                    <?php if (isset($errors) && in_array('name', $errors)) echo "<p class='red-alert'>Please fill in slider name</p>"; ?>
                  </div>
                  <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="5" placeholder="Enter slider description"><?= $slider['description'] ?? '' ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="">Thumbnail<sup>*</sup></label>
                    <div class="input-group" style="display: flex;">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" onchange="updateThumb()" id="thumb" name="thumb">
                        <input type="hidden" class="" id="thumbPath" name="thumbPath" value="<?= (!empty($_POST['thumbPath'])) ? htmlspecialchars($_POST['thumbPath']) : $slider['thumb'] ?>">
                        <input type="hidden" class="" id="oldThumb" name="oldThumb">
                        <label class="custom-file-label" for="thumb">Choose File</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                    <?php if (isset($errors) && in_array('thumb', $errors)) echo "<p class='red-alert'>Please upload this slider</p>"; ?>
                    <div id="thumbPreview" class="mt-3">
                      <img src="<?= (!empty($_POST['thumbPath'])) ? htmlspecialchars($_POST['thumbPath']) : $slider['thumb'] ?>" alt="No Thumbnail" width="300px" height="100px">
                    </div>
                  </div>
									<div class="form-group"> 
                    <label for="active">Status</label> 
                    <select class="form-control" id="active" name="active">
											<option value="1" <?php if ($slider['active'] === '1') echo "selected"; ?>>Active</option>
											<option value="0" <?php if ($slider['active'] === '0') echo "selected"; ?>>Disabled</option>
										</select>
									</div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                  <button type="button" class="btn btn-default float-right">Cancel</button>
                </div>
              </form>
            </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php include_once 'templates/footer.php'; ?>