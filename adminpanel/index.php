<?php
require "session.php";
require "../koneksi.php";

$queryKategori = mysqli_query($con, "SELECT * FROM kategori");
$jumlahKategori = mysqli_num_rows($queryKategori);

$queryProduk = mysqli_query($con, "SELECT * FROM produk");
$jumlahProduk = mysqli_num_rows($queryProduk);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .summary-box {
            border-radius: 10px;
            padding: 20px;
            color: white;
            transition: transform 0.3s;
        }
        .summary-box:hover {
            transform: scale(1.05);
        }
        .summary-kategori {
            background-color: #28a745;
        }
        .summary-produk {
            background-color: 	#4169E1;
        }
        .no-decoration {
            text-decoration: none;
        }
        .summary-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
        }
        .summary-details {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
        }
    </style>
</head>
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
    <h2>Halo, <?php echo $_SESSION['username']; ?>!</h2>

    <div class="row mt-5">
        <div class="col-lg-4 mb-3">
            <div class="card summary-box summary-kategori">
                <div class="row">
                    <div class="col-6 summary-icon">
                        <i class="fas fa-align-justify fa-7x text-black-50"></i>
                    </div>
                    <div class="col-6 summary-details">
                        <h3 class="fs-2">Kategori</h3>
                        <p class="fs-4"><?php echo $jumlahKategori; ?> Kategori</p>
                        <p><a href="kategori.php" class="text-white no-decoration">Lihat Detail</a></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-3">
            <div class="card summary-box summary-produk">
                <div class="row">
                    <div class="col-6 summary-icon">
                        <i class="fas fa-box fa-7x text-black-50"></i>
                    </div>
                    <div class="col-6 summary-details">
                        <h3 class="fs-2">Produk</h3>
                        <p class="fs-4"><?php echo $jumlahProduk; ?> Produk</p>
                        <p><a href="produk.php" class="text-white no-decoration">Lihat Detail</a></p>
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
