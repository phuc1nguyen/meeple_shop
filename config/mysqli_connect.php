<?php 
  $dbc = mysqli_connect('localhost', 'root', 'abc123', 'meeple_db');
  if ($dbc) {
    mysqli_set_charset($dbc, 'utfmb8');
  } else {
    trigger_error('Database connection failed: ' . mysqli_connect_error());
  }
?>