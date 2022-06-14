<?php 
  // requires __DIR__ otherwise cause error when calling ajax to other php files
  require_once __DIR__ . '/../database/dbconnection.php';

  // import PHPMailer classes
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  // load Composer's Autoloader
  require __DIR__ . '/../vendor/autoload.php';

  define('BASE_URL', 'http://meeple_shop.test/');

  if (!function_exists('isAdmin')) {
    function isAdmin() {
      // check if authenticated user is admin
      return (isset($_SESSION['user_type']) && $_SESSION['user_type'] === '0');
    }
  }

  if (!function_exists('adminAccess')) {
    function adminAccess() {
      // redirect to home page if not admin
      if (!isAdmin()) redirect();
    }
  }

  if (!function_exists('redirect')) {
    function redirect($page = "index.php"){
      // redirect to wanted urls
      $url = BASE_URL . $page;
      header("Location: " . $url);
      exit;
    }
  }

  if (!function_exists('filteredInput')) {
    function filteredInput($userInput) {
      // filter user inputs
      $userInput = trim($userInput);
      $userInput = stripslashes($userInput);
      $userInput = strip_tags($userInput);
      $userInput = htmlspecialchars($userInput);

      return $userInput;
    }
  }

  if (!function_exists('isRoute')) {
    // highlight admin side navigation items when certain routes is currently active
    // strtok() ignores the query string, then in_array check if the REQUEST_URI is in array of routes
    // https://stackoverflow.com/questions/1283327/how-to-get-url-of-current-page-in-php#1283330
    function isRoute($arrRoutes, $className) {
      if (in_array(strtok(basename($_SERVER['REQUEST_URI']), '?'), $arrRoutes)) echo $className;

      echo "";
    }
  }

  if (!function_exists('pagination')) {
    function pagination($table) {
      // page pagination for admin
      global $dbh;
      global $start;
      global $display;  // $display = 5 written in each php file that needs pagination

      if (isset($_GET['p']) && filter_var($_GET['p'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
        $page = $_GET['p'];
      } else {
        $query = "SELECT * FROM {$table};";
        $sth = $dbh->prepare($query);
        $sth->execute();
        $records = $sth->rowCount();

        if ($records > $display) {
          // if database records > number of records we want to display => calculate pages needed
          $page = ceil($records / $display);
        } else {
          // otherwise only one page needed
          $page = 1;
        }
      }

      $output = "";
      if ($page > 1) {
        // display pages pagination if we need more than one page to display records
        $output .= "<div class='card-footer'><ul class='pagination justify-content-center m-0'>";
        $currentPage = ($start / $display) + 1;
      
        if ($currentPage !== 1) {
          // display previous page link if not on the first page
          $previousPage = $start - $display;
          $output .= "<li class='page-item'><a class='page-link' href='" . ltrim($_SERVER['PHP_SELF'], '/backend/') . "?s={$previousPage}&p={$page}'>Previous</a></li>";
        }

        for ($i = 1; $i <= $page; $i++) {
          // display remaining page links
          if ($i !== $currentPage) {
            $listPages = $display * ($i - 1);
            $output .= "<li class='page-item'><a class='page-link' href='" . ltrim($_SERVER['PHP_SELF'], '/backend/') . "?s={$listPages}&p={$page}'>{$i}</a></li>";
          } else {
            $output .= "<li class='page-item active'><a class='page-link'>{$i}</a></li>";
          }
        }

        if ($currentPage !== $page) {
          // display next page link if not on the last page
          $nextPage = $start + $display;
          $output .= "<li class='page-item'><a class='page-link' href='" . ltrim($_SERVER['PHP_SELF'], '/backend/') . "?s={$nextPage}&p={$page}'>Next</a></li>";
        }
        $output .= "</ul></div>";
      }
    
      return $output;
    }
  }

  if (!function_exists('slugify')) {
    // https://stackoverflow.com/questions/2955251/php-function-to-make-slug-url-string
    function slugify($text, string $divider = '-') {
      // create url slugs
      return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', $divider, $text)));
    }
  }

  if (!function_exists('mailAfterRegisting')) {
    function mailAfterRegisting($recipientAddr, $subject, $body) {
      // send email to user address after successfully registered to activate user account
      // https://github.com/PHPMailer/PHPMailer
      $mail = new PHPMailer(true);    // set 'true' to enable exceptions

      try {
        // Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                         // Enable verbose debug output (SMTP::DEBUG_SERVER)
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = MAILER_HOST;                            // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = MAILER_ADDRESS;                         // SMTP username
        $mail->Password   = MAILER_PASSWORD;                        // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Enable implicit TLS encryption
        $mail->Port       = 465;                                    // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
        // Recipients
        $mail->setFrom(MAILER_ADDRESS, 'MeepleShop');
        $mail->addAddress($recipientAddr);

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        if ($mail->send()) {
          return true;
        }
      } catch (Exception $err) {
        echo "Mailer Error: {$mail->ErrorInfo}";
        echo $err->getMessage();
        return false;
      }

      return false;
    }
  }

  if (!function_exists('productPrice')) {
    function productPrice($product) {
      return ($product['price_sale'] !== '0') ? '$' . $product['price_sale'] : '$' . $product['price'];
    }
  }

?>