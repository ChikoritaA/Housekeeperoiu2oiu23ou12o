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

<style type="text/css">
.custom-control {
line-height: unset;
}
</style>

</head>

<body class="h-100 login-bg">

<div class="row align-items-center">


<div class="col-md-4 mx-auto mt-5">

<!-- alert start -->
<?php if($this->session->flashdata('ch_err')){ ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('ch_err'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('ch_err'); } ?>

<?php if($this->session->flashdata('ch_suc')){ ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('ch_suc'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('ch_suc'); } ?>

<!-- alert end -->

<div class="login-content">
<div class="row no-gutters">
<div class="col-xl-12">
<div class="auth-form">
<div class="text-center mb-3">
<a href="#"><img class="img-fluid login-logo" src="images/logo.png" alt=""></a>
</div>
<h4 class="text-center mb-4 custom-font custom-color-1 font-weight-bold">Change Password</h4>
<form action="<?php echo base_url();?>employee/emp_changed_pass" method="post">
<div class="form-group">
<label class="mb-1"><strong>Enter password</strong></label>
<input type="password" name="password" class="form-control" value="" placeholder="Password" required>

</div>

<div class="form-group">
<label class="mb-1"><strong>Enter Confirm password</strong></label>
<input type="password" name="cpassword" class="form-control" value="" placeholder="Confirm password" required>

<input type="hidden" name="emp_id" value="<?php echo $this->uri->segment(3);?>">
</div>


<div class="text-center">
<button type="submit" class="btn custom-btn">Change Passoword</button>
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