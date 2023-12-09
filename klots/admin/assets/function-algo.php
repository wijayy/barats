<?php
// $conn = mysqli_connect("localhost", "root", "", "db_klots");
$conn = mysqli_connect("localhost", "root", "", "db_klots");

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

function insert_product($query)
{
  global $conn;

  // ambil data teks dari $_POST
  $title = htmlspecialchars($_POST["title"]);
  $color = htmlspecialchars($_POST["color"]);
  $fabric = htmlspecialchars($_POST["fabric"]);
  $sablon = htmlspecialchars($_POST["sablon"]);
  $gender = 'Male'; //htmlspecialchars($_POST["gender"]);
  $style = 'Oversized'; //htmlspecialchars($_POST["style"]);
  $story = htmlspecialchars($_POST["story"]);
  $start_sell = htmlspecialchars($_POST["start_sell"]);
  $price = htmlspecialchars($_POST["price"]);

  $link_tt = htmlspecialchars($_POST["link_tt"]);
  $link_sp = htmlspecialchars($_POST["link_sp"]);
  $link_tp = htmlspecialchars($_POST["link_tp"]);
  $link_lz = htmlspecialchars($_POST["link_lz"]);


  // cek setiap gambar yang ada di $_FILES
  $poster = upload($_FILES["poster"], "poster");

  for ($i = 1; $i <= 10; $i++) :
    $gambar[$i - 1] = upload($_FILES["image" . $i], "image");
    if ($gambar[$i - 1] === 0) {
      $gambar[$i - 1] = "";
      break;
    } else if (!$gambar[$i - 1]) return false;
  endfor;

  if (!$poster) {
    return false;
  }

  // insert data ke tb_link
  $query2 = "INSERT INTO tb_link VALUES
                  (NULL, '$title', '$link_tt', '$link_sp', '$link_tp', '$link_lz') ";
  $result2 = mysqli_query($conn, $query2);
  // insert data ke tb_baju

  $query1 = "INSERT INTO `tb_baju` 
            (`id`, `title`, `color`, `fabric`, `sablon`, `gender`, `style`, `story`, `image`, `start_sell`, `price`) 
            VALUES 
            (NULL, '$title', '$color', '$fabric', '$sablon', '$gender', '$style', '$story', '$poster', '$start_sell', '$price')";
  $result1 = mysqli_query($conn, $query1);


  // insert data ke tb_image
  $query3 = "INSERT INTO `tb_image` 
  (`id`, `title`, `image1`, `image2`, `image3`, `image4`, `image5`, `image6`, `image7`, `image8`, `image9`, `image10`) 
  VALUES 
  (NULL, '$title', '$gambar[0]', '$gambar[1]', '$gambar[2]', '$gambar[3]', '$gambar[4]', '$gambar[5]', '$gambar[6]', '$gambar[7]', '$gambar[8]', '$gambar[9]');";
  $result3 = mysqli_query($conn, $query3);



  return mysqli_affected_rows($conn);
}

function upload($data, $type)
{
  $namafile = $data['name'];
  $ukfiles = $data['size'];
  $error = $data['error'];
  $tmpname = $data['tmp_name'];

  if ($error === 4) {
    return 0;
  }

  $ekstensiValid = ['jpg', 'jpeg', 'png'];
  $ekstensiGambar = explode('.', $namafile);
  $ekstensiGambar = strtolower(end($ekstensiGambar));


  if (!in_array($ekstensiGambar, $ekstensiValid)) {
    $text = $data . 'harus berekstensi .jpg / .jpeg / .png';
    echo "
        <script>
            alert($text);
        </script>
        ";
    return false;
  }

  $fileBaru = uniqid();
  $fileBaru .= '.';
  $fileBaru .= $ekstensiGambar;

  move_uploaded_file($tmpname, "assets/../../assets/images/" . $type . "/" . $fileBaru);
  return $fileBaru;
}

function update_product($query)
{
  global $conn;
  // var_dump($_POST);
  // echo "<br>";
  // var_dump($_FILES);
  // die;
  $id = htmlspecialchars($_POST["id"]);
  $title = htmlspecialchars($_POST["title"]);
  $color = htmlspecialchars($_POST["color"]);
  $fabric = htmlspecialchars($_POST["fabric"]);
  $sablon = htmlspecialchars($_POST["sablon"]);
  $gender = 'male'; //htmlspecialchars($_POST["gender"]);
  $style = 'oversized';  //htmlspecialchars($_POST["style"]);
  $story = htmlspecialchars($_POST["story"]);
  $start_sell = htmlspecialchars($_POST["start_sell"]);
  $price = htmlspecialchars($_POST["price"]);

  $link_tt = htmlspecialchars($_POST["link_tt"]);
  $link_sp = htmlspecialchars($_POST["link_sp"]);
  $link_tp = htmlspecialchars($_POST["link_tp"]);
  $link_lz = htmlspecialchars($_POST["link_lz"]);
  $posterLama = htmlspecialchars($_POST["image"]);


  if ($_FILES["poster"]["error"] === 4) {
    $gambar = $posterLama;
  } else if (($gambar = upload($_FILES["poster"], "poster")) === false) {
    return false;
  }


  for ($i = 1; $i < 11; $i++) {
    if ($_FILES["image" . $i]["error"] === 4) {
      $images[] = htmlspecialchars($_POST["image" . $i]);
    } else if (($images[] = upload($_FILES["image" . $i], "image")) === false) {
      return false;
    }
  }

  $query = "UPDATE tb_baju SET
                title = '$title', 
                color = '$color', 
                fabric = '$fabric', 
                sablon = '$sablon', 
                gender = '$gender', 
                style = '$style' ,
                story = '$story' ,
                `image` = '$gambar' ,
                start_sell = '$start_sell', 
                price = $price 
                WHERE id = $id";
  mysqli_query($conn, $query);

  $query = "UPDATE tb_link SET
                title = '$title', 
                link_tt = '$link_tt', 
                link_sp = '$link_sp', 
                link_tp = '$link_tp', 
                link_lz = '$link_lz'
                WHERE id=$id";
  mysqli_query($conn, $query);

  $query = "UPDATE tb_image SET
                title = '$title', 
                image1 = '$images[0]', 
                image2 = '$images[1]', 
                image3 = '$images[2]', 
                image4 = '$images[3]', 
                image5 = '$images[4]', 
                image6 = '$images[5]', 
                image7 = '$images[6]', 
                image8 = '$images[7]', 
                image9 = '$images[8]', 
                image10 = '$images[9]'
                WHERE id=$id";
  mysqli_query($conn, $query);

  return 1;
}

function hapus_product($id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM tb_baju WHERE id = $id");
  mysqli_query($conn, "DELETE FROM tb_link WHERE id = $id");
  mysqli_query($conn, "DELETE FROM tb_image WHERE id = $id");

  return mysqli_affected_rows($conn);
}

function insert_slider($query)
{
  global $conn;

  // ambil data teks dari $_POST
  $title = htmlspecialchars($_POST["title"]);
  $link = htmlspecialchars($_POST["link"]);
  $priority = htmlspecialchars($_POST["priority"]);
  $show_until = htmlspecialchars($_POST["show_until"]);

  // cek setiap gambar yang ada di $_FILES
  $image = upload($_FILES["image"], "slider");

  if (!$image) {
    return false;
  }

  // insert data ke tb_slider
  $query = "INSERT INTO tb_slider VALUES
                  (NULL, '$title', $priority , '$image', '$link', '$show_until') ";
  $result = mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function hapus_slider($id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM tb_slider WHERE id = $id");
  return mysqli_affected_rows($conn);
}

function update_slider($query)
{
  global $conn;
  // var_dump($_POST);
  // echo "<br>";
  // var_dump($_FILES);
  // die;
  $id = htmlspecialchars($_POST["id"]);
  $title = htmlspecialchars($_POST["title"]);
  $priority = htmlspecialchars($_POST["priority"]);
  $link = htmlspecialchars($_POST["link"]);
  $show_until = htmlspecialchars($_POST["show_until"]);
  $sliderLama = htmlspecialchars($_POST["slider"]);


  if ($_FILES["image"]["error"] === 4) {
    $image = $sliderLama;
  } else if (($image = upload($_FILES["image"], "slider")) === false) {
    return false;
  }

  $query = "UPDATE tb_slider SET
                title = '$title', 
                link = '$link', 
                priority = $priority;
                show_until = '$show_until', 
                `image` = '$image'
                WHERE id=$id";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function registrasi($data)
{
  global $conn;
  // ambil data dari $data
  $username = stripslashes(strtolower($_POST["username"]));
  $password = mysqli_real_escape_string($conn, $_POST["password"],);
  $password2 = mysqli_real_escape_string($conn, $_POST["password2"]);


  // cek username sudah ada atau belum
  $result = mysqli_query($conn, "SELECT username FROM tb_user WHERE username = '$username'");

  if (mysqli_fetch_assoc($result)) {
    echo "
        <script>
            alert('username sudah terdaftar');
        </script>
        ";
    return false;
  }

  // cek konfirmasi password
  if ($password != $password2) {
    echo "
        <script>
            alert('konfirmasi password tidak sesuai');
        </script>
        ";
    return false;
  }

  // encrypted password;
  $password = password_hash($password, PASSWORD_DEFAULT);


  // tambahkan user baru ke database
  mysqli_query($conn, "INSERT INTO tb_user VALUES('', '$username', '$password')");

  return mysqli_affected_rows($conn);
}
