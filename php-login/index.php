<?php 
  session_start();

  require 'database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO: :FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
  ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>welcome to your App</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/stile.css">
</head>
<body>

   <?php require 'partials/header.php' ?>

    <?php if(!empty($user)): ?>
    <br>welcome. <?= $user['email'] ?>
    <br>You are Successfully Logged In 
    <a href="deslogin.php">deslogin</a>
   <?php else: ?>
    <h1>Please login or Registro</h1>

    <a href="login.php">Login</a> or
    <a href="registro.php">Registro</a>
    <?php endif; ?>
</body>
</html>