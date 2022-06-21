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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">

<!-- Title -->
<title>House Keepers</title>
<!-- Favicon -->
<link href="<?php echo base_url();?>assets/images/
logo.ico" sizes="128x128" rel="shortcut icon" type="image/x-icon" />
<link href="<?php echo base_url();?>assets/images/
logo.ico" sizes="128x128" rel="shortcut icon" />
<style>
small.text-danger p {
    color: #dc3545!important;
}
</style>
</head>
<body id="home-page">
<div class="wrapper">
<div class="preloader"></div>

<!--=====Header-nav======-->
<?php include(APPPATH.'views/include/header-nav.php'); ?>
<!--=====/Header-nav======-->

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
<!------Don't-delete-------->


<!-- Home Design -->
<section class="home-one home1-overlay home1_bgi1">
<div class="container">
<div class="row posr">
<div class="col-lg-12">
<div class="home_content">
<div class="home-text text-center">
<h2 class="fz55"> Find best house cleaning services</h2>
<p class="fz18 color-white">This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis </p>
</div>
<div class="home_adv_srch_opt">
<div class="tab-content home1_adsrchfrm">
<form method="post" action="<?php echo base_url();?>home/search_job">
<!-- <form method="post" action="<?php echo base_url();?>home/filter_cards"> -->
	

<div class="row">

<div class="col-lg-3 col-6 mb-2">
<div class="search_option_two">
<!-- <label>Package</label> -->

<div class="candidate_revew_select">
<select name="package" class="selectpicker w100 show-tick">
<option value="">Package</option>
<option value="0" <?php echo (set_value('package')=='0')?" selected=' selected'":""?>>At A Time</option>
<option value="1" <?php echo (set_value('package')=='1')?" selected=' selected'":""?>>Once A Week</option>
<option value="2" <?php echo (set_value('package')=='2')?" selected=' selected'":""?>>Twice A Week</option>
<option value="3" <?php echo (set_value('package')=='3')?" selected=' selected'":""?>>Thrice A Week</option>

</select>
</div>
</div>
<small class="text-danger"><?php echo form_error('package');?></small>
</div>

<div class="col-lg-3 col-6 mb-2">
<div class="search_option_two">
<!-- <label>Shift</label> -->

<div class="candidate_revew_select">


<select class="form-control selectpicker show-tick" data-show-subtext="false" data-live-search="true" name="shift_li">
<option value="">Shift</option>

<?php 
foreach($shift as $shift_list){ ?>
<option value="<?php echo $shift_list->shift_id;?>" <?php echo (set_value('shift_li')== $shift_list->shift_id)?" selected=' selected'":""?>><?php echo $shift_list->from_time;?> to <?php echo $shift_list->to_time;?> <?php echo $shift_list->hours;?> hrs</option>

<?php } ?>
</select>

</div>
</div>
<small class="text-danger"><?php echo form_error('shift_li');?></small>

</div>

<div class="col-lg-3 col-6 mb-2">

<div class="search_option_two">
<div class="candidate_revew_select">
<!-- <label>Area</label> -->
<?php 
 $uid       = $this->session->userdata('user_id'); 
 $address   = $this->session->userdata('address'); 
 $addrs_id  = $this->session->userdata('addrs_id'); 
 $acode     = $this->session->userdata('area_code'); 
?>
<div class="form-group">
<select name="area_code" class="selectpicker w100 show-tick" data-show-subtext="false" data-live-search="true">
<option value="">Area</option>

<?php if(!empty($uid) && set_value('area_code')==''){ ?>
<option value="<?php echo $addrs_id;?>,<?php echo $acode;?>" selected='selected'><?php echo $address;?></option>
<?php } ?>


<?php 
foreach($area as $area_code){ ?>
<option value="<?php echo $area_code->area_uniqid;?>,<?php echo $area_code->area_code;?>" <?php echo (set_value('area_code')== $area_code->area_uniqid.",".$area_code->area_code)?" selected=' selected'":""?>><?php echo $area_code->area_name;?></option>
<?php } ?>
</select>
<small class="text-danger"><?php echo form_error('area_code');?></small>

</div>

</div>
</div>

</div>


<div class="col-lg-3 col-6 mb-2">
<!-- <label>Select Date</label> -->

<div class="form-group">
<?php

$today_date  = strtotime(date('Y-m-d'));
//$month_date  = date('Y-m-d', strtotime('+1 month', $today_date));

?>
<input type="text" name="start_date"  class="form-control" id="exampleInputEmail" placeholder="dd/mm/yyyy" onfocus="(this.type = 'date')" onfocus="(this.type='date')" min="<?php echo date('Y-m-d');?>" max="" value="<?php echo set_value('start_date');?>">

<small class="text-danger"><?php echo form_error('start_date');?></small>

</div>


</div>

<div class="col-lg-3 col-6 btn">
<div class="search_option_button">
<input type="hidden" name="page" value="home">
<button type="submit" class="btn btn-thm btn-block">Search</button>
</div>

</div>

</div>
<small class="show_choose text-danger" style="display:none;"></small>

</form>

</div>	

</div>
</div>
</div>
</div>
</div>

</section>


<!---About us--->

<section class="about-us fh xs-none">
<div class="container">
<div class="row">

<div class="col-lg-6 col-md-12 col-xs-12" data-aos="fade-left">
<img  alt="image" src="<?php echo base_url();?>assets/images/
about/1.jpg">

</div>

<div class="col-lg-6 col-md-12 who-1" data-aos="fade-right">
<div>
<h2 class="text-left mb-4" data-aos="fade-up">About <span>House Keepers</span></h2>
</div>
<div class="pftext">
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum odio id voluptatibus incidunt cum? Atque quasi eum debitis optio ab. Esse itaque officiis tempora possimus odio rerum aperiam ratione, sunt. Lorem ipsum dolor sit amet, consectetur adipisicing elit sunt.</p>

<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum odio id voluptatibus incidunt cum? Atque quasi eum debitis optio ab. Esse itaque officiis tempora possimus odio rerum aperiam ratione, sunt. Lorem ipsum dolor sit amet, consectetur adipisicing elit sunt.</p>

<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum odio id voluptatibus incidunt cum? Atque quasi eum debitis optio ab. Esse itaque officiis tempora possimus odio rerum aperiam ratione, sunt. Lorem ipsum dolor sit amet, consectetur adipisicing elit sunt.</p>

<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum odio id voluptatibus incidunt cum? Atque quasi eum debitis optio ab. Esse itaque officiis tempora possimus odio rerum aperiam ratione, sunt. Lorem ipsum dolor sit amet, consectetur adipisicing elit sunt.</p>

<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum odio id voluptatibus incidunt cum? Atque quasi eum debitis optio ab. Esse itaque officiis tempora possimus odio rerum aperiam ratione, sunt. Lorem ipsum dolor sit amet, consectetur adipisicing elit sunt.</p>


</div>
<div class="box bg-2">
<a href="#" class="btn btn-thm">read More</a>

</div>
</div>

</div>
</div>
</section>


<!---->
<section id="" class="our-partners overflow-hidden">
<div class="container">
<div class="section-title">
<h3>Our Monthly</h3>
<h2>Subscription</h2>
</div>

<div class="row mt-3 -b-3 mx-">



<div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-4">
<div class="profile-card">
<div class="row mx-0"> 
<div class="col-lg-12 col-md-12 col-sm-12 col-12">

	 <div class="ribbon ribbon-top-right"><span>Subscribe</span></div>
	
<h2 class="name"></h2>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-12">
<p> 
<span class="pr-1"> <i class="flaticon-calendar mr-2" aria-hidden="true"></i></span>


<span class="pr-1"> <i class="fa fa-clock-o mr-2" aria-hidden="true"></i></span>
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

</p>
<p class="text-center">

<a href="#" class="btn btn-thm">Book <i class="fa fa-angle-right"></i> </a>
</p>
</div>
</div>
</div>
</div>    



</div><!----row---->    
</div><!----profile-card--->
</div><!-----col full card----->




</div><!---row--->

</section>


<!-- Our Jobers -->
<section id="" class="our-partners bg-white d-sm-block d-none">
<div class="container">
<div class="section-title">
<h3>How it Works</h3>
<h2>This is Photoshop's version</h2>
</div>

<div class="row mt-3 -b-3 mx-0 bg-arrow">

<div class="col-lg-3">

<div class="icon-box text-center">
<img class="icos" src="<?php echo base_url();?>assets/images/
login-ico.png">
</div>

<div class="foot-cont mt-5 mb-3">
<h3 class="text-center">Login</h3>
<p class="text-center">This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor</p>

</div>	

</div><!----col------>

<div class="col-lg-3">

<div class="icon-box text-center">
<img class="icos" src="<?php echo base_url();?>assets/images/
finder-ico.png">
</div>

<div class="foot-cont mt-5 mb-3">
<h3 class="text-center">Find Jobers </h3>
<p class="text-center">This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor</p>

</div>	

</div><!----col------>

<div class="col-lg-3">

<div class="icon-box text-center">
<img class="icos" src="<?php echo base_url();?>assets/images/
pay-ico.png">
</div>

<div class="foot-cont mt-5 mb-3">
<h3 class="text-center">Pay</h3>
<p class="text-center">This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor</p>

</div>	

</div><!----col------>

<div class="col-lg-3">

<div class="icon-box text-center">
<img class="icos" src="<?php echo base_url();?>assets/images/
book-job-ico.png">
</div>

<div class="foot-cont mt-5 mb-3">
<h3 class="text-center">Book</h3>
<p class="text-center">This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor</p>

</div>	

</div><!----col------>







</div><!---row--->

</section>




<!-- Our Testimonials -->
<section id="our-testimonials" class="our-testimonial d-sm-block d-none">
<div class="container">
<div class="row">
<div class="col-lg-6 offset-lg-3">
<div class="main-title text-center">
<h2 class="color-white">Testimonials</h2>
<p class="color-white">Here could be a nice sub title</p>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-6 offset-lg-3">
<div class="testimonial_grid_slider">
<div class="item">
<div class="testimonial_grid">
<div class="thumb">
<img src="<?php echo base_url();?>assets/images/
testimonial/1.jpg" alt="1.jpg">
</div>
<div class="details">
<h4>Augusta Silva</h4>
<p>Sales Manager</p>
<p class="mt25">Aliquam dictum elit vitae mauris facilisis at dictum urna dignissim donec vel lectus vel felis.</p>
</div>
</div>
</div>
<div class="item">
<div class="testimonial_grid">
<div class="thumb">
<img src="<?php echo base_url();?>assets/images/
testimonial/1.jpg" alt="1.jpg">
</div>
<div class="details">
<h4>Augusta Silva</h4>
<p>Sales Manager</p>
<p class="mt25">Aliquam dictum elit vitae mauris facilisis at dictum urna dignissim donec vel lectus vel felis.</p>
</div>
</div>
</div>
<div class="item">
<div class="testimonial_grid">
<div class="thumb">
<img src="<?php echo base_url();?>assets/images/
testimonial/1.jpg" alt="1.jpg">
</div>
<div class="details">
<h4>Augusta Silva</h4>
<p>Sales Manager</p>
<p class="mt25">Aliquam dictum elit vitae mauris facilisis at dictum urna dignissim donec vel lectus vel felis.</p>
</div>
</div>
</div>
<div class="item">
<div class="testimonial_grid">
<div class="thumb">
<img src="<?php echo base_url();?>assets/images/
testimonial/1.jpg" alt="1.jpg">
</div>
<div class="details">
<h4>Augusta Silva</h4>
<p>Sales Manager</p>
<p class="mt25">Aliquam dictum elit vitae mauris facilisis at dictum urna dignissim donec vel lectus vel felis.</p>
</div>
</div>
</div>
<div class="item">
<div class="testimonial_grid">
<div class="thumb">
<img src="<?php echo base_url();?>assets/images/
testimonial/1.jpg" alt="1.jpg">
</div>
<div class="details">
<h4>Augusta Silva</h4>
<p>Sales Manager</p>
<p class="mt25">Aliquam dictum elit vitae mauris facilisis at dictum urna dignissim donec vel lectus vel felis.</p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>

<!--=====Fotter-n-js======-->
<?php include(APPPATH.'views/include/footer-n-js.php'); ?>
<!--=====/Fotter-n-js=====-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
<script>
$(document).ready(function(){
  $('.info_alert').on("click", function(){
swal({
title: "Alert",
text: "Please select package,shift,area and booking date!",
type: "warning",
// showCancelButton: !0,
confirmButtonText: "Choose",
// cancelButtonText: "No, cancel!",
reverseButtons: !0
}).then(function (e) {
if (e.value === true) {
    //toggle here
//$("#sroll_top").scrollTop(0);
$("html").animate({ scrollTop: 0 }, "slow");
$(".show_choose").show();
$(".show_choose").html("Please Select All Mandatory Fiels!");

}

    });
  });
});
</script>

</body>
</html>