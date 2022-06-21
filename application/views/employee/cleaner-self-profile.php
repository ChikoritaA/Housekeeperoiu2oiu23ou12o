<!DOCTYPE html>
<html lang="en">
<head>
<!--*******************
css meta titlal include
********************-->
 <?php include(APPPATH.'views/admin/include/css.php'); ?>

<!--*******************
css meta titlal include
********************-->
<style type="text/css">
.dataTables_wrapper .dataTables_paginate{
background:transparent;}
.form-control:focus{
box-shadow:none;}
a{color:#fff;}
</style>
</head>
<body>
<!--*******************
Preloader start
********************-->
<div id="preloader">
<div class="sk-three-bounce">
<div class="sk-child sk-bounce1"></div>
<div class="sk-child sk-bounce2"></div>
<div class="sk-child sk-bounce3"></div>
</div>
</div>
<!--*******************
Preloader end
********************-->
<!--**********************************
Main wrapper start
***********************************-->
<div id="main-wrapper">
<!--**********************************
Sidebar start
***********************************-->
 <?php include(APPPATH.'views/admin/include/cleaner-sidebar.php'); ?>

<!--**********************************
Sidebar end
***********************************-->
<!--**********************************
Content body start
***********************************-->
<div class="content-body">
<?php 
$emp_id      = $this->session->userdata('emp_id');
$profile     = $this->Model->getData('cleanner',array('emp_id' => $emp_id)); 
$job_type    = $profile->job_type; 
?>
<!-- row -->
<div class="container-fluid">
<div class="form-head mb-4">
<h2 class="text-black font-w600 mb-0">My Profile</h2>
</div>
<div class="row">
<div class="col-xl-6">
<div class="card">
<div class="card-body ">  
<div class="row">
<div class="col-xl-7">
<img class="img-fluid" src="<?php echo base_url();?>uploads/idcard/<?php echo $profile->profile;?>" style="    height: 140px; width: auto;">
</div>  
<div class="col-xl-5">
<h2 class="mt-2"><?php echo $profile->fullname;?></h2>
<h6><?php echo $profile->job_type;?></h6>
</div>  
</div>  
</div><!----card-body--->
</div>
</div> <!----col-xl-6---->
<div class="col-xl-6">
<div class="card">
<div class="card-body ">  
<div class="row">
<div class="col-xl-7">
<img class="img-fluid" src="<?php echo base_url();?>uploads/idcard/<?php echo $profile->identity_card;?>" style="    height: 140px; width: auto;">
</div>  
<div class="col-xl-5">
<h2 class="mt-2">Id Card</h2>
<h6>passport</h6>
</div>  
</div>  
</div><!----card-body--->
</div>
</div> <!----col-xl-6---->
<div class="col-xl-6">
<div class="card">
<div class="card-body ">  
<div class="row pt-2 pb-2">
<div class="col-xl-5">
<h2 class="mt-2">Mobile Number</h2>
<h6><?php echo $profile->phone;?></h6>
</div> 
<div class="col-xl-7 text-center">
<i class="fa fa-phone big-icon-font"> </i>
</div>      
</div>  <!----inner row--->
</div><!----card-body--->
</div>
</div> <!----col-xl-6---->


<div class="col-xl-6">
<div class="card">
<div class="card-body ">  
<div class="row pt-2 pb-2">
<div class="col-xl-5">
<h2 class="mt-2">Email Id</h2>
<h6><?php echo $profile->email;?></h6>
</div> 
<div class="col-xl-7 text-center">
<i class="fa fa-envelope-o big-icon-font"> </i>
</div>      
</div>  <!----inner row--->
</div><!----card-body--->
</div>
</div> <!----col-xl-6----> 


<?php if($job_type == 'driver') { ?>
	
<div class="col-xl-12">
<div class="card">
<div class="card-body ">  
<div class="row pt-2 pb-2">
<div class="col-xl-5">
<h2 class="mt-2">Area Code</h2>
<h6><?php echo $profile->area_code;?></h6>
</div> 
<div class="col-xl-7 text-center">
<i class="fa fa-code big-icon-font"> </i>
</div>      
</div>  <!----inner row--->
</div><!----card-body--->
</div>
</div> <!----col-xl-6----> 
</div> <!--/row-->
</div>
</div>
<?php  } ?>


</div> <!--/row-->
</div>
</div>



<!--**********************************
Content body end
***********************************-->
<!--**********************************
Footer and Js include
***********************************-->
 <?php include(APPPATH.'views/admin/include/footer.php'); ?>

<!--**********************************
Footer and Js include
***********************************-->

</body>
</html>