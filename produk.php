<?php
require "koneksi.php";

// Periksa apakah koneksi berhasil
if ($con === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Default query untuk produk
$queryProduk = "SELECT * FROM produk";

// get produk by nama produk/keyword
if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    $queryProduk = "SELECT * FROM produk WHERE nama LIKE '%$keyword%'";
} 
// get produk by kategori
else if (isset($_GET['kategori'])) {
    $kategoriNama = $_GET['kategori'];
    $requerykategoriId = mysqli_query($con, "SELECT id FROM kategori WHERE nama='$kategoriNama'");
    
    // Periksa apakah query berhasil
    if ($requerykategoriId === false) {
        die("ERROR: Could not execute query. " . mysqli_error($con));
    }

    $kategori = mysqli_fetch_array($requerykategoriId);
    $kategoriId = $kategori['id'];
    $queryProduk = "SELECT * FROM produk WHERE kategori_id='$kategoriId'";
}

// Jalankan query produk
$requeryProduk = mysqli_query($con, $queryProduk);

// Periksa apakah query berhasil
if ($requeryProduk === false) {
    die("ERROR: Could not execute query. " . mysqli_error($con));
}

// Hitung jumlah produk
$countProduk = mysqli_num_rows($requeryProduk);
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
        .banner-produk {
            background: url('image/banner.jpg') no-repeat center center;
            background-size: cover;
            height: 300px;
        }
        .no-decoration {
            text-decoration: none;
            color: inherit;
        }
        .no-decoration:hover {
            color: #007bff;
        }
        .card h4 {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .text-truncate {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .text-harga {
            font-size: 1.2rem;
            color: #dc3545;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php require "navbar.php"; ?>

    <!-- banner -->
    <div class="container-fluid banner-produk d-flex align-items-center">
        <div class="container">
            <h1 class="text-white">Produk</h1>
        </div>
    </div>

    <!-- body -->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-3 mb-5">
                <ul class="list-group">
                    <?php 
                    // Jalankan query kategori
                    $requerykategori = mysqli_query($con, "SELECT * FROM kategori");

                    // Periksa apakah query berhasil
                    if ($requerykategori === false) {
                        die("ERROR: Could not execute query. " . mysqli_error($con));
                    }

                    while($kategori = mysqli_fetch_array($requerykategori)) { ?>
                    <a class="no-decoration" href="produk.php?kategori=<?php echo $kategori['nama']; ?>">
                        <li class="list-group-item"><?php echo $kategori['nama']; ?></li>
                    </a>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-lg-9">
                <h3 class="text-center mb-3">Produk</h3>
                <div class="row">
                    <?php
                    if ($countProduk == 0) {
                    ?>
                        <h4 class="text-center my-5">Produk yang Anda cari tidak tersedia</h4>
                    <?php
                    } else {
                        while($produk = mysqli_fetch_array($requeryProduk)) { ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="image-box">
                                    <img src="image/<?php echo $produk['foto'];?>" class="card-img-top" alt="...">
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo $produk['nama']; ?></h4>
                                    <p class="card-text text-truncate"><?php echo $produk['detail']; ?></p>
                                    <p class="card-text text-harga">Rp <?php echo number_format($produk['harga'], 0, ',', '.'); ?></p>
                                    <a href="produk-detail.php?nama=<?php echo $produk['nama']; ?>" class="btn btn-primary text-white">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                        <?php }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php require "footer.php"; ?>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>

</body>
</html>
