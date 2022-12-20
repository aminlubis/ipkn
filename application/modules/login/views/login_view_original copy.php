<!DOCTYPE html>

<html lang="en">

	<!-- begin::Head -->
	<head>
		<base href="../../../">
		<meta charset="utf-8" />
		<title>VISIT - Form Login</title>
		<meta name="description" content="Visit Login">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!--begin::Fonts -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

		<!--end::Fonts -->

		<!--begin::Page Custom Styles(used by this page) -->
		<link href="<?php echo base_url()?>assets/css/pages/login/login-2.css" rel="stylesheet" type="text/css" />

		<!--end::Page Custom Styles -->

		<!--begin::Global Theme Styles(used by all pages) -->
		<link href="<?php echo base_url()?>assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url()?>assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

		<!--end::Global Theme Styles -->

		<!--begin::Layout Skins(used by all pages) -->
		<link href="<?php echo base_url()?>assets/css/skins/header/base/light.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url()?>assets/css/skins/header/menu/light.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url()?>assets/css/skins/brand/dark.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url()?>assets/css/skins/aside/dark.css" rel="stylesheet" type="text/css" />

		<!--end::Layout Skins -->
		<link rel="shortcut icon" href="<?php echo base_url()?>assets/media/logos/logo-parekraf.png" />
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

		<!-- begin:: Page -->
		<div class="kt-grid kt-grid--ver kt-grid--root">
			<div class="kt-grid kt-grid--hor kt-grid--root kt-login kt-login--v2 kt-login--signin" id="kt_login">
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url(<?php echo base_url()?>assets/media/bg/12.jpg);">
					<div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
						<div class="kt-login__container" style="background: #a8b8d870; padding: 20px">
							<div class="kt-login__logo">
								<a href="#">
									<img src="<?php echo base_url()?>assets/media/logos/logo-parekraf.png" style="max-width: 120px">
								</a>
							</div>
							<div class="kt-login__signin">
								<div class="kt-login__head">
									<h3 class="kt-login__title" style="color: #092346">Sign in to Admin</h3>
								</div>
								<form class="kt-form" action="<?php echo base_url().'login/process'?>" id="form-login" method="post">
									<div class="input-group">
										<input class="form-control" type="text" placeholder="Username" name="username" id="username" autocomplete="off">
									</div>
									<div class="input-group">
										<input class="form-control" type="password" placeholder="Password" name="password" id="password">
									</div>
									<div class="row kt-login__extra">
										<div class="col">
											<label class="kt-checkbox">
												<input type="checkbox" name="remember"> Remember me
												<span></span>
											</label>
										</div>
										<div class="col kt-align-right">
											<a href="javascript:;" id="kt_login_forgot" class="kt-link kt-login__link">Forget Password ?</a>
										</div>
									</div>
									<div class="kt-login__actions">
										<button id="kt_login_signin_submit" class="btn btn-pill kt-login__btn-primary" style="background: #e9870a">Sign In</button>
									</div>
								</form>
							</div>
							
						</div>
					</div>
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

		
		<link href="<?php echo base_url()?>assets/js/achtung/ui.achtung-mins.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="<?php echo base_url()?>assets/js/achtung/ui.achtung-min.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/js/achtung/achtung.js"></script> 
		<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.form.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-validation/dist/jquery.validate.js"></script> 
    
    <script>
      $('document').ready(function() {  

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
      </script>

		<!--end::Page Scripts -->
	</body>

	<!-- end::Body -->
</html>