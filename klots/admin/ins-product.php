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

  if (insert_product($_POST) > 0) {
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
  <?php head("input product"); ?>
  <link rel="stylesheet" href="assets/style.css">
</head>

<body>
  <!-- ! NAVBAR START ==================================================== -->
  <?php navbar(); ?>
  <!-- ! NAVBAR END ====================================================== -->

  <!-- Name Product START -->
  <section id="product">
    <div class="outer">
      <h4 class="title">Input Design Klots</h4>
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
            <label for="color">color</label>
            <input type="text" name="color" id="color">
          </div>

          <div class="input-row">
            <label for="fabric">fabric</label>
            <input type="text" name="fabric" id="fabric">
          </div>

          <div class="input-row">
            <label for="sablon">sablon</label>
            <input type="text" name="sablon" id="sablon">
          </div>

          <div class="input-row">
            <label for="gender">gender</label>
            <div class="radio">
              <span>
                <input type="radio" name="gender" id="gender" value="male">male
              </span>
              <span>
                <input type="radio" name="gender" id="gender" value="female">female
              </span>
            </div>
          </div>

          <div class="input-row">
            <label for="style">style</label>
            <div class="radio">
              <span>
                <input type="radio" name="style" id="style" value="normal">normal
              </span>
              <span>
                <input type="radio" name="style" id="style" value="oversized">oversized
              </span>
            </div>
          </div>

          <div class="input-row">
            <label for="price">price</label>
            <input type="number" name="price" id="price">
          </div>

          <div class="input-row">
            <label for="start_sell">start sell</label>
            <div class="radio">
              <input type="date" name="start_sell" id="start_sell">
            </div>
          </div>

          <div class="input-row">
            <label for="story">story</label>
            <input type="text" name="story" id="story">
          </div>

          <div class="input-row">
            <label for="link_tt">link tiktok</label>
            <input type="url" name="link_tt" id="link_tt">
          </div>

          <div class="input-row">
            <label for="link_sp">link shopee</label>
            <input type="url" name="link_sp" id="link_sp">
          </div>

          <div class="input-row">
            <label for="link_tp">link tokped</label>
            <input type="url" name="link_tp" id="link_tp">
          </div>

          <div class="input-row">
            <label for="link_lz">link lazada</label>
            <input type="url" name="link_lz" id="link_lz">
          </div>

          <div class="input-row">
            <label for="poster">poster</label>
            <div class="radio">
              <input type="file" name="poster" id="poster" required>
            </div>
          </div>
          <div class="input-row">
            <label for="image1">image 1</label>
            <div class="radio">
              <input type="file" name="image1" id="image1">
            </div>
          </div>
          <div class="input-row">
            <label for="image2">image 2</label>
            <div class="radio">
              <input type="file" name="image2" id="image2">
            </div>
          </div>
          <div class="input-row">
            <label for="image3">image 3</label>
            <div class="radio">
              <input type="file" name="image3" id="image3">
            </div>
          </div>
          <div class="input-row">
            <label for="image4">image 4</label>
            <div class="radio">
              <input type="file" name="image4" id="image4">
            </div>
          </div>
          <div class="input-row">
            <label for="image5">image 5</label>
            <div class="radio">
              <input type="file" name="image5" id="image5">
            </div>
          </div>
          <div class="input-row">
            <label for="image6">image 6</label>
            <div class="radio">
              <input type="file" name="image6" id="image6">
            </div>
          </div>
          <div class="input-row">
            <label for="image7">image 7</label>
            <div class="radio">
              <input type="file" name="image7" id="image7">
            </div>
          </div>
          <div class="input-row">
            <label for="image8">image 8</label>
            <div class="radio">
              <input type="file" name="image8" id="image8">
            </div>
          </div>
          <div class="input-row">
            <label for="image9">image 9</label>
            <div class="radio">
              <input type="file" name="image9" id="image9">
            </div>
          </div>
          <div class="input-row">
            <label for="image10">image 10</label>
            <div class="radio">
              <input type="file" name="image10" id="image10">
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