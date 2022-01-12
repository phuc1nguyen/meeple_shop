<?php
  $title = "Registration | Meeple Shop";
  include('templates/header.php');
  include('../config/mysqli_connect.php');
  include('../inc/functions.php');
?>

<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../index.php" class="h1" target="_blank"><b>Meeple Shop</b></a>
    </div>
    <div class="card-body">
      <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $errors = array();

          if (isset($_POST['name']) && preg_match('/^ [\w-]{4,20} $/', $_POST['name'])) {
            $name = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['name'])));
          } else {
            $errors[] = 'name';
          }

          if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $email = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['email'])));
          } else {
            $errors[] = 'email';
          }

          if (isset($_POST['password']) && preg_match('/^ [\w\'.-]{6,20} $/', $_POST['password'])){
            if ($_POST['password'] == $_POST['password_2']) {
              $password = mysqli_real_escape_string($dbc, trim($_POST['password']));
            } else {
              $errors[] = 'passwords do not match';
            }
          } else {
            $errors[] = 'password';
          }

          if (empty($errors)) {
            // kiem tra xem da ton tai user voi email chua
            $query = "INSERT INTO users(name, email, password) VALUES ('{$name}', '{$email}', '{$password}')";
            $result = mysqli_query($dbc, $query) or die("Query ${query} failed: " . mysqli_error($dbc));

          } else {

          }
        }
      ?>
      <p class="login-box-msg">Register a new membership</p>

      <form id="register-form" action="" method="POST">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="name" placeholder="Full name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password_2" placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="button" id="btn-register" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <!-- <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a> -->
      </div>

      <a href="login.php" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<?php include('templates/script.php'); ?>
<script>
  toastr.options = {
    "positionClass": "toast-bottom-left",
    "timeOut": 3000,
    "progressBar": true
  }

  $(document).ready(function(){
    $('#btn-register').click(function(){
      if ($('#agreeTerms').prop("checked", false)) {
        toastr.error('You must agree with our terms');
      } else {
        $('#register-form').submit();
      }
    });
  })
</script>
</body>
</html>