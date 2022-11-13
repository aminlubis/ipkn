
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VISIT - Visualisasi & Integrasi TTCI</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="NBS" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/new_landing/images/parekraf-logo-color.png') ?>">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/new_landing/css/bootstrap.min.css')?>" >

    <!-- Material Icon -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/new_landing/css/materialdesignicons.min.css')?>" />

    <!-- owl carousel -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/new_landing/css/owl.carousel.min.css')?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/new_landing/css/owl.theme.default.min.css')?>" />

    <!-- Custom  sCss -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/new_landing/css/style.css')?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/new-landing-custom.css')?>" />

</head>

<body>

<!--Navbar Start-->
<nav class="navbar navbar-expand-lg fixed-top navbar-custom sticky navbar-light sticky-dark">
    <div class="container">
        <!-- LOGO -->
        <a class="logo text-uppercase" href="<?= base_url('new_landing') ?>">
            <img src="<?php echo base_url()?>assets/new_landing/images/parekraf-logo-color.png" class="logo-light" alt="" height="60">
            <img src="<?php echo base_url()?>assets/new_landing/images/parekraf-logo-color.png" class="logo-dark" alt="" height="60">
            <span>Kementerian Pariwisata dan Ekonomi Kreatif/ Badan Pariwisata dan Ekonomi Kreatif, Republik Indonesia</span>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <i class="mdi mdi-menu"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-auto navbar-center" id="mySidenav">
                <li class="nav-item active">
                    <a href="#home" onclick="window.location = '<?= base_url() ?>'" class="nav-link">Beranda</a>
                </li>
                <li class="nav-item active">
                    <a href="#" onclick="window.location = '<?= base_url("about") ?>'" class="nav-link">Data TTCI</a>
                </li>
                <li class="nav-item active">
                    <a href="#download" onclick="window.location = '<?= base_url("new_landing/download") ?>'" class="nav-link">Download</a>
                </li>
            </ul>
            <button class="btn btn-success btn-rounded navbar-btn" onclick="window.location='<?= base_url('login')?>'">Login</button>

        </div>
    </div>
</nav>
<!-- Navbar End -->


<!-- Download start -->
<section class="section bg-light mt-5" id="download">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="mb-5 text-center">
                    <h5 class="text-uppercase small-title">Download</h5>
                    <h4 class="mb-3">Lampiran Dokumen</h4>
                    <p>Halaman ini berisi list file Laporan dan Metodologi TTCI yag dapat didownload sebagai rujukan dan acuan analisa. Silahkan digunakan sebagaimana mestinya.</p>
                </div>
            </div>
            <div class="col-lg-8">
                <div id="accordion" class="ttci-file">

                    <!-- START LOOP YEAR -->
                    <div class="card">
                        <div class="card-header" id="heading-2019">
                            <a role="button" data-toggle="collapse" href="#collapse-2021" aria-expanded="true" aria-controls="collapse-2021">
                                2021 <span class="mdi"></span>
                            </a>
                        </div>
                        <div id="collapse-2021" class="collapse show" data-parent="#accordion" aria-labelledby="heading-2021">
                            <div class="card-body">
                                <ul>
                                    <li><a href="<?php echo base_url().PATH_FILES.'WEF_Travel_Tourism_Development_2021.pdf'?>" target="_blank">WEF_Travel_Tourism_Development_2021.pdf</a></li>
                                    <li><a href="<?php echo base_url().PATH_FILES.'Laporan_TTCI_Booklet_20_01_2022.pdf'?>" target="_blank">Laporan_TTCI_Booklet_20_01_2022.pdf</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- END LOOP YEAR -->

                    <!-- START LOOP YEAR -->
                    <div class="card">
                        <div class="card-header" id="heading-2019">
                            <a role="button" data-toggle="collapse" href="#collapse-2019" aria-expanded="true" aria-controls="collapse-2019">
                                2019 <span class="mdi"></span>
                            </a>
                        </div>
                        <div id="collapse-2019" class="collapse show" data-parent="#accordion" aria-labelledby="heading-2019">
                            <div class="card-body">
                                <ul>
                                    <li><a href="<?php echo base_url().PATH_FILES.'TTCR_2019.pdf'?>" target="_blank">TTCR_2019.pdf</a></li>
                                    <li><a href="<?php echo base_url().PATH_FILES.'WEF_TTCI_2019_Profile_IDN.pdf'?>" target="_blank">WEF_TTCI_2019_Profile_IDN.pdf</a></li>
                                    <li><a href="<?php echo base_url().PATH_FILES.'TTCR-METHODOLOGY-B-C.pdf'?>" target="_blank">TTCR-METHODOLOGY-B-C.pdf</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- END LOOP YEAR -->

                    <!-- START LOOP YEAR -->
                    <div class="card">
                        <div class="card-header" id="heading-2017">
                            <a role="button" data-toggle="collapse" href="#collapse-2017" aria-expanded="trfaue" aria-controls="collapse-2017">
                                2017 <span class="mdi"></span>
                            </a>
                        </div>
                        <div id="collapse-2017" class="collapse" data-parent="#accordion" aria-labelledby="heading-2017">
                            <div class="card-body">
                                <ul>
                                    <li><a href="<?php echo base_url().PATH_FILES.'TTCR_2017.pdf'?>" target="_blank">TTCR_2017.pdf</a></li>
                                    <li><a href="<?php echo base_url().PATH_FILES.'WEF_TTCI_2017_Profile_IDN.pdf'?>" target="_blank">WEF_TTCI_2017_Profile_IDN.pdf</a></li>
                                    <li><a href="<?php echo base_url().PATH_FILES.'TTCR-METHODOLOGY-B-C.pdf'?>" target="_blank">TTCR-METHODOLOGY-B-C.pdf</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- END LOOP YEAR -->

                    <!-- START LOOP YEAR -->
                    <!-- <div class="card">
                                <div class="card-header" id="heading-2015">
                                    <a role="button" data-toggle="collapse" href="#collapse-2015" aria-expanded="true" aria-controls="collapse-2015">
                                        2015 <span class="mdi"></span>
                                    </a>
                                </div>
                                <div id="collapse-2015" class="collapse show" data-parent="#accordion" aria-labelledby="heading-2015">
                                    <div class="card-body">
                                        <div id="accordion-2015">
                                            <div class="card">
                                                <div class="card-header" id="heading-2015-1">
                                                    <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-2015-1" aria-expanded="false" aria-controls="collapse-2015-1">
                                                        Metodologi
                                                    </a>
                                                </div>
                                                <div id="collapse-2015-1" class="collapse" data-parent="#accordion-2015" aria-labelledby="heading-2015-1">
                                                    <div class="card-body">
                                                        <ul>
                                                            <li><a href="<?php echo base_url().PATH_FILES.''?>" target="_blank">Data TTCR 2015.PDF</a></li>
                                                            <li><a href="<?php echo base_url().PATH_FILES.''?>" target="_blank">Data TTCR 2015.PDF</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" id="heading-2015-2">
                                                    <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-2015-2" aria-expanded="false" aria-controls="collapse-2015-2">
                                                        Report
                                                    </a>
                                                </div>
                                                <div id="collapse-2015-2" class="collapse" data-parent="#accordion-2015" aria-labelledby="heading-2015-2">
                                                    <div class="card-body">
                                                        <ul>
                                                            <li><a href="<?php echo base_url().PATH_FILES.''?>" target="_blank">Data TTCR 2015.PDF</a></li>
                                                            <li><a href="<?php echo base_url().PATH_FILES.''?>" target="_blank">Data TTCR 2015.PDF</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                    <!-- END LOOP YEAR -->

                    <div class="card">
                        <div class="card-header" id="heading-2015">
                            <a role="button" data-toggle="collapse" href="#collapse-2015" aria-expanded="true" aria-controls="collapse-2015">
                                2015 <span class="mdi"></span>
                            </a>
                        </div>
                        <div id="collapse-2015" class="collapse" data-parent="#accordion" aria-labelledby="heading-2015">
                            <div class="card-body">
                                <ul>
                                    <li><a href="<?php echo base_url().PATH_FILES.'TTCR_2015.pdf'?>" target="_blank">TTCR_2015.pdf</a></li>
                                    <li><a href="<?php echo base_url().PATH_FILES.'TTCR-METHODOLOGY-B-C.pdf'?>" target="_blank">TTCR-METHODOLOGY-B-C.pdf</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</section>
<!-- Download end -->

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
                    <p>Kementerian Pariwisata dan Ekonomi Kreatif/Badan Pariwisata dan Ekonomi Kreatif merupakan Lembaga Pemerintah yang memiliki tugas menyelenggarakan urusan pemerintahan di bidang kepariwisataan  dan di bidang ekonomi kreatif untuk membantu Presiden dalam menyelenggarakan pemerintahan negara.</p>
                </div>
                <div class="offset-3">
                </div>
                <div class="col-md-5">
                    <h4 class="footer-header">Hubungi Kami</h4>
                    <div class="footer-title">Alamat</div>
                    <p>Sapta Pesona building, Jl. Medan Merdeka Barat No.17, RT.2/RW.3, Gambir, Kecamatan Gambir, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10110</p>
                    <ul class="footer-social">
                        <li>
                            <a href="https://www.instagram.com/kemenparekraf.ri" class="footer-social-instagram"><i class="fab fa-instagram"></i></a>
                        </li>
                        <li>
                            <a href="https://www.facebook.com/ParekrafRI/" class="footer-social-facebook"><i class="fab fa-facebook-f"></i></a>
                        </li>
                        <li>
                            <a href="https://twitter.com/Kemenparekraf" class="footer-social-twitter"><i class="fab fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="https://www.youtube.com/channel/UClm8VHUZQnhFmIndX6oLgJA" class="footer-social-youtube"><i class="fab fa-youtube"></i></a>
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
<script src="<?php echo base_url('assets/landing/js/select2.min.js')?>"></script>

<!-- app js -->
<script src="<?= base_url('assets/new_landing/js/app.js') ?>"></script>


<script>
    $('#accordion').collapse({
        toggle: false
    })
</script>
</body>

</html>