<?php 
  $title = "Log In | Meeple Shop";
  include('templates/header.php');
  include('../config/mysqli_connect.php');
  include('../inc/functions.php');

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
            $e = mysqli_real_escape_string($dbc, $_POST['email']);
          } else {
            $errors[] = 'email';
          }

          if (isset($_POST['password'])){
            $p = mysqli_real_escape_string($dbc, $_POST['password']);
          } else {
            $errors[] = 'password';
          }
          
          if (empty($errors)) {
            // neu khong xay ra loi thi query csdl
            $query = "SELECT id, name, type FROM users WHERE (email = '${e}' AND password = sha1('$p')) AND active = 1 LIMIT 1";
            $result = mysqli_query($dbc, $query) or die("Query ${query} failed: " . mysqli_error($dbc));

            if (mysqli_num_rows($result) == 1){
              list($id, $name, $type) = mysqli_fetch_array($result, MYSQLI_NUM);
              $_SESSION['user_id'] = $id;
              $_SESSION['user_name'] = $name;
              $_SESSION['user_type'] = $type;
              if ($type == 0) {
                // chuyen huong trang admin neu dang nhap bang tai khoan admin
                redirect('admin');
              } else {
                // chuyen huong sang trang chu
                redirect();
              }
            } else {
              // sai thong tin dang nhap
              $msg = "<p class='noti noti-warning'>Check your credentials again or activate your account.</p>";
            }
          } else {
            $msg = "<p class='noti noti-warning'>Please fill in all required fields</p>";
          }
        }
      ?>
      <p class="login-box-msg">Sign in to start your session</p>
      <?php if(!empty($msg)) echo $msg; ?>

      <form id="login-form" action="" method="POST">
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" value="<?php if (isset($_POST['email'])) echo htmlentities($_POST['email']); ?>" placeholder="Email">
          <?php if (isset($errors) && in_array('email', $errors)) echo "<p class='noti noti-warning'>Please fill in your email</p>"; ?>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" value="<?php if (isset($_POST['password'])) echo htmlentities($_POST['password']); ?>" placeholder="Password">
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
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mt-2 mb-3">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <!-- <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a> -->
      </div>
      <!-- /.social-auth-links -->

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
