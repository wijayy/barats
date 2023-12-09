<?php
session_start();
if (isset($_SESSION["login"])) {
  header("Location: index.php");
  exit;
}

require "assets/function.php";
require "assets/function-algo.php";


if (isset($_POST["login"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  // cek username terlebiih dahulu
  $result = mysqli_query($conn, "SELECT * FROM `tb_user` WHERE username = '$username'");

  // cek username 
  if (mysqli_num_rows($result) === 1) {

    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row["password"])) {
      $_SESSION["login"] = true;
      header("Location: index.php");
      exit;
    }
  }
  $error = true;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <?php head("login") ?>
</head>

<body>


  <section id="product">
    <div class="outer">
      <h4 class="title">KLOTS Login</h4>
      <div class="line"></div>
    </div>
  </section>


  <section id='form'>
    <div class="outer">
      <?php if (isset($error)) : ?>
      <h3>Username/Password Salah</h3>
      <?php endif ?>
      <form action="" method="post">
        <div class="register">
          <div class="input-box">
            <div class="input-row">
              <label for="username">username</label>
              <input required type="text" name="username" id="username">
            </div>
            <div class="input-row">
              <label for="password">password</label>
              <input required type="password" name="password" id="password">
            </div>
          </div>
        </div>
        <div class="button">
          <button type="submit" name="login">login</button>
        </div>
      </form>
    </div>
  </section>
</body>

</html>