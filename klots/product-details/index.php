<?php
require "../assets/function.php";

if (!isset($_GET["design"]) || $_GET["design"] == NULL) :
  header("Location: ../home");
  exit;
endif;
$d = $_GET["design"];
$designs = query("SELECT * FROM tb_baju WHERE title='$d'")[0];
$images = query("SELECT * FROM tb_image WHERE title='$d'")[0];
$links = query("SELECT * FROM tb_link WHERE title='$d'")[0];

if ($designs == NULL) {
  header("Location: ../home");
}

$gender = $designs["gender"];
// echo $gender;
$style = $designs["style"];

$sizes = query("SELECT * FROM tb_size WHERE gender='$gender' AND style='$style' ORDER BY lebar ASC ");

$s = ["size0", "size1", "size2"];
// var_dump($sizes);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php head($designs["title"]); ?>
</head>

<body>
  <!-- ! NAVBAR START ==================================================== -->
  <?php navbar(); ?>
  <!-- ! NAVBAR END ====================================================== -->

  <!-- Name Product START -->
  <section id="product">
    <div class="outer">
      <h4 class="title">Klots <?= $designs["title"] ?></h4>
      <div class="line"></div>
    </div>
  </section>
  <!-- Name Product END -->

  <!-- Swiper START -->
  <section id="swiper">
    <div class="outer">
      <div class="swiper mySwiper main">
        <div class="swiper-wrapper wrapper">
          <?php for ($i = 1; $i <= 10; $i++) : ?>
          <?php if (strlen($images["image" . $i]) > 3) : ?>
          <div class="swiper-slide slide">
            <img src="../assets/images/image/<?= $images["image" . $i] ?>" alt="" srcset="" class="image" />
          </div>
          <?php endif ?>
          <?php endfor ?>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
      </div>
    </div>
  </section>
  <!-- Swiper END -->

  <!-- Deskripsi START -->
  <section id="desk">
    <div class="outer">
      <div class="deskripsi">
        <div class="left desk-box">
          <div class="details">
            Title : <span id="title">KLOTS <?= $designs["title"] ?></span>
          </div>
          <div class="details">Color : <span id="color"><?= $designs["color"] ?></span></div>
          <div class="details">
            Fabric : <span id="fabric"><?= $designs["fabric"] ?></span>
          </div>
          <div class="details">
            Sablon : <span id="fabric"><?= $designs["sablon"] ?></span>
          </div>
          <div class="details">Gender : <span id="gender"><?= $designs["gender"] ?></span></div>
          <div class="details">Style : <span id="style"><?= $designs["style"] ?></span></div>
          <div class="details">Size : <span id="size">
              <?php $count = 0;
              foreach ($sizes as $size) :  ?>
              <span class="size<?= $count ?>"><?= strtoupper($size["size"]) ?></span>
              <?php $count++;
              endforeach ?>
            </span></div>
          <div class="details">Width : <span id="lebar">
              <?php $count = 0;
              foreach ($sizes as $size) :  ?>
              <span class="size<?= $count ?>"><?= strtoupper($size["lebar"]) ?></span>
              <?php $count++;
              endforeach ?></span>cm</div>
          <div class="details">Height : <span id="panjang">
              <?php $count = 0;
              foreach ($sizes as $size) : ?>
              <span class="size<?= $count ?>"><?= strtoupper($size["panjang"]) ?></span>
              <?php $count++;
              endforeach ?></span>cm</div>
          <div class="details">Harga : <span id="harga"><?= $designs["price"] ?></span></div>
        </div>
        <div class="right desk-box">
          <div class="story">Story Product</div>
          <p>
            <?= $designs["story"] ?>
          </p>
          <div class="buy">
            <div class="text">Buy at</div>
            <div class="media-icons">
              <a id="TT" href="<?= $links["link_tt"] ?>" target="_blank">TT</a>
              <a id="SP" href="<?= $links["link_sp"] ?>" target="_blank">SP</a>
              <a id="TP" href="<?= $links["link_tp"] ?>" target="_blank">TP</a>
              <a id="LZ" href="<?= $links["link_lz"] ?>" target="_blank">LZ</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Deskripsi END -->

  <!-- FOOTER START ==================================================== -->
  <?php footer(); ?>
  <!-- FOOTER END ====================================================== -->

  <?php script(); ?>

</body>

</html>