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



<body id="signup-page">



<div class="wrapper">



<div class="preloader"></div>







<!--=====Header-nav======-->



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



<!-- <section class="inner_page_breadcrumb">



<div class="container">



<div class="row">



<div class="col-xl-6">



<div class="breadcrumb_content">



<h4 class="breadcrumb_title">signup</h4>



<ol class="breadcrumb">



<li class="breadcrumb-item"><a href="#">Home</a></li>



<li class="breadcrumb-item active" aria-current="page">Signup</li>



</ol>



</div>



</div>



</div>



</div>



</section> -->







<!-- Our LogIn Register -->



<section class="our-log bg-white" style="background-image: url(<?php echo base_url();?>assets/images/login-page-bg.jpg);">



<div class="container">



<div class="row">







<div class="col-sm-6 col-lg-6 xs-none">



<!-- <img src="<?php echo base_url();?>assets/images/



login-side-img.png"> -->







</div>



<div class="col-sm-6 col-lg-6 xs-12">



<div class="custom-padding bg-custom">

    

<div class="heading">



<h3 class="">Sign Up</h3>



</div>



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



<form method="post" action="<?php echo base_url();?>user/user_signup" class="">





<div class="row mx-0">







<div class="col-lg-12 col-12 mx-0">



<div class="form-group">



<input type="text" name="fullname" class="form-control" value="<?php echo set_value('fullname');?>" placeholder="Fullname" onKeyPress="return ValidateAlpha(event);" maxlength="25">



</div>

<small class="text-danger"><?php echo form_error('fullname');?></small>





</div>







<div class="col-lg-6 col-12">



<div class="form-group">



<input type="email" name="email" class="form-control" value="<?php echo set_value('email');?>" placeholder="Email" maxlength="35">



</div>

<small class="text-danger"><?php echo form_error('email');?></small>





</div>



<div class="col-lg-6 col-12">

<div class="form-group">



<input type="text" name="phone" class="form-control" value="<?php echo set_value('phone');?>"  onkeypress="return onlyNumberKey(event)" maxlength="15" size="50%" / placeholder="Mobile Number">



</div>

<small class="text-danger"><?php echo form_error('phone');?></small>

</div>





<div class="col-lg-6 col-12">
<div class="form-group">

<input type="password" name="password" class="form-control" value="<?php echo set_value('password');?>" placeholder="Password" maxlength="25">
</div>

<small class="text-danger"><?php echo form_error('password');?></small>
</div>


<div class="col-lg-6 col-12">
<div class="form-group">

<input type="password" name="cpassword" class="form-control" value="<?php echo set_value('cpassword');?>" placeholder="Confirm Password" maxlength="25">
</div>

<small class="text-danger"><?php echo form_error('cpassword');?></small>
</div>



<div class="col-lg-12 col-12">



<div class="form-group">



<input type="text" name="fulladdress" class="form-control" value="<?php echo set_value('fulladdress');?>" maxlength="50" size="50%" / placeholder="Full address (apartment/house number, street, floor, etc)">



</div>

<small class="text-danger"><?php echo form_error('fulladdress');?></small>



</div>









<!-- <div class="col-lg-12 col-12">



<div class="form-group">



<input type="text" name="address" class="form-control" value="<?php echo set_value('address');?>" placeholder="Address" maxlength="25">



</div>

<small class="text-danger"><?php echo form_error('address');?></small>

</div> -->



<div class="col-lg-12 col-12">

<div class="search_option_two">

<div class="candidate_revew_select">



<div class="form-group">

<select name="address" class="selectpicker w100 show-tick" data-show-subtext="false" data-live-search="true">

<option value="">Select Area</option>



<?php 

$areaname = $this->Model->getAlData('area_code_list');

foreach($areaname as $area_code){ ?>

<option value="<?php echo $area_code->area_uniqid;?>,<?php echo $area_code->area_name;?>" <?php echo (set_value('address')== $area_code->area_uniqid.",".$area_code->area_name)?" selected=' selected'":""?>><?php echo $area_code->area_name;?></option>

<?php } ?>

</select>



<small class="text-danger"><?php echo form_error('address');?></small>



</div>



</div>

</div>



</div>







<div class="form-group custom-control custom-checkbox">



<input type="checkbox" name="agree" value="1" class="custom-control-input" id="exampleCheck3">



<label class="custom-control-label" for="exampleCheck3">







I agree to the </label> <a class="tdu btn-fpswd text-decoration-none" href="<?php echo base_url();?>home/terms">



Terms & Conditions



</a>



<small class="text-danger"><?php echo form_error('agree');?></small>



</div>





<div class="col-lg-6 col-6">



<button type="submit" class="hvr-bounce">Sign Up</button>



</div>



<br><br>

<div class="col-lg-6 col-6">



<a href="<?php echo base_url();?>home/user_login" class="hvr-bounce">Login</a>



</div>





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