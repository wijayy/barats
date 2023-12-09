<?php
session_start();
if (isset($_SESSION["login"])) {
  header("Location: index.php");
  exit;
}

require "assets/function.php";
require "assets/function-algo.php";

if (isset($_POST["register"])) {
  if (registrasi($_POST) > 0) {
    $_SESSION["login"] = true;
    echo "
      <script>
        alert('user baru berhasil ditambahkan')
        document.location.href = 'index.php';
      </script>
      ";
  } else {
    mysqli_error($conn);
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php head("register") ?>
</head>

<body>

  <section id="product">
    <div class="outer">
      <h4 class="title">KLOTS Register Username</h4>
      <div class="line"></div>
    </div>
  </section>

  <section id='form'>
    <div class="outer">
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
            <div class="input-row">
              <label for="password2">confirm password</label>
              <input required type="password" name="password2" id="password2">
            </div>
          </div>
        </div>
        <div class="button">
          <button type="submit" name="register">Register</button>
        </div>
      </form>
    </div>
  </section>
</body>

</html>