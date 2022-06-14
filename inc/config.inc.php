<?php
  // Database Config
  define('DATABASE_HOSTNAME', 'localhost');
  define('DATABASE_NAME', 'meeple_db');
  define('DATABASE_USERNAME', 'root');
  define('DATABASE_PASSWORD', 'yourRootPassword');
  define('PASSWORD_ENCRYPTION_TYPE', '');       // md5
  define('PASSWORD_ENCRYPTION', false);         // true | false

  // PHPMailer Config
  define('MAILER_HOST', 'smtp.gmail.com');
  define('MAILER_ADDRESS', 'yourGmailAddress');
  define('MAILER_PASSWORD', 'yourGmailAppPassword');
  
  // Toggle Custom Error
  define('APP_DEBUG', TRUE);          // TRUE: in development | FALSE: in production
?>