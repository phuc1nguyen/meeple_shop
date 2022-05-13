<?php
require_once("../database/dbconnection.php");
require_once("../inc/functions.inc.php");

// query thong tin nguoi dung
if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
  $userId = $_GET['id']; 
} else {
  redirect('backend/user_index.php');
}

$query = "SELECT * FROM users WHERE id = :userId LIMIT 1";
$sth = $dbh->prepare($query);
$sth->bindParam(':userId', $userId);
if ($sth->execute()) {
  $user = $sth->fetch(PDO::FETCH_ASSOC);
}

// sua nguoi dung
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$errors = array();

	if (isset($_POST['name']) ) {
		$name = filteredInput($_POST['name']);
	} else {
		$errors[] = 'name';
	}

	if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL, array(['min_range' => 1]))) {
		$description = filteredInput($_POST['email']);
	} else {
		$errors[] = 'email';
	}

	if (isset($_POST['password'])) {
		if ($_POST['password'] === $_POST['passwordcf']) {
			$password = filteredInput($_POST['password']);
		} else {
			$msg = "<script type='text/javascript'>toastr.error('Passwords do not matches');</script>";
		}
	} else {
		$errors[] = 'password';
	}

	// if (isset($_POST['thumbnail'])) {
	//   $thumb = '';
	// } else {
	//   $errors[] = 'thumbnail';
	// }

	if (empty($errors)) {
		// neu ko co input trong thi query csdl

		if ($sth->execute($data)) {
			redirect('backend/user_index.php');
		} else {
			$msg = "<p class='noti noti-warning'>Failed to update due to server error</p>";
		}
	} else {
		// neu co input trong thi thong bao loi
		$msg = "<p class='noti noti-warning'>Please fill in all fields</p>";
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
						<p class="noti noti-warning"><?= $msg ?? ""; ?></p>
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
							<!-- /.card-header -->
							<!-- form start -->
							<form class="form-horizontal" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
								<div class="card-body">
									<div class="form-group">
										<label for="name">Name</label>
										<input type="text" class="form-control" id="name" name="name" placeholder="Enter username" value="<?php if (isset($user['name'])) echo $user['name']; ?>">
									</div>
									<div class="form-group">
										<label for="email">Email</label>
										<input type="email" class="form-control" id="email" name="email" placeholder="Enter user email" value="<?php if (isset($user['email'])) echo $user['email']; ?>">
									</div>
									<div class="form-group">
										<label for="password">Password</label>
										<input type="password" class="form-control" id="password" name="password" placeholder="Enter user password">
									</div>
									<div class="form-group">
										<label for="password_cf">Re-type password</label>
										<input type="password" class="form-control" id="password_cf" name="password_cf" placeholder="Confirm password">
									</div>
									<div class="form-group">
										<label for="avatar">Profile picture</label>
										<div class="input-group">
											<div class="custom-file">
												<input type="file" class="custom-file-input" value="" id="avatar">
												<label class="custom-file-label" for="avatar">Choose File</label>
											</div>
											<div class="input-group-append">
												<span class="input-group-text">Upload</span>
											</div>
											<div id="thumb">
                        <img src="<?php if (isset($user['avatar'])) echo $user['avatar']; ?>">
											</div>
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
								<!-- /.card-body -->
								<div class="card-footer">
									<button type="submit" class="btn btn-info">Update</button>
									<button type="button" class="btn btn-default float-right">Cancel</button>
								</div>
								<!-- /.card-footer -->
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

<?php include_once('templates/footer.php'); ?>