<?php
  $title = "Registration | Meeple Shop";
  require_once('../database/dbconnection.php');
  require_once('../inc/functions.inc.php');

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = array();

    if (isset($_POST['name'])) {
      $name = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['name'])));
    } else {
      $errors[] = 'name';
    }

    if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $email = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['email'])));
    } else {
      $errors[] = 'email';
    }

    if (isset($_POST['password'])){
      if ($_POST['password'] == $_POST['password_2']) {
        $password = mysqli_real_escape_string($dbc, trim($_POST['password']));
      } else {
        $errors[] = 'passwords do not match';
      }
    } else {
      $errors[] = 'password';
    }

    if (empty($errors)) {
      // neu khong co loi kiem tra xem da ton tai user voi email chua
      $query = "SELECT id FROM users WHERE email = '${email}' LIMIT 1";
      $result = mysqli_query($dbc, $query) or die('Query ${query} failed: ' . mysqli_error($dbc));

      if (mysqli_num_rows($result) != 0) {
        // user voi email vua nhap da ton tai trong csdl
        $msg = "<p class='noti noti-danger'>Email already exists</p>";
      } else {
        // khong tim thay user trong csdl thi cho dang ky tai khoan
        $activation = md5(uniqid(rand(), true));
        $query2 = "INSERT INTO users (name, email, password, active, registration_date) VALUES ('${name}', '${email}', sha1('$password'), '${activation}', NOW())";
        $result2 = mysqli_query($dbc, $query2) or die("Query ${query} failed: " . mysqli_error($dbc));

        if (mysqli_affected_rows($dbc) == 1) {
          // dang ky thanh cong thi gui mail cho kich hoat tai khoan
          $body = "Thank you for registering on Meeple Shop.\n";
          $body .= "Click <a href='auth/activation.php?text=" . urlencode($_POST['email']) . "&key=${activation}'>here</a> to activate your account.";
          if (mail($_POST['email'], 'Meeple Shop Registration', $body)) {
            $msg = "<p class='noti noti-info'>An email has been sent to your email address.\nPlease activate your account before logging in.</p>";
          } else {
            $msg = "<p class='noti noti-danger'>Can not send email due to server error</p>";
          }
        }
      }
    } else {
      // neu co loi thi hien thi len browser
      $msg = "<p class='noti noti-warning'>Please fill in all required fields</p>";
    }
  }
?>

<?php
  include_once('templates/header.php');
?>

<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../index.php" class="h1"><b>Meeple Shop</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Register a new membership</p>
      <?php if (isset($msg)) echo $msg; ?>
      <form id="register-form" action="" method="POST">
        <div class="input-group mb-3">
          <input type="text" class="form-control" id="nameRegis" name="name" value="<?php if (isset($_POST['name'])) echo htmlentities($_POST['name']); ?>" placeholder="Name">
          <?php if (!empty($errors) && in_array('name', $errors)) echo "<p class='noti noti-warning'>Fill in your name</p>"; ?>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" id="emailRegis" name="email" <?php if (isset($_POST['email'])) echo htmlentities($_POST['email']); ?> placeholder="Email">
          <?php if (!empty($errors) && in_array('email', $errors)) echo "<p class='noti noti-warning'>Fill in your email</p>"; ?>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="passRegis" name="password" placeholder="Password">
          <?php if (!empty($errors) && in_array('password', $errors)) echo "<p class='noti noti-warning'>Fill in your password</p>"; ?>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="passRegis2" name="password_2" placeholder="Retype password">
          <?php if (!empty($errors) && in_array('passwords do not match', $errors)) echo "<p class='noti noti-warning'>Passwords do not match</p>"; ?>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div> -->
          <!-- /.col -->
          <div class="col-12 mb-2">
            <button type="submit" id="btn-register" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <a href="login.php" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<?php include('templates/script.php'); ?>
</body>
</html>