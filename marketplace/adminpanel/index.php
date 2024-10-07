<?php
require "session.php";
require "../koneksi.php";

$queryKategori = mysqli_query($con,"SELECT * FROM kategori");
$jumlahKategori = mysqli_num_rows($queryKategori);

$queryProduk = mysqli_query($con,"SELECT * FROM produk");
$jumlahProduk = mysqli_num_rows($queryProduk);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>

<style>
  .kotak {
    border: 2px solid black;
    padding: 10px;
    margin: 10px;
  }

  .summary-kategory, .summary-produk {
    border-radius: 10px;
    padding: 15px;
  }

  .summary-kategory {
    background-color: #0a6b4a;
  }

  .summary-produk {
    background-color: #0a516b;
  }

  .no-decoration {
    text-decoration: none;
  }
</style>

<body>

<?php require "navbar.php"; ?>

<div class="container mt-5">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">
        <i class="fas fa-home"></i> Beranda
      </li>
    </ol>
  </nav>
  <h2>Halooo <?php echo $_SESSION['username']; ?> </h2>

  <div class="row mt-5">
    <div class="col-lg-4 mb-3">
      <div class="summary-kategory">
      <div class="row">
        <div class="col-6">
          <i class="fas fa-align-justify fa-7x text-black-50"></i>
        </div>
        <div class="col-6 text-white">
          <h3 class="fs-2">Kategori</h3>
          <p class="fs-4"><?php echo $jumlahKategori; ?> Kategori</p>
          <p><a href="kategori.php" class="text-white no-decoration">Lihat Detail</a></p>
        </div>
      </div>
    </div>
    </div>

    <div class="col-lg-4 mb-3">
      <div class="summary-produk">
      <div class="row">
        <div class="col-6">
          <i class="fa-solid fa-box fa-7x text-black-50"></i>
        </div>
        <div class="col-6 text-white">
          <h3 class="fs-2">Produk</h3>
          <p class="fs-4"><?php echo $jumlahProduk; ?> Produk</p>
          <p><a href="kategori.php" class="text-white no-decoration">Lihat Detail</a></p>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../fontawesome/js/all.min.js"></script>
</body>
</html>
