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
<body class="h-100 login-bg">
<div class="row align-items-center">
<div class="col-md-4 mx-auto mt-5">

<!-- alert start -->
<?php if($this->session->flashdata('pas_err')){ ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('pas_err'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('pas_err'); } ?>

<?php if($this->session->flashdata('pas_suc')){ ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('pas_suc'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('pas_suc'); } ?>
<!-- alert end -->

<div class="login-content">
<div class="row no-gutters">
<div class="col-xl-12">
<div class="auth-form">
<div class="text-center mb-3">
<a href="#"><img class="img-fluid login-logo" src="<?php echo base_url();?>assets/admin_assets/images/logo.png" alt=""></a>
</div>
<h4 class="text-center mb-4 custom-font custom-color-1 font-weight-bold">Create Password</h4>
<form method="post" action="<?php echo base_url();?>home/emp_acc_active">
<div class="form-group">
<label class="mb-1"><strong>New Password</strong></label>
<input type="password" name="password" class="form-control" value="<?php echo set_value('password');?>" minlength="6" maxlength="15" placeholder="New Password" required>
<small class="text-danger"><?php echo form_error('password');?></small>
</div>
<div class="form-group">
<label class="mb-1"><strong>Confirm Password</strong></label>
<input type="password" name="cpassword" class="form-control" value="<?php echo set_value('cpassword');?>" minlength="6" maxlength="15" placeholder="Confirm Password" required>
<small class="text-danger"><?php echo form_error('cpassword');?></small>

</div>
<div class="text-center">
<input type="hidden" name="emp_id" value="<?php echo $this->uri->segment(3);?>">

<button type="submit" class="btn custom-btn">Submit</button>
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
</body>
</html>