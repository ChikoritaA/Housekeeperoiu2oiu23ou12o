<!DOCTYPE html>
<html lang="en">

<head>

<!--*******************
css meta titlal include
********************-->

<?php include(APPPATH.'views/admin/include/css.php'); ?>


<link rel="stylesheet" type="text/css" href=" https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">





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
<!-- row -->
<div class="container-fluid">
<div class="form-head mb-4">
<h2 class="text-black font-w600 mb-0">Complete Jobs</h2>
</div>

<form method="" action="" class="form">
<div class="row">
<div class="col-xl-12">
<div class="card">
<div class="card-body">

<div class="row">

<div class="col-12">

<div class="table-responsive">
<table id="example22" class="display table" >
<thead>
<tr>

<th>#</th>
<th>Client Name</th>
<th>Plan</th>
<th>Shift</th>
<th>Area Code</th>
<th>Day</th>
<th>Start Date</th>
<th>Status</th>

</tr>
</thead>
<tbody>

<?php if(is_array($complted_job)): ?>

<?php 
$i = 1;
foreach($complted_job as $complted_jobhere ){ 

$job_id      = $complted_jobhere['job_id'];
$book_date   = $complted_jobhere['book_date'];
$day         = $complted_jobhere['day'];
$user_id     = $complted_jobhere['user_id'];
$uniqid      = $complted_jobhere['uniqid'];

//get schedul job data 
$getjobdata = $this->Model->getData('job_scheduler',array('scheduler_id'=>$job_id));
$emp_id = $getjobdata->emp_id;
$shift  = $getjobdata->shift;
$area   = $getjobdata->area_code;
$plan_type = $getjobdata->plan_type;

//get users data 
$getudata = $this->Model->getData('users',array('user_id'=>$user_id));
$fullname = $getudata->fullname;
//get shift data 
$getshiftdata = $this->Model->getData('shift',array('shift_id'=>$shift));
$shift_f = $getshiftdata->from_time;
$shift_t = $getshiftdata->to_time;
$shift_h = $getshiftdata->hours;

$currentdate = date('Y-m-d');

?>
<tr>

<td><?php echo $i; ?> </td>
<td><?php  echo $fullname;?></td>
<td><?php if($plan_type == '0'){ echo "At A Time"; } else if($plan_type == '1'){ echo "Once A Week";}else if($plan_type == '2'){ echo "Twice A Week";}else if($plan_type == '3'){ echo "Thrice a week";}?></td>
<td><?php echo $shift_f;?> to <?php echo $shift_t;?> <?php echo $shift_h;?> hrs</td>


<td><?php echo $area;?></td>
<td><?php echo $day;?></td>
<td><?php echo $book_date;?></td>

<td><a class="badge badge-success text-white">Done</a></td>

</tr>
<?php  $i++; } ?>
<?php endif; ?>


</tbody>
</table>
</div>
</div>




</div> <!----row--->
</div><!----card-body--->
</div>
</div>


</div>

</form>
<!--/form-->


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
<script src=" https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
$('#example22').DataTable();
} );

</script>



</body>

</html>