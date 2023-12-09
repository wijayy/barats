<?php
require "../assets/function.php";

$products = query("SELECT * FROM tb_baju  WHERE ((YEAR(NOW())-YEAR(start_sell))*365 + (MONTH(NOW())-MONTH(start_sell))*31 + (DAY(NOW())-DAY(start_sell)) >= 0) ORDER BY id DESC");


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php head("All Product") ?>
</head>

<body>
  <!-- ! NAVBAR START ==================================================== -->
  <?php navbar(); ?>
  <!-- ! NAVBAR END ====================================================== -->

  <!-- ALl Product START -->
  <section id="procuct">
    <div class="outer">
      <!-- <h4 class="title">New Stok</h4> -->
      <!-- <div class="line"></div> -->
      <div class="blog">
        <?php foreach ($products as $product) : ?>
        <div class="row">
          <a href="../product-details/?design=<?= $product["title"] ?>">
            <div class="images">
              <img src="../assets/images/poster/<?= $product["title"] ?>.png" alt="">
            </div>
            <p>KLOTS <?= $product["title"] ?></p>
          </a>
        </div>
        <?php endforeach ?>
      </div>
    </div>
  </section>
  <!-- ALl Product END -->

  <!-- FOOTER START ==================================================== -->
  <?php footer(); ?>
  <!-- FOOTER END ====================================================== -->

  <?php script(); ?>
</body>

</html>