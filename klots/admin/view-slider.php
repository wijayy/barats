<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

require "assets/function.php";
require "assets/function-algo.php";

if (!isset($_GET["design"]) || $_GET["design"] == "") {
  header("Location: index.php");
  exit;
}
$title = $_GET["design"];
$slider = query("SELECT * FROM tb_slider WHERE title= '$title'")[0];

if (isset($_POST["delete"])) {
  $id = $slider["id"];

  if (hapus_slider($id) > 0) {
    echo "
    <script>
      alert('Data berhasil dihapus');
      document.location.href = 'index.php'
    </script>
    ";
  } else {
    echo "
      <script>
        alert('Data gagal dihapus');
        document.location.href = 'index.php'
      </script>
    ";
  }
}

if (isset($_POST["submit"])) {

  if (update_slider($_POST) > 0) {
    echo "
        <script>
          alert('Data berhasil diubah');
          document.location.href = 'index.php'
        </script>
    ";
  } else {
    echo "
    <script>
      alert('Data gagal diubah');
    </script>
    ";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php head($slider["title"]); ?>
</head>

<body>
  <!-- ! NAVBAR START ==================================================== -->
  <?php navbar(); ?>
  <!-- ! NAVBAR END ====================================================== -->

  <!-- Name Product START -->
  <section id="product">
    <div class="outer">
      <h4 class="title">KLOTS <?= $slider["title"] ?></h4>
      <div class="line"></div>
    </div>
  </section>
  <!-- Name Product END -->

  <section class="input">
    <div class="outer">

      <form action="" method="post" enctype="multipart/form-data">
        <div class="input-box">
          <input type="hidden" name="id" value="<?= $slider['id'] ?>">
          <input type="hidden" name="slider" value="<?= $slider['image'] ?>">

          <div class="input-row">
            <label for="title">title</label>
            <input value="<?= $slider["title"] ?>" type="text" name="title" id="title" required>
          </div>

          <div class="input-row">
            <label for="priority">priority</label>
            <input value="<?= $slider["priority"] ?>" type="number" name="priority" id="priority" placeholder="0-10; default 0">
          </div>

          <div class="input-row">
            <label for="link">link</label>
            <input value="<?= $slider["link"] ?>" type="url" name="link" id="link">
          </div>

          <div class="input-row">
            <label for="show_until">show until</label>
            <div class="radio">
              <input value="<?= $slider["show_until"] ?>" type="date" name="show_until" id="show_until">
            </div>
          </div>

          <div class="input-row">
            <label for="image">image</label>
            <div class="radio">
              <input type="file" name="image" id="image">
            </div>
          </div>

          <div class="button">
            <button type="submit" name="submit" id="submit">sumbit</button>
            <div class="delete">delete
            </div>
          </div>

          <div class="message">
            <p>Are you sure to delete <?= $slider["title"] ?>?</p>
            <button type="submit" name="delete" id="delete">YES</button>
          </div>

      </form>

    </div>
  </section>

  <?php script(); ?>
  <script>
    var dlt = document.querySelector(".delete");
    var msg = document.querySelector(".message");

    dlt.addEventListener("click", () => {
      msg.classList.toggle("view");
    });
  </script>

</body>

</html>