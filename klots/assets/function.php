<?php
$conn = mysqli_connect("localhost", "root", "", "db_klots");
// mysqli_connect("mertawijaya.site", "u1587014_merta", "e&KlZl$40U)(", "u1587014_db_klots");

function query($query)
{
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function navbar()
{
  echo '
    <nav>
      <div class="nav-bar">
        <i class="bx bx-menu sidebarOpen"></i>
        <span class="logo navLogo"
          ><a href="../home">KLOTS Fashions</a></span
        >

        <div class="menu">
          <div class="logo-toggle">
            <span class="logo"
              ><a href="../home">KLOTS Fashions</a></span
            >
            <i class="bx bx-x siderbarClose"></i>
          </div>

          <ul class="nav-links">
            <li><a href="../home">Home</a></li>
            <li><a href="../all-product">All Product</a></li>
            <li><a href="../faq">FaQ</a></li>
          </ul>
        </div>

        <div class="darkLight-searchBox">
          <div class="dark-light">
            <i class="bx bx-moon moon"></i>
            <i class="bx bx-sun sun"></i>
          </div>

          <div class="searchBox">
            <div class="searchToggle">
              <i class="bx bx-x cancel"></i>
              <i class="bx bx-search search"></i>
            </div>
            <form action="../all-product/" method="post">
              <div class="search-field">
                <input id="keyword" type="text" placeholder="Search..." autocomplete="false" />
                <i class="bx bx-search " id="search" ></i>
                <i class="bx bx-loader" id="loader" ></i>
              </div>
            </form>
          </div>
        </div>
        
      </div>
    </nav>
    ';
}

function footer()
{
  echo '
    <footer>
      <div class="content">
        <div class="left box">
          <div class="upper">
            <div class="topic">About us</div>
            <p>
              Klots is a Brand Created by Two Teenagers Who are Hungry for Money
            </p>
            <p>Outfit Kece Bersama Klots</p>
          </div>
          <div class="lower">
            <div class="topic">Contact us</div>
            <div class="phone">
              <a href="tel:087816140110"
                ><i class="fas fa-phone-volume"></i
                ><span class="desc">+62 878 </span>1614 0110</a
              >
            </div>
            <div class="email">
              <a href="mailto:fashion.klots@gmail.com"
                ><i class="fas fa-envelope"></i
                ><span class="desc">fashion.klots</span>@gmail.com</a
              >
            </div>
          </div>
        </div>
        <div class="right box">
          <div class="media-icons">
            <a id="WA" href="http://wa.me/+6287816140110" target="_blank">WA</a>
            <a id="IG" href="https://instagram.com/klotsclothes" target="_blank"
              >IG</a
            >
            <a
              id="TT"
              href="https://www.tiktok.com/@klotsclothes"
              target="_blank"
              >TT</a
            >
          </div>
          <div class="media-icons">
            <a id="SP" href="http://shopee.co.id/fashion_klots" target="_blank">SP</a>
            <a id="TP" href="https://tokopedia.com/fashionklots" target="_blank"
              >TP</a
            >
            <a
              id="LZ"
              href="#"
              target="_blank"
              >LZ</a
            >
          </div>
        </div>
      </div>
      <div class="bottom">
        <p>
          Copyright 2022 <a href="../home">Klots Clothes</a> All rights
          reserved
        </p>
      </div>
    </footer>
    ';
}

function script()
{
  echo '
  <script src="../assets/swiper-bundle.min.js"></script>
  <script>
  var swiper = new Swiper(".mySwiper", {
    spaceBetween: 30,
    centeredSlides: true,
    loop: true,
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });
  </script>
  ';
}

function head($title)
{
  $title = strtoupper($title);
  echo "
  <meta charset='UTF-8' />
  <meta http-equiv='X-UA-Compatible' content='IE=edge' />
  <meta name='viewport' content='width=device-width, initial-scale=1.0' />

  <!-- ===== Boxicons CSS ===== -->
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet' />
  <link rel='stylesheet' href='../assets/swiper-bundle.min.css'>
  <link rel='stylesheet' href='../assets/style.css' />


  <title>$title | KLOTS Fashion</title>

  <link rel='shortcut icon' href='../assets/images/favicon.ico' type='image/x-icon' />
  <script src='../assets/jquery.min.js'></script>
  <script src='../assets/script.js'></script>
  ";
}
