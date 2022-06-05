<?php
  $title = "Forgot Password | Meeple Shop";
  require_once('../database/dbconnection.php');
  require_once('../inc/functions.inc.php');
  include_once('templates/header.php');

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = array();

    if (!empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $email = filteredInput($_POST['email']);
    } else {
      $errors[] = 'email';
    }

    if (empty($errors)) {
      // if email field is valid, check if user with matching email exists
      $query = "SELECT * FROM users WHERE email = :email LIMIT 1;";
      $sth = $dbh->prepare($query);
      $sth->bindParam(':email', $email);
      $sth->execute();
      $user = $sth->fetch(PDO::FETCH_ASSOC);
      if ($user) {
        // user with matching email exists, change current password to temporary password
        $tempPass = substr(md5(uniqid(rand(), true)), 3, 10);
        // non-hash for the user, hashed password for database
        $tempPassHash = password_hash($tempPass, PASSWORD_BCRYPT);
        $query = "UPDATE users SET password = :password WHERE id = :id LIMIT 1;";
        $sth = $dbh->prepare($query);
        $sth->bindParam(':password', $tempPassHash);
        $sth->bindParam(':id', $user['id']);

        if ($sth->execute()) {
          // send email with new password after successfully changed password
          $body = "Your password has been temporarily changed to ${tempPass}, make sure to change your password later.";
          mailAfterRegisting($user['email'], 'MeepleShop Password Retrieve', $body);
        } else {
          $msg = "<script type='text/javascript'>toastr.error('Something went wrong');</script>";
        }
      } else {
        // user does not exist in database
        $msg = "<script type='text/javascript'>toastr.error('Email does not exists');</script>";
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
      <p class="login-box-msg">You forgot your password?<br>Submit your email address then check it for new password.</p>

      <form id="forgotForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email" value="<?php if (isset($_POST['email'])) echo htmlspecialchars($_POST['email']); ?>" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <?php if (isset($errors) && in_array('email', $errors)) echo "<p class='red-alert'>Please fill in your email address</p>"; ?>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Request new password</button>
          </div>
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="login.php">Login</a>
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
