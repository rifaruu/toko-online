<?php
    require "session.php";
    require "../koneksi.php";

    $query = mysqli_query($con, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id=b.id");
    $jumlahProduk = mysqli_num_rows($query);
    
    $queryKategori = mysqli_query($con, "SELECT * FROM kategori");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <style>
        .no-decoration {
            text-decoration: none;
        }
        form div {
            margin-bottom: 10px;
        }
        .breadcrumb a {
            color: #808080;
            text-decoration: none;
        }
        .breadcrumb a:hover {
            color: #0056b3;
            text-decoration: none;
        }
        .breadcrumb-item.active {
            color: #6c757d;
        }
        .btn-custom {
            background-color: #0d6efd;
            color: white;
        }
        .btn-custom:hover {
            background-color: #0b5ed7;
        }
        .form-control, .form-select {
            border-radius: 0.25rem;
        }
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <?php require "navbar.php"; ?>
    
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="../adminpanel/" class="no-decoration"><i class="fas fa-home" ></i> Beranda</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Produk
                </li>
            </ol>
        </nav>

        <div class="my-5 col-12 col-md-6">
            <h3>Tambah Produk</h3>
            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" class="form-control" autocomplete="off">
                </div>
                <div>
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" class="form-select">
                        <option value="">Pilih Satu</option>
                        <?php while($data=mysqli_fetch_array($queryKategori)): ?>
                            <option value="<?php echo $data['id']; ?>"><?php echo $data['nama']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div>
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control" name="harga">
                </div>
                <div>
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>
                <div>
                    <label for="detail">Detail</label>
                    <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div>
                    <label for="ketersediaan_stok">Ketersediaan Stok</label>
                    <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-select">
                        <option value="tersedia">Tersedia</option>
                        <option value="habis">Habis</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-custom" name="simpan">Simpan</button>
                </div>
            </form>

            <?php if(isset($_POST['simpan'])): ?>
                <?php
                    $nama = htmlspecialchars($_POST['nama']);
                    $kategori = htmlspecialchars($_POST['kategori']);
                    $harga = htmlspecialchars($_POST['harga']);
                    $detail = htmlspecialchars($_POST['detail']);
                    $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);

                    $target_dir = "../image/";
                    $nama_file = basename($_FILES["foto"]["name"]);
                    $target_file = $target_dir . $nama_file;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $image_size = $_FILES["foto"]["size"];

                    if ($nama == '' || $kategori == '' || $harga == ''):
                ?>
                    <div class='alert alert-warning mt-3'>Nama, kategori, dan harga wajib diisi!</div>
                <?php else: ?>
                    <?php if ($nama_file != ''): ?>
                        <?php if ($image_size > 5000000): ?>
                            <div class="alert alert-warning mt-3" role="alert">File melebihi 5 MB!</div>
                        <?php elseif (!in_array($imageFileType, ['jpg', 'png', 'gif', 'jpeg'])): ?>
                            <div class="alert alert-warning mt-3" role="alert">File tidak valid!</div>
                        <?php else: ?>
                            <?php move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file); ?>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php
                        // Query insert to produk table
                        $queryTambah = mysqli_query($con, "INSERT INTO produk(kategori_id, nama, harga, foto, detail, ketersediaan_stok) VALUES ('$kategori', '$nama', '$harga', '$target_file', '$detail', '$ketersediaan_stok')");

                        if ($queryTambah):
                    ?>
                        <div class="alert alert-primary mt-3" role="alert">Produk berhasil tersimpan</div>
                        <meta http-equiv="refresh" content="2; url=produk.php" />
                    <?php else: ?>
                        <div class="alert alert-danger mt-3" role="alert"><?php echo mysqli_error($con); ?></div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <div class="mt-3 mb-5">
            <h2>List Produk</h2>
            <div class="table-responsive mt-5">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Ketersediaan Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead> 
                    <tbody>
                        <?php if ($jumlahProduk == 0): ?>
                            <tr>
                                <td colspan='6' class='text-center'>Tidak ada data Produk</td>
                            </tr>
                        <?php else: ?>
                            <?php $jumlah = 1; ?>
                            <?php while($data = mysqli_fetch_array($query)): ?>
                                <tr>
                                    <td><?php echo $jumlah; ?></td>
                                    <td><?php echo $data['nama']; ?></td>
                                    <td><?php echo $data['nama_kategori']; ?></td>
                                    <td><?php echo 'Rp ' . number_format($data['harga'], 0, ',', '.'); ?></td>
                                    <td><?php echo ucfirst($data['ketersediaan_stok']); ?></td>
                                    <td>
                                        <a href="produk-detail.php?p=<?php echo $data['id']; ?>" class="btn btn-info"><i class="fas fa-search"></i></a>
                                    </td>
                                </tr>
                                <?php $jumlah++; ?>
                            <?php endwhile; ?>
                        <?php endif; ?>    
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>    
</body>
</html>
