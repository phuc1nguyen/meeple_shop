<?php
  $title = "Profile | Meeple Shop";
  include 'templates/header.php';
  require_once 'database/dbconnection.php';
  require_once 'inc/functions.inc.php';

  if (!isset($_SESSION['user_id'])) {
    redirect('/auth/login.php');
  } else {
    $userId = $_SESSION['user_id'];
    $query = "SELECT * FROM users WHERE id = :id LIMIT 1;";
    $sth = $dbh->prepare($query);
    $sth->bindParam(':id', $userId);
    
    if ($sth->execute()) {
      $user = $sth->fetch(PDO::FETCH_ASSOC);
    } else {
      redirect('/auth/login.php');
    }
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // profile picture and password fields are not required
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

    if (!empty($_POST['thumbPath'])) {
      $thumb = filteredInput($_POST['thumbPath']); 
      $thumb = explode('/', $thumb);
      array_shift($thumb);
      $thumb = implode('/', $thumb);
    } else {
      if (isset($user['avatar'])) {
        $thumb = $user['avatar'];
      } else {
        $thumb = null;
      }
    }

    if (!empty($_POST['password'])) {
      // if user enters password field
      if (!preg_match('/^[\w]{6,20}$/', filteredInput($_POST['password']))) {
        // password is invalid
        $errors[] = 'password';
      } else {
        // password is valid
        if ($_POST['password_cf'] !== $_POST['password']) {
          $errors[] = 'passwords not match';
        } else {
          $password = filteredInput($_POST['password']);
          $password = password_hash($password, PASSWORD_BCRYPT);
        }
      }
    } else {
      // if user leaves password field blank
      $password = $user['password'];
    }

    if (empty($errors)) {
      $data = [
        ':name' => $name,
        ':email' => $email,
        ':password' => $password,
        ':thumb' => $thumb,
        ':updated' => (new DateTime())->format('Y-m-d H:i:s'),
        ':id' => $userId,
      ];
      $query = "UPDATE users SET name = :name, email = :email, password = :password, type = 1, avatar = :thumb, updated_date = :updated WHERE id = :id LIMIT 1;";
      $sth = $dbh->prepare($query);
      
      if ($sth->execute($data)) {
        // $msg = "<script type='text/javascript'>alert('Your profile has been successfully updated')</script>";
        redirect('/user_profile.php');
      } else {
        $msg = "<script type='text/javascript'>alert('Something went wrong')</script>";
      }
    } else {
      $msg = "<script type='text/javascript'>alert('Please fill in all required inputs')</script>";
    }
  }
?>

<div class="section__main">
  <div class="home__content" style="flex-wrap: wrap;">
    <fieldset>
      <legend><h3>Personal Information</h3></legend>
      <form id="userForm" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
        <div class="edit__profile-picture">
          <div class="thumbPreview">
            <img src="<?php if (!is_null($user['avatar'])) echo 'backend/' . $user['avatar']; else echo 'public/img/no_avatar.jpg'; ?>" alt="No Avatar" style="margin-right: 1rem; margin-bottom: 1rem;">
          </div>
          <div class="thumb-items">
            <label for="avatar">Profile picture</label>
            <input type="file" id="thumb" name="thumb" value="" onchange="updateThumb()">
            <input type="hidden" id="thumbPath" name ="thumbPath" value="">
          </div>
        </div>
        <div class="edit__profile-inputs">
          <div class="input-items">
            <label for="name">Your name<sup>*</sup></label>
            <input type="text" id="name" name="name" placeholder="Name" value="<?= (isset($_POST['name'])) ? htmlspecialchars($_POST['name']) : $user['name']; ?>"> 
            <?php if (isset($errors) && in_array('name', $errors)) echo "<p class='red-alert'>Username is required</p>"; ?>
          </div>
          <div class="input-items">
            <label for="email">Your email<sup>*</sup></label>
            <input type="email" id="email" name="email" placeholder="Email" value="<?= (isset($_POST['email'])) ? htmlspecialchars($_POST['email']) : $user['email']; ?>">
            <?php if (isset($errors) && in_array('email', $errors)) echo "<p class='red-alert'>Email is required and must be unique</p>"; ?>
          </div>
          <div class="input-items">
            <label for="password">Your new password</label>
            <input type="password" id="password" name="password" placeholder="Leave blank to keep old password"> 
            <?php if (isset($errors) && in_array('password', $errors)) echo "<p class='red-alert'>New password must have 6 to 20 characters</p>"; ?>
          </div>
          <div class="input-items">
            <label for="password_cf">New password confirm</label>
            <input type="password" id="password_cf" name="password_cf" placeholder="New Password Confirm"> 
            <?php if (isset($errors) && in_array('passwords not match', $errors)) echo "<p class='red-alert'>Passwords do not match</p>"; ?>
          </div>
          <div class="input-items">
            <button type="submit">UPDATE</button>
          </div>
        </div>
      </form>
    </fieldset>
  </div>
</div>

<?php
  include 'templates/footer.php';

  if (isset($msg)) echo $msg;

  include_once 'templates/script.php';
?>