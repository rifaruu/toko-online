<?php
require "koneksi.php";

// Sanitize input to prevent SQL Injection
$nama = mysqli_real_escape_string($con, htmlspecialchars($_GET["nama"]));

// Query produk berdasarkan nama
$queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE nama='$nama'");
$produk = mysqli_fetch_array($queryProduk);

// Query produk terkait berdasarkan kategori
$queryProdukTerkait = mysqli_query($con, "SELECT * FROM produk WHERE kategori_id='$produk[kategori_id]' AND id !='$produk[id]' LIMIT 4");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planet Bakso | Produk</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <style>
        .text-harga {
            font-size: 1.5rem;
            color: #dc3545;
            font-weight: bold;
        }
        .warna2 {
            background-color: #f8f9fa;
        }
        .img-thumbnail-produk-terkait-image {
            width: 100%;
            height: auto;
            border: none;
        }
        .produk-detail img {
            max-width: 100%;
        }
    </style>
</head>
<body>
    <?php require "navbar.php"; ?>
    
    <!-- detail produk -->
    <div class="container py-5">
        <div class="row produk-detail">
            <div class="col-lg-6 mb-5">
                <img src="image/<?php echo $produk['foto'] ?>" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6">
                <h1><?php echo $produk['nama'] ?></h1>
                <p class="fs-5"><?php echo nl2br($produk['detail']); ?></p>
                <p class="text-harga">Rp <?php echo number_format($produk['harga'], 0, ',', '.'); ?></p>
                <p class="fs-5">Status ketersediaan: <strong><?php echo $produk['ketersediaan_stok']; ?></strong></p>
            </div>
        </div>
    </div>
    
    <!-- produk terkait -->
    <div class="container py-5 warna2">
        <h2 class="text-center mb-5">Produk Terkait</h2>
        <div class="row">
            <?php while($data = mysqli_fetch_array($queryProdukTerkait)) { ?>
            <div class="col-md-3 mb-4">
                <a href="produk-detail.php?nama=<?php echo $data['nama']; ?>">
                    <img src="image/<?php echo $data['foto']; ?>" class="img-fluid img-thumbnail-produk-terkait-image" alt="">
                </a>
            </div>
            <?php } ?>
        </div>
    </div>

    <?php require "footer.php"; ?>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>
