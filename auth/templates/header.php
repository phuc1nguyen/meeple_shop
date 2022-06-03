<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php if(isset($title)) echo $title; else echo "Meeple Shop"; ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../backend/public/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../backend/public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../backend/public/dist/css/adminlte.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
  <style>
    .noti {
      padding: 1rem;
      margin-top: 1rem;
      width: 100%;
      color: #ffffff;
      border-radius: .25rem;
      text-align: center;
    }

    .noti-warning {
      background-color: #f7a736;
    }

    .noti-success {
      background-color: #72b372;
    }

    .noti-danger {
      background-color: #c85c57;
    }

    .noti-info {
      background-color: #57a9c1;
    }

    .red-alert {
      color: red;
      margin-left: .5rem;
      margin-bottom: 0.5rem;
    }
  </style>
</head>