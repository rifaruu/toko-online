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
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <style>
        .no-decoration {
            text-decoration: none;
        }

        .breadcrumb-item a {
            color: #6c757d;
        }

        .breadcrumb-item.active {
            color: #000;
        }

        .form-section {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table-section {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table thead th {
            background-color: #007bff;
            color: #ffffff;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-warning {
            color: #ffffff;
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .btn-warning:hover {
            color: #ffffff;
            background-color: #e0a800;
            border-color: #d39e00;
        }

        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php require "navbar.php"; ?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="../adminpanel/" class="no-decoration"><i class="fas fa-home"></i> Beranda</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Kategori
                </li>
            </ol>
        </nav>

        <div class="my-5 col-12 col-md-6 form-section">
            <h3>Tambah Kategori</h3>

            <form action="" method="post">
                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
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
                        echo "<div class='alert alert-warning'>Kategori sudah ada!</div>";
                    } else {
                        $querySimpan = mysqli_query($con, "INSERT INTO kategori (nama) VALUES ('$kategori')");
                        if ($querySimpan) {
                            echo "<div class='alert alert-success'>Kategori berhasil disimpan!</div>";
                            echo "<meta http-equiv='refresh' content='2'>";
                        } else {
                            echo "<div class='alert alert-danger'>Gagal menyimpan kategori!</div>";
                        }
                    }
                }
            ?>
        </div>

        <div class="mt-3 table-section">
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
