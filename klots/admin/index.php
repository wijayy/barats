<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

// Script PHP untuk mengetahui Resolusi Layar Monitor
if (isset($_POST['width']) && isset($_POST['height'])) {
  $_SESSION['screen_width'] = $_POST['width'];
  $_SESSION['screen_height'] = $_POST['height'];
  echo json_encode(array('outcome' => 'success'));
} else {
  echo json_encode(array('outcome' => 'error', 'error' => "Couldn't save dimension info"));
}


require "assets/function.php";
require "assets/function-algo.php";

$products = query("SELECT * FROM tb_baju ORDER BY id DESC");
$sliders = query("SELECT * FROM tb_slider ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php head("admin") ?>
</head>

<body>
  <!-- ! NAVBAR START -->
  <?php navbar() ?>
  <!-- ! NAVBAR ENDS -->

  <!-- !  -->
  <section id="shirt">
    <div class="outer">
      <h4 class="title">Shirt</h4>
      <div class="line"></div>
      <div class="blog">
        <?php foreach ($products as $product) : ?>
        <div class="row">
          <a href="view-product.php?design=<?= $product['title'] ?>">
            <div class="images">
              <img src="../assets/images/poster/<?= $product["image"] ?>" alt="" />
            </div>
            <p><?= $product["title"] ?></p>
          </a>
        </div>
        <?php endforeach ?>
      </div>
    </div>
  </section>

  <section id="slider">
    <div class="outer">
      <h4 class="title">Slider</h4>
      <div class="line"></div>
      <div class="blog">
        <?php foreach ($sliders as $slider) : ?>
        <div class="row">
          <a href="view-slider.php?design=<?= $slider['title'] ?>">
            <div class="images">
              <img src="../assets/images/slider/<?= $slider["image"] ?>" alt="" />
            </div>
            <p><?= $slider["title"] ?></p>
          </a>
        </div>
        <?php endforeach ?>
      </div>
    </div>
  </section>

  <!-- ! SCRIPT  -->
  <?php script() ?>

  <script>
  $(function() {
    $.post('some_script.php', {
      width: screen.width,
      height: screen.height
    }, function(json) {
      if (json.outcome == 'success') {
        // do something with the knowledge possibly?
      } else {
        alert('Unable to let PHP know what the screen resolution is!');
      }
    }, 'json');
  });
  </script>
</body>

</html>