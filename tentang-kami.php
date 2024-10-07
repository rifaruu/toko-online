<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planet Bakso | Tentang Kami</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .banner2 {
    background-image: url('image/banner.jpg');
    background-size: cover;
    background-position: center;
    height: 300px; /* Atur tinggi sesuai kebutuhan */
}

    </style>
</head>

<body>
    <?php require "navbar.php"; ?>


    <!-- banner -->
    <div class="container-fluid banner2 d-flex align-items-center">
        <div class="container">
            <h1 class="text-white text-center">Tentang Kami</h1>
        </div>
    </div>

    <!-- Tentang Kami -->
    <div class="container-fluid warna4 py-5">
        <div class="container text-center">
            <p class="fs-5">
            Kami merupakan mahasiswa UNUGHA Teknik Informatika,dalam project kali ini terdapat tiga anggota dalam tim kami yaitu, Rifal Abdussyakur, Lintang Kesit Haniko dan Ahmad Nurrohim, ini merupakan pengalaman perdana bagi kami dalam pembuatan sebuah web yang bertujuan sebagai media pemasaran sebuah produk,kami sadar banyak kekurangan dan kesalahan pada hasil karya kami, oleh karena itu kritik dan saran yang membangun sangat kami butuhkan terima kasih.
            </p>
            <!-- <p class="fs-5">
                Menyelami Kehebatan Proyek Web

                Proyek web ini bukan sekadar tugas akhir biasa. Di dalamnya terpancar semangat inovatif dan tekad untuk
                menghasilkan karya yang bermanfaat dan memukau. Perpaduan keahlian "Rifal Abdussyakur, Lintang Kesit.H.,
                dan Akhmad Nurrohim" telah menghasilkan sebuah web yang:

                Fungsional dan Interaktif: Pengguna akan dimanjakan dengan kemudahan navigasi dan fitur-fitur menarik
                yang memanjakan interaksi.
                Desain Menawan: Tampilan web memancarkan estetika visual yang memikat dan selaras dengan fungsinya.
                Teknologi Mutakhir: Pemanfaatan teknologi web terkini memastikan performa yang optimal dan pengalaman
                pengguna yang maksimal.
                Manfaat Nyata: Proyek ini tidak hanya indah dan canggih, tetapi juga menawarkan nilai dan manfaat nyata
                bagi penggunanya.
            </p>
            <p class="fs-5">
                Apresiasi dan Penghargaan

                Karya luar biasa "Rifal Abdussyakur, Lintang Kesit.H., dan Akhmad Nurrohim" patut diapresiasi dan
                dibanggakan. Dedikasi dan ketekunan mereka dalam mempelajari dan menguasai pemrograman web telah
                membuahkan hasil yang gemilang. Kemampuan mereka dalam menggabungkan fungsionalitas, desain, dan
                teknologi dengan apik menunjukkan potensi mereka sebagai programmer web yang handal di masa depan.
            </p>
            <p class="fs-5">
                Penutup

                Proyek web ini menjadi inspirasi bagi para mahasiswa lain untuk terus berkarya dan berinovasi di bidang
                pemrograman web. Kami yakin "Rifal Abdussyakur, Lintang Kesit.H., dan Akhmad Nurrohim" akan terus
                berkembang dan mencapai kesuksesan di masa depan.

                Mari kita nantikan karya-karya luar biasa mereka selanjutnya!
            </p> -->

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
