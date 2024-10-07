<?php
require "session.php";
require "../koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus kategori berdasarkan ID
    $queryHapus = mysqli_query($con, "DELETE FROM kategori WHERE id='$id'");

    if ($queryHapus) {
        // Set session untuk pesan berhasil dihapus
        $_SESSION['status'] = 'success';
        $_SESSION['message'] = 'Kategori berhasil dihapus';
    } else {
        // Set session untuk pesan gagal dihapus
        $_SESSION['status'] = 'danger';
        $_SESSION['message'] = 'Gagal menghapus kategori';
    }

    // Redirect ke halaman kategori
    header("Location: kategori.php");
}
?>
