<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VISIT - Visualisasi & Integrasi TTCI</title>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="author" content="NBS"/>

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/new_landing/images/parekraf-logo-color.png') ?>">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/new_landing/css/bootstrap.min.css') ?>">

    <!-- Material Icon -->
    <link rel="stylesheet" type="text/css"
          href="<?= base_url('assets/new_landing/css/materialdesignicons.min.css') ?>"/>

    <!-- owl carousel -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/new_landing/css/owl.carousel.min.css') ?>"/>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/new_landing/css/owl.theme.default.min.css') ?>"/>

    <!-- Custom  sCss -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/new_landing/css/style.css') ?>"/>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/new-landing-custom.css') ?>"/>

</head>

<body>

<!--Navbar Start-->
<nav class="navbar navbar-expand-lg fixed-top navbar-custom sticky navbar-light sticky-dark">
    <div class="container">
        <!-- LOGO -->
        <a class="logo text-uppercase" href="<?= base_url('new_landing') ?>">
            <img src="<?php echo base_url() ?>assets/new_landing/images/parekraf-logo-color.png" class="logo-light"
                 alt="" height="60">
            <img src="<?php echo base_url() ?>assets/new_landing/images/parekraf-logo-color.png" class="logo-dark"
                 alt="" height="60">
            <span>Kementerian Pariwisata dan Ekonomi Kreatif/ Badan Pariwisata dan Ekonomi Kreatif, Republik Indonesia</span>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <i class="mdi mdi-menu"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-auto navbar-center" id="mySidenav">
                <li class="nav-item active">
                    <a href="#home" onclick="window.location = '<?= base_url() ?>'" class="nav-link">Beranda</a>
                </li>
                <li class="nav-item active">
                    <a href="#about" onclick="window.location = '<?= base_url("about") ?>'" class="nav-link">
                        Data TTCI
                    </a>
                </li>
                <li class="nav-item active">
                    <a href="#download" onclick="window.location = '<?= base_url("new_landing/download") ?>'"
                       class="nav-link">Download</a>
                </li>
            </ul>
            <button class="btn btn-primary btn-rounded navbar-btn"
                    onclick="window.location='<?= base_url('login') ?>'">Login
            </button>

        </div>
    </div>
</nav>
<!-- Navbar End -->

<!-- Hero section Start -->
<section class="hero-section" id="home">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="hero-wrapper mb-4">
                    <h1 class="hero-title mb-4 text-title">Selamat Datang di Website <span class="text-primary">TTCI (Travel and Tourism Competitive Index)</span>
                    </h1>
                    <p>
                        Website Ini bertujuan untuk mengkordinasikan Kolaborasi
                        Kementerian Pariwisata dan Ekonomi Kreatif Dalam Menaikkan Peringkat TTCi Indonesia di Tingkat
                        Dunia
                    </p>

                    <div class="mt-4">
                        <a href="<?= base_url('about') ?>" class="btn btn-primary mt-2 mr-2">Pelajari Lebih Lanjut</a>
                    </div>
                </div>

            </div>

            <div class="col-lg-6 col-sm-8">
                <div class="home-img mt-5 mt-lg-0">
                    <img src="<?= base_url('assets/new_landing/images/about-1.png') ?>" alt=""
                         class="img-fluid mx-auto d-block">
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</section>
<!-- Hero section End -->

<!-- Features start -->
<section class="section" id="features">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <h4 class="mb-3">Apa yang dimaksud TTCI ?</h4>
                    <p>Travel and Tourism Competitive Index</p>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-lg-5">
                <div class="mt-5 pt-3">
                    <h5 class="text-primary">TTCI Adalah sebuah acuan peringkat Global</h5>
                    <p class="mb-4 text-justify">
                        TTCI (Travel and Tourism Competitiveness Index) adalah Indeks Daya Saing
                        Pariwisata yang dirilis oleh World Economic Forum (WEF). Penilaian TTCI
                        dikeluarkan oleh WEF dua tahun sekali kepada 140 negara di dunia.
                        Penilaian TTCI dilakukan dengan menggunakan data 19 Kementerian/
                        Lembaga di Indonesia sehingga sangat penting untuk diintegrasikan dan
                        tersistem dengan baik.
                    </p>
                </div>
            </div>

            <div class="col-lg-5 ml-lg-auto col-sm-8">
                <img src="<?= base_url('assets/new_landing/images/about-2.png') ?>" alt=""
                     class="img-fluid mx-auto d-block">
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</section>
<!-- Features start -->
<section class="section bg-primary" id="features">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-sm-8">
                <img src="<?= base_url('assets/new_landing/images/about-3.png') ?>" alt=""
                     class="img-fluid mx-auto d-block">
            </div>
            <div class="col-lg-5 ml-lg-auto">
                <div class="mt-5 pt-3">
                    <h5 class="text-title">TARGET PENINGKATAN RANKING TTCI INDONESIA</h5>
                    <p class="mb-4 text-justify">
                        Tujuan dari dibangunnya sistem ini adalah untuk mengintegrasikan
                        pengelolaan dan penanganan TTCI kedalam gugus tugas lintas K/L, serta
                        memperbaiki cara pengumpulan data lintas K/L melalui teknologi informasi.
                        VISIT TTCI menjadi sangat strategis karena didalamnya merupakan bentuk
                        kolaborasi dan integrasi lintas K/L dengan tujuan bersama yaitu
                        meningkatkan peringkat TTCI Indonesia.
                    </p>
                    <div>
                        <a href="<?= base_url("new_landing/download") ?>" class="btn btn-primary mt-2 mr-2">
                            Lihat Laporan TTCI
                        </a>
                    </div>
                </div>
            </div>

        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</section>
<!-- Features end -->


<!-- Services start -->
<section class="section bg-light" id="services">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <h5 class="text-primary text-uppercase small-title">Seberapa penting peranan TTCI</h5>
                    <h4 class="mb-3">Peranan Travel and Tourism Competitive Index</h4>
                    <p>TTCI Berperan dalam menentukan arah dan kualitas pariwisata indonesia
                        dalam pandangan dunia</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-sm-6">
                <div class="text-center p-4 mt-3">
                    <div class="avatar-md mx-auto mb-4">
                        <span class="avatar-title rounded-circle bg-primary">
                            01
                        </span>
                    </div>
                    <p class="mb-0">Sebagai standar global untuk meningkatkan citra pariwasata indonesia</p>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6">
                <div class="text-center p-4 mt-3">
                    <div class="avatar-md mx-auto mb-4">
                        <span class="avatar-title rounded-circle bg-primary">
                            02
                        </span>
                    </div>
                    <p class="mb-0">Memiliki nilai untik dijual kepada calon wisatawan mancananegar sehingga
                        miningkatkan kunjungan wisatawan mancanegara</p>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6">
                <div class="text-center p-4 mt-3">
                    <div class="avatar-md mx-auto mb-4">
                        <span class="avatar-title rounded-circle bg-primary">
                            03
                        </span>
                    </div>
                    <p class="mb-0">Sebagai sala satu alat promosi yang efektif guna mendatangkan inverstor bidang
                        pariwisata</p>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</section>
<!-- Services end -->

<!-- Counter start -->
<section class="section bg-primary">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-7">
                <div class="text-center text-white-50">
                    <h4 class="text-white">
                        Perjalanan kami sudah cukup panjang dalam menaikan level TTCI indonesia
                        agar semakin tinggi di tingkat dunia
                    </h4>
                </div>
            </div>
        </div>
        <div class="row" id="counter">
            <div class="col-xl-3 col-sm-6">
                <div class="text-center mt-4">
                    <i class="fas fa-building fa-3x"></i>
                    <h2 class="counter-value text-white mt-4" data-count="<?php echo $kementerian; ?>">0</h2>
                    <p class="font-16 text-white-50">Kementerian</p>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6">
                <div class="text-center mt-4">
                    <i class="fas fa-calendar-alt  fa-3x"></i>
                    <h2 class="counter-value text-white mt-4" data-count="2">0</h2>
                    <p class="font-16 text-white-50">Periode Berjalan</p>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6">
                <div class="text-center mt-4">
                    <i class="fas fa-layer-group  fa-3x"></i>
                    <h2 class="counter-value text-white mt-4" data-count="<?php echo $total_subpillar; ?>">0</h2>
                    <p class="font-16 text-white-50">Subpilar</p>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="text-center mt-4">
                    <i class="fas fa-star  fa-3x"></i>
                    <h2 class="counter-value text-white mt-4" data-count="40">0</h2>
                    <p class="font-16 text-white-50">Ranking 2019</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end container -->
</section>
<!-- Counter end -->

<!-- Pricing start -->
<section class="section bg-light" id="pricing">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <h4 class="mb-3">Lebih Dalam Tentang Data TTCI Indonesia</h4>
                    <p>
                        Apa saja yang mempengaruhi perubahan data dan bagaimana peringkat TTCI dapat meningkat atau
                        menurun?
                        Klik Tombol Dibawah untuk mengetahui lebih detail
                    </p>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="text-center mb-4">
                    <a href="<?= base_url('about'); ?>" class="btn btn-primary">Tentang TTCI</a>
                </div>
            </div>
        </div>

        <!-- end row -->
    </div>
    <!-- end container -->
</section>
<!-- Pricing end -->

<!-- Cta start -->
<!-- Cta end -->

<!-- Footer start -->
<footer id="footer">
    <div class="footer-main">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="logo">
                        <img src="<?= base_url('assets/new_landing/images/logo-footer.png') ?>" alt="TTCI">
                    </div>
                    <p>Kementerian Pariwisata dan Ekonomi Kreatif/Badan Pariwisata dan Ekonomi Kreatif merupakan Lembaga
                        Pemerintah yang memiliki tugas menyelenggarakan urusan pemerintahan di bidang kepariwisataan dan
                        di bidang ekonomi kreatif untuk membantu Presiden dalam menyelenggarakan pemerintahan
                        negara.</p>
                </div>
                <div class="offset-3">
                </div>
                <div class="col-md-5">
                    <h4 class="footer-header">Hubungi Kami</h4>
                    <div class="footer-title">Alamat</div>
                    <p>Sapta Pesona building, Jl. Medan Merdeka Barat No.17, RT.2/RW.3, Gambir, Kecamatan Gambir, Kota
                        Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10110</p>
                    <ul class="footer-social">
                        <li>
                            <a href="https://www.instagram.com/kemenparekraf.ri" class="footer-social-instagram"><i
                                        class="fab fa-instagram"></i></a>
                        </li>
                        <li>
                            <a href="https://www.facebook.com/ParekrafRI/" class="footer-social-facebook"><i
                                        class="fab fa-facebook-f"></i></a>
                        </li>
                        <li>
                            <a href="https://twitter.com/Kemenparekraf" class="footer-social-twitter"><i
                                        class="fab fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="https://www.youtube.com/channel/UClm8VHUZQnhFmIndX6oLgJA"
                               class="footer-social-youtube"><i class="fab fa-youtube"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Footer alt start -->
<!-- Footer alt start -->

<!-- Javascript -->
<script src="<?= base_url('assets/new_landing/js/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/new_landing/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/new_landing/js/jquery.easing.min.js') ?>"></script>
<script src="<?= base_url('assets/new_landing/js/scrollspy.min.js') ?>"></script>
<script src="<?= base_url('assets/new_landing/js/feather.min.js') ?>"></script>

<!-- owl carousel -->
<script src="<?= base_url('assets/new_landing/js/owl.carousel.min.js') ?>"></script>

<!-- app js -->
<script src="<?= base_url('assets/new_landing/js/app.js') ?>"></script>

</body>

</html>