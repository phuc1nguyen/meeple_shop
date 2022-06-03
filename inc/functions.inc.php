<?php 
  // requires __DIR__ otherwise cause error when calling ajax to other php files
  require_once(__DIR__ . '/../database/dbconnection.php');

  // Import PHPMailer classes
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  // Load Composer's Autoloader
  require('../vendor/autoload.php');

  define('BASE_URL', 'http://meeple_shop.test/');

  if (!function_exists('redirect')) {
    function redirect($page = "index.php"){
      // redirect to certain url
      $url = BASE_URL . $page;
      header("Location: " . $url);
      exit();
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
    // highlight admin side navigation items when certain route is currently active
    // strtok() ignores the query string, then in_array check if the REQUEST_URI is in array of routes
    // https://stackoverflow.com/questions/1283327/how-to-get-url-of-current-page-in-php#1283330
    function isRoute($arrRoutes, $className) {
      if (in_array(strtok($_SERVER['REQUEST_URI'], '?'), $arrRoutes)) {
        echo $className;
      }

      echo "";
    }
  }

  if (!function_exists('pagination')) {
    function pagination() {

    }
  }

  if (!function_exists('slugify')) {
    // https://stackoverflow.com/questions/2955251/php-function-to-make-slug-url-string
    function slugify($text, string $divider = '-') {
      // create url slug
      return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', $divider, $text)));
    }
  }

  if (!function_exists('mailAfterRegisting')) {
    function mailAfterRegisting($recipientAddr, $subject, $body) {
      // send email to user after successfully registered to activate user account
      // https://github.com/PHPMailer/PHPMailer
      $mail = new PHPMailer(true);    // set to 'true' to enable exceptions

      try {
        // Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = MAILER_HOST;                            //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = MAILER_ADDRESS;                         //SMTP username
        $mail->Password   = MAILER_PASSWORD;                        //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;
        
        // Recipients
        $mail->setFrom(MAILER_ADDRESS, 'MeepleShop');
        $mail->addAddress($recipientAddr);     //Add a recipient

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        if ($mail->send()) {
          return true;
        }
      } catch (Exception $err) {
        echo "Mailer Error: {$mail->ErrorInfo}";
        return false;
      }

      return false;
    }
  }
?>