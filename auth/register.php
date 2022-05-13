<?php
  $title = "Registration | Meeple Shop";
  require_once('../database/dbconnection.php');
  require_once('../inc/functions.inc.php');

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = array();

    if (isset($_POST['name'])) {
      $name = filteredInput($_POST['name']);
    } else {
      $errors[] = 'name';
    }

    if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $email = filteredInput($_POST['email']);
    } else {
      $errors[] = 'email';
    }

    if (isset($_POST['password'])){
      if ($_POST['password'] === $_POST['password_2']) {
        $password = filteredInput($_POST['password']);
      } else {
        $errors[] = 'passwords do not match';
      }
    } else {
      $errors[] = 'password';
    }

    if (empty($errors)) {
      // neu khong co loi kiem tra xem da ton tai user voi email chua
      $query = "SELECT id FROM users WHERE email = :email LIMIT 1";
      $sth = $dbh->prepare($query);
      $sth->bindParam(':email', $email);
      $sth->execute();
      $user = $sth->fetch(PDO::FETCH_ASSOC);

      if ($user) {
        // user voi email vua nhap da ton tai trong csdl
        $msg = "<script type='text/javascript'>toastr.warning('Email already existed!');</script>";
      } else {
        // khong tim thay user trong csdl thi cho dang ky tai khoan
        $password = password_hash($password, PASSWORD_BCRYPT);
        $activation = md5(uniqid(rand(), true));
        $now = new DateTime();
        $now = $now->format('Y-m-d H:i:s');
        $data = array(
          ':name' => $name,
          ':email' => $email, 
          ':password' => $password, 
          ':activation' => $activation, 
          ':now' => $now
        );
        $query = "INSERT INTO users (name, email, password, active, registration_date)";
        $query .= " VALUES (:name, :email, :password, :activation, :now)";
        $sth = $dbh->prepare($query);

        if ($sth->execute($data)) {
          // dang ky thanh cong thi gui mail cho kich hoat tai khoan
          $body = "Thank you for registering on Meeple Shop.\n";
          $body .= "Click <a href='auth/activation.php?text=" . urlencode($email) . "&key={$activation}' target='_blank'>here</a> to activate then log in to your account.";
          if (mail($email, 'Meeple Shop Registration', $body)) {
            $msg = "<script type='text/javascript'>toastr.success('An email has been sent to your email address.\nPlease activate your account before logging in');</script>";
            redirect('auth/login.php');
          } else {
            $msg = "<script type='text/javascript'>toastr.error('Can not send email due to server error');</script>";
          }
        }
      }
    } else {
      // neu co loi thi hien thi len browser
      $msg = "<script type='text/javascript'>Please check your credentials</script>";
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

      <form id="register-form" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
        <div class="input-group mb-3">
          <input type="text" class="form-control" id="nameRegis" name="name" value="<?php if (isset($_POST['name'])) echo htmlspecialchars($_POST['name']); ?>" placeholder="Name" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          <?php if (!empty($errors) && in_array('name', $errors)) echo "<p class='noti noti-warning'>Fill in your name</p>"; ?>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" id="emailRegis" name="email" value="<?php if (isset($_POST['email'])) echo htmlspecialchars($_POST['email']); ?>" placeholder="Email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          <?php if (!empty($errors) && in_array('email', $errors)) echo "<p class='noti noti-warning'>Fill in your email</p>"; ?>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="passRegis" name="password" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <?php if (!empty($errors) && in_array('password', $errors)) echo "<p class='noti noti-warning'>Fill in your password</p>"; ?>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="passRegis2" name="password_2" placeholder="Retype password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <?php if (!empty($errors) && in_array('passwords do not match', $errors)) echo "<p class='noti noti-warning'>Passwords do not match</p>"; ?>
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

<?php 
  include('templates/script.php'); 
  
  if (isset($msg)) echo $msg;
?>

</body>
</html>