<?php
require_once("../database/dbconnection.php");
require_once("../inc/functions.inc.php");

// them nguoi dung
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$errors = array();

	if (isset($_POST['name']) ) {
		$name = filteredInput($_POST['name']);
	} else {
		$errors[] = 'name';
	}

	if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL, array(['min_range' => 1]))) {
		$email = filteredInput($_POST['email']);
	} else {
		$errors[] = 'email';
	}

	if (isset($_POST['password'])) {
		if ($_POST['password'] === $_POST['password_cf']) {
			$password = filteredInput($_POST['password']);
		} else {
			$password = '';
			$msg = "<script type='text/javascript'>toastr.error('Passwords do not matches');</script>";
		}
	} else {
		$errors[] = 'password';
	}

	if (isset($_POST['active'])) {
		$active = $_POST['active'];
	}

	if (empty($errors)) {
		// if there are no errors, first check if there is existing user with the same email
		// $query = "SELECT id FROM users WHERE email = ? LIMIT 1";
		// $sth = $dbh->prepare($query);
		// $sth->bindParam(1, $email);
		// $sth->execute();
		// $user = $sth->fetch(PDO::FETCH_ASSOC);

		// if ($user) {
		// 	$msg = "<script type='text/javascript'>Email already exists</script>";
		// } else {
		// 	$password = password_hash($password, PASSWORD_BCRYPT);
		// 	$data = array(
		// 		':name' => $name,
		// 		':email' => $email,
		// 		':password' => $password,
		// 		':type' => 1,
		// 		':avatar' => 'test/test',
		// 		':active' => $active,
		// 		':now' => (new DateTime())->format('Y-m-d H:i:s')
		// 	);
		// 	$query = "INSERT INTO users (name, email, password, type, avatar, active, registration_date)";
		// 	$query .= " VALUES (:name, :email, :password, :type, :avatar, :active, :now)";
		// 	$sth = $dbh->prepare($query);

		// 	if ($sth->execute($data)) {
		// 		redirect('backend/user_index.php');
		// 	} else {
		// 		$msg = "<p class='noti noti-warning'>Failed to update due to server error</p>";
		// 	}
		// }
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
						<h1 class="ml-2">Create User</h1>
						<p class="noti noti-warning"><?= isset($msg) ? $msg : ""; ?></p>
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
										<input type="text" class="form-control" id="name" name="name" placeholder="Enter username" value="<?= $_POST['name'] ?? '' ?>">
									</div>
									<div class="form-group">
										<label for="email">Email</label>
										<input type="email" class="form-control" id="email" name="email" placeholder="Enter user email" value="<?= $_POST['email'] ?? '' ?>">
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
												<input type="file" name="avatar" class="custom-file-input" value="<?= $_POST['avatar'] ?? '' ?>" id="avatar">
												<input type="hidden" name="MAX_FILE_SIZE" value="524288">
												<label class="custom-file-label" for="avatar">Choose File</label>
											</div>
											<div class="input-group-append">
												<span class="input-group-text">Upload</span>
											</div>
										</div>
										<div id="thumb" class="mt-3">
											<img src="/public/img/no_avatar.png" width="200px" alt="No Avatar">
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
								<!-- /.card-body -->
								<div class="card-footer">
									<button type="submit" class="btn btn-info">Create</button>
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

<?php
	if (isset($msg)) echo $msg;

	include_once('templates/footer.php'); 
?>