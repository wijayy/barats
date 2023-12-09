<?php
require "../assets/function.php";

$faqs = query("SELECT * FROM tb_faq")
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php head("FaQ") ?>
  <!-- <link rel="stylesheet" href="../assets/style.css" /> -->
</head>

<body>
  <!-- ! NAVBAR START ==================================================== -->
  <?php navbar(); ?>
  <!-- ! NAVBAR END ====================================================== -->

  <!-- HEADER START -->
  <section id="product">
    <div class="outer">
      <h4 class="title">Frequenly Asked Questions</h4>
      <div class="line"></div>
    </div>
  </section>
  <!-- HEADER END -->

  <!-- FaQ START -->
  <section id="faq">
    <div class="outer">
      <div class="faq-box">
        <?php foreach ($faqs as $faq) : ?>
        <div class="faq-row">
          <div class="question-box">
            <span><?= $faq["question"] ?></span>
          </div>
          <div class="line"></div>
          <div class="answer-box">
            <span>
              <?= $faq["answer"] ?>
            </span>
          </div>
        </div>
        <?php endforeach ?>
      </div>
    </div>
  </section>
  <!-- FaQ END -->

  <!-- FOOTER START ==================================================== -->
  <?php footer(); ?>
  <!-- FOOTER END ====================================================== -->

  <?php script(); ?>
</body>

</html>