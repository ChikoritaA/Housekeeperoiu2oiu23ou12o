<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>House Keepers</title>
<!-- Favicon icon -->
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>assets/admin_assets/images/logo.png">
<link href="<?php echo base_url();?>assets/admin_assets/css/style.css" rel="stylesheet">
</head>
<body class="h-100">
<section class="login-bg">
<div class="row align-items-center mx-0">
<div class="col-md-4 mx-auto mt-5">

<!-- alert start -->
<?php if($this->session->flashdata('login_err')){ ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('login_err'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('login_err'); } ?>
<!-- alert end -->

<div class="login-content">
<div class="row no-gutters">
<div class="col-xl-12">
<div class="auth-form">
<div class="text-center mb-3">
<a href="#"><img class="img-fluid login-logo" src="<?php echo base_url();?>assets/admin_assets/images/house-keeper-black.png" alt=""></a>
</div>
<h3 class="text-center mb-4 custom-color-1 font-weight-bold">Welcome To House Keepers</h3>
<form method="post" action="<?php echo base_url();?>admin/login">
<div class="form-group">
<label class="mb-1"><strong>Email</strong></label>
<input type="text" name="email" class="form-control" value="<?php echo set_value('email');?>" placeholder="Email" maxlength="35">
<small class="text-danger"><?php echo form_error('email');?></small>
</div>
<div class="form-group">
<label class="mb-1"><strong>Password</strong></label>
<input type="password" name="password" class="form-control" value="<?php echo set_value('password');?>" placeholder="Password" min="6" maxlength="30" >
<small class="text-danger"><?php echo form_error('password');?></small>

</div>
<div class="text-center">
<button type="submit" class="btn custom-btn">Log in</button>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<!--**********************************
Scripts
***********************************-->
<!-- Required vendors -->
<?php include(APPPATH.'views/admin/include/script.php'); ?>
</section>	
</body>
</html>