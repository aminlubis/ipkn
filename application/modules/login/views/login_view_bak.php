<!DOCTYPE html>

<html lang="en">

	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>Login | Dashboard TTDI & IPKN</title>
		<meta name="description" content="Support center faq example">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap.css" />
		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/ace.css" />
		<!-- Favicon -->
		<link rel="shortcut icon" href="<?php echo base_url()?>">
		<!--end::Layout Skins -->
		<link rel="shortcut icon" href="<?php echo base_url()?>assets/media/logos/favicon.ico" />

	</head>

	<style type="text/css">
    #body-style {
      background-image:url(<?php echo base_url().'assets/img/bg-3.jpeg';?>);
      background-size: 100%; 
      background-attachment: fixed;
      background-position: center;
      background-size: cover;
      opacity: 2.8;
      filter: alpha(opacity=50);
      background-repeat: no-repeat;
      /* background: #5f9ea04a; */
    }
    #popup {
      display:none;
      position:absolute;
      margin:0 auto;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      box-shadow: 0px 0px 50px 2px #000;
      background-color:#fff;
      z-index:9999;
  }
  </style>
  


<script>
function display_ct6() {
  var x = new Date()
  var ampm = x.getHours( ) >= 12 ? ' PM' : ' AM';
  hours = x.getHours( ) % 12;
  hours = hours ? hours : 12;
  var x1=x.getMonth() + 1+ "/" + x.getDate() + "/" + x.getFullYear(); 
  x1 = x1 + " - " +  hours + ":" +  x.getMinutes() + ":" +  x.getSeconds() + ":" + ampm;
  document.getElementById('ct6').innerHTML = x1;
  display_c6();
}
function display_c6(){
  var refresh=1000; // Refresh rate in milli seconds
  mytime=setTimeout('display_ct6()',refresh)
}
display_c6()
</script>

  <body class="login-layout light-login" id="body-style" onload=display_c6();>
    <div class="main-container">
      <div class="main-content">
        <div class="row">

          <div class="col-sm-10 col-sm-offset-1">
            <div class="login-container" style="padding-top: 100px">

              <div class="space-6"></div>
              <div class="position-relative">
                <div id="login-box" class="login-box visible widget-box no-border">
                  <div class="widget-body">
                    
                    <div class="widget-main">
						<form class="form-horizontal" action="<?php echo base_url().'login/process'?>" id="form-login" method="post">
							<center>
							<img src="<?php echo base_url().'assets/landing/images/parekraf-logo-color.png'?>" width="80px"><br>
							<div class="social-or-login center">
								<span class="bigger-110"><i>Single Sign On (SSO)</i></span>
							</div>
							<span style="font-style: italic">Kementerian Pariwisata dan Ekonomi Kreatif<br>
							<span style="font-size: 14px; ">Dashboard TTDI & IPKN</span></span>
							</center>
							<br>
							<h4 class="header blue lighter bigger">
								<i class="ace-icon fa fa-lock blue"></i>
								FORM LOGIN
							</h4>
							<div class="space-6"></div>
							<fieldset>
							<label class="block clearfix">
								<span class="block input-icon input-icon-right">
								Nama Pengguna : <br>
								<input type="text" class="form-control" placeholder="Username" name="username" id="userid" value="<?php echo set_value('username')?>" />
								<i class="ace-icon fa fa-user"></i>
								</span>
							</label>

							<label class="block clearfix">
								<span class="block input-icon input-icon-right">
								Kata Sandi : <br>
								<input type="password" class="form-control" placeholder="Password" name="password" id="passwd" value="<?php echo set_value('passwd')?>" />
								<i class="ace-icon fa fa-lock"></i>
								</span>
							</label>


							<div class="space"></div>

							<div class="clearfix">
								<label class="inline">
								<input type="checkbox" class="ace" />
								<span class="lbl"> Ingatkan saya</span>
								</label>

								<input type="submit" id="btn_submit" value="Sign In" class="width-35 pull-right btn btn-sm btn-primary" >

								<!-- <button id="button-login" name="Submit" value="submit" class="width-35 pull-right btn btn-sm btn-primary">
								<i class="ace-icon fa fa-key"></i>
								<span class="bigger-110">Masuk</span>
								</button> -->
							</div>
							
							<div class="social-or-login center">
								<span class="bigger-110"><a href="<?php echo base_url()?>">Kembali ke Halaman Website</span>
							</div>
							
							<div class="space-4"></div>
							</fieldset>
						</form>
                    </div><!-- /.widget-main -->
                    <div class="toolbar clearfix" style="background: #0e203c !important">
                      <div style="width:100% !important; text-align:center; font-size:11px;color:white;padding-top:15px">
                        <i class="fa fa-clock"></i><span id='ct6' style=" font-size: 16px;" ></span>
                      </div>
                    </div>
                  </div><!-- /.widget-body -->
                </div><!-- /.login-box -->

              </div><!-- /.position-relative -->

            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.main-content -->
    </div><!-- /.main-container -->

  </body>

  	<script type="text/javascript">
      window.jQuery || document.write("<script src='<?php echo base_url()?>assets/js/jquery.js'>"+"<"+"/script>");
	</script>

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
		
		$( "#btn_submit" )
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
					$.achtung({message: jsonResponse.message, timeout:5, className:'achtungFail'});
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


	<!-- end::Body -->
</html>