<?php
    require "session.php";
    require "../koneksi.php";

    $queryKategori = mysqli_query($con, "SELECT * FROM kategori");
    $jumlahKategori = mysqli_num_rows($queryKategori);
    $number = 1;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>

<style>
.no-decoration {
    text-decoration: none;
}
</style>  

<body>
    <?php require "navbar.php"; ?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="../adminpanel/" class="no-decoration text-muted"><i class="fas fa-home"></i> Beranda</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Kategori
                </li>
            </ol>
        </nav>

        <div class="my-5 col-12 col-md-6">
            <h3>Tambah Kategori</h3>

            <form action="" method="post">
                <div>
                    <label for="kategori">Kategori</label>
                    <input type="text" id="kategori" name="kategori" placeholder="Input nama kategori" class="form-control" required>
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary" type="submit" name="simpan_kategori">Simpan</button>
                </div>
            </form>

            <?php
                if (isset($_POST['simpan_kategori'])) {
                    $kategori = htmlspecialchars($_POST['kategori']);

                    $queryExist = mysqli_query($con, "SELECT nama FROM kategori WHERE nama='$kategori'");
                    $jumlahDataKategoriBaru = mysqli_num_rows($queryExist);

                    if ($jumlahDataKategoriBaru > 0) {
                        echo "<div class='alert alert-warning mt-3'>Kategori sudah ada!</div>";
                    } else {
                        $querySimpan = mysqli_query($con, "INSERT INTO kategori (nama) VALUES ('$kategori')");
                        if ($querySimpan) {
                            echo "<div class='alert alert-success mt-3'>Kategori berhasil disimpan!</div>";
                            echo "<meta http-equiv='refresh' content='2'>";
                        } else {
                            echo "<div class='alert alert-danger mt-3'>Gagal menyimpan kategori!</div>";
                        }
                    }
                }
            ?>
        </div>

        <div class="mt-3">
            <h2>List Kategori</h2>

            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if ($jumlahKategori == 0) {
                                echo "<tr><td colspan='3' class='text-center'>Tidak ada data kategori</td></tr>";
                            } else {
                                while ($data = mysqli_fetch_array($queryKategori)) {
                                    echo "<tr>";
                                    echo "<td>" . $number . "</td>";
                                    echo "<td>" . $data['nama'] . "</td>";
                                    echo "<td><a href='edit_kategori.php?id=" . $data['id'] . "' class='btn btn-warning btn-sm'>Edit</a></td>";
                                    echo "</tr>";
                                    $number++;
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>    
</body>
</html>
