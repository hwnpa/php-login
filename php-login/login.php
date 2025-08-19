<?php 

  session_start();

  if (isset($_SESSION['user id'])) {
    header('Location: /php-login');
  }

 require 'database.php';

 if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email=:email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results =  $records->fetch(PDO: :FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
      header('Location: /php-login'); 
    } else {
      $message = 'Sorry, Those credentials do not match';   
    }
 }
 ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/stile.css">
</head>
<body>

    <?php require 'partials/header.php' ?>

    <h1>Login</h1>
    <span>or <a href="registro.php">registro</a> </span>

    <?php if (!empty($message)) : ?>
      <p><?= $message ?></p>
    <?php endif;?>
     
    <form action="login.php" method="post">
        <input type="text" name="email" placeholder="Enter your email">
        <input type="password" name="password" placeholder="Enter your password">
        <input type="submit" value="Send">
    </form>

</body>
</html>