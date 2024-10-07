<?php
require "session.php";
require "../koneksi.php";

$id = $_GET['id'];

$query = mysqli_query($con, "SELECT * FROM kategori WHERE id='$id'");
$data = mysqli_fetch_array($query);

if (isset($_POST['editBtn'])) {
    $kategori = htmlspecialchars($_POST['kategori']);

    if ($data['nama'] == $kategori) {
        echo '<div class="alert alert-info mt-3" role="alert">Kategori tidak berubah</div>';
        echo '<meta http-equiv="refresh" content="2; url=kategori.php" />';
    } else {
        // Cek apakah nama kategori sudah ada, kecuali kategori dengan ID saat ini
        $queryExist = mysqli_query($con, "SELECT nama FROM kategori WHERE nama='$kategori' AND id != '$id'");
        $jumlahDataKategoriBaru = mysqli_num_rows($queryExist);

        if ($jumlahDataKategoriBaru == 0) {
            $queryUpdate = mysqli_query($con, "UPDATE kategori SET nama='$kategori' WHERE id='$id'");
            if ($queryUpdate) {
                $_SESSION['status'] = 'success';
                $_SESSION['message'] = 'Kategori berhasil diupdate';
                echo '<meta http-equiv="refresh" content="2; url=kategori.php" />';
            } else {
                $_SESSION['status'] = 'danger';
                $_SESSION['message'] = 'Gagal mengupdate kategori';
            }
        } else {
            $_SESSION['status'] = 'warning';
            $_SESSION['message'] = 'Kategori sudah ada';
            echo '<meta http-equiv="refresh" content="2; url=kategori.php" />';
        }
    }
}

// Tambahkan script JavaScript untuk menampilkan alert dan redirect setelah tombol hapus diklik
if (isset($_GET['deleted'])) {
    echo '<script>
            setTimeout(function(){
                alert("Kategori berhasil dihapus");
                window.location.href = "kategori.php";
            }, 2000);
        </script>';
        echo "<meta http-equiv='refresh' content='2; url=edit_kategori.php'>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kategori</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>
<body>
    <?php require "navbar.php"; ?>

    <div class="container mt-5">
        <h2>Detail Kategori</h2>
        
        <div class="col-12 col-md-6">
            <?php
            if (isset($_SESSION['message'])) {
                echo '<div class="alert alert-' . $_SESSION['status'] . ' mt-3" role="alert">' . $_SESSION['message'] . '</div>';
                unset($_SESSION['message']);
                unset($_SESSION['status']);
            }
            ?>
        
            <form action="" method="post">
                <div>
                    <label for="kategori">Kategori</label>
                    <input type="text" name="kategori" id="kategori" class="form-control" value="<?php echo trim($data['nama']); ?>">
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary" name="editBtn">Edit</button>
                    <a href="hapus_kategori.php?id=<?php echo $id; ?>&deleted=true" class="btn btn-danger ml-2" onclick="return confirm('Anda yakin ingin menghapus kategori ini?')">Hapus</a>
                </div>
            </form>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
