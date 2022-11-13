
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
        <link rel="shortcut icon" href="<?php echo base_url()?>assets/landing/images/favicon.ico">

        <link href="<?php echo base_url()?>assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
        <!--begin::Global Theme Styles(used by all pages) -->
		<link href="<?php echo base_url()?>assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url()?>assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="<?php echo base_url()?>assets/landing/css/bootstrap.min.css" type="text/css">

        <!-- Material Icon -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/landing/css/materialdesignicons.min.css" />

        <!-- Plugin -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/landing/css/owl.carousel.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/landing/css/owl.theme.default.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/landing/css/select2.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/landing/css/select2-bootstrap4.min.css">

        <!-- Custom  sCss -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/landing/css/style.css" />

    </head>

    <body>

        <!--Navbar Start-->
        <nav class="navbar navbar-expand-lg fixed-top navbar-custom sticky sticky-dark">
            <div class="container">
                <!-- LOGO -->
                <a class="logo text-uppercase" href="#">
                    <img src="<?php echo base_url()?>assets/landing/images/logo-light.png" class="logo-dark" alt="" height="60">
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="mdi mdi-menu"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav ml-auto navbar-center" id="mySidenav">
                        <li class="nav-item active">
                            <a href="#home" class="nav-link" onclick="window.location='<?php echo base_url();?>#home'">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="#about" class="nav-link" onclick="window.location='<?php echo base_url();?>#about'">About</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="#faq" class="nav-link">FAQ</a>
                        </li> -->
                        <li class="nav-item active">
                            <a href="#download" class="nav-link" onclick="window.location='<?php echo base_url().'download'?>'">Download</a>
                        </li>
                    </ul>
                    <button class="btn btn-success btn-rounded navbar-btn" onclick="window.location='<?php echo base_url().'login'?>'">Login</button>
                </div>
            </div>
        </nav>
        <!-- Navbar End -->

        
        <!-- Hero section Start -->
        <section class="hero-section-5" id="home"  style="background-image: url(<?php echo base_url()?>assets/landing/images/bg.jpg);">
            <div class="bg-overlay"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="hero-wrapper text-center mb-4">
                            <p class="font-16 text-uppercase text-white-50">VISIT TTCI </p>
                            <h1 class="hero-title text-white mb-4">Visualization and Integration</h1>
                            <p class="text-white">Travel and Tourism Competitiveness Index</p>
                        </div>

                    </div>
                </div>
                <!-- end row -->
            </div>
        </section>
        <!-- Hero section End -->

        <!-- Download start -->
        <section class="section bg-light" id="download">
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

        <!-- Footer alt start -->
        <section class="ttci-footer" id="download">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8 text-left">
                        <p class="copyright-desc mb-0">2020 © VISIT - Visualisasi & Integrasi TTCI</p>
                        <p class="ttci-footer-desc">Situs ini dikelola oleh Kementerian Pariwisata dan Ekonomi Kreatif/Badan Pariwisata dan Ekonomi Kreatif Republik Indonesia. Semua data yang tercantum di dalam situs ini bertujuan untuk memberikan informasi Indeks Daya Saing Pariwisata Indonesia yang dirilis oleh World Economic Forum (WEF)</p>
                    </div>
                    <div class="col-lg-4">
                        <div class="ttci-footer__sosmed">
                            <ul>
                                <li>
                                    <a href="https://www.facebook.com/ParekrafRI/" target="_blank"><span class="mdi mdi-facebook"></span></a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/Kemenparekraf" target="_blank"><span class="mdi mdi-twitter"></span></a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/kemenparekraf.ri/" target="_blank"><span class="mdi mdi-instagram"></span></a>
                                </li>
                                <li>
                                    <a href="https://www.youtube.com/channel/UClm8VHUZQnhFmIndX6oLgJA" target="_blank"><span class="mdi mdi-youtube"></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
        <!-- Footer alt start -->

        <!-- BACK TO TOP -->
        <button id="backToTop" class="backToTop-hidden"><span class="mdi mdi-chevron-up"></span></button>
        <!-- BACK TO TOP END -->

        <!-- Javascript -->
        <script src="<?php echo base_url()?>assets/landing/js/jquery.min.js"></script>
        <script src="<?php echo base_url()?>assets/landing/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo base_url()?>assets/landing/js/jquery.easing.min.js"></script>
        <script src="<?php echo base_url()?>assets/landing/js/scrollspy.min.js"></script>
        <script src="<?php echo base_url()?>assets/landing/js/feather.min.js"></script>

        <!-- Plugin -->
        <script src="<?php echo base_url()?>assets/landing/js/owl.carousel.min.js"></script>
        <script src="<?php echo base_url()?>assets/landing/js/select2.min.js"></script>

        <script>
        $(document).ready(function() {
            $('#chartdiv').load('<?php echo base_url()?>landing/Landing/chart_global?_=' + (new Date()).getTime());
        });
        </script>
        
        <!-- app js -->
        <script src="<?php echo base_url()?>assets/landing/js/app.js"></script>

        <script>
            $('#accordion').collapse({
                toggle: false
            })
        </script>

    </body>

</html>