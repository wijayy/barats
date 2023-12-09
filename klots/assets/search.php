<?php
require "function.php";

$keyword = $_GET['keyword'];

$rows = query("SELECT * FROM tb_baju
                WHERE
                title LIKE '%$keyword%'
                OR color LIKE '%$keyword%'
                OR style LIKE '%$keyword%'
                ");

?>

<div class="outer">
  <h4 class="title">Search</h4>
  <div class="line"></div>
  <div class="blog">
    <?php foreach ($rows as $row) : ?>
    <div class="row">
      <div class="images">
        <img src="../assets/images/poster/<?= $row["image"] ?>" alt="" />
      </div>
      <p>KLOTS <?= $row["title"] ?></p>
    </div>
    <?php endforeach ?>
  </div>
</div>