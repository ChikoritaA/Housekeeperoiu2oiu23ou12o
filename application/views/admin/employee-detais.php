<!DOCTYPE html>
<html lang="en">
<head>
<!--*******************
css meta titlal include
********************-->
<?php include(APPPATH.'views/admin/include/css.php'); ?>
<link href="<?php base_url();?>assets/admin_assets/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
<!--*******************
css meta titlal include
********************-->
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
<?php include(APPPATH.'views/admin/include/sidebar.php'); ?>
<!--**********************************
Sidebar end
***********************************-->
<!--**********************************
Content body start
***********************************-->
<div class="content-body">
<!-- row -->
<div class="container-fluid">
<div class="form-head mb-4">
<h2 class="text-black font-w600 mb-0">Employee Details</h2>
</div>


<div class="row">
<div class="col-xl-6">
<div class="card">
<div class="card-body ">  
<div class="row">
<div class="col-xl-7">
<img class="img-fluid" src="<?php echo base_url();?>uploads/idcard/<?php echo $emp_detail->profile;?>" style="height: 140px; width: auto;">
</div>	
<div class="col-xl-5">
<h2 class="mt-2"><?php echo $emp_detail->fullname;?></h2>
<h6><?php echo $emp_detail->job_type;?></h6>
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
<img class="img-fluid" src="<?php echo base_url();?>uploads/idcard/<?php echo $emp_detail->identity_card;?>" style="height: 140px; width: auto;">
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
<h6><?php echo $emp_detail->phone;?></h6>
</div> 
<div class="col-xl-7 text-center">
<i class="fa fa-phone big-icon-font"> </i>
</div>		
</div>	<!----inner row--->
</div><!----card-body--->
</div>
</div> <!----col-xl-6---->
<div class="col-xl-6">
<div class="card">
<div class="card-body ">  
<div class="row pt-2 pb-2">
<div class="col-xl-5">
<h2 class="mt-2">Email Id</h2>
<h6><?php echo $emp_detail->email;?></h6>
</div> 
<div class="col-xl-7 text-center">
<i class="fa fa-envelope-o big-icon-font"> </i>
</div>		
</div>	<!----inner row--->
</div><!----card-body--->
</div>
</div> <!----col-xl-6----> 
<div class="col-xl-3 mx-auto text-center">
<a href="<?php echo base_url();?>admin/edit_employee/<?php echo $emp_detail->emp_id;?>" class="custom-btn"> Edit Profile </a> 
</div>	
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
<!-- Datatable -->
<script src="<?php base_url();?>assets/admin_assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php base_url();?>assets/admin_assets/js/plugins-init/datatables.init.js"></script>
</body>
</html>