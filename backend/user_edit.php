<?php
	require_once("../inc/functions.inc.php");

	// get user by id from database
	if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
		$userId = $_GET['id']; 
	} else {
		redirect('backend/user_index.php');
		exit();
	}

	$query = "SELECT * FROM users WHERE id = :userId LIMIT 1";
	$sth = $dbh->prepare($query);
	$sth->bindParam(':userId', $userId);

	if ($sth->execute()) {
		$user = $sth->fetch(PDO::FETCH_ASSOC);
	} else {
		redirect('backend/user_index.php');
		exit();
	}

	// update this user
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		// user profile picture and password are not required for user update
		$errors = array();

		if (!empty($_POST['name'])) {
			$name = filteredInput($_POST['name']);
		} else {
			$errors[] = 'name';
		}

		if (!empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL, array(['min_range' => 1]))) {
			$email = filteredInput($_POST['email']);
		} else {
			$errors[] = 'email';
		}

		if (empty($_POST['password'])) {
			$password = $user['password'];
		} elseif (isset($_POST['password']) && !preg_match('/^[\w]{6,20}$/', filteredInput($_POST['password']))) {
			$errors[] = 'password';
		} else {
			if (isset($_POST['password_cf']) && ($_POST['password'] === $_POST['password_cf'])) {
				$password = filteredInput($_POST['password']);
			} else {
				$errors[] = 'passwords not match';
			}
		}

		if (!empty($_POST['thumbPath'])) {
			$path = filteredInput($_POST['thumbPath']);
		} else {
			$path = null;
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
			$password = password_hash($password, PASSWORD_BCRYPT);
			$data = array(
				":name" => $name,
				":email" => $email,
				":password" => $password,
				":thumb" => $path,
				":active" => $active,
				":updated" => (new DateTime())->format('Y-m-d H:i:s'),
				":id" => $userId,
			);
			$query = "UPDATE users";
			$query .= " SET name = :name, email = :email, password = :password, avatar = :thumb, active = :active, updated_date = :updated";
			$query .= " WHERE id = :id LIMIT 1;";
			$sth = $dbh->prepare($query);

			if ($sth->execute($data)) {
				redirect('backend/user_index.php');
				exit();
			} else {
				// failed to update
				$msg = "<script type='text/javascript'> toastr.error('Something went wrong'); </script>";
			}
		} else {
			// some missing inputs alert
			$msg = "<script type='text/javascript'> toastr.error('Please fill in all field'); </script>";
		}
	}
?>

<?php
  include_once("templates/header.php");
  include_once("templates/navbar.php");
  include_once("templates/sidebar.php");
?>

	<div class="content-wrapper">
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-12">
						<h1 class="ml-2">Edit User</h1>
					</div>
				</div>
			</div>
		</div>

		<section class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<div class="card card-info">
							<div class="card-header">
								<h3 class="card-title">User Information</h3>
							</div>
							<form class="form-horizontal" id="myForm" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) . '?id=' . $userId; ?>" method="POST" enctype="multipart/form-data">
								<div class="card-body">
									<div class="form-group">
										<label for="name">Name<sup>*</sup></label>
										<input type="text" class="form-control" id="name" name="name" placeholder="Enter username" value="<?= $user['name'] ?? '' ?>">
										<?php if (isset($errors) && in_array('name', $errors)) echo "<p class='red-alert'>Please fill in username</p>"; ?>
									</div>
									<div class="form-group">
										<label for="email">Email<sup>*</sup></label>
										<input type="email" class="form-control" id="email" name="email" placeholder="Enter user email" value="<?= $user['email'] ?? '' ?>">
										<?php if (isset($errors) && in_array('email', $errors)) echo "<p class='red-alert'>Please fill in user email</p>"; ?>
									</div>
									<div class="form-group">
										<label for="password">New Password</label>
										<input type="password" class="form-control" id="password" name="password" placeholder="Enter new password (6 to 20 characters) or leave blank">
										<?php if (isset($errors) && in_array('password', $errors)) echo "<p class='red-alert'>Password must have 6 to 20 characters</p>"; ?>
									</div>
									<div class="form-group">
										<label for="password_cf">Re-type new password</label>
										<input type="password" class="form-control" id="password_cf" name="password_cf" placeholder="Confirm new password">
										<?php if (isset($errors) && in_array('passwords not match', $errors)) echo "<p class='red-alert'>Passwords must match</p>"; ?>
									</div>
                  <div class="form-group">
                    <label for="">Thumbnail</label>
                    <div class="input-group" style="display: flex;">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" onchange="updateThumb()" id="thumb" name="thumb">
                        <input type="hidden" class="" id="thumbPath" name="thumbPath" value="<?= (!empty($_POST['thumbPath'])) ? htmlspecialchars($_POST['thumbPath']) : $user['avatar']; ?>">
                        <input type="hidden" class="" id="oldThumb" name="oldThumb">
                        <label class="custom-file-label" for="thumb">Choose File</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                    <div id="thumbPreview" class="mt-3">
                      <img src="<?= (!empty($_POST['thumbPath'])) ? htmlspecialchars($_POST['thumbPath']) : $user['avatar'] ?>" alt="No Thumbnail" width="100px" height="100px">
                    </div>
                  </div>
									<div class="form-group">
										<label for="active">Status</label>
										<select class="form-control" id="active" name="active">
											<option value="1" <?php if ($user['active'] === '1') echo "selected"; ?>>Active</option>
											<option value="0" <?php if ($user['active'] === '0') echo "selected"; ?>>Disabled</option>
										</select>
									</div>
								</div>
								<div class="card-footer">
									<button type="submit" class="btn btn-info">Update</button>
									<button type="button" class="btn btn-default float-right">Cancel</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

<?php include_once('templates/footer.php'); ?>