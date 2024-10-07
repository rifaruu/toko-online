<?php
    require "koneksi.php";

    $requerykategori = mysqli_query($con, " SELECT * FROM kategori");

    // get produk by nama produk/keyword
    if(isset($_GET['keyword'])){
        $requerykategori = mysqli_query($con,"SELECT * FROM produk WHERE nama LIKE '%$_GET[keyword]%'");
    }
    // get produk by kategori
    else if(isset($_GET['kategori'])){
        $requerykategori = mysqli_query($con,"SELECT id FROM kategori WHERE nama='$_GET[kategori]'");
        $kategori = mysqli_fetch_array($requerykategoriId);

        $queryKategori = mysqli_query($con,"SELECT * FROM produk WHERE kategori_id='$kategoriId[id]'");
    }
    // get produk default
    else{
        $queryKategori = mysqli_query($con,"SELECT * FROM produk");
    }
    $countProduk = mysqli_num_rows($queryProduk);
    echo $countData;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible"content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online | Produk</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
</head>
<body>
    <?php require "navbar.php"; ?>

    <!-- banner -->
     <div class=" container- fluid banner-produk d-flex align- items-center">
        <div class="container">
            <h1 class="text-white text-white">Produk</h1>
        </div>
     </div>
     <!-- body -->
      <div class="container py-5">
        <div class="row">
            <div class="col-lg-3 mb-5">
                <ul class="list-group">
                    <?php while($kategori = mysqli_fetch_array($requerykategori)) { ?>
                    <a class="no-decoration" href="produk.php?kategori=<?php echo $kategori['nama']; ?>">
                        <li class="list-group-items"><?php echo $kategori['nama']; ?></li>
                    </a>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-lg-9"></div>
                <h3 class="text-center mb-3">produk</h3>
            <div class="row">
                <?php
                   if($countData){
                ?>
                    <h4 class="text-center my-5">Produk yang anda cari tidak tersedia</h4>
                <?php
                   }

                ?>
                <?php while($produk = mysqli_fetch_array($requeryProduk)) { ?>
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="image-box">
                            <img src="image/<?php echo $produk['foto'];?> class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $produk['nama']; ?></h4>
                            <p class="card-text text-truncate"><?php echo $produk['detail']; ?></p>
                            <p class="card-text text-harga">Rp <?php echo $produk['harga']; ?></p>
                            <a href="produk-detail.php?nama=<?php echo $produk['nama']; ?>"class="btn warna2 text-white">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
      </div>

      <!-- footer -->
       <?php require "footer.php"; ?>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>

</body>
</html>