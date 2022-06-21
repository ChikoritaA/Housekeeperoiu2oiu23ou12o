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
		<link href="<?php echo base_url();?>assets/images/logo.ico" sizes="128x128" rel="shortcut icon" type="image/x-icon" />

<link href="<?php echo base_url();?>assets/images/logo.ico" sizes="128x128" rel="shortcut icon" />
	</head>
	<body>
		<div class="wrapper">
			<div class="preloader"></div>
			<!--=====Header-nav=====-->
			<?php include(APPPATH.'views/include/header-nav.php'); ?>
           <!--=====/Header-nav=====-->

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

			<!-- Inner Page Breadcrumb -->
			<section class="inner_page_breadcrumb">
				<div class="container">
					<div class="row">
						<div class="col-xl-6">
							<div class="breadcrumb_content">
								<h4 class="breadcrumb_title">Contact Us </h4>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Contact Us</li>
								</ol>
							</div>
						</div>
					</div>
				</div>
			</section>

			<!-- Our Contact -->
	<section class="our-contact pb0 bgc-f7">
		<div class="container">
			<div class="row">
				<div class="col-lg-7 col-xl-8">
					<div class="form_grid">
						<h4 class="mb5">Get in Touch</h4>
						<!-- alert -->
						<?php if($this->session->flashdata('inq_suc')){ ?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
						<?php echo $this->session->flashdata('inq_suc'); ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>
						<?php $this->session->unset_userdata('inq_suc'); } ?>

						<!-- alert -->
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In gravida quis libero eleifend ornare. Maecenas mattis enim at arcu feugiat, sit amet blandit nisl iaculis.</p>
			            <form class="contact_form" action="<?php echo base_url();?>home/contact_us" method="post">
							<div class="row">
				                <div class="col-md-6">
				                    <div class="form-group">
										<input type="text" name="name" class="form-control" placeholder="Name" onKeyPress="return ValidateAlpha(event);" maxlength="15">
									    <small class="text-danger"><?php echo form_error('name');?></small>
									</div>
				                </div>
				                <div class="col-md-6">
				                    <div class="form-group">
									<input type="email" name="email" class="form-control" placeholder="Email" maxlength="25">
									<small class="text-danger"><?php echo form_error('email');?></small>

				                    </div>
				                </div>
				                <div class="col-md-6">
				                    <div class="form-group">
									<input type="text" name="phone" class="form-control" placeholder="Phone" onkeypress="return onlyNumberKey(event)" maxlength="11" >
									<small class="text-danger"><?php echo form_error('phone');?></small>

				                    </div>
				                </div>
				                <div class="col-md-6">
				                    <div class="form-group">
									<input type="text" name="subject" class="form-control" placeholder="Subject" maxlength="50">
									<small class="text-danger"><?php echo form_error('subject');?></small>

									</div>
				                </div>
				                <div class="col-sm-12">
		                            <div class="form-group">
		                                <textarea name="msg" class="form-control required" rows="8" placeholder="Your Message" maxlength="350"></textarea>
										<small class="text-danger"><?php echo form_error('msg');?></small>

									</div>
				                    <div class="form-group mb0">
					                    <button type="submit" class="btn btn-lg btn-thm">Send Message</button>
				                    </div>
				                </div>
			                </div>
			            </form>
					</div>
				</div>
				<div class="col-lg-5 col-xl-4">
					<div class="contact_localtion">
						<h4>Contact Us</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In gravida quis libero eleifend ornare.</p>
						<div class="content_list">
							<h5>Address</h5>
							<p>2301 Ravenswood Rd Madison, <br>WI 53711</p>
						</div>
						<div class="content_list">
							<h5>Phone</h5>
							<p>(315) 905-2321</p>
						</div>
						<div class="content_list">
							<h5>Mail</h5>
							<p>info@findhouse.com</p>
						</div>
						
						<h5>Follow Us</h5>
						<ul class="contact_form_social_area">
							<li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
							
							<li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
							<li class="list-inline-item"><a href="#"><i class="fa fa-google"></i></a></li>
						
						</ul>

						<div class="content_list">
							<h5>&nbsp;</h5>
							<p>&nbsp;</p>
						</div>
						
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid p0 mt50">
			<div class="row">
				<div class="col-lg-12">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10570.704725475889!2d54.60410827440319!3d24.48841554975975!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5e440f723ef2b9%3A0xc7cc2e9341971108!2sAbu%20Dhabi%20-%20United%20Arab%20Emirates!5e0!3m2!1sen!2sin!4v1644486854844!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
				</div>
			</div>
		</div>
	</section>




            <!--=====Fotter-n-js======-->
			<?php include(APPPATH.'views/include/footer-n-js.php'); ?>
			<!--=====/Fotter-n-js=====-->

				<script>

				function onlyNumberKey(evt) {
				// Only ASCII character in that range allowed

				var ASCIICode = (evt.which) ? evt.which : evt.keyCode

				if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))

				return false;

				return true;

				}

				function ValidateAlpha(evt)
				{
				var keyCode = (evt.which) ? evt.which : evt.keyCode
				if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)

				return false;
				return true;
				}


				</script>
		</body>
	</html>