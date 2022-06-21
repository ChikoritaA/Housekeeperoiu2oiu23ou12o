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
<body>
<div class="wrapper">
<div class="preloader"></div>

<!--=====Fotter-n-js======-->
<?php include(APPPATH.'views/include/header-nav.php'); ?>

<!--=====/Fotter-n-js=====-->

<!-------Don't-delete------->
<li class="list-inline-item" style="opacity: 0;">

<div class="dd_content2">
<div class="pricing_acontent">

<span id="slider-range-value1"></span>
<span id="slider-range-value2"></span>
<div id="slider"></div>
</div>
</div>
</li>
<!-------------->





<!-- How it Works -->
<section id="" class="our-partners">
<div class="container">
<div class="section-title">
<h3>Available Jobs</h3>
</div>


<div class="row mt-3 -b-3 mx-">

<?php if(is_array($schedule)): ?>
<?php 

foreach($schedule as $plans ){

$empid   = $plans['emp_id'] ;
$dayid   = $plans['day'] ;
$shiftid = $plans['shift'] ;
$scheduler_id = $plans['scheduler_id'] ;
//get employee details from employee id
$empdata  = $this->Model->getData('cleanner',array('emp_id'=>$empid));

$emp_name = $empdata->fullname;

//get data of day from day combination
$day_comb  = $this->Model->getData('subscription_day',array('sub_id'=>$dayid));

$day_name = $day_comb->day;

//get shift name from master shift
$shiftdata  = $this->Model->getData('shift',array('shift_id'=>$shiftid));

?>
<div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-4">
<div class="profile-card">
<div class="row mx-0"> 
<div class="col-lg-12 col-md-12 col-sm-12 col-12">
<h2 class="name"><?php echo ucwords($emp_name);?></h2>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-12">
<p>  
<span class="pr-1"> <i class="flaticon-calendar mr-2" aria-hidden="true"></i> <?php echo date('Y-m-d');?> </span>
<span class="pr-1"> <i class="fa fa-clock-o mr-2" aria-hidden="true"></i> <?php echo $shiftdata->from_time;?> to <?php echo $shiftdata->to_time;?> <?php echo $shiftdata->hours;?> hrs </span>
</p>
</div>  

<div class="col-lg-12 col-md-12 col-sm-12 col-12">
<div class="day-card">
<div class="row mx-0">
<div class="col-12">
<div class="row mx-0">
<div class="col-6 text-left">
<span class="working-tittle pl-0">Working Day</span> 
</div>

<div class="col-6 text-right">
<span class="working-tittle pr-0">

</div>

</div>
<p class="working-day">
<?php echo $day_name;?>
</p>
<p class="text-center">
<a class="btn btn-thm"  href="<?php echo base_url();?>home/service_details/<?php echo $scheduler_id; ?>">Book <i class="fa fa-angle-right"></i> </a>
</p>
</div>
</div>
</div>
</div>    



</div><!----row---->    
</div><!----profile-card--->
</div><!-----col full card----->

<?php } ?>
<?php endif; ?>  


</div><!---row--->

<div class="row">
	<div class="col-12">
	<?php if(empty($schedule)){ ?>
	<center>
	<img src="<?php echo base_url();?>assets/nodata.jpeg" >
	</center>
	<?php } ?>

	</div>
</div>
</section>


<!--=====Fotter-n-js======-->
<?php include(APPPATH.'views/include/footer-n-js.php'); ?>
<!--=====/Fotter-n-js=====-->

</body>
</html>