<?php
require "../assets/function.php";


$count = 0;

$upcomings = query("SELECT * FROM tb_baju WHERE  (start_sell = NULL) OR ((YEAR(NOW())-YEAR(start_sell))*365 + (MONTH(NOW())-MONTH(start_sell))*31 + (DAY(NOW())-DAY(start_sell)) < 0) OR (YEAR(start_sell) = 0) ORDER BY id DESC");

// $upcomings = query("SELECT * FROM tb_baju ");
$new_stoks = query("SELECT * FROM tb_baju  WHERE ((YEAR(NOW())-YEAR(start_sell))*365 + (MONTH(NOW())-MONTH(start_sell))*31 + (DAY(NOW())-DAY(start_sell)) >= 0) AND (YEAR(start_sell) != 0) ORDER BY id DESC");
$sliders = query("SELECT * FROM tb_slider  WHERE ((YEAR(NOW())-YEAR(show_until))*365 + (MONTH(NOW())-MONTH(show_until))*31 + (DAY(NOW())-DAY(show_until)) <= 0)  ORDER BY `priority` DESC");


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <?php head("Home") ?>
</head>

<body>
  <!-- ! NAVBAR START ==================================================== -->
  <?php navbar(); ?>
  <!-- ! NAVBAR END ====================================================== -->

  <!-- Swiper START -->
  <section id="swiper">
    <div class="outer">
      <div class="swiper mySwiper main">
        <div class="swiper-wrapper wrapper">
          <?php foreach ($sliders as $slider) : ?>
            <div class="swiper-slide slide">
              <a href="<?= $slider["link"] ?>">
                <img src="../assets/images/slider/<?= $slider["image"] ?>" alt="" srcset="" class="image" />
              </a>
            </div>
          <?php endforeach ?>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
      </div>
    </div>
  </section>
  <!-- Swiper END -->

  <!-- Upcoming START -->
  <section id="upcoming" class="search-section">
    <div class="outer">
      <h4 class="title">Upcoming</h4>
      <div class="line"></div>
      <div class="blog">
        <?php foreach ($upcomings as $upcoming) : ?>
          <div class="row">
            <div class="images">
              <img src="../assets/images/poster/<?= $upcoming["image"] ?>" alt="" />
            </div>
            <p>KLOTS <?= $upcoming["title"] ?></p>
          </div>
        <?php endforeach ?>
      </div>
    </div>
  </section>
  <!-- Upcoming END -->

  <!-- New Stok START -->
  <section id="newstok">
    <div class="outer">
      <h4 class="title">New Stok</h4>
      <div class="line"></div>
      <div class="blog">
        <?php $count = 0;
        foreach ($new_stoks as $new_stok) :
          if ($count < 4) : ?>
            <div class="row">
              <a href="../product-details?design=<?= $new_stok["title"] ?>">
                <div class="images">
                  <img src="../assets/images/poster/<?= $new_stok["image"] ?>" alt="" />
                </div>
                <p>KLOTS <?= $new_stok["title"] ?></p>
              </a>
            </div>
        <?php endif;
          $count++;
        endforeach ?>
      </div>
    </div>
  </section>
  <!-- New Stok END -->

  <!-- FOOTER START ==================================================== -->
  <?php footer() ?>
  <!-- FOOTER END ====================================================== -->

  <!-- <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script> -->

  <?php script() ?>

</body>

</html>