<!--//main-row--->

<?php if(!empty($booking)){ ?>
<?php if(is_array($booking)): ?>

<?php 
$i = 1;
foreach($booking as $booking_job ){ 

  $job_id      = $booking_job['job_id'];
  $book_date   = $booking_job['book_date'];
  $day         = $booking_job['day'];
  $job_empid   = $booking_job['emp_id'];
  $job_primary = $booking_job['id'];
  $job_status  = $booking_job['status'];
  
                //get schedul job data 
  $getjobdata = $this->Model->getData('job_scheduler',array('scheduler_id'=>$job_id));
  $emp_id = $getjobdata->emp_id;
  $shift  = $getjobdata->shift;
  $area   = $getjobdata->area_code;
  $plan_type = $getjobdata->plan_type;
                 
  if($job_empid == $emp_id){
  //get employee data 
  $getudata = $this->Model->getData('cleanner',array('emp_id'=>$emp_id));
  $fullname = $getudata->fullname;
  }else{

  //get employee data 
  $getudata = $this->Model->getData('cleanner',array('emp_id'=>$job_empid));
  $fullname = $getudata->fullname;

  }
  

  //get shift data 
  $getshiftdata = $this->Model->getData('shift',array('shift_id'=>$shift));
  $shift_f = $getshiftdata->from_time;
  $shift_t = $getshiftdata->to_time;
  $shift_h = $getshiftdata->hours;


?>
        

<div class="row my-1 px-0 mx-0 align-items-center d-flex bg-white mb-1 bdr-hadow">

<div class="col-11 px-1">

<div class="row">

<div class="col-12">
<p class="font-18 px-0 mb-0 custom-heading-clr"><strong><?php echo $fullname;?></strong></p>
</div>

<div class="col-3">
<span class="nam"><strong class="custom-heading-clr">Start Date</strong> <br><?php echo $book_date;?></span>
</div>	

<div class="col-3">
<span class="nam"><strong class="custom-heading-clr">Plan</strong><br> <?php if($plan_type == '0'){ echo "At A Time"; } else if($plan_type == '1'){ echo "Once A Week";}else if($plan_type == '2'){ echo "Twice A Week";}else if($plan_type == '3'){ echo "Thrice A Week";}?></span>
</div>

<div class="col-3">
<span class="nam"><strong class="custom-heading-clr">Day</strong><br> <?php echo $day;?></span>
</div>

<div class="col-3">
<span class="nam"><strong class="custom-heading-clr">Status</strong><br> <?php if($job_status == '1'){ echo '<i class="badge badge-success">Booked</i>'; }else if($job_status == '2'){ echo '<i class="badge badge-danger">Cancelled</i>';}?></span>
</div>

<div class="col-12">
<span class="nam"><strong class="custom-heading-clr">Shift</strong>  <?php echo $shift_f;?> to <?php echo $shift_t;?> <?php echo $shift_h;?> hrs</span>
</div>



</div>	<!--inner row--->



</div>	<!----// col-10---->

<div class="col-1">
<?php if($job_status == '1'){ ?>


<a href="javascript:(void)" class="text-danger" data-href="<?php echo base_url();?>user/deny_day/<?php echo $job_primary?>" data-toggle="modal" data-target="#confirm-deny"><i class="fa fa-trash text-danger font-22"></i></a>


<?php } else{ ?>

<a href="javascript:(void)" class="text-danger"><i class="fa fa-trash text-danger font-22"></i></a>

<?php } ?>



</div>		




</div><!--//main-row--->

<?php $i++; } ?>
<?php endif; ?>

<?php 
 }else{

    echo '<div class="col-12 mx-auto">
    <center>
  <img class="img-fluid w-25" src="https://sharukh.dbtechserver.online/housekeeper/assets/images/no-data.png">
  <h2 class="text-capitalize">Oops! no data found please search again...</h2>
  </center>
  
  </div>';

   }
?>

