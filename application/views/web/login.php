<!DOCTYPE html>

<html dir="ltr" lang="en">

<head>

<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="keywords" content="">

<meta name="description" content="">

<meta name="" content="">

<!-- css file -->

<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">

<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">

<!-- Responsive stylesheet -->

<link rel="stylesheet" href="<?php echo base_url();?>assets/css/responsive.css">

<!-- Title -->

<title>House Keepers</title>

<!-- Favicon -->

<link href="<?php echo base_url();?>assets/images/

logo.ico" sizes="128x128" rel="shortcut icon" type="image/x-icon" />

<link href="<?php echo base_url();?>assets/images/

logo.ico" sizes="128x128" rel="shortcut icon" />



</head>

<body id="login-page">

<div class="wrapper">

	<div class="preloader"></div>



   <!--=====Header-nav======-->

<?php include(APPPATH.'views/include/header-nav.php'); ?>

<!--=====/Header-nav=====-->



	<!-- Inner Page Breadcrumb -->

<!-- 	<section class="inner_page_breadcrumb">

		<div class="container">

			<div class="row">

				<div class="col-xl-6">

					<div class="breadcrumb_content">

						<h4 class="breadcrumb_title">Login</h4>

						<ol class="breadcrumb">

						    <li class="breadcrumb-item"><a href="#">Home</a></li>

						    <li class="breadcrumb-item active" aria-current="page">Login</li>

						</ol>

					</div>

				</div>

			</div>

		</div>

	</section> -->

<!------Don't-delete-------->

<li class="list-inline-item" style="display:none ;opacity: 0;">

<div class="dd_content2">

<div class="pricing_acontent">

<span id="slider-range-value1"></span>

<span id="slider-range-value2"></span>

<div id="slider"></div>

</div>

</div>

</li>

<!------Don't-delete-------->



	<!-- Our LogIn Register -->

	<section class="our-log" style="background-image: url(<?php echo base_url();?>assets/images/login-page-bg.jpg);">

		<div class="container">

			<div class="row">



					<div class="col-sm-6 col-lg-6 xs-none">

					<!-- 	<img src="<?php echo base_url();?>assets/images/login-side-img.png"> -->

				

				</div>

				<div class="col-sm-6 col-lg-6 xs-12">

					<div class="custom-padding bg-custom">

							<div class="heading">

								<h3 class="">Login</h3>

							</div>


					<!-- alert start -->
					<?php if($this->session->flashdata('login_err')){ ?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<?php echo $this->session->flashdata('login_err'); ?>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>
					<?php $this->session->unset_userdata('login_err'); } ?>
				  
				  <?php if($this->session->flashdata('signup_succ')){ ?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
					<?php echo $this->session->flashdata('signup_succ'); ?>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>
					<?php $this->session->unset_userdata('signup_succ'); } ?>

					<!-- alert end -->
					<form method="post" action="<?php echo base_url();?>user/user_login" class="">


							 <div class="form-group">

						    	<input type="email" name="email" class="form-control" value="<?php if(isset($_COOKIE['user_email'])){ echo $_COOKIE['user_email']; }else{ echo set_value('email'); }?>" placeholder="Email Address" maxlength="30">
                               <small class="text-danger"><?php echo form_error('email');?></small>

							 </div>

							<div class="form-group">

						    	<input type="password" name="password" class="form-control" value="<?php if(isset($_COOKIE['upassword'])){ echo $_COOKIE['upassword']; }else{ echo set_value('password'); }?>" placeholder="Password" maxlength="30">
                  <small class="text-danger"><?php echo form_error('password');?></small>

							</div>


							

							<div class="form-group custom-control custom-checkbox">
								<input type="checkbox" name="remember" value="remember" <?php if(isset($_COOKIE['user_email'])){ echo "checked"; }?> class="custom-control-input" id="Check3">
								<label class="custom-control-label" for="Check3">Remember me</label>
								 <a class="tdu btn-fpswd float-right text-decoration-none" href="<?php echo base_url();?>home/forgot_password">Forgot Password?</a>
							</div>

							 <div class="row">
              <div class="col-lg-6 col-6"><button type="submit" class="hvr-bounce">Login</button></div>

              <div class="col-lg-6 col-6"><a href="<?php echo base_url();?>home/user_signup" class="hvr-bounce">Sign up</a></div>
            </div>
							
					
							

							

							

						</form>

					</div>

				</div>

			</div>

		</div>
</div>

	</section>

</div>
</div>
</div>

 <!--=====Fotter-n-js======-->

<?php include(APPPATH.'views/include/footer-n-js.php'); ?>



  <!--=====/Fotter-n-js=====-->







</body>



</html>