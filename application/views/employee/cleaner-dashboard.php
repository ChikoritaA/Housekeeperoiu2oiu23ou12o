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

.bg-custom{
background: #d7c9a3;
}
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
<!-- row -->
<div class="container-fluid">
<div class="form-head mb-4">
<h2 class="text-black font-w600 mb-0">Dashboard</h2>
</div>

<?php 
$emp_id      = $this->session->userdata('emp_id');
$profile     = $this->Model->getData('cleanner',array('emp_id' => $emp_id)); 
$job_type    = $profile->job_type; 
?>
<?php if($job_type == 'cleaner') { ?>

<div class="row">

<div class="col-md-6 col-xl-6 col-xxl-6 mb-3">

<div class="card">
<div class="card-body">

<div class="media align-items-center">
<div class="media-body">
<h2 class="fs-38 text-black font-w600"><?php echo $upcoming_job;?></h2>
<span class="fs-18"> Upcoming Job</span>
</div>
<span class="p-3 border ml-3 bg-custom">

<img src="<?php echo base_url();?>assets/images/Activ-jobs-ico.png">
</span>
</div>

</div>
</div>                 
</div>

<div class="col-md-6 col-xl-6 col-xxl-6 mb-3">

<div class="card">
<div class="card-body">

<div class="media align-items-center">
<div class="media-body">
<h2 class="fs-38 text-black font-w600"><?php echo $complte_job;?></h2>
<span class="fs-18"> Complete Job</span>
</div>
<span class="p-3 border ml-3 bg-custom">

<img src="<?php echo base_url();?>assets/images/Activ-jobs-ico.png">
</span>
</div>

</div>
</div>                 
</div>   


</div><!-- row--->
<?php  } ?>

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