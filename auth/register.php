<?php
  $title = "Registration | Meeple Shop";
  require_once '../inc/functions.inc.php';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = array();

    if (!empty($_POST['name'])) {
      $name = filteredInput($_POST['name']);
    } else {
      $errors[] = 'name';
    }

    if (!empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $email = filteredInput($_POST['email']);
    } else {
      $errors[] = 'email';
    }

    if (!empty($_POST['password']) && preg_match('/^[\w]{6,20}$/', filteredInput($_POST['password']))) {
      if ($_POST['password'] === $_POST['password_2']) {
        $password = filteredInput($_POST['password']);
      } else {
        $errors[] = 'passwords do not match';
      }
    } else {
      $errors[] = 'password';
    }

    if (empty($errors)) {
      // check if there is existing user with the registed email first
      $query = "SELECT id FROM users WHERE email = :email LIMIT 1;";
      $sth = $dbh->prepare($query);
      $sth->bindParam(':email', $email);
      $sth->execute();
      $user = $sth->fetch(PDO::FETCH_ASSOC);

      if ($user) {
        // email has already been registered
        $msg = "<script type='text/javascript'>toastr.error('Email already existed!');</script>";
      } else {
        // there's no existing user with matching email
        $password = password_hash($password, PASSWORD_BCRYPT);
        $activation = md5(uniqid(rand(), true));
        $now = (new DateTime())->format('Y-m-d H:i:s');
        $data = array(
          ':name' => $name,
          ':email' => $email, 
          ':password' => $password, 
          ':activation' => $activation,
          ':now' => $now,
          ':updated' => $now,
        );
        $query = "INSERT INTO users (name, email, password, active, registration_date, updated_date)";
        $query .= " VALUES (:name, :email, :password, :activation, :now, :updated);";
        $sth = $dbh->prepare($query);

        if ($sth->execute($data)) {
          // send email to users to activate their accounts (using PHPMailer, function in functions.inc.php)
          $body = "Hi <b>{$name}</b>,<br>";
          $body .= "<p>Thank you for being a part of MeepleShop.</p>";
          $body .= "<p>Click <a href='meeple_shop.test/auth/activation.php?text=" . urlencode($email) . "&key={$activation}' target='_blank'>here</a> to activate your account then sign in.</p>";
          
          if (mailAfterRegisting($email, 'MeepleShop Account Activation', $body)) {
            redirect();
          } else {
            $msg = "<script type='text/javascript'>toastr.error('Something went wrong')</script>";
          }
        }
      }
    }
  }
?>

<?php include_once 'templates/header.php'; ?>

<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../index.php" class="h1"><b>Meeple Shop</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Register a new membership<br>Then check <b>email</b> for further instructions</p>

      <form id="register-form" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
        <div class="input-group mb-3">
          <input type="text" class="form-control" id="nameRegis" name="name" value="<?php if (isset($_POST['name'])) echo htmlspecialchars($_POST['name']); ?>" placeholder="Name" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <?php if (!empty($errors) && in_array('name', $errors)) echo "<p class='red-alert'>Fill in your name</p>"; ?>
        <div class="input-group mb-3">
          <input type="email" class="form-control" id="emailRegis" name="email" value="<?php if (isset($_POST['email'])) echo htmlspecialchars($_POST['email']); ?>" placeholder="Email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <?php if (!empty($errors) && in_array('email', $errors)) echo "<p class='red-alert'>Please fill in your email</p>"; ?>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="passRegis" name="password" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <?php if (!empty($errors) && in_array('password', $errors)) echo "<p class='red-alert'>Please fill in your password (6 to 20 characters)</p>"; ?>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="passRegis2" name="password_2" placeholder="Retype password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <?php if (!empty($errors) && in_array('passwords do not match', $errors)) echo "<p class='red-alert'>Passwords do not match</p>"; ?>
        <div class="row">
          <div class="col-12 mb-2">
            <button type="submit" id="btn-register" class="btn btn-primary btn-block">Register</button>
          </div>
        </div>
      </form>

      <a href="login.php" class="text-center">I already have a membership</a>
    </div>
  </div>
</div>

<?php
  include_once 'templates/script.php';
  if (isset($msg)) echo $msg;
?>

</body>
</html>