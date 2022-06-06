<?php 
  ini_set('session.use_only_cookies', true);
  session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
  <link rel="stylesheet" href="public/css/style.css">
  <link rel="stylesheet" href="public/css/responsive.css">
  <title>
    <?php if (isset($title)) echo $title; else echo "Meeple Shop"; ?>
  </title>
</head>
<body>
  <div class="section__header">
    <!-- Header -->
    <header id="main-header">
      <div class="header-inner wide">
        <div class="header__menu-mobile">
          <a href="#">
            <span class="toggle-icon-bar toggle-icon-top"></span>
            <span class="toggle-icon-bar toggle-icon-mid"></span>
            <span class="toggle-icon-bar toggle-icon-bot"></span>
          </a>
        </div>
        <div class="header__logo">
          <a href="/"><img src="public/img/meeple_logo.png" alt="Meeple Shop Logo"></a>
          <h2><a href="index.php">Meeple Shop</a></h2>
        </div>
        <div class="header__search">
          <input type="text" value="" placeholder="Tìm kiếm...">
          <button class="btn btn-search"><i class="fas fa-search"></i></button>
        </div>
        <div class="header__info">
          <div class="header__user">
            <div class="header__user-1">
              <?php 
                if (isset($_SESSION['user_name']) && isset($_SESSION['user_type'])){
                  if ($_SESSION['user_type'] == 0) {
                    echo "<p><a href='backend/index.php'>" . ucwords($_SESSION['user_name']) . "</a> | <a href='auth/logout.php'>Log Out</a></p>";
                  } else {
                    echo "<p><a href='user_profile.php'>" . ucwords($_SESSION['user_name']) . "</a> | <a href='auth/logout.php'>Log Out</a></p>";
                  }
                } else {
                  echo "<p><a href='auth/login.php'>Login</a> / <a href='auth/register.php'>Signup</a></p>";
                }
              ?>
            </div> 
          </div>
          <div class="header__account-mobile">
            <a href="#">
              <i class="fas fa-user-circle"></i>
            </a>
          </div>
          <div class="header__cart">
            <a href="cart.php">
              <i class="fas fa-shopping-cart"></i>
            </a>
          </div>
        </div>
        <div class="header__search-mobile">
          <input type="text" value="" placeholder="Tìm kiếm...">
          <button class="btn btn-search"><i class="fas fa-search"></i></button>
        </div>
      </div>
    </header>
    <!-- End header -->

    <!-- Navigation bar -->
    <nav id="main-nav" class="home__navbar">
      <ul class="nav-list wide">
        <li class="nav-item"><a href="#">Board Games</a></li>
        <li class="nav-item"><a href="#">Deal of the Day</a></li>
        <li class="nav-item"><a href="#">Kid Games</a></li>
        <li class="nav-item"><a href="#">Family Games</a></li>
        <li class="nav-item"><a href="#">Accessories</a></li>
        <li class="nav-item"><a href="#">Gift Cards</a></li>
        <li class="nav-item"><a href="#">FAQs</a></li>
      </ul> 
    </nav>
    <!-- End navigation bar -->
  </div>