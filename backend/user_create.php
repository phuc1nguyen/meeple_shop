<?php
	require_once '../inc/functions.inc.php';

	// create user
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		// user profile picture (avatar) is not required
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

		if (!empty($_POST['password']) && preg_match('/^[\w]{6,20}$/', filteredInput($_POST['password']))) {
			if (isset($_POST['password_cf']) && ($_POST['password'] === $_POST['password_cf'])) {
				$password = filteredInput($_POST['password']);
			} else {
				$errors[] = 'passwords not match';
			}
		} else {
			$errors[] = 'password';
		}

		if (!empty($_POST['thumbPath'])) {
			$path = filteredInput($_POST['thumbPath']);
		} else {
			$path = null;
		}

		if (isset($_POST['active'])) {
			$active = $_POST['active'];
		} else {
			$active = 1;
		}

		if (empty($errors)) {
			// if there are no errors, first check if there is existing user with the same email
			$query = "SELECT id FROM users WHERE email = ? LIMIT 1";
			$sth = $dbh->prepare($query);
			$sth->bindParam(1, $email);
			$sth->execute();
			$user = $sth->fetch(PDO::FETCH_ASSOC);

			if ($user) {
				$msg = "<script type='text/javascript'>Email already exists</script>";
			} else {
				$password = password_hash($password, PASSWORD_BCRYPT);
				$data = array(
					':name' => $name,
					':email' => $email,
					':password' => $password,
					':type' => 1,
					':avatar' => $path,
					':active' => $active,
					':now' => (new DateTime())->format('Y-m-d H:i:s'),
					':updated' => (new DateTime())->format('Y-m-d H:i:s'),
				);
				$query = "INSERT INTO users (name, email, password, type, avatar, active, registration_date, updated_date)";
				$query .= " VALUES (:name, :email, :password, :type, :avatar, :active, :now, :updated);";
				$sth = $dbh->prepare($query);

				if ($sth->execute($data)) {
					redirect('backend/user_index.php');
				} else {
					$msg = "<script type='text/javascript'> toastr.error('Failed to update due to server error'); </script>";
				}
			}
		} else {
			// missing inputs alert
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
						<h1 class="ml-2">Create User</h1>
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
								<h3 class="card-title">User Information</h3>
							</div>
							<form class="form-horizontal" id="myForm" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
								<div class="card-body">
									<div class="form-group">
										<label for="name">Name<sup>*</sup></label>
										<input type="text" class="form-control" id="name" name="name" placeholder="Enter username" value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                    <?php if (isset($errors) && in_array('name', $errors)) echo "<p class='red-alert'>Please fill in username</p>"; ?>
									</div>
									<div class="form-group">
										<label for="email">Email<sup>*</sup></label>
										<input type="email" class="form-control" id="email" name="email" placeholder="Enter user email" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                    <?php if (isset($errors) && in_array('email', $errors)) echo "<p class='red-alert'>Please fill in user email</p>"; ?>
									</div>
									<div class="form-group">
										<label for="password">Password<sup>*</sup></label>
										<input type="password" class="form-control" id="password" name="password" placeholder="Enter user password">
										<?php if (isset($errors) && in_array('password', $errors)) echo "<p class='red-alert'>Please fill in user password (6 to 20 characters)</p>"; ?>
									</div>
									<div class="form-group">
										<label for="password_cf">Re-type password<sup>*</sup></label>
										<input type="password" class="form-control" id="password_cf" name="password_cf" placeholder="Confirm password">
										<?php if (isset($errors) && in_array('passwords not match', $errors)) echo "<p class='red-alert'>Passwords must match</p>"; ?>
									</div>
                  <div class="form-group">
                    <label for="">Profile Picture</label>
                    <div class="input-group" style="display: flex;">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" onchange="uploadThumb()" id="thumb" name="thumb">
                        <input type="hidden" class="" id="thumbPath" name="thumbPath" value="<?= htmlspecialchars($_POST['thumbPath']) ?? ''; ?>">
                        <label class="custom-file-label" for="thumb">Choose File</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                    <div id="thumbPreview" class="mt-3">
                      <img src="<?= (!empty($_POST['thumbPath'])) ? htmlspecialchars($_POST['thumbPath']) : "public/img/no_avatar.jpg" ?>" alt="No Thumbnail" width="100px" height="100px">
                    </div>
                  </div>
									<div class="form-group">
										<label for="active">Status</label>
										<select class="form-control" id="active" name="active">
											<option value="1" <?php if (isset($_POST['active']) && $_POST['active'] === '1') echo "selected"; ?>>Active</option>
											<option value="0" <?php if (isset($_POST['active']) && $_POST['active'] === '0') echo "selected"; ?>>Disabled</option>
										</select>
									</div>
								</div>
								<div class="card-footer">
									<button type="submit" class="btn btn-primary">Create</button>
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