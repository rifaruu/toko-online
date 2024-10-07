<?php
require "session.php";
require "../koneksi.php";

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $stmt = $con->prepare("SELECT * FROM kategori WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if (!$data) {
        $_SESSION['status'] = 'danger';
        $_SESSION['message'] = 'Kategori tidak ditemukan';
        header('Location: kategori.php');
        exit();
    }
} else {
    $_SESSION['status'] = 'danger';
    $_SESSION['message'] = 'ID tidak valid';
    header('Location: kategori.php');
    exit();
}

if (isset($_POST['editBtn'])) {
    $kategori = htmlspecialchars($_POST['kategori']);

    if ($data['nama'] == $kategori) {
        $_SESSION['status'] = 'info';
        $_SESSION['message'] = 'Kategori tidak berubah';
        header('Refresh: 2; url=edit_kategori.php?id=' . $id);
    } else {
        // Cek apakah nama kategori sudah ada, kecuali kategori dengan ID saat ini
        $stmtExist = $con->prepare("SELECT nama FROM kategori WHERE nama = ? AND id != ?");
        $stmtExist->bind_param("si", $kategori, $id);
        $stmtExist->execute();
        $resultExist = $stmtExist->get_result();
        $jumlahDataKategoriBaru = $resultExist->num_rows;

        if ($jumlahDataKategoriBaru == 0) {
            $stmtUpdate = $con->prepare("UPDATE kategori SET nama = ? WHERE id = ?");
            $stmtUpdate->bind_param("si", $kategori, $id);
            if ($stmtUpdate->execute()) {
                $_SESSION['status'] = 'success';
                $_SESSION['message'] = 'Kategori berhasil diupdate';
                header('Refresh: 2; url=kategori.php');
            } else {
                $_SESSION['status'] = 'danger';
                $_SESSION['message'] = 'Gagal mengupdate kategori';
                header('Refresh: 2; url=edit_kategori.php?id=' . $id);
            }
        } else {
            $_SESSION['status'] = 'warning';
            $_SESSION['message'] = 'Kategori sudah ada';
            header('Refresh: 2; url=edit_kategori.php?id=' . $id);
        }
    }
}

if (isset($_GET['deleted'])) {
    $_SESSION['status'] = 'success';
    $_SESSION['message'] = 'Kategori berhasil dihapus';
    header('Refresh: 2; url=kategori.php');
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kategori</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
</head>
<body>
    <?php require "navbar.php"; ?>

    <div class="container mt-5">
        <h2>Detail Kategori</h2>
        
        <div class="col-12 col-md-6">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <input type="text" name="kategori" id="kategori" class="form-control" value="<?php echo htmlspecialchars(trim($data['nama'])); ?>">
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary" name="editBtn">Edit</button>
                    <a href="hapus_kategori.php?id=<?php echo $id; ?>&deleted=true" class="btn btn-danger ml-2" onclick="return confirm('Anda yakin ingin menghapus kategori ini?')">Hapus</a>
                </div>
            </form>

            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-<?php echo $_SESSION['status']; ?> mt-3" role="alert">
                    <?php echo htmlspecialchars($_SESSION['message']); ?>
                </div>
                <?php
                unset($_SESSION['message']);
                unset($_SESSION['status']);
                ?>
            <?php endif; ?>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>
