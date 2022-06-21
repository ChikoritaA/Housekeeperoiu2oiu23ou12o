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
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/aos.css">
                           
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">

<!-- Responsive stylesheet -->

<link rel="stylesheet" href="<?php echo base_url();?>assets/css/responsive.css">

<!-- Title -->

<title>House Keepers</title>

<!-- Favicon -->

<link href="<?php echo base_url();?>assets/images/logo.ico" sizes="128x128" rel="shortcut icon" type="image/x-icon" />

<link href="<?php echo base_url();?>assets/images/logo.ico" sizes="128x128" rel="shortcut icon" />

</head>

<body>

<div class="wrapper">

<div class="preloader"></div>



<!--=====Header-nav======-->

<?php include(APPPATH.'views/include/header-nav.php'); ?>

<!--=====/Header-nav=====-->

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
<!-------Don't-delete------->

<!-- Inner Page Breadcrumb -->

<section class="inner_page_breadcrumb">

<div class="container">

<div class="row">

<div class="col-xl-6">

<div class="breadcrumb_content">

<h4 class="breadcrumb_title">Book </h4>

<ol class="breadcrumb">

<li class="breadcrumb-item"><a href="<?php echo base_url();?>">Home</a></li>

<li class="breadcrumb-item active" aria-current="page">Book</li>

</ol>

</div>

</div>

</div>

</div>

</section>



<!-- Listing Grid View -->

<section class="our-listing bgc-f7 pb30-991 pt100-360">

<div class="container">

<div class="row">

<div class="col-lg-6">

<div class="breadcrumb_content style2 mb0-991">



<h2 class="breadcrumb_title">Details Jobers / Booking</h2>

</div>

</div>



</div>

<div class="row">



<div class="col-lg-8 col-xl-8 col-12">

<div class="sidebar_listing_grid1 dn-991">

<div class="sidebar_listing_list">

<div class="sidebar_advanced_search_widget">



<div class="row">

<?php
//here get data from scheduler from sch id
$empid   = $get_sch->emp_id ;
$dayid   = $get_sch->day ;
$shiftid = $get_sch->shift ;

$plan_type    = $get_sch->plan_type ;
$plan_price   = $get_sch->price ;

$scheduler_id = $get_sch->scheduler_id ;

//get employee details from employee id
$empdata  = $this->Model->getData('cleanner',array('emp_id'=>$empid));

$emp_name    = $empdata->fullname;
$emp_profile = $empdata->profile;

//get data of day from day combination
$day_comb  = $this->Model->getData('subscription_day',array('sub_id'=>$dayid));

$day_name = $day_comb->day;

//get shift name from master shift
$shiftdata  = $this->Model->getData('shift',array('shift_id'=>$shiftid));

?>


<div class="col-lg-12 col-12 text-center">

<img class="profile-img-set" src="<?php echo base_url();?>/uploads/idcard/<?php echo $emp_profile ;?>">

<h2 class="mt-2"><?php echo ucwords($emp_name);?></h2>

</div>



<!-- <div class="col-lg-6 col-12"> -->

<!-- <p> <span class="pr-1"> <i class="flaticon-maps-and-flags mr-2" aria-hidden="true"></i>area code </span> </p>  -->
<!-- <p>  <span class="pr-1"> <i class="flaticon-calendar mr-2" aria-hidden="true"></i> <?php echo date('Y-m-d');?> </span></p> -->
<!-- <p>  <span class="pr-1"> <i class="flaticon-arrows mr-2" aria-hidden="true"></i>Shift</span></p>

<p><span class="pr-1"><i class="fa fa-clock-o mr-2" aria-hidden="true"></i> <?php echo $shiftdata->from_time;?> to <?php echo $shiftdata->to_time;?></span></p> -->

<!-- </div>	 -->


<div class="col-lg-6 col-12 text-center">

<span class="working-tittle pl-0">Working Shift</span> 



<p class="working-day mt-3">

<?php echo $shiftdata->from_time;?> to <?php echo $shiftdata->to_time;?>
</p>

</div>

<div class="col-lg-6 col-12 text-center">

<span class="working-tittle pl-0">Working Day</span> 



<p class="working-day mt-3">

<?php echo $day_name;?>

</p>

</div>





<div class="col-lg-12 col-12 mt-3">

<div class="table-responsive mt0">

<table class="table">

<thead class="thead-light">

<tr>

<th scope="col"><?php echo $shiftdata->hours;?> hour visits</th>

<th scope="col">Visits</th>

<th scope="col">Price</th>



</tr>

</thead>

<tbody>

<tr>


<td><?php if($plan_type == '0'){ echo "At a time";}else if($plan_type == '1'){ echo "Once a Week";}else if($plan_type == '2'){ echo "Twice a Week";}else if($plan_type == '3'){ echo "Thrice a Week";} ?></td>

<td><?php if($plan_type == '0'){ echo "1";}else if($plan_type == '1'){ echo "4";}else if($plan_type == '2'){ echo "8";}else if($plan_type == '3'){ echo "12";} ?></td>

<td><?php echo $plan_price;?> KD</td>



</tr>

</tbody>



</table>

</div>	

</div> 







</div> <!---row---> 





</div>

</div>   		

</div>

</div>





<div class="col-lg-4 col-xl-4 col-12">

<div class="sidebar_listing_grid1 dn-991">

<div class="sidebar_listing_list">

<div class="sidebar_advanced_search_widget">



<div class="row">



<div class="col-lg-12 col-12 text-center">



<img class="w-75 aos-init aos-animate" data-aos="zoom-in" src="<?php echo base_url();?>assets/images/jobers-vector.jpg">

</div>	







<div class="col-lg-12 col-12">
<h2 class="text-center">Total: <span><?php echo $plan_price;?> KD</span></h2> 
</div> 
<div class="col-lg-12 col-12">&nbsp;</div>	



<div class="col-lg-12 col-12 text-center">
<?php 
$search_id    = $this->uri->segment(4);

if($search_id == 'book'){

$start_date    = date('Y-m-d');

}else{


$get_search   = $this->Model->getData('search_history',array('search_id'=>$search_id));

$start_date    = $get_search->start_date;

}

?>



<form method="post" action="<?php echo base_url();?>admin/checkout">
	<input type="hidden" name="start_date" value="<?php echo $start_date;?>">
	<input type="hidden" name="scheduler_id" value="<?php echo $scheduler_id;?>">
	<input type="hidden" name="userid" value="<?php echo $this->uri->segment(5);?>">
	<button type="submit" class="btn btn-thm mt-2 mb-2">Hire me <i class="fa fa-angle-right"></i> </button>
</form>


</div>	
</div> <!---row---> 
</div>

</div>   		

</div>

</div>

</div>

</div>

</section>


<!--=====Fotter-n-js======-->

<?php include(APPPATH.'views/include/footer-n-js.php'); ?>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/aos.js"></script>
<!--=====/Fotter-n-js=====-->

<script type="text/javascript">
AOS.init({
  duration: 800
});

   // AOS.init({
   //    offset: 200,
   //    duration: 600,
   //    easing: 'ease-in-sine',
   //    delay: 100,
   //  });

</script>





</body>



</html>