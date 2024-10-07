<?php
require "session.php";
require "../koneksi.php";

$id = $_GET['id'];

// Cek apakah kategori sudah digunakan di produk
$queryCheck = mysqli_query($con, "SELECT COUNT(*) as count FROM produk WHERE kategori_id='$id'");
$dataCheck = mysqli_fetch_array($queryCheck);

if ($dataCheck['count'] > 0) {
    $_SESSION['status'] = 'warning';
    $_SESSION['message'] = 'Kategori tidak bisa dihapus karena sudah digunakan di produk';
    echo '<meta http-equiv="refresh" content="2; url=edit_kategori.php?id=' . $id . '">';
} else {
    // Lanjutkan dengan penghapusan kategori
    $query = mysqli_query($con, "DELETE FROM kategori WHERE id='$id'");
    if ($query) {
        $_SESSION['status'] = 'success';
        $_SESSION['message'] = 'Kategori berhasil dihapus';
        echo '<meta http-equiv="refresh" content="2; url=edit_kategori.php?deleted=true">';
    } else {
        $_SESSION['status'] = 'danger';
        $_SESSION['message'] = 'Gagal menghapus kategori';
        echo '<meta http-equiv="refresh" content="2; url=edit_kategori.php?id=' . $id . '">';
    }
}
?>
