<!DOCTYPE html>

<html lang="en">

	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>TTCI - Dashboard System</title>
		<meta name="description" content="Support center faq example">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!--begin::Page Custom Styles(used by this page) -->
        <link href="<?php echo base_url()?>assets/css/pages/login/login-1.css" rel="stylesheet" type="text/css" />

		<!--end::Page Custom Styles -->

		<!--begin::Global Theme Styles(used by all pages) -->
		<link href="<?php echo base_url()?>assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url()?>assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

		<!--end::Global Theme Styles -->

		<!--begin::Layout Skins(used by all pages) -->
		<!-- <link href="<?php echo base_url()?>assets/css/skins/header/base/light.css" rel="stylesheet" type="text/css" /> -->
		<!-- <link href="<?php echo base_url()?>assets/css/skins/header/menu/light.css" rel="stylesheet" type="text/css" /> -->

		<!--end::Layout Skins -->
        <link rel="shortcut icon" href="<?php echo base_url()?>assets/landing/images/parekraf-logo-color.png">
	</head>

	<!-- end::Head -->
	<style>
		.kt-aside--fixed .kt-wrapper{
			padding-left: 10px !important;
			padding-top: 0px !important;
		}

	</style>
	<!-- begin::Body -->
    <body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

    <!-- begin:: Page -->
    <div class="kt-grid kt-grid--ver kt-grid--root">
        <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v1" id="kt_login">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">

                <!--begin::Aside-->
                <div class="kt-grid__item kt-grid__item--order-tablet-and-mobile-2 kt-grid kt-grid--hor kt-login__aside" style="background-image: url(<?php echo base_url()?>assets/new_landing/images/login_banner.jpg);">
                    <div class="kt-grid__item">
                        <!-- <a href="#" class="kt-login__logo">
                            <img src="<?= base_url('assets/landing/images/parekraf-logo-color.png') ?>" alt="KEMENTERIAN PARIWISATA DAN EKONOMI KREATIF" height="60">
                        </a> -->
                    </div>
                </div>

                <!--begin::Aside-->

                <!--begin::Content-->
                <div class="kt-grid__item kt-grid__item--fluid  kt-grid__item--order-tablet-and-mobile-1  kt-login__wrapper">

                    <!--begin::Head-->
                    <div class="kt-login__head">
                        <a href="<?php echo base_url('landing')?>" class="kt-link kt-login__signup-link">Back to Home</a>
                    </div>

                    <!--end::Head-->

                    <!--begin::Body-->
                    <div class="kt-login__body">

                        <!--begin::Signin-->
                        <div class="kt-login__form">
                            <div class="kt-login__title">
                                <img src="<?php echo base_url()?>assets/landing/images/parekraf-logo-color.png" alt="" style="width: 27%">
                                <h3>TTCI DASHBOARD SYSTEM</h3>
                                <p>Travel & Tourism Competitiveness Index</p>
                            </div>

                            <!--begin::Form-->

                            <form class="kt-form" action="<?php echo base_url().'login/process'?>" id="form-login" method="post">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Username" name="username" id="username" autocomplete="off" disabled>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="password" placeholder="Password" name="password" id="password" autocomplete="off" disabled>
                                </div>

                                <!--begin::Action-->
                                <div class="kt-login__actions">
                                    <button type="submit" id="kt_login_signin_submit" class="btn btn-primary btn-block btn-elevate kt-login__btn-primary" disabled>Sign In</button>
                                </div>

                                <!--end::Action-->
                            </form>

                            <!--end::Form-->
                        </div>

                        <!--end::Signin-->
                    </div>

                    <!--end::Body-->
                </div>

                <!--end::Content-->
            </div>
        </div>
    </div>

    <!-- end:: Page -->

    <!-- begin::Global Config(global config for global JS sciprts) -->
    <script>
        var KTAppOptions = {
            "colors": {
                "state": {
                    "brand": "#5d78ff",
                    "dark": "#282a3c",
                    "light": "#ffffff",
                    "primary": "#5867dd",
                    "success": "#34bfa3",
                    "info": "#36a3f7",
                    "warning": "#ffb822",
                    "danger": "#fd3995"
                },
                "base": {
                    "label": [
                        "#c5cbe3",
                        "#a1a8c3",
                        "#3d4465",
                        "#3e4466"
                    ],
                    "shape": [
                        "#f0f3ff",
                        "#d9dffa",
                        "#afb4d4",
                        "#646c9a"
                    ]
                }
            }
        };
    </script>

    <!-- end::Global Config -->

    <!--begin::Global Theme Bundle(used by all pages) -->
    <script src="<?php echo base_url()?>assets/plugins/global/plugins.bundle.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets/js/scripts.bundle.js" type="text/javascript"></script>

    <!--end::Global Theme Bundle -->

    <!--begin::Page Scripts(used by this page) -->
    <!-- <script src="<?php echo base_url()?>assets/js/pages/custom/login/login-1.js" type="text/javascript"></script> -->
    <script src="<?php echo base_url()?>assets/plugins/custom/datatables/datatables.bundle.js"></script>

    <link href="<?php echo base_url()?>assets/js/achtung/ui.achtung-mins.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/achtung/ui.achtung-min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/achtung/achtung.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.form.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-validation/dist/jquery.validate.js"></script>

    <!--end::Global Theme Bundle -->
    <script>

        $('document').ready(function() {
            // remove disabled
            $('.form-control').removeAttr("disabled");
            $('#kt_login_signin_submit').removeAttr("disabled");

            /*========== PROCESS LOGIN ================*/
            $("#form-login").validate({focusInvalid:true});

            $( "#username" )
            .keypress(function(event) {
                var keycode =(event.keyCode?event.keyCode:event.which);
                if(keycode ==13){
                event.preventDefault();
                if($(this).valid()){
                    $('#password').focus();
                }
                return false;
                }
            });

            $( "#password" )
            .keypress(function(event) {
                var keycode =(event.keyCode?event.keyCode:event.which);
                if(keycode ==13){
                if($("#form-login").valid()) {
                    $('#form-login').ajaxForm({
                    beforeSend: function() {
                        achtungShowLoader();
                    },
                    uploadProgress: function(event, position, total, percentComplete) {
                    },
                    complete: function(xhr) {
                        var data=xhr.responseText;
                        var jsonResponse = JSON.parse(data);

                        if(jsonResponse.status === 200){
                        window.location = '<?php echo base_url().'dashboard'?>';
                        }else{
                        $.achtung({message: jsonResponse.message, timeout:5});
                        }
                        achtungHideLoader();
                    }

                    });
                }
                $("#form-login").submit();
                }
            });

            $( "#kt_login_signin_submit" )
            .on("click",function(event) {
                var keycode =(event.keyCode?event.keyCode:event.which);
                if($("#form-login").valid()) {
                    $('#form-login').ajaxForm({
                    beforeSend: function() {
                        achtungShowLoader();
                    },
                    complete: function(xhr) {
                        //alert(xhr.responseText); return false;
                        var data=xhr.responseText;
                        var jsonResponse = JSON.parse(data);

                        if(jsonResponse.status === 200){
                        window.location = '<?php echo base_url().'dashboard'?>';
                        }else{
                        $.achtung({message: jsonResponse.message, timeout:5});
                        }
                        achtungHideLoader();
                    }
                    });
                }
                //   $("#form-login").submit();

            });

            $("#form-login input:text").first().focus();

            /*========== END PROCESS LOGIN ================*/

        });

        function format_html ( data ) {
            return data.html;
        }

    </script>
    <!--end::Page Scripts -->
    </body>

	<!-- end::Body -->
</html>