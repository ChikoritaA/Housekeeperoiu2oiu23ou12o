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

td a, td {
    white-space: nowrap;
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
<h2 class="text-black font-w600 mb-0">Upcoming Jobs</h2>
</div>

<form method="" action="" class="form">
<div class="row">
<div class="col-xl-12">
<div class="card">
<div class="card-body">

<div class="row">

<div class="col-12">
<!-- alert start -->
<?php if($this->session->flashdata('not_done')){ ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('not_done'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('not_done'); } ?>

<?php if($this->session->flashdata('job_done')){ ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('job_done'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('job_done'); } ?>
<!-- alert start -->

<div class="table-responsive">
<table id="example22" class="display table w-100" >
<thead>
<tr>
<th>#</th>
<th>Client Name</th>
<th>Plan</th>
<th>Shift</th>
<th>Area Code</th>
<th>Day</th>
<th>Start Date</th>
<th>View Details</th>
<th>Action</th>
</tr>
</thead>

<tbody>
<?php if(is_array($upcoming_jobs)): ?>

<?php 
$i = 1;
foreach($upcoming_jobs as $upcomingjobs ){ 

$job_id      = $upcomingjobs['job_id'];
$book_date   = $upcomingjobs['book_date'];
$day         = $upcomingjobs['day'];
$user_id     = $upcomingjobs['user_id'];
$uniqid      = $upcomingjobs['uniqid'];
$job_primary      = $upcomingjobs['id'];

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
<td><?php echo $fullname;?></td>
<td><?php if($plan_type == '0'){ echo "At A Time"; } else if($plan_type == '1'){ echo "Once A Week";}else if($plan_type == '2'){ echo "Twice A Week";}else if($plan_type == '3'){ echo "Thrice A Week";}?></td>
<td><?php echo $shift_f;?> to <?php echo $shift_t;?> <?php echo $shift_h;?> hrs</td>


<td><?php echo $area;?></td>
<td><?php echo $day;?></td>
<td><?php echo $book_date;?></td>
<td><a href="<?php echo base_url();?>employee/view_client_profile/<?php echo $user_id ;?>/<?php echo $uniqid ;?>" class="custom-btn"> View </a></td>
<td>
<a data-href="<?php echo base_url();?>employee/job_done/<?php echo $job_primary ;?>" data-toggle="modal" data-target="#confirm-done" class="btn btn-square btn-success text-white"><i class="la la-magic"></i> Job Done! </a>
</td>

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

<!-- Modal -->

<div class="modal fade" id="confirm-done" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title" id="myModalLabel">Confirm  your Job is done?</h4>
</div>

<div class="modal-body">
<p>Are you sure!</p>
<!-- <p class="debug-url"></p> -->
</div>

<div class="modal-footer">
<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
<a class="btn btn-success btn-ok">Done</a>
</div>
</div>
</div>
</div>
<!---Modal ---> 



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

<script>
$('#confirm-done').on('show.bs.modal', function(e) {
$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

});
</script>



</body>

</html>