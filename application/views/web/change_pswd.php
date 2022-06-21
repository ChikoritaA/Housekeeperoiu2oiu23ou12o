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

<link href="<?php echo base_url();?>assets/images/logo.ico" sizes="128x128" rel="shortcut icon" type="image/x-icon" />

<link href="<?php echo base_url();?>assets/images/logo.ico" sizes="128x128" rel="shortcut icon" />



</head>

<body>

<div class="wrapper">

	<div class="preloader"></div>



   <!--=====Fotter-n-js======-->

<?php include(APPPATH.'views/include/header-nav.php'); ?>



  <!--=====/Fotter-n-js=====-->



  <!-------Don't-delete------->

	<!-- Inner Page Breadcrumb -->

	<section class="inner_page_breadcrumb">

		<div class="container">

			<div class="row">

				<div class="col-xl-6">

					<div class="breadcrumb_content">

						<h4 class="breadcrumb_title">Forgot Password</h4>

						<ol class="breadcrumb">

						    <li class="breadcrumb-item"><a href="#">Home</a></li>

						    <li class="breadcrumb-item active" aria-current="page">Change Password</li>

						</ol>

					</div>

				</div>

			</div>

		</div>

	</section>



	<!-- Our LogIn Register -->

	<section class="our-log bg-white">

		<div class="container">

			<div class="row">



					<div class="col-sm-6 col-lg-6 xs-none">

						<img src="<?php echo base_url();?>assets/images/login-side-img.png">

				

				</div>

				<div class="col-sm-6 col-lg-6 xs-12">


					<div class="login_form inner_page">

						<form method="post" action="<?php echo base_url();?>user/emp_changed_pass" class="mt-5">

							<div class="heading">

								<h3 class="">Change Password</h3>

							</div>


								<!-- alert -->
								<?php if($this->session->flashdata('fgerr')){ ?>

								<div class="alert alart_style_four alert-dismissible fade show" role="alert">
								  <?php echo $this->session->flashdata('fgerr'); ?>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								    	<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<?php $this->session->unset_userdata('fgerr'); } ?>

								<!-- alert start -->
								<?php if($this->session->flashdata('ch_suc')){ ?>
								<div class="alert alert-success alert-dismissible fade show" role="alert">
								<?php echo $this->session->flashdata('ch_suc'); ?>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
								</div>
								<?php $this->session->unset_userdata('ch_suc'); } ?>
								<!-- alert end -->

								

							<div class="form-group">

						   <input type="password" name="password" value="" class="form-control" id="exampleInputEmail3" placeholder="Password" min="6" required="">

							
							</div>

							<div class="form-group">

						   <input type="password" name="cpassword" value="" class="form-control" id="exampleInputEmail3" placeholder="Confirm Password" min="6" required="">
							
							</div>
							<div class="form-group">
							<input type="hidden" name="user_id" value="<?php echo $this->uri->segment(3);?>">
							<button type="submit" class="hvr-bounce">Reset Passoword</button>
							</div>

						</form>

					</div>

				</div>

			</div>

		</div>

	</section>



 <!--=====Fotter-n-js======-->

<?php include(APPPATH.'views/include/footer-n-js.php'); ?>



  <!--=====/Fotter-n-js=====-->







</body>



</html>