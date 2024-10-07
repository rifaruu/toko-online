<?php
require "koneksi.php";

// Periksa apakah koneksi berhasil
if ($con === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$queryProduk = mysqli_query($con, "SELECT id, nama, harga, foto, detail FROM produk LIMIT 6");

// Periksa apakah query berhasil
if ($queryProduk === false) {
    die("ERROR: Could not execute query. " . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planet Bakso | Home</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .highlighted-kategori {
            background-color: #f8f9fa;
            /* Warna latar belakang abu-abu terang */
            border: 1px solid #dee2e6;
            /* Border ringan */
            height: 200px;
            /* Tinggi tetap */
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-size: 1.5rem;
            /* Ukuran teks besar */
            color: #343a40;
            /* Warna teks gelap */
        }

        .highlighted-kategori a.no-decoration {
            text-decoration: none;
            /* Menghilangkan garis bawah */
            color: inherit;
            /* Menggunakan warna teks dari elemen induk */
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <?php 
    if (file_exists('navbar.php')) {
        require 'navbar.php';
    } else {
        echo '<div class="alert alert-danger">Navbar file not found!</div>';
    }
    ?>

    <!-- Banner -->
    <div class="container-fluid banner d-flex align-items-center">
        <div class="container text-center text-white">
            <h1>Planet Bakso</h1>
            <h2>Mau Pesan Apa?</h2>
            <div class="col-md-8 offset-md-2">
                <form method="get" action="produk.php">
                    <div class="input-group input-group-lg my-4">
                        <input type="text" class="form-control" placeholder="Jelajahi Menu..." aria-label="Search"
                            name="keyword">
                        <button type="submit" class="btn warna2 text-white">Telusuri</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Highlighted Kategori -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Kategori Terlaris</h3>
            <div class="row mt-5">
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori kategori-bakso d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a href="produk.php?kategori=Bakso" class="no-decoration">Bakso</a></h4>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div
                        class="highlighted-kategori kategori-mie-ayam d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=Mie Ayam">Mie Ayam</a>
                        </h4>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori kategori-minuman d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=Minuman">Minuman</a>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tentang Kami -->
    <div class="container-fluid warna3 py-5">
        <div class="container text-center">
            <h3>Tentang Kami</h3>
            <p class="fs-5">
                Kami merupakan mahasiswa UNUGHA Teknik Informatika,dalam project kali ini terdapat tiga anggota dalam tim kami yaitu, Rifal Abdussyakur, Lintang Kesit Haniko dan Ahmad Nurrohim, ini merupakan pengalaman perdana bagi kami dalam pembuatan sebuah web yang bertujuan sebagai media pemasaran sebuah produk,kami sadar banyak kekurangan dan kesalahan pada hasil karya kami, oleh karena itu kritik dan saran yang membangun sangat kami butuhkan terima kasih :>
            </p>
        </div>
    </div>

    <!-- Produk -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Produk</h3>
            <div class="row mt-5">
                <?php while ($data = mysqli_fetch_array($queryProduk)) { ?>
                    <div class="col-sm-6 col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="image-box">
                                <img src="image/<?php echo $data['foto']; ?>" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $data['nama']; ?></h4>
                                <p class="card-text text-truncate"><?php echo $data['detail']; ?></p>
                                <p class="card-text text-harga">Rp <?php echo number_format($data['harga'], 0, ',', '.'); ?></p>
                                <a href="produk-detail.php?nama=<?php echo $data['nama']; ?>"
                                    class="btn warna2 text-white">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <a class="btn btn-outline-warning mt-3 fs-2" href="produk.php">Lihat Lebih Banyak</a>
        </div>
    </div>

    <!-- Footer -->
    <?php
    if (file_exists('footer.php')) {
        require 'footer.php';
    } else {
        echo '<footer class="footer mt-auto py-3 bg-light">
                <div class="container">
                    <span class="text-muted">&copy; 2024 Planet Bakso</span>
                </div>
              </footer>';
    }
    ?>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>

</html>
