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
<li class="list-inline-item" style="opacity: 0;display:none;">

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
$empid        = $get_sch->emp_id ;
$dayid        = $get_sch->day ;
$day_names    = $get_sch->day_name ;
$shiftid      = $get_sch->shift ;
$plan_type    = $get_sch->plan_type ;
$plan_price   = $get_sch->price ;
$scheduler_id = $get_sch->scheduler_id ;

$bdate        = $searchdata->start_date;
$day_name     = date('l', strtotime($bdate));




if($plan_type =='0'){
  

  if($day_names == $day_name){

  //date booking for single day
  $week1      = $bdate;
  $week_name1 = $day_name;

  }else{
  
  //check alternate date and days
  for ($a = 1; $a < 8; $a++) {
  
  //get date
  $get_exact_date = date('Y-m-d', strtotime($bdate. ' + '.$a.' days'));
  $get_exact_days = date('l', strtotime($get_exact_date));
  
  if ($day_names == $get_exact_days) {
      
      break;
    
     }

  }//loop close



      $week1       = $get_exact_date;
      $week_name1  = $get_exact_days;

  }

  
  
$chk_ifexist = $this->Model->CountWhereRecord('job_avalability',array('job_id'=>$scheduler_id));
//chk if user already book 
$getdatess = $this->Model->CountWhereRecord('job_avalability',array('job_id'=>$scheduler_id,'book_date'=>$week1));
$week10    = date('Y-m-d', strtotime($week1. ' + 7 days'));

$getdats1  = $this->Model->CountWhereRecord('job_avalability',array('job_id'=>$scheduler_id,'book_date'=>$week10));
$week2     = date('Y-m-d', strtotime($week10. ' + 7 days'));

$getdates2 = $this->Model->CountWhereRecord('job_avalability',array('job_id'=>$scheduler_id,'book_date'=>$week2));
$week3     = date('Y-m-d', strtotime($week2. ' + 7 days'));

$getdates3 = $this->Model->CountWhereRecord('job_avalability',array('job_id'=>$scheduler_id,'book_date'=>$week3));
$week4     = date('Y-m-d', strtotime($week3. ' + 7 days'));

$getdates4 = $this->Model->CountWhereRecord('job_avalability',array('job_id'=>$scheduler_id,'book_date'=>$week4));
$week5     = date('Y-m-d', strtotime($week4. ' + 7 days'));


if($chk_ifexist > 0 ){

  
  if($getdatess > 0 ){

  $week1 = $week10;

  }
  if($getdats1 > 0){
  
  $week1 = $week2;
   
  }
  if($getdates2 > 0){
  
  $week1 = $week3;
    
  }
  if($getdates3 > 0){
  
  $week1 = $week4;
    
  }
  if($getdates4 > 0){

  $week1 = $week5;

  }


}else{

  $week1   = $week1 ;

  }
  
  }else if($plan_type =='1'){

  //date booking for once a week day
  $day_data    = $this->Model->getData('subscription_day',array('sub_id' => $dayid));
  $daysin_str  =  $day_data->day;
  
  if($day_name == $daysin_str){

  $week1      = $bdate;
  $week_name1 = $day_name;

  }else{


  //check alternate date and days
  for ($a = 1; $a < 8; $a++) {
    
    //get date
    
    $get_exact_date = date('Y-m-d', strtotime($bdate. ' + '.$a.' days'));

    $get_exact_days = date('l', strtotime($get_exact_date));
          
        if ($daysin_str == $get_exact_days) {
          
           break;

          }
      }//loop close


  $week1      = $get_exact_date;
  $week_name1 = $get_exact_days;

  }
  

  $week2      = date('Y-m-d', strtotime($week1. ' + 7 days'));
  $week_name2 = date('l', strtotime($week2));
  
  $week3      = date('Y-m-d', strtotime($week2. ' + 7 days'));
  $week_name3 = date('l', strtotime($week3));
  
  $week4      = date('Y-m-d', strtotime($week3. ' + 7 days'));
  $week_name4 = date('l', strtotime($week4));
  


}else if($plan_type =='2'){


  //get day for twice 
  $day_data    = $this->Model->getData('subscription_day',array('sub_id' => $dayid));
  $daysin_str  =  $day_data->day;
  
  $get_twice   = explode (",", $daysin_str); 
  
  $get_twice1  = $get_twice[0];
  $get_twice2  = $get_twice[1];

  $week1      = $bdate;
  $week_name1 = $day_name;

  if($week_name1 == $get_twice1 || $week_name1 == $get_twice2){
    
    $firstday_date1 = $week1;
    $firstday_day1  = $week_name1;
    
   
  }else{

  //check alternate date and days
  for ($a = 1; $a < 8; $a++) {
    
    //get date
    
    $get_exact_date = date('Y-m-d', strtotime($week1. ' + '.$a.' days'));

    $get_exact_days = date('l', strtotime($get_exact_date));
          
        if ($get_twice1 == $get_exact_days || $get_twice2 == $get_exact_days) {
          
           break;

          }
      }//loop close

      $firstday_date1 = $get_exact_date;
      $firstday_day1  = $get_exact_days;

  }

  if($firstday_day1 == $get_twice1){
  

    for ($x = 1; $x < 8; $x++) {
    
    //get twice day and date
    //$get_twic_dayndate = date('Y-m-d', strtotime($week1. '+'. $x. 'days'));
    $get_twic_dayndate = date('Y-m-d', strtotime($firstday_date1. ' + '.$x.' days'));

    $get_twic_days = date('l', strtotime($get_twic_dayndate));
          
        if ($get_twice2 == $get_twic_days) {
          
           break;

          }
      }//loop close

    }//end if
    else{
   

        for ($x = 1; $x < 8; $x++) {
    
            //get twice day and date
            //$get_twic_dayndate = date('Y-m-d', strtotime($week1. '+'. $x. 'days'));
            $get_twic_dayndate = date('Y-m-d', strtotime($firstday_date1. ' + '.$x.' days'));

            $get_twic_days = date('l', strtotime($get_twic_dayndate));
                  
                if ($get_twice1 == $get_twic_days) {
                  
                   break;

                  }
              }//loop close

        
        }

   
   
   $second_day_date1 = $get_twic_dayndate;
   $second_day_week1 = $get_twic_days;
  
   //second week data
  $firstday_date2 = date('Y-m-d', strtotime($firstday_date1. '+ 7 days'));
  $firstday_day2  = date('l', strtotime($firstday_date2));
  
  $second_day_date2 = date('Y-m-d', strtotime($second_day_date1. '+ 7 days'));
  $second_day_week2 = date('l', strtotime($second_day_date2));


  //third week data
  $firstday_date3 = date('Y-m-d', strtotime($firstday_date2. '+ 7 days'));
  $firstday_day3  = date('l', strtotime($firstday_date3));
  
  $second_day_date3 = date('Y-m-d', strtotime($second_day_date2. '+ 7 days'));
  $second_day_week3 = date('l', strtotime($second_day_date3));


  //four week data
  $firstday_date4 = date('Y-m-d', strtotime($firstday_date3. '+ 7 days'));
  $firstday_day4  = date('l', strtotime($firstday_date4));
  
  $second_day_date4  = date('Y-m-d', strtotime($second_day_date3. '+ 7 days'));
  $second_day_week4  = date('l', strtotime($second_day_date4));

  
}else if($plan_type =='3'){


  //get day for twice 
  $day_data    = $this->Model->getData('subscription_day',array('sub_id' => $dayid));
  $daysin_str  =  $day_data->day;

  $get_twice   = explode (",", $daysin_str); 
  $get_twice1  = $get_twice[0];
  $get_twice2  = $get_twice[1];
  $get_twice3  = $get_twice[2];

  $week1       = $bdate;
  $week_name1  = $day_name;


  if($week_name1 == $get_twice1 || $week_name1 == $get_twice2 || $week_name1 == $get_twice3){

   $firstday_date1 = $week1;
   $firstday_day1  = $week_name1;


  }else{

    for ($a = 1; $a < 8; $a++) {
    //get date
    $get_exact_date = date('Y-m-d', strtotime($week1. ' + '.$a.' days'));

    $get_exact_days = date('l', strtotime($get_exact_date));
          
        if ($get_twice1 == $get_exact_days || $get_twice2 == $get_exact_days || $get_twice3 == $get_exact_days) {
          
           break;

          }
      }//loop close

      $firstday_date1 = $get_exact_date;
      $firstday_day1  = $get_exact_days;



  }


  //get tiwce and thrice date and day
  
  if($firstday_day1 == $get_twice1){
  

    for ($x = 1; $x < 8; $x++) {
    
    //get twice day and date
    
    $get_twic_dayndate = date('Y-m-d', strtotime($firstday_date1. ' + '.$x.' days'));

    $get_twic_days     = date('l', strtotime($get_twic_dayndate));
          
        if ($get_twice2 == $get_twic_days) {
          
           break;
          
          }

      }//loop close

      for ($k = 1; $k < 8; $k++) {
           
           $thirce_date = date('Y-m-d', strtotime($get_twic_dayndate. ' + '.$k.' days'));

           $thirce_days = date('l', strtotime($thirce_date));
            
            if ($get_twice3 == $thirce_days) {
          
                break;
             }

           }
    //end if
    }else if($firstday_day1 == $get_twice2){
    
     for ($x = 1; $x < 8; $x++) {
    
    //get twice day and date
    
    $get_twic_dayndate = date('Y-m-d', strtotime($firstday_date1. ' + '.$x.' days'));

    $get_twic_days = date('l', strtotime($get_twic_dayndate));
          
        if ($get_twice3 == $get_twic_days) {
          
           break;
          
          }

      }//loop close

      for ($k = 1; $k < 8; $k++) {
           
           $thirce_date = date('Y-m-d', strtotime($get_twic_dayndate. ' + '.$k.' days'));

           $thirce_days = date('l', strtotime($thirce_date));
            
            if ($get_twice1 == $thirce_days) {
          
                break;
             }

           }
    //end else if

    }else if($firstday_day1 == $get_twice3){

         for ($x = 1; $x < 8; $x++) {
    
    //get twice day and date
    
    $get_twic_dayndate = date('Y-m-d', strtotime($firstday_date1. ' + '.$x.' days'));

    $get_twic_days = date('l', strtotime($get_twic_dayndate));
          
        if ($get_twice1 == $get_twic_days) {
          
           break;
          
          }

      }//loop close

      for ($k = 1; $k < 8; $k++) {
           
           $thirce_date = date('Y-m-d', strtotime($get_twic_dayndate. ' + '.$k.' days'));

           $thirce_days = date('l', strtotime($thirce_date));
            
            if ($get_twice2 == $thirce_days) {
          
                break;
             }

           }
    //end if

    }

   
   $second_day_date1 = $get_twic_dayndate;
   $second_day_week1 = $get_twic_days;

   $thrice_date1 = $thirce_date;
   $thrice_days1 = $thirce_days;
  
   //second week data
  $firstday_date2 = date('Y-m-d', strtotime($firstday_date1. '+ 7 days'));
  $firstday_day2  = date('l', strtotime($firstday_date2));
  
  $second_day_date2 = date('Y-m-d', strtotime($second_day_date1. '+ 7 days'));
  $second_day_week2 = date('l', strtotime($second_day_date2));
  
  $thrice_date2 = date('Y-m-d', strtotime($thrice_date1. '+ 7 days'));
  $thrice_days2 = date('l', strtotime($thrice_date2));

  //third week data
  $firstday_date3 = date('Y-m-d', strtotime($firstday_date2. '+ 7 days'));
  $firstday_day3  = date('l', strtotime($firstday_date3));
  
  $second_day_date3 = date('Y-m-d', strtotime($second_day_date2. '+ 7 days'));
  $second_day_week3 = date('l', strtotime($second_day_date3));

  $thrice_date3 = date('Y-m-d', strtotime($thrice_date2. '+ 7 days'));
  $thrice_days3 = date('l', strtotime($thrice_date3));


  //four week data
  $firstday_date4 = date('Y-m-d', strtotime($firstday_date3. '+ 7 days'));
  $firstday_day4  = date('l', strtotime($firstday_date4));
  
  $second_day_date4  = date('Y-m-d', strtotime($second_day_date3. '+ 7 days'));
  $second_day_week4  = date('l', strtotime($second_day_date4));

  $thrice_date4 = date('Y-m-d', strtotime($thrice_date3. '+ 7 days'));
  $thrice_days4 = date('l', strtotime($thrice_date4));

  
}


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

<!-- <span class="working-tittle pl-0">Working Shift</span>  -->
<span class="working-tittle pl-0">Price</span>


<p class="working-day mt-3">

<!-- <?php echo $shiftdata->from_time;?> to <?php echo $shiftdata->to_time;?> -->
<?php echo $plan_price;?> KD
</p>

</div>

<div class="col-lg-6 col-12 text-center">

<!-- <span class="working-tittle pl-0">Working Day</span> 



<p class="working-day mt-3">

<?php echo $day_name;?>

</p> -->

<span class="working-tittle pl-0">Plan</span> 



<p class="working-day mt-3">

<!-- <?php echo $day_name;?> -->

<?php if($plan_type == '0'){ echo "At a time";}else if($plan_type == '1'){ echo "Once a Week";}else if($plan_type == '2'){ echo "Twice a Week";}else if($plan_type == '3'){ echo "Thrice a Week";} ?>
</p>

</div>





<div class="col-lg-12 col-12 mt-3">

<div class="table-responsive mt0">

<table class="table">

<thead class="thead-light">

<tr>

<!-- <th scope="col"><?php echo $shiftdata->hours?> hour visits</th>

<th scope="col">Visits</th>

<th scope="col">Price</th> -->

<th scope="col">Day</th> 

<th scope="col">Date</th> 

<!-- <th scope="col">Shift</th>  -->

<th scope="col">Hours </th>

<!-- <th scope="col">Price</th>  -->





</tr>

</thead>

<tbody>



<!-- <td><?php if($plan_type == '0'){ echo "At a time";}else if($plan_type == '1'){ echo "Once a Week";}else if($plan_type == '2'){ echo "Twice a Week";}else if($plan_type == '3'){ echo "Thrice a Week";} ?>
</td> -->


<?php if($plan_type == '0'){
 echo "<tr>";
 echo "<td>".$week_name1."</td> <td>".$week1."</td> <td>".$shiftdata->hours. " hrs</td>";
 echo "</tr>";

}else if($plan_type == '1'){

 echo "<tr>";
 echo "<td>".$week_name1."</td> <td>".$week1."</td> <td>".$shiftdata->hours. "hrs</td>";
 echo "<tr>";

 echo "<tr>";
 echo "<td>".$week_name2."</td> <td>".$week2."</td> <td>".$shiftdata->hours. "hrs</td>";
 echo "<tr>";

 echo "<tr>";
 echo "<td>".$week_name3."</td> <td>".$week3."</td> <td>".$shiftdata->hours. "hrs</td>";
 echo "<tr>";

 echo "<tr>";
 echo "<td>".$week_name4."</td> <td>".$week4."</td> <td>".$shiftdata->hours. "hrs</td>";
 echo "<tr>";


}else if($plan_type == '2'){ 

 echo "<tr>";
 echo "<td>".$firstday_day1."</td> <td>".$firstday_date1."</td> <td>".$shiftdata->hours. "hrs</td>";
 echo "<tr>";

 echo "<tr>";
 echo "<td>".$second_day_week1."</td> <td>".$second_day_date1."</td> <td>".$shiftdata->hours. "hrs</td>";
 echo "<tr>";

 echo "<tr>";
 echo "<td>".$firstday_day2."</td> <td>".$firstday_date2."</td> <td>".$shiftdata->hours. "hrs</td>";
 echo "<tr>";

 echo "<tr>";
 echo "<td>".$second_day_week2."</td> <td>".$second_day_date2."</td> <td>".$shiftdata->hours. "hrs</td>";
 echo "<tr>";


 echo "<tr>";
 echo "<td>".$firstday_day3."</td> <td>".$firstday_date3."</td> <td>".$shiftdata->hours. "hrs</td>";
 echo "<tr>";

 echo "<tr>";
 echo "<td>".$second_day_week3."</td> <td>".$second_day_date3."</td> <td>".$shiftdata->hours. "hrs</td>";
 echo "<tr>";

 echo "<tr>";
 echo "<td>".$firstday_day4."</td> <td>".$firstday_date4."</td> <td>".$shiftdata->hours. "hrs</td>";
 echo "<tr>";

 echo "<tr>";
 echo "<td>".$second_day_week4."</td> <td>".$second_day_date4."</td> <td>".$shiftdata->hours. "hrs</td>";
 echo "<tr>";

}else if($plan_type == '3'){

 echo "<tr>";
 echo "<td>".$firstday_day1."</td> <td>".$firstday_date1."</td> <td>".$shiftdata->hours. "hrs</td>";
 echo "<tr>";

 echo "<tr>";
 echo "<td>".$second_day_week1."</td> <td>".$second_day_date1."</td> <td>".$shiftdata->hours. "hrs</td>";
 echo "<tr>";

 echo "<tr>";
 echo "<td>".$thrice_days1."</td> <td>".$thrice_date1."</td> <td>".$shiftdata->hours. "hrs</td>";
 echo "<tr>";

 echo "<tr>";
 echo "<td>".$firstday_day2."</td> <td>".$firstday_date2."</td> <td>".$shiftdata->hours. "hrs</td>";
 echo "<tr>";

 echo "<tr>";
 echo "<td>".$second_day_week2."</td> <td>".$second_day_date2."</td> <td>".$shiftdata->hours. "hrs</td>";
 echo "<tr>";

 echo "<tr>";
 echo "<td>".$thrice_days2."</td> <td>".$thrice_date2."</td> <td>".$shiftdata->hours. "hrs</td>";
 echo "<tr>";

 echo "<tr>";
 echo "<td>".$firstday_day3."</td> <td>".$firstday_date3."</td> <td>".$shiftdata->hours. "hrs</td>";
 echo "<tr>";

 echo "<tr>";
 echo "<td>".$second_day_week3."</td> <td>".$second_day_date3."</td> <td>".$shiftdata->hours. "hrs</td>";
 echo "<tr>";

 echo "<tr>";
 echo "<td>".$thrice_days3."</td> <td>".$thrice_date3."</td> <td>".$shiftdata->hours. "hrs</td>";
 echo "<tr>";

 echo "<tr>";
 echo "<td>".$firstday_day4."</td> <td>".$firstday_date4."</td> <td>".$shiftdata->hours. "hrs</td>";
 echo "<tr>";

 echo "<tr>";
 echo "<td>".$second_day_week4."</td> <td>".$second_day_date4."</td> <td>".$shiftdata->hours. "hrs</td>";
 echo "<tr>";

 echo "<tr>";
 echo "<td>".$thrice_days4."</td> <td>".$thrice_date4."</td> <td>".$shiftdata->hours. "hrs</td>";
 echo "<tr>";
} 
 ?>



<!-- <?php echo $plan_price;?> KD -->
<!-- <td>11:00 AM to 12:00 PM</td> -->
<!-- <?php echo $plan_price;?> KD -->

<!-- <td> <?php if($plan_type == '0'){ echo "1";}else if($plan_type == '1'){ echo "4";}else if($plan_type == '2'){ echo "8";}else if($plan_type == '3'){ echo "12";} ?></td> -->



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



<img class="w-75" src="<?php echo base_url();?>assets/images/jobers-vector.jpg">

</div>	

<?php 
//check coupon is applied or not
$coupon       = $this->session->userdata('coupon'); 
$get_reward   = $this->Model->getData('reward_price',array('id' => 1));
$add_discount = $get_reward->discount;

$toldprice    = $get_sch->price ;


if(!empty($coupon)){

    $plan_price = $plan_price - $add_discount;

    }else{

    $plan_price = $plan_price;
    
    }
?>





<div class="col-lg-12 col-12">
<h2 class="text-center">Total: <span class="tprice"><?php echo $plan_price;?> KD</span></h2>
<input type="hidden" name="totalprice" class="totalprice" value="<?php echo $plan_price;?>"> 
<input type="hidden" name="toldprice" class="toldprice" value="<?php echo $toldprice;?>"> 
</div> 
<div class="col-lg-12 col-12 mt-2 col-12">
    <p class="text-center click-input">Have A Coupon Code <span class="badge">?</span> 
    </p>

        <small class="emp_coupon"></small>
      
      <div class="">
        <form id="myform">
        <div class="input-group submit-coupon" style="display:none;">
       
        <input type="text" class="form-control" name="coupon" placeholder="Coupon Code" aria-describedby="">

         <div class="input-group-prepend">
          <span class="input-group-text" > <button class="btn text-white btn-coupon" type="submit">Submit</button></span>


        </div>


        <small class="remove_coupon" style="display: none;"><a href="javascript:void(0)" class="text-danger btn-remove">Remove</a></small>
        
          <?php //if(!empty($coupon)){ ?>

          <!-- <small class="remove_coupon"><a href="javascript:void(0)" class="text-danger btn-remove">Remove</a></small> -->

          <?php //} ?>

       
      </div>


      </form>

    </div>    

<div>	



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

<?php
if($this->session->userdata('user_email') ==''){
?>
<a href="<?php echo base_url();?>user/checkout/<?php echo $scheduler_id;?>/<?php echo $search_id;?>" class="btn btn-thm mt-2 mb-2">Hire me</a>

<?php }else{ ?>

<!-- <a href="" class="btn btn-thm mt-2 mb-2">Hire me</a> -->




<form method="post" action="<?php echo base_url();?>user/pay">

<div class="form-group">
<select name="main_address" class="selectpicker w100 show-tick" data-show-subtext="false" data-live-search="true">

<?php 
$user_id    = $this->session->userdata('user_id');
$user_addrs = "SELECT * FROM `user_addrs` WHERE uid='$user_id'";
$user_addrs = $this->Model->getSqlData($user_addrs);
?>

<?php foreach($user_addrs as $area_c){ ?>

<option value="<?php echo $area_c['address'];?>"><?php echo $area_c['address'];?></option>

<?php } ?>

</select>

</div>
  
  <?php if($plan_type =='0'){ ?>
  <input type="hidden" name="start_date" value="<?php echo $week1;?>">
  <?php }else{ ?>
	<input type="hidden" name="start_date" value="<?php echo $start_date;?>">
  <?php } ?>

	<input type="hidden" name="scheduler_id" value="<?php echo $scheduler_id;?>">
	<button type="submit" class="btn btn-thm mt-2 mb-2">Hire me <i class="fa fa-angle-right"></i> </button>
</form>

<?php } ?>

<!-- <a href="<?php echo base_url();?>home/thank_you" class="btn btn-thm mt-2 mb-2">Hire me</a> -->

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
</script>

<script type="text/javascript">
$(document).ready(function(){
  $(".click-input").click(function(){
    $(".submit-coupon").toggle();
  });
});
</script>


<script type="text/javascript">

  $(document).ready(function() {
   <?php if(!empty($coupon)){ ?>
    $(".remove_coupon").show();
   
   <?php } ?>

      $(".btn-coupon").click(function(e){
        e.preventDefault();

        var coupon     = $("input[name='coupon']").val();
        var totalprice = $("input[name='totalprice']").val();
           
          $.ajax({
              url: "<?php echo base_url();?>home/add_discount",
              type:'POST',
              dataType: "json",
              data: {coupon:coupon,totalprice:totalprice},
              success: function(data) {
                  if (data.status=='success') {

                    //$("#myform")[0].reset();
                    $(".emp_coupon").html('<p style="color:green;">'+data.response+'</p>');
                    $(".tprice").html(data.rm_price);
                    $(".remove_coupon").show();

                  }else{
                    $(".emp_coupon").html('<p style="color:red;">'+data.response+'</p>');

                  }
              }
          });


      }); 


  });


      $(".btn-remove").click(function(e){
        e.preventDefault();

        var coupon      = "<?php echo $coupon; ?>";
        var totalprice  = $("input[name='totalprice']").val();
        var toldprice   = $("input[name='toldprice']").val();
        
          $.ajax({
              url: "<?php echo base_url();?>home/remove_discount",
              type:'POST',
              dataType: "json",
              data: {coupon:coupon,totalprice:totalprice,toldprice:toldprice},
              success: function(data) {
                  
                  if (data.status=='success') {
                    
                    $("#myform")[0].reset();

                    $(".emp_coupon").html('<p style="color:green;">'+data.response+'</p>');
                    
                    $(".tprice").html(data.rm_price);

                    $(".remove_coupon").hide();





                  }else{
                    $(".emp_coupon").html('<p style="color:red;">'+data.response+'</p>');

                  }
              }
          });


      }); 

</script>

</body>
</html>