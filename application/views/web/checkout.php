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
<body style="background:#f7f7f7;">
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
<h4 class="breadcrumb_title">Check Out</h4>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">Check Out</li>
</ol>
</div>
</div>
</div>
</div>
</section>
<!-- Our LogIn Register -->
<section class="our-log bg-white pt-2">
<div class="container">
<div class="row">
<div class="login_form inner_page">
<!-- alert start -->
<?php if($this->session->flashdata('signup_err')){ ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('signup_err'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('signup_err'); } ?>
<?php if($this->session->flashdata('signup_succ')){ ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('signup_succ'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('signup_succ'); } ?>
<!-- alert end -->


<form method="post" action="<?php echo base_url();?>user/user_signup" class="mt-5">
<div class="row">

<div class="col-lg-6 listing_single_description">
	
	<div class="row">
		<div class="col-lg-12 col-12">
<div class="form-group">
<input type="type" name="fullname" class="form-control" value="<?php echo set_value('fullname');?>" placeholder="Fullname" maxlength="15">
</div>
<small class="text-danger"><?php echo form_error('fullname');?></small>
</div>
<div class="col-lg-12 col-12">
<div class="form-group">
<input type="email" name="email" class="form-control" value="<?php echo set_value('email');?>" placeholder="Email">
</div>
<small class="text-danger"><?php echo form_error('email');?></small>
</div>
<div class="col-lg-12 col-12">
<div class="form-group">
<input type="text" name="phone" class="form-control" value="<?php echo set_value('phone');?>"  onkeypress="return onlyNumberKey(event)" maxlength="11" size="50%" / placeholder="Mobile Number">
</div>
<small class="text-danger"><?php echo form_error('phone');?></small>
</div>
<div class="col-lg-12 col-12">
<div class="form-group">
<input type="text" name="address" class="form-control" value="<?php echo set_value('address');?>" placeholder="Address">
</div>
<small class="text-danger"><?php echo form_error('address');?></small>
</div>
<div class="form-group custom-control custom-checkbox">
<input type="checkbox" name="agree" value="1" class="custom-control-input" id="exampleCheck3">
<small class="text-danger"><?php echo form_error('agree');?></small>
</div>

    </div>		

</div><!----->

<div class="col-lg-6 text-center mx-auto">
<img class="img-fluid w-75 text-center xs-hidden" src="<?php echo base_url();?>assets/images/new-pay.png">

<div class="mt-3">
<button type="submit" class="hvr-bounce w-50">Pay</button>

</div><!---->

</div>
</form>

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
</script>
</body>
</html>