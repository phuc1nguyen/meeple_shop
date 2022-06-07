<?php 
  $title = "Log In | Meeple Shop";
  include_once('templates/header.php');
  include_once('../inc/functions.inc.php');

  // redirect if already authenticated
  if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 0) {
    redirect('admin');
    exit();
  } elseif (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 1) {
    redirect();
    exit();
  }
 ?>

<?php
  $errors = array();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $email = filteredInput($_POST['email']);
    } else {
      $errors[] = 'email';
    }

    if (isset($_POST['password']) && preg_match('/^[\w]{6,20}$/', filteredInput($_POST['password']))) {
      $password = filteredInput($_POST['password']);
    } else {
      $errors[] = 'password';
    }

    if (empty($errors)) {
      // query the database if there are no errors
      // $data = array($email, $password);
      $query = "SELECT id, name, type, password FROM users WHERE (email = :email AND active = 1) LIMIT 1;";
      // $sth stands for statement handle
			$sth = $dbh->prepare($query);
      $sth->bindParam(':email', $email);
      $sth->execute();
      $user = $sth->fetch(PDO::FETCH_ASSOC);

      if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_type'] = $user['type'];
        if ($user['type'] == 0) {
          // redirect to admin dashboard if it's admin
          redirect('backend');
          exit();
        } else {
          // otherwise redirect to home page
          redirect();
          exit();
        }
      } else {
        $msg = "<script type='text/javascript'>toastr.error('Please check your credentials again or contact admin');</script>";
      }
    }
  }
?>

<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../index.php" class="h1"><b>Meeple Shop</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <form id="login-form" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
        <div class="input-group mb-3">
          <input type="email" class="form-control" id="emailLogin" name="email" value="<?php if (isset($_POST['email'])) echo htmlspecialchars($_POST['email']); ?>" placeholder="Email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="passwordLogin" name="password" value="<?php if (isset($_POST['password'])) echo htmlspecialchars($_POST['password']); ?>" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 mb-2">
            <button type="submit" id="btn-signin" class="btn btn-primary btn-block">Sign In</button>
          </div>
        </div>
      </form>

      <p class="mb-1">
        <a href="forgot.php">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.php" class="text-center">Register a new membership</a>
      </p>
    </div>
  </div>
</div>

<?php 
  include_once('templates/script.php'); 
  if (isset($msg)) echo $msg;
?>
</body>
</html>
