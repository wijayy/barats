<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

require "assets/function.php";
require "assets/function-algo.php";

// cek apakah tombol sumbit sudah ditekan
if (isset($_POST["submit"])) {

  if (insert_slider($_POST) > 0) {
    echo "
        <script>
          alert('Data berhasil ditambahkan');
          document.location.href = 'index.php'
        </script>
    ";
  } else {
    echo "
    <script>
      alert('Data gagal ditambahkan');
    </script>
    ";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php head("input slider"); ?>
  <link rel="stylesheet" href="assets/style.css">
</head>

<body>
  <!-- ! NAVBAR START ==================================================== -->
  <?php navbar(); ?>
  <!-- ! NAVBAR END ====================================================== -->

  <!-- Name Product START -->
  <section id="product">
    <div class="outer">
      <h4 class="title">Input Slider Klots</h4>
      <div class="line"></div>
    </div>
  </section>
  <!-- Name Product END -->

  <section class="input">
    <div class="outer">

      <form action="" method="post" enctype="multipart/form-data">
        <div class="input-box">
          <div class="input-row">
            <label for="title">title</label>
            <input type="text" name="title" id="title" required>
          </div>

          <div class="input-row">
            <label for="priority">priority</label>
            <input type="number" name="priority" id="priority" placeholder="0-10; default 0">
          </div>

          <div class="input-row">
            <label for="link">link</label>
            <input type="url" name="link" id="link">
          </div>

          <div class="input-row">
            <label for="show_until">show until</label>
            <div class="radio">
              <input type="date" name="show_until" id="show_until">
            </div>
          </div>

          <div class="input-row">
            <label for="image">image</label>
            <div class="radio">
              <input type="file" name="image" id="image">
            </div>
          </div>

        </div>
        <button type="submit" name="submit" id="submit">sumbit</button>
      </form>

    </div>
  </section>

  <?php script(); ?>

</body>

</html>