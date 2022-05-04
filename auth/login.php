<?php 
  $title = "Log In | Meeple Shop";
  include('templates/header.php');
  require('../database/dbconnection.php');
  include_once('../inc/functions.inc.php');

  // neu dang dang nhap thi ko cho vao trang dang nhap
  if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 0) {
    redirect('admin');
  } elseif (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 1) {
    redirect();
  }
 ?>

<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../index.php" class="h1"><b>Meeple Shop</b></a>
    </div>
    <div class="card-body">
      <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
          $errors = array();

          if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $email = filteredInput($_POST['email']);
          } else {
            $errors[] = 'email';
          }

          if (isset($_POST['password'])){
            $password = filteredInput($_POST['password']);
          } else {
            $errors[] = 'password';
          }
          
          if (empty($errors)) {
            // $data = array($email, $password);
            // neu khong xay ra loi thi query csdl
            $query = 'SELECT id, name, type FROM users WHERE (email = :email AND password = sha1(:pass)) AND active = 1 LIMIT 1';
            // $sth stands for statement handle
            $sth = $dbh->prepare($query);
            $sth->bindParam(':email', $email);
            $sth->bindParam(':pass', $password);
            $sth->execute(); 
            $user = $sth->fetch(PDO::FETCH_ASSOC);

            if ($user) {
              $_SESSION['user_id'] = $user['id'];
              $_SESSION['user_name'] = $user['name'];
              $_SESSION['user_type'] = $user['type'];
              if ($user['type'] == 0) {
                // chuyen huong trang admin neu dang nhap bang tai khoan admin
                redirect('admin');
              } else {
                // chuyen huong sang trang chu
                redirect();
              }
            } else {
              $msg = '<p class="noti noti-warning">Please check your credentials again</p>';
            }
          } else {
            $msg = '<p class="noti noti-warning">Please fill in all required fields</p>';
          }
        }
      ?>
      <p class="login-box-msg">Sign in to start your session</p>
      <?php if(!empty($msg)) echo $msg; ?>

      <form id="login-form" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" value="<?php if (isset($_POST['email'])) echo htmlspecialchars($_POST['email']); ?>" placeholder="Email">
          <?php if (isset($errors) && in_array('email', $errors)) echo "<p class='noti noti-warning'>Please fill in your email</p>"; ?>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" value="<?php if (isset($_POST['password'])) echo htmlspecialchars($_POST['password']); ?>" placeholder="Password">
          <?php if (isset($errors) && in_array('email', $errors)) echo "<p class='noti noti-warning'>Please fill in your password</p>"; ?>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div> -->
          <!-- /.col -->
          <div class="col-12 mb-2">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-1">
        <a href="forgot.php">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.php" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<?php include('templates/script.php'); ?>
<script>
  // toastr noti
  
</script>
</body>
</html>
